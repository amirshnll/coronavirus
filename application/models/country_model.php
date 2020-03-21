<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class Country_model extends CI_Model {

	/* Public */
	public function __construct()
    {
        parent::__construct();
    }

	public function insert($name, $number_of_patients, $number_of_death, $updated_time) {
		$data = array (
			'name'					=> $name,
			'number_of_patients'	=> $number_of_patients,
			'number_of_death'		=> $number_of_death,
			'updated_time'			=> $updated_time
		);
		if( $this->db->insert('country', $data) )
			return true;
		else
			return false;
	}

	public function select($limit = 0) {
		$this->db->order_by('number_of_patients', 'DESC');
		if($limit === 0)
			$query = $this->db->get('country');
		else
			$query = $this->db->get('country', $limit);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function update($id, $name, $number_of_patients, $number_of_death, $updated_time) {
		$data = array (
			'name'					=> $name,
			'number_of_patients'	=> $number_of_patients,
			'number_of_death'		=> $number_of_death,
			'updated_time'			=> $updated_time
		);
        if( $this->db->update('country', $data, array('id' => $id)) )
        	return true;
        else
        	return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
        if( $this->db->delete('country') )
        	return true;
        else
        	return false;
	}

	public function single_select($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('country', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function count() {
		return $this->db->count_all('country');
	}

}

?>