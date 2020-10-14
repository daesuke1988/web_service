<?php

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Customers extends REST_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get()
    {
        $id = $this->get('customerid');
        if (!empty($id)) {
            $customers = $this->db->get_where("customers", ['customerid' => $id]);
        } else {
            $customers = $this->db->get("customers");
        }

        $response = array();

        foreach ($customers->result() as $hasil) {

            $response[] = array(
                'customerid'    => $hasil->customerid,
                'companyname'   => $hasil->companyname,
                'contactname'   => $hasil->contactname,
                'contacttitle'  => $hasil->contacttitle,
                'address'       => $hasil->address,
                'city'          => $hasil->city,
            );
        }

        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: GET');

        echo json_encode(
            array(
                'took' => microtime(true),
                'code' => 200,
                'message' => 'Respone successfully',
                'data'    => $response
            )
        );
    }
}
