<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Order extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the order list
     */
    function orderListing()
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
            
            $count = $this->order_model->orderListingCount($searchText);

			$returns = $this->paginationCompress ( "orderListing/", $count, 10 );
            
            $data['orderRecords'] = $this->order_model->orderListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'LaundryKu : Order Listing';
            
            $this->loadViews("orders/orders", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the finished order list
     */
    function finishedorderListing()
    {
        if($this->isAdmin() == TRUE && $this->isManager() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->order_model->finishedorderListingCount($searchText);

            $returns = $this->paginationCompress ( "finishedorderListing/", $count, 10 );
            
            $data['orderRecords'] = $this->order_model->finishedorderListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'LaundryKu : Finished Order Listing';
            
            $this->loadViews("orders/finishedorders", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addOrder()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            $data['cusroles'] = $this->order_model->getCustomerRoles();
            $data['svcroles'] = $this->order_model->getServiceRoles();
            
            $this->global['pageTitle'] = 'LaundryKu : Add New Order';

            $this->loadViews("orders/addneworder", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new order to the system
     */
    function SaveNewOrder()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('cusrole','Customer Role','trim|required|numeric');
            $this->form_validation->set_rules('svcrole','Service Role','trim|required|numeric');
            $this->form_validation->set_rules('weight','Weight','required|min_length[1]|max_length[99]');
            $this->form_validation->set_rules('memo','Memo','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addOrder();
            }
            else
            {
                $customerId = $this->input->post('cusrole');
                $serviceId = $this->input->post('svcrole');                
                $weight = $this->input->post('weight');
                $price = $this->order_model->getServicePriceRoles($serviceId);
                $memo = $this->security->xss_clean($this->input->post('memo'));
                
                $cost = $price->price;
                
                $orderInfo = array('customerId'=> $customerId, 'serviceId'=> $serviceId, 'stageId'=> 1, 'weight'=>$weight, 'cost'=>$cost, 'memo'=>$memo, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('order_model');
                $result = $this->order_model->addNewOrder($orderInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Order created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Order creation failed');
                }
                
                redirect('addorder');
            }
        }
    }

    
    /**
     * This function is used load order edit information
     * @param number $orderId : Optional : This is order id
     */
    function editOld($orderId = NULL)
    {
        if($this->isEmployee() == TRUE || $orderId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($orderId == null)
            {
                redirect('orderListing');
            }
            
            $data['stages']  = $this->order_model->getStageRoles();
            $data['orderInfo'] = $this->order_model->getorderInfo($orderId);
            
            $this->global['pageTitle'] = 'LaundryKu : Edit Order';
            
            $this->loadViews("orders/editoldorder", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the order information
     */
    function editOrder()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $orderId = $this->input->post('orderId');
            
            $this->form_validation->set_rules('stgrole','Stage Role','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($orderId);
            }
            else
            {
                
                $stageId = $this->input->post('stgrole');   
                
                $orderInfo = array();
                
                $orderInfo = array('stageId'=>$stageId, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->order_model->editOrder($orderInfo, $orderId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Order updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Order updation failed');
                }
                
                redirect('orderlist');
            }
        }
    }


    /**
     * This function is used to delete the order using orderId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOrder()
    {
        if($this->isEmployee() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $orderId = $this->input->post('orderId');
            $orderInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->order_model->deleteOrder($orderId, $orderInfo);
            
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