<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class Detect_model extends CI_Model {

	/* Public */
	public function __construct()
    {
        parent::__construct();
    }

	public function insert($time, $user_agent, $ip, $content) {
		$data = array (
			'time'					=> $time,
			'user_agent'			=> $user_agent,
			'ip'					=> $ip,
			'content'				=> $content
		);
		if( $this->db->insert('detect', $data) )
			return true;
		else
			return false;
	}

	public function select($limit = 0) {
		$this->db->order_by('id', 'DESC');
		if($limit === 0)
			$query = $this->db->get('detect');
		else
			$query = $this->db->get('detect', $limit);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function update($id, $time, $user_agent, $ip, $content) {
		$data = array (
			'time'					=> $time,
			'user_agent'			=> $user_agent,
			'ip'					=> $ip,
			'content'				=> $content
		);
        if( $this->db->update('detect', $data, array('id' => $id)) )
        	return true;
        else
        	return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
        if( $this->db->delete('detect') )
        	return true;
        else
        	return false;
	}

	public function single_select($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('detect', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function count() {
		return $this->db->count_all('detect');
	}

}

?>