<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class User_model extends CI_Model {

	/* Public */
	public function __construct()
    {
        parent::__construct();
    }

	public function insert($username, $password) {
		$data = array (
			'username'				=> $username,
			'password'				=> $password
		);
		if( $this->db->insert('user', $data) )
			return true;
		else
			return false;
	}

	public function select($limit = 0) {
		$this->db->order_by('id', 'DESC');
		if($limit === 0)
			$query = $this->db->get('user');
		else
			$query = $this->db->get('user', $limit);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function update($id, $username, $password) {
		$data = array (
			'username'				=> $username,
			'password'				=> $password
		);
        if( $this->db->update('user', $data, array('id' => $id)) )
        	return true;
        else
        	return false;
	}

	public function delete($id) {
		$this->db->where('id', $id);
        if( $this->db->delete('user') )
        	return true;
        else
        	return false;
	}

	public function single_select($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('user', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function login_select($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('user', 1);

        $result = $query->result_array();
        if($query->num_rows() < 1)
        	$result = false;
        return $result;
	}

	public function count() {
		return $this->db->count_all('user');
	}

}

?>