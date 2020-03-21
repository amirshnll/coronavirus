<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class Symptom_model extends CI_Model {

	/* Public */
	public function __construct()
    {
        parent::__construct();
    }

	public function insert($title, $type, $impact_percentage, $updated_time) {
		$data = array (
			'title'						=> $title,
			'type'						=> $type,
			'impact_percentage'			=> $impact_percentage,
			'updated_time'				=> $updated_time
		);
		if( $this->db->insert('symptom', $data) )
			return true;
		else
			return false;
	}

	public function select($limit = 0) {
		$this->db->order_by('id', 'DESC');
		if($limit === 0)
			$query = $this->db->get('symptom');
		else
			$query = $this->db->get('symptom', $limit);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function update($id, $type, $impact_percentage, $updated_time) {
		$data = array (
			'title'						=> $title,
			'type'						=> $type,
			'impact_percentage'			=> $impact_percentage,
			'updated_time'				=> $updated_time
		);
        if( $this->db->update('symptom', $data, array('id' => $id)) )
        	return true;
        else
        	return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
        if( $this->db->delete('symptom') )
        	return true;
        else
        	return false;
	}

	public function single_select($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('symptom', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function count() {
		return $this->db->count_all('symptom');
	}

}

?>