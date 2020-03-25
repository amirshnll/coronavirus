<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class User extends CI_Controller {

	/* Private */
	private function parser($view_name, $my_data = null) {
        if(empty($view_name) || is_null($view_name))
        {
            show_404();
            return false;
        }

        $this->load->helper('security');
        $this->load->library('parser');

        $view_name = xss_clean($view_name);
        $data = array(
            'base'  =>  $this->base_url()
        );
        if(!is_null($my_data))
            $data = array_merge($data, $my_data);

        $this->parser->parse($view_name, $data);
        return true;
    }

    private function base_url() {
        $this->load->helper("url");
        return base_url();
    }

    private function time() {
        return time();
    }

    private function user_agent() {
        $this->load->library('user_agent');
        return $this->agent->agent_string();
    }

    private function ip() {
        return $this->input->ip_address();
    }


    /* Public */
    public function index() {
        $this->load->helper("url");
        redirect($this->base_url());
        return;
    }

    public function login() {

        $data = array();


        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());


        $this->parser("login", $data);
    }

}

?>