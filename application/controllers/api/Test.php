<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Test extends REST_Controller {

	function __construct($config = 'rest'){
        // Construct the parent class
        parent::__construct($config);
    }

	function index_get(){
		$id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, REST_Controller::HTTP_OK);
	}

	function index_post(){
		$data = array(
            'nama'		=> $this->post('nama'),
            'nomor'		=> $this->post('nomor')
        );

        $insert = $this->db->insert('telepon', $data);

        if ($insert) {
            $this->response(array( 'status' => 'ok', 'data' => $data , 'msg' => 'Sukses input data'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', REST_Controller::HTTP_BAD_GATEWAY));
        }
	}
}