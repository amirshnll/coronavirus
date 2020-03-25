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

        $form_error = "";
        if($this->session->has_userdata('form_error'))
        {
            $form_error = $this->session->userdata('form_error');
            $this->session->unset_userdata('form_error');
        }
        else
            $form_error = null;

        $this->load->helper("form");

        $this->load->model("symptom_model");
        $symptom = $this->symptom_model->select();

        $impact_form = "";
        if($symptom!==false && is_array($symptom)) {
            $impact_form .= form_open(
                $this->base_url() . "update_factors",
                array(
                    "class"     =>  "form-group text-left"
                )
            );

            $impact_form .= "<br />";

            foreach ($symptom as $key => $value) {
                $impact_form .= "<label for='input_" . strtolower(str_replace(" ", "", $value['title'])) . "'>" . $value['title'] . " <b>Impact Percentage</b> <sup class='text-danger text-bold'>*</sup></label>";
                $impact_form .= form_input(
                    array(
                        "name"          =>  strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                        "id"            =>  strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                        "placeholder"   =>  $value['title'],
                        "value"         =>  $value['impact_percentage'],
                        "class"         =>  "form-control"
                    )
                );
                $impact_form .= "<br />";
            }

            $impact_form .= "<br />";
            $impact_form .= form_submit(
                array(
                    "name"          =>  "input_submit",
                    "id"            =>  "input_submit",
                    "value"         =>  "Save",
                    "class"         =>  "btn btn-primary float-right"
                )
            );
            $impact_form .= "<div class='clearfix'></div>";
            $impact_form .= form_close();
        }
        else
            $impact_form .= "<br /><p class='text-danger text-bold'>System Have A Problem :(</p>";

        $data = array(
            "form_error"    =>  $form_error,
            "impact_form"   =>  $impact_form,
        );

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

        $form_error = "";
        if($this->session->has_userdata('form_error'))
        {
            $form_error = $this->session->userdata('form_error');
            $this->session->unset_userdata('form_error');
        }
        else
            $form_error = null;

        $this->load->helper("form");

        $this->load->model("country_model");
        $country = $this->country_model->select();

        $country_form = "";
        if($country!==false && is_array($country)) {
            $country_form .= form_open(
                $this->base_url() . "update_country",
                array(
                    "class"     =>  "form-group text-left"
                )
            );

            $country_form .= "<br />";

            foreach ($country as $key => $value) {
                $country_form .= "<label>" . $value['name'] . " <b>Statistics Number</b> <sup class='text-danger text-bold'>*</sup></label>";
                $country_form .= "<p style='font-size:14px;'>number of patients:</p>";
                $country_form .= form_input(
                    array(
                        "name"          =>  strtolower(str_replace(" ", "", "input_" .  $value['name'])) . "1",
                        "id"            =>  strtolower(str_replace(" ", "", "input_" .  $value['name'])),
                        "placeholder"   =>  "number of patients",
                        "value"         =>  $value['number_of_patients'],
                        "class"         =>  "form-control"
                    )
                );
                $country_form .= "<p style='font-size:14px;'>number of death:</p>";
                $country_form .= form_input(
                    array(
                        "name"          =>  strtolower(str_replace(" ", "", "input_" .  $value['name'])) . "2",
                        "id"            =>  strtolower(str_replace(" ", "", "input_" .  $value['name'])),
                        "placeholder"   =>  "number of death",
                        "value"         =>  $value['number_of_death'],
                        "class"         =>  "form-control"
                    )
                );
                $country_form .= "<br />";
            }

            $country_form .= "<br />";
            $country_form .= form_submit(
                array(
                    "name"          =>  "input_submit",
                    "id"            =>  "input_submit",
                    "value"         =>  "Save",
                    "class"         =>  "btn btn-primary float-right"
                )
            );
            $country_form .= "<div class='clearfix'></div>";
            $country_form .= form_close();
        }
        else
            $country_form .= "<br /><p class='text-danger text-bold'>System Have A Problem :(</p>";

        $data = array(
            "form_error"    =>  $form_error,
            "country_form"  =>  $country_form
        );

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("country_data", $data);
    }

    public function update_factors() {
        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->load->library("form_validation");
        $this->load->database();
        $this->load->helper("url");

        $this->load->model("symptom_model");
        $symptom = $this->symptom_model->select();

        $rules = array();
        foreach ($symptom as $key => $value) {
            array_push($rules,
                array(
                    'field' =>  strtolower(str_replace(" ", "", "input_" .  $value["title"])),
                    'label' =>  $value["title"],
                    'rules' =>  'required|numeric',
                    'errors'=>  array(
                        'required'  =>  '%s is required.',
                        'numeric'   =>  '%s is numeric field.'
                    )
                )
            );
        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-danger text-left"><strong>Errors :</strong>' . validation_errors("<br /><span>", "</span>") . '</p>');
            redirect($this->base_url() . "impact_factors");

            return;
        }
        else
        {
            $data = array();
            foreach ($symptom as $key => $value) {
                $temp = $this->input->post(strtolower(str_replace(" ", "", "input_" .  $value["title"])), true);
                array_push($data,
                    array(
                        "id"                    =>  $value['id'],
                        "impact_percentage"     =>  $temp,
                        "updated_time"          =>  $this->time()
                    )
                );
            }

            $this->symptom_model->update_batch($data);

            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-primary text-left">Saved.</p>');
            redirect($this->base_url() . "impact_factors");
        }
    }

    public function update_country() {
        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->load->library("form_validation");
        $this->load->database();
        $this->load->helper("url");

        $this->load->model("country_model");
        $country = $this->country_model->select();

        $rules = array();
        foreach ($country as $key => $value) {
            array_push($rules,
                array(
                    'field' =>  strtolower(str_replace(" ", "", "input_" .  $value["name"])) . "1",
                    'label' =>  $value["name"],
                    'rules' =>  'required|numeric',
                    'errors'=>  array(
                        'required'  =>  '%s is required.',
                        'numeric'   =>  '%s is numeric field.'
                    )
                )
            );
            array_push($rules,
                array(
                    'field' =>  strtolower(str_replace(" ", "", "input_" .  $value["name"])) . "2",
                    'label' =>  $value["name"],
                    'rules' =>  'required|numeric',
                    'errors'=>  array(
                        'required'  =>  '%s is required.',
                        'numeric'   =>  '%s is numeric field.'
                    )
                )
            );
        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-danger text-left"><strong>Errors :</strong>' . validation_errors("<br /><span>", "</span>") . '</p>');
            redirect($this->base_url() . "country_data");

            return;
        }
        else
        {
            $data = array();
            foreach ($country as $key => $value) {
                $temp1 = $this->input->post(strtolower(str_replace(" ", "", "input_" .  $value["name"])) . "1", true);
                $temp2 = $this->input->post(strtolower(str_replace(" ", "", "input_" .  $value["name"])) . "2", true);
                array_push($data,
                    array(
                        "id"                    =>  $value['id'],
                        "number_of_patients"    =>  $temp1,
                        "number_of_death"       =>  $temp2,
                        "updated_time"          =>  $this->time()
                    )
                );
            }

            $this->country_model->update_batch($data);

            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-primary text-left">Saved.</p>');
            redirect($this->base_url() . "country_data");
        }
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