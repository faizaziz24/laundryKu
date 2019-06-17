<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Service extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the service list
     */
    function serviceListing()
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
            
            $count = $this->service_model->serviceListingCount($searchText);

			$returns = $this->paginationCompress ( "serviceListing/", $count, 10 );
            
            $data['serviceRecords'] = $this->service_model->serviceListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'LaundryKu : Service Listing';
            
            $this->loadViews("services/services", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addService()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('service_model');
            
            $this->global['pageTitle'] = 'LaundryKu : Add New Service';

            $this->loadViews("services/addnewservice", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new service to the system
     */
    function SaveNewService()
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
            $this->form_validation->set_rules('price','Price','required|min_length[4]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addService();
            }
            else
            {
                $service = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $description = $this->security->xss_clean($this->input->post('description'));
                $price = $this->security->xss_clean($this->input->post('price'));
                
                $serviceInfo = array('service'=> $service, 'price'=>$price, 'description'=>$description, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('service_model');
                $result = $this->service_model->addNewService($serviceInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Service created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service creation failed');
                }
                
                redirect('addservice');
            }
        }
    }

    
    /**
     * This function is used load service edit information
     * @param number $serviceId : Optional : This is service id
     */
    function editOld($serviceId = NULL)
    {
        if($this->isAdmin() == TRUE || $serviceId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($serviceId == null)
            {
                redirect('serviceListing');
            }
            
            $data['serviceInfo'] = $this->service_model->getserviceInfo($serviceId);
            
            $this->global['pageTitle'] = 'LaundryKu : Edit Service';
            
            $this->loadViews("services/editoldservice", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the service information
     */
    function editService()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $serviceId = $this->input->post('serviceId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('description','Description','trim|required');
            $this->form_validation->set_rules('price','Price','required|min_length[4]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($serviceId);
            }
            else
            {
                $service = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $description = $this->security->xss_clean($this->input->post('description'));
                $price = $this->security->xss_clean($this->input->post('price'));
                
                $serviceInfo = array();
                
                $serviceInfo = array('service'=>$service, 'price'=>$price, 'description'=>$description, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->service_model->editService($serviceInfo, $serviceId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Service updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service updation failed');
                }
                
                redirect('servicelist');
            }
        }
    }


    /**
     * This function is used to delete the service using serviceId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteService()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $serviceId = $this->input->post('serviceId');
            $serviceInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->service_model->deleteService($serviceId, $serviceInfo);
            
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