<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
    /**
     * This function is used to get the service listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function serviceListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.serviceId, BaseTbl.service, BaseTbl.price, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_services as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(  BaseTbl.description  LIKE '%".$searchText."%'
                            OR  BaseTbl.service  LIKE '%".$searchText."%'
                            OR  BaseTbl.price  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    
    /**
     * This function is used to get the service listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function serviceListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.serviceId, BaseTbl.service, BaseTbl.price, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_services as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.description  LIKE '%".$searchText."%'
                            OR  BaseTbl.service  LIKE '%".$searchText."%'
                            OR  BaseTbl.price  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.serviceId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

    /**
     * This function is used to add new service to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewService($serviceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_services', $serviceInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function used to get service information by id
     * @param number $serviceId : This is service id
     * @return array $result : This is service information
     */
    function getserviceInfo($serviceId)
    {
        $this->db->select('serviceId, service, price, description');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('serviceId', $serviceId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the service information
     * @param array $serviceInfo : This is services updated information
     * @param number $serviceId : This is service id
     */
    function editService($serviceInfo, $serviceId)
    {
        $this->db->where('serviceId', $serviceId);
        $this->db->update('tbl_services', $serviceInfo);
        
        return TRUE;
    }    
    
    
    /**
     * This function is used to delete the service information
     * @param number $serviceId : This is service id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteService($serviceId, $serviceInfo)
    {
        $this->db->where('serviceId', $serviceId);
        $this->db->update('tbl_services', $serviceInfo);
        
        return $this->db->affected_rows();
    }

    /**
     * This function used to get service information by id
     * @param number $serviceId : This is service id
     * @return array $result : This is service information
     */
    function getserviceInfoById($serviceId)
    {
        $this->db->select('serviceId, service, price, description');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $this->db->where('serviceId', $serviceId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get service count
     */
    function getServiceCount()
    {
        $this->db->select('serviceId AS serviceCount');
        $this->db->from('tbl_services');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
}

  