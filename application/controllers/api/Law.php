<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Law extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Seoul');
    }


    public function lawapi()
    {
        $param['query'] = $this->input->get('query', true);

        $url = 'http://www.law.go.kr/DRF/lawSearch.do?target=prec&OC=grandskywind&type=XML&search=2&query='.$param['query'];
        $ch = cURL_init();

        cURL_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        cURL_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = cURL_exec($ch);
        cURL_close($ch);

        $object = simplexml_load_string($response);
        $suggest0 = $object->CompleteSuggestion[0]->suggestion["data"];

        echo $suggest0;

        //load_admin_view('crm/mbroffice/edt', $suggest0);
    }







}
?>
