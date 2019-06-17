<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    /**
     * This function is used to get the customer listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function customerListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.customerId, BaseTbl.name, BaseTbl.mobile, BaseTbl.address, BaseTbl.createdDtm');
        $this->db->from('tbl_customers as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    
    /**
     * This function is used to get the customer listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function customerListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.customerId, BaseTbl.name, BaseTbl.mobile, BaseTbl.address, BaseTbl.createdDtm');
        $this->db->from('tbl_customers as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.customerId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

    /**
     * This function is used to add new customer to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCustomer($customerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customers', $customerInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function used to get customer information by id
     * @param number $customerId : This is customer id
     * @return array $result : This is customer information
     */
    function getcustomerInfo($customerId)
    {
        $this->db->select('customerId, name, mobile, address');
        $this->db->from('tbl_customers');
        $this->db->where('isDeleted', 0);
        $this->db->where('customerId', $customerId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the customer information
     * @param array $customerInfo : This is customers updated information
     * @param number $customerId : This is customer id
     */
    function editCustomer($customerInfo, $customerId)
    {
        $this->db->where('customerId', $customerId);
        $this->db->update('tbl_customers', $customerInfo);
        
        return TRUE;
    }    
    
    
    /**
     * This function is used to delete the customer information
     * @param number $customerId : This is customer id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCustomer($customerId, $customerInfo)
    {
        $this->db->where('customerId', $customerId);
        $this->db->update('tbl_customers', $customerInfo);
        
        return $this->db->affected_rows();
    }

    /**
     * This function used to get customer information by id
     * @param number $customerId : This is customer id
     * @return array $result : This is customer information
     */
    function getcustomerInfoById($customerId)
    {
        $this->db->select('customerId, name, mobile, address');
        $this->db->from('tbl_customers');
        $this->db->where('isDeleted', 0);
        $this->db->where('customerId', $customerId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get customer count
     */
    function getCustomerCount()
    {
        $this->db->select('customerId AS customerCount');
        $this->db->from('tbl_customers');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

}

  