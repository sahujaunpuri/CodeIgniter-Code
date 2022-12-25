<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model{
	
	function get_country(){
		$query = $this->db->get('country');
		return $query;	
	}

	function get_sub_country($country_id){
		$query = $this->db->get_where('state', array('country_id' => $country_id));
		return $query;
	}
	
	function save_city($city_name,$country_id,$state_id,$zip_code){
		$data = array(
			'city_name' => $city_name,
			'zip_code' => $zip_code,
			'country_id' => $country_id,
			'state_id' => $state_id 
		);
		$this->db->insert('city',$data);
	}

	function get_citys(){
		$this->db->select('city_id,city_name,zip_code,country_name,state_name');
		$this->db->from('city');
		$this->db->join('country','country.country_id = city.country_id','left');
		$this->db->join('state','state.state_id = city.state_id','left');	
		$query = $this->db->get();
		return $query;
	}

	function get_city_by_id($city_id){
		$query = $this->db->get_where('city', array('city_id' =>  $city_id));
		return $query;
	}

	function update_city($city_id,$city_name,$country_id,$state_id,$zip_code){
		$this->db->set('city_name', $city_name);
		$this->db->set('zip_code', $zip_code);
		$this->db->set('country_id', $country_id);
		$this->db->set('state_id', $state_id);
		$this->db->where('city_id', $city_id);
		$this->db->update('city');
	}

	//Delete City
	function delete_city($city_id){
		$this->db->delete('city', array('city_id' => $city_id));
	}

	
}