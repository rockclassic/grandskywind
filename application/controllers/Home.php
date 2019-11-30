<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Home Controller
 * @ author : prog106 <prog106@haomun.com>
 */
class Home extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
// test
    } // }}}

    // index .....
    public function index() { // {{{
        redirect('/crm/', 'refresh');
    } // }}}




}
?>
