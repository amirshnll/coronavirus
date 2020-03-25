<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class View_model extends CI_Model {

	/* Public */
	public function __construct()
    {
        parent::__construct();
    }

	public function insert($time, $user_agent, $ip, $section) {
		$data = array (
			'time'				=> $time,
			'user_agent'		=> $user_agent,
			'ip'				=> $ip,
			'section'			=> $section
		);
		if( $this->db->insert('view', $data) )
			return true;
		else
			return false;
	}

	public function select($limit = 0) {
		$this->db->order_by('id', 'DESC');
		if($limit === 0)
			$query = $this->db->get('view');
		else
			$query = $this->db->get('view', $limit);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function update($id, $time, $user_agent, $ip, $section) {
		$data = array (
			'time'				=> $time,
			'user_agent'		=> $user_agent,
			'ip'				=> $ip,
			'section'			=> $section
		);
        if( $this->db->update('view', $data, array('id' => $id)) )
        	return true;
        else
        	return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
        if( $this->db->delete('view') )
        	return true;
        else
        	return false;
	}

	public function single_select($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('view', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function count() {
		return $this->db->count_all('view');
	}

}

?>