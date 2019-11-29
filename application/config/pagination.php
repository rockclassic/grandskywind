<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 페이징 처리 기본 설정값
$config['prefix'] = '';
$config['num_links'] = 2;
$config['use_page_numbers'] = true;
$config['per_page'] = PAGE_LIMIT;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
$config['cur_tag_close'] = '</a></li>';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['first_link'] = '&lsaquo; First';
$config['next_link'] = '&gt;';
$config['prev_link'] = '&lt;';
$config['last_link'] = 'Last &rsaquo;';
$config['reuse_query_string'] = TRUE;

//$config['base_url'] = '/review/lists';
//$config['total_rows'] = $count['data']['cnt'];
?> 
