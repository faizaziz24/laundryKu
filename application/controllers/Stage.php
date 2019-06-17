<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Stage extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('stage_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the stage list
     */
    function stageListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->stage_model->stageListingCount($searchText);

			$returns = $this->paginationCompress ( "stageListing/", $count, 10 );
            
            $data['stageRecords'] = $this->stage_model->stageListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'LaundryKu : Stage Listing';
            
            $this->loadViews("stages/stages", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addStage()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('stage_model');
            
            $this->global['pageTitle'] = 'LaundryKu : Add New Stage';

            $this->loadViews("stages/addnewstage", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new stage to the system
     */
    function SaveNewStage()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('description','Description','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addStage();
            }
            else
            {
                $stage = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $stageInfo = array('stage'=> $stage, 'description'=>$description, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('stage_model');
                $result = $this->stage_model->addNewStage($stageInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Stage created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Stage creation failed');
                }
                
                redirect('addstage');
            }
        }
    }

    
    /**
     * This function is used load stage edit information
     * @param number $stageId : Optional : This is stage id
     */
    function editOld($stageId = NULL)
    {
        if($this->isAdmin() == TRUE || $stageId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($stageId == null)
            {
                redirect('stageListing');
            }
            
            $data['stageInfo'] = $this->stage_model->getstageInfo($stageId);
            
            $this->global['pageTitle'] = 'LaundryKu : Edit Stage';
            
            $this->loadViews("stages/editoldstage", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the stage information
     */
    function editStage()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $stageId = $this->input->post('stageId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('description','description','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($stageId);
            }
            else
            {
                $stage = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $stageInfo = array();
                
                $stageInfo = array('stage'=>$stage, 'description'=>$description, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->stage_model->editStage($stageInfo, $stageId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Stage updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Stage updation failed');
                }
                
                redirect('stagelist');
            }
        }
    }


    /**
     * This function is used to delete the stage using stageId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStage()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $stageId = $this->input->post('stageId');
            $stageInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->stage_model->deleteStage($stageId, $stageInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'LaundryKu : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

}

?>