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
        $this->load->helper("url");
        if($this->session->has_userdata("login")) {
            redirect($this->base_url() . "panel");
            return;
        }

        $form_error = "";
        if($this->session->has_userdata('form_error'))
        {
            $form_error = $this->session->userdata('form_error');
            $this->session->unset_userdata('form_error');
        }
        else
            $form_error = null;

        $data = array(
            "form_error"    =>  $form_error,
        );

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("login", $data);
    }

    public function auth() {

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->load->helper("url");
        if($this->session->has_userdata("login")) {
            redirect($this->base_url() . "panel");
            return;
        }

        $this->load->library("form_validation");
        $this->load->database();

        $rules = array(
            array(
                'field' =>  'username',
                'label' =>  'username',
                'rules' =>  'required',
                'errors'=>  array(
                    'required'  =>  '%s is required.'
                )
            ),
            array(
                'field' =>  'password',
                'label' =>  'password',
                'rules' =>  'required|max_length[40]',
                'errors'=>  array(
                    'required'  =>  '%s is required.'
                )
            )
        );

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-danger text-left"><strong>Errors :</strong>' . validation_errors("<br /><span>", "</span>") . '</p>');
            redirect($this->base_url() . "login");

            return;
        }
        else
        {
            $username   = $this->input->post('username', true);
            $password   = $this->input->post('password', true);

            $this->load->model('user_model');

            $user = $this->user_model->login_select($username, sha1(md5($password)));

            if($user!==false)
            {
                $this->load->model("login_model");
                $this->login_model->insert($user[0]['id'], $this->time(), $this->user_agent());

                $this->session->set_userdata("login", true);

                redirect($this->base_url() . "panel");
                return;
            }
            else {
                $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-danger text-left">Incorrect User.</p>');
                redirect($this->base_url() . "login");
                return;
            }
        }
    }

    public function panel() {
        $this->load->helper("url");
        if(!$this->session->has_userdata("login")) {
            redirect($this->base_url() . "login");
            return;
        }

        $data = array();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("panel", $data);
    }

    public function impact_factors() {
        $this->load->helper("url");
        if(!$this->session->has_userdata("login")) {
            redirect($this->base_url() . "login");
            return;
        }

        $data = array();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("impact_factors", $data);
    }

    public function country_data() {
        $this->load->helper("url");
        if(!$this->session->has_userdata("login")) {
            redirect($this->base_url() . "login");
            return;
        }

        $data = array();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("country_data", $data);
    }

    public function out() {
        $this->load->helper("url");
        if($this->session->has_userdata("login")) {
            $this->session->unset_userdata("login");
        }

        redirect($this->base_url() . "login");
        return;
    }

}

?>