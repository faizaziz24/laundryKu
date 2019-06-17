<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Stage_model extends CI_Model
{
    /**
     * This function is used to get the stage listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function stageListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.stageId, BaseTbl.stage, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_work_order_stages as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(  BaseTbl.description  LIKE '%".$searchText."%'
                            OR  BaseTbl.stage  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    
    /**
     * This function is used to get the stage listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function stageListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.stageId, BaseTbl.stage, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_work_order_stages as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.description  LIKE '%".$searchText."%'
                            OR  BaseTbl.stage  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.stageId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

    /**
     * This function is used to add new stage to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewStage($stageInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_work_order_stages', $stageInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function used to get stage information by id
     * @param number $stageId : This is stage id
     * @return array $result : This is stage information
     */
    function getstageInfo($stageId)
    {
        $this->db->select('stageId, stage, description');
        $this->db->from('tbl_work_order_stages');
        $this->db->where('isDeleted', 0);
        $this->db->where('stageId', $stageId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the stage information
     * @param array $stageInfo : This is stages updated information
     * @param number $stageId : This is stage id
     */
    function editStage($stageInfo, $stageId)
    {
        $this->db->where('stageId', $stageId);
        $this->db->update('tbl_work_order_stages', $stageInfo);
        
        return TRUE;
    }    
    
    
    /**
     * This function is used to delete the stage information
     * @param number $stageId : This is stage id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStage($stageId, $stageInfo)
    {
        $this->db->where('stageId', $stageId);
        $this->db->update('tbl_work_order_stages', $stageInfo);
        
        return $this->db->affected_rows();
    }

    /**
     * This function used to get stage information by id
     * @param number $stageId : This is stage id
     * @return array $result : This is stage information
     */
    function getstageInfoById($stageId)
    {
        $this->db->select('stageId, stage, description');
        $this->db->from('tbl_work_order_stages');
        $this->db->where('isDeleted', 0);
        $this->db->where('stageId', $stageId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get stage count
     */
    function getStageCount()
    {
        $this->db->select('stageId AS stageCount');
        $this->db->from('tbl_work_order_stages');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

}

  