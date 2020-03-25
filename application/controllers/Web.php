<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author 	: A.shokri
 * Email 	: amirsh.nll@gmail.com
 * Date 	: 2020/03/21
*/

class Web extends CI_Controller {

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

        $data = array();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->parser("index", $data);
    }

    public function detect() {

        $this->load->helper("form");

        $this->load->model("symptom_model");
        $symptom = $this->symptom_model->select();

        $detect_form = "";
        if($symptom!==false && is_array($symptom)) {
            $detect_form .= form_open(
                $this->base_url() . "detection",
                array(
                    "class"     =>  "form-group text-left"
                )
            );

            $detect_form .= "<br />";

            foreach ($symptom as $key => $value) {
                if($value['type']==1) {
                    $detect_form .= "<label for='input_" . strtolower(str_replace(" ", "", $value['title'])) . "'>" . $value['title'] . "<sup class='text-danger text-bold'>*</sup></label>";
                    $detect_form .= form_input(
                        array(
                            "name"          =>  strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                            "id"            =>  strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                            "placeholder"   =>  $value['title'],
                            "class"         =>  "form-control"
                        )
                    );
                    $detect_form .= "<br />";
                }
                elseif($value['type']==2) {
                    $detect_form .= "<label for='input_" . strtolower(str_replace(" ", "", $value['title'])) . "'>" . $value['title'] . "<sup class='text-danger text-bold'>*</sup></label>";
                    if(strtolower(str_replace(" ", "", $value['title'])) == "sex")
                    {
                        $options = array(
                            "0"    =>  "Please Select...",
                             "1" =>  "Male",
                               "2" =>  "Female");
                    }
                    else {
                        $options = array(
                            "0"    =>  "Please Select...",
                             "1" =>  "Yes",
                               "2" =>  "No");
                    }
                    $detect_form .= form_dropdown(
                        strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                        $options,
                        0,
                        array(
                            "id" =>  strtolower(str_replace(" ", "", "input_" .  $value['title'])),
                            "class" =>  "form-control"
                        )
                    );
                    $detect_form .= "<br />";
                }
                else
                    continue;
            }

            $detect_form .= "<br />";
            $detect_form .= form_submit(
                array(
                    "name"          =>  "input_submit",
                    "id"            =>  "input_submit",
                    "value"         =>  "Run Detection",
                    "class"         =>  "btn btn-primary float-right"
                )
            );
            $detect_form .= form_reset(
                array(
                    "name"          =>  "input_reset",
                    "id"            =>  "input_reset",
                    "value"         =>  "Reset",
                    "class"         =>  "btn btn-danger float-right",
                    "style"         =>  "margin-right:10px;"
                )
            );
            $detect_form .= "<div class='clearfix'></div>";
            $detect_form .= form_close();
        }
        else
            $detect_form .= "<br /><p class='text-danger text-bold'>System Have A Problem :(</p>";

        $form_error = "";
        if($this->session->has_userdata('form_error'))
        {
            $form_error = $this->session->userdata('form_error');
            $this->session->unset_userdata('form_error');
        }
        else
            $form_error = null;
        $data = array();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $data = array(
            'detect_form'           =>  $detect_form,
            'form_error'            =>  $form_error
        );

        $this->parser("detect", $data);
    }

    public function statistics() {

        $this->load->model("country_model");
        $country = $this->country_model->select();
        if($country===false || !is_array($country)) {
            $country= array();
            $top_ten = array();
        }
        else {
            $top_ten = array();
            $i = 0;
            foreach ($country as $key => $value) {
                if($i == 10)
                    break;
                array_push($top_ten, array(
                    'id'                    => $value['id'],
                    'name'                  => $value['name'],
                    'number_of_patients'    => $value['number_of_patients'],
                    'number_of_death'       => $value['number_of_death'],
                    'updated_time'          => $value['updated_time']
                ));
                $i++;
            }
        }

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $data = array(
            "country"       =>  $country,
            "top_ten"       =>  $top_ten,
        );

        $this->parser("statistics", $data);
    }

    public function export() {

        $this->load->library("xml_writer");

        $this->load->model('detect_model');
        $detect = $this->detect_model->select();

        $xml = new Xml_writer;
        $xml->setRootName('coronavirus');
        $xml->initiate();
        $xml->startBranch("developer");
        $xml->addNode("author", "A.shokri");
        $xml->addNode("email", "amirsh.nll@gmail.com");
        $xml->addNode("website", "www.amirshnll.ir");
        $xml->endBranch();

        $i = 1;
        if($detect!==false && is_array($detect)) {
            foreach ($detect as $key => $value) {
                $xml->startBranch("detect");
                $xml->addNode("id", $i);
                $xml->addNode("content", htmlspecialchars_decode($value['content']));
                $xml->addNode("detect_rate", $value['detect_rate']);
                $xml->endBranch();
                $i++;
            }
        }

        $xml_result = $xml->getXml(false);

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $data = array(
            "xml_result" =>  $xml_result,
        );

        $this->parser("export", $data);
    }

    public function detection() {
        $this->load->model("symptom_model");
        $symptom = $this->symptom_model->select();

        $this->load->model("view_model");
        $this->view_model->insert($this->time(), $this->user_agent(), $this->ip(), $this->router->fetch_class() . "/" . $this->router->fetch_method());

        $this->load->library("form_validation");
        $this->load->database();
        $this->load->helper("url");

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
            redirect($this->base_url() . "detect");

            return;
        }
        else
        {
            $result_string = "";
            $sum_impact_factor = 0;
            $user_impact_factor= 0;
            $i = 0;
            $data = array();
            foreach ($symptom as $key => $value) {
                $temp = $this->input->post(strtolower(str_replace(" ", "", "input_" .  $value["title"])), true);
                $data[strtolower(str_replace(" ", "", $value["title"]))]    =   $temp;

                if(strtolower(str_replace(" ", "", $value["title"])) == "fever" && $temp > 37.5)
                    $user_impact_factor += $value['impact_percentage'];
                if(strtolower(str_replace(" ", "", $value["title"])) == "age" && $temp > 50)
                    $user_impact_factor += $value['impact_percentage'];
                elseif($temp == 1)
                    $user_impact_factor += $value['impact_percentage'];

                $i++;
                $sum_impact_factor += $value['impact_percentage'];
            }

            $rank = round($user_impact_factor / $sum_impact_factor * 100);

            $this->session->set_userdata('form_error', '<p style="font-size:14px;" class="alert alert-primary text-left"><strong>Result :</strong> ' . $user_impact_factor . ' of ' . $sum_impact_factor . '  : ( ' . $rank . '% probability positive)</p>');

            $this->load->model("detect_model");
            $this->detect_model->insert($this->time(), $this->user_agent(), $this->ip(), json_encode($data) , $rank);
        }

        redirect($this->base_url() . "detect");
    }

}

?>