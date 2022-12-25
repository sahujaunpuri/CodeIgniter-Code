<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('City_model','city_model');
		$this->load->library('session');
	}

	function index(){
		$data['citys'] = $this->city_model->get_citys();
		$this->load->view('city_list_view',$data);
	}

	// add new city
	function add_new(){
		$data['country'] = $this->city_model->get_country()->result();
		$this->load->view('add_city_view', $data);
	}

	// get sub country by country_id
	function get_sub_country(){
		$country_id = $this->input->post('id',TRUE);
		$data = $this->city_model->get_sub_country($country_id)->result();
		echo json_encode($data);
	}

	//save city to database
	function save_city(){
		$city_name 	= $this->input->post('city_name',TRUE);
		$country_id 	= $this->input->post('country',TRUE);
		$state_id = $this->input->post('state',TRUE);
		$zip_code 	= $this->input->post('zip_code',TRUE);
		$this->city_model->save_city($city_name,$country_id,$state_id,$zip_code);
		$this->session->set_flashdata('msg','<div class="alert alert-success">City Saved</div>');
		redirect('city');
	}

	function get_edit(){
		$city_id = $this->uri->segment(3);
		$data['city_id'] = $city_id;
		$data['country'] = $this->city_model->get_country()->result();
		$get_data = $this->city_model->get_city_by_id($city_id);
		if($get_data->num_rows() > 0){
			$row = $get_data->row_array();
			$data['sub_country_id'] = $row['state_id'];
		}
		$this->load->view('edit_city_view',$data);
	}

	function get_data_edit(){
		$city_id = $this->input->post('city_id',TRUE);
		$data = $this->city_model->get_city_by_id($city_id)->result();
		echo json_encode($data);
	}

	//update city to database
	function update_city(){
		$city_id 	= $this->input->post('city_id',TRUE);
		$city_name 	= $this->input->post('city_name',TRUE);
		$country_id 	= $this->input->post('country',TRUE);
		$state_id = $this->input->post('state',TRUE);
		$zip_code 	= $this->input->post('zip_code',TRUE);
		$this->city_model->update_city($city_id,$city_name,$country_id,$state_id,$zip_code);
		$this->session->set_flashdata('msg','<div class="alert alert-success">City Updated</div>');
		redirect('city');
	}

	//Delete City from Database
	function delete(){
		$city_id = $this->uri->segment(3);
		$this->city_model->delete_city($city_id);
		$this->session->set_flashdata('msg','<div class="alert alert-success">City Deleted</div>');
		redirect('city');
	}
}