<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function orderListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.orderId, BaseTbl.weight, BaseTbl.cost, BaseTbl.memo, Stage.stage, Customer.name, Service.service, BaseTbl.createdDtm');
        $this->db->from('tbl_work_orders as BaseTbl');
        $this->db->join('tbl_work_order_stages as Stage', 'BaseTbl.stageId = Stage.stageId');
        $this->db->join('tbl_customers as Customer', 'BaseTbl.customerId = Customer.customerId');
        $this->db->join('tbl_services as Service', 'BaseTbl.serviceId = Service.serviceId');

        if(!empty($searchText)) {
            $likeCriteria = "(  Customer.name  LIKE '%".$searchText."%'
                            OR  Service.service  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Stage.stageId !=', 4);
        $query = $this->db->get();
        
        return $query->num_rows();
    }    
    
    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function orderListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.orderId, BaseTbl.weight, BaseTbl.cost, BaseTbl.memo, Stage.stage, Customer.name, Service.service, BaseTbl.createdDtm');
        $this->db->from('tbl_work_orders as BaseTbl');
        $this->db->join('tbl_work_order_stages as Stage', 'BaseTbl.stageId = Stage.stageId');
        $this->db->join('tbl_customers as Customer', 'BaseTbl.customerId = Customer.customerId');
        $this->db->join('tbl_services as Service', 'BaseTbl.serviceId = Service.serviceId');

        if(!empty($searchText)) {
            $likeCriteria = "(  Customer.name  LIKE '%".$searchText."%'
                            OR  Service.service  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Stage.stageId !=', 4);
        $this->db->order_by('BaseTbl.orderId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function finishedorderListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.orderId, BaseTbl.weight, BaseTbl.cost, BaseTbl.memo, Stage.stage, Customer.name, Service.service, BaseTbl.createdDtm');
        $this->db->from('tbl_work_orders as BaseTbl');
        $this->db->join('tbl_work_order_stages as Stage', 'BaseTbl.stageId = Stage.stageId');
        $this->db->join('tbl_customers as Customer', 'BaseTbl.customerId = Customer.customerId');
        $this->db->join('tbl_services as Service', 'BaseTbl.serviceId = Service.serviceId');

        if(!empty($searchText)) {
            $likeCriteria = "(  Customer.name  LIKE '%".$searchText."%'
                            OR  Service.service  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Stage.stageId', 4);
        $query = $this->db->get();
        
        return $query->num_rows();
    }    
    
    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function finishedorderListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.orderId, BaseTbl.weight, BaseTbl.cost, BaseTbl.memo, Stage.stage, Customer.name, Service.service, BaseTbl.createdDtm');
        $this->db->from('tbl_work_orders as BaseTbl');
        $this->db->join('tbl_work_order_stages as Stage', 'BaseTbl.stageId = Stage.stageId');
        $this->db->join('tbl_customers as Customer', 'BaseTbl.customerId = Customer.customerId');
        $this->db->join('tbl_services as Service', 'BaseTbl.serviceId = Service.serviceId');

        if(!empty($searchText)) {
            $likeCriteria = "(  Customer.name  LIKE '%".$searchText."%'
                            OR  Service.service  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Stage.stageId', 4);
        $this->db->order_by('BaseTbl.orderId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to add new order to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewOrder($orderInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_work_orders', $orderInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function used to get order information by id
     * @param number $orderId : This is order id
     * @return array $result : This is order information
     */
    function getorderInfo($orderId)
    {
        $this->db->select('BaseTbl.orderId, Customer.name, BaseTbl.serviceId, BaseTbl.stageId, BaseTbl.weight, BaseTbl.cost, BaseTbl.memo');
        $this->db->from('tbl_work_orders as BaseTbl');
        $this->db->join('tbl_customers as Customer', 'BaseTbl.customerId = Customer.customerId');
        $this->db->join('tbl_services as Service', 'BaseTbl.serviceId = Service.serviceId');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.orderId', $orderId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the order information
     * @param array $orderInfo : This is orders updated information
     * @param number $orderId : This is order id
     */
    function editOrder($orderInfo, $orderId)
    {
        $this->db->where('orderId', $orderId);
        $this->db->update('tbl_work_orders', $orderInfo);
        
        return TRUE;
    }    
    
    
    /**
     * This function is used to delete the order information
     * @param number $orderId : This is order id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOrder($orderId, $orderInfo)
    {
        $this->db->where('orderId', $orderId);
        $this->db->update('tbl_work_orders', $orderInfo);
        
        return $this->db->affected_rows();
    }

    /**
     * This function used to get order information by id
     * @param number $orderId : This is order id
     * @return array $result : This is order information
     */
    function getorderInfoById($orderId)
    {
        $this->db->select('orderId, customerId, serviceId, stageId, weight, cost, memo');
        $this->db->from('tbl_work_orders');
        $this->db->where('isDeleted', 0);
        $this->db->where('orderId', $orderId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function is used to get the customer roles information
     * @return array $result : This is result of the query
     */
    function getCustomerRoles()
    {
        $this->db->select('customerId, name');
        $this->db->from('tbl_customers');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the service roles information
     * @return array $result : This is result of the query
     */
    function getServiceRoles()
    {
        $this->db->select('serviceId, service, price');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the stage roles information
     * @return array $result : This is result of the query
     */
    function getStageRoles()
    {
        $this->db->select('stageId, stage, description');
        $this->db->from('tbl_work_order_stages');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the service price roles information
     * @return array $result : This is result of the query
     */
    function getServicePriceRoles($serviceId)
    {
        $this->db->select('price');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('serviceId', $serviceId);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  