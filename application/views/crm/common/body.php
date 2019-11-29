<?
/**
 * description : admin common template
 * author : prog106 <prog106@haomun.com>
 */
// 메뉴 접근 금지
$user_grade=  $this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'));

foreach($_menu as $k => $v) {
foreach($v['sub'] as $kk => $vv) {
    if($_class."/".$_method == $kk){
        if(!in_array($user_grade,$vv['grade'])){
            alertmsg_back("잘못된 접근입니다.");
//            redirect("/");
        }
    }
}
}
// header
$this->load->view('crm/common/head');
// container
if(isset($view_file)) $this->load->view($view_file);
// footer
$this->load->view('crm/common/footer');

?>
