<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Customer extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the customer list
     */
    function customerListing()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->customer_model->customerListingCount($searchText);

			$returns = $this->paginationCompress ( "customerListing/", $count, 10 );
            
            $data['customerRecords'] = $this->customer_model->customerListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'LaundryKu : Customer Listing';
            
            $this->loadViews("customers/customers", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCustomer()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('customer_model');
            
            $this->global['pageTitle'] = 'LaundryKu : Add New Customer';

            $this->loadViews("customers/addnewcustomer", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new customer to the system
     */
    function SaveNewCustomer()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addCustomer();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $address = $this->security->xss_clean($this->input->post('address'));
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $customerInfo = array('name'=> $name, 'mobile'=>$mobile, 'address'=>$address, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('customer_model');
                $result = $this->customer_model->addNewCustomer($customerInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Customer created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Customer creation failed');
                }
                
                redirect('addcustomer');
            }
        }
    }

    
    /**
     * This function is used load customer edit information
     * @param number $customerId : Optional : This is customer id
     */
    function editOld($customerId = NULL)
    {
        if($this->isEmployee() == TRUE || $customerId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($customerId == null)
            {
                redirect('customerListing');
            }
            
            $data['customerInfo'] = $this->customer_model->getcustomerInfo($customerId);
            
            $this->global['pageTitle'] = 'LaundryKu : Edit Customer';
            
            $this->loadViews("customers/editoldcustomer", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the customer information
     */
    function editCustomer()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $customerId = $this->input->post('customerId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($customerId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $address = $this->security->xss_clean($this->input->post('address'));
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $customerInfo = array();
                
                $customerInfo = array('name'=>$name, 'mobile'=>$mobile, 'address'=>$address, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->customer_model->editCustomer($customerInfo, $customerId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Customer updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Customer updation failed');
                }
                
                redirect('customerlist');
            }
        }
    }


    /**
     * This function is used to delete the customer using customerId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCustomer()
    {
        if($this->isEmployee() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $customerId = $this->input->post('customerId');
            $customerInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->customer_model->deleteCustomer($customerId, $customerInfo);
            
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