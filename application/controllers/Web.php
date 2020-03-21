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


    /* Public */
    public function index() {

        $data = array();

        $this->parser("index", $data);
    }

    public function detect() {

        $data = array();

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
                $xml->addNode("content", $value['content']);
                $xml->endBranch();
                $i++;
            }
        }

        $xml_result = $xml->getXml(false);

        $data = array(
            "xml_result" =>  $xml_result,
        );

        $this->parser("export", $data);
    }

}

?>