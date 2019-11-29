<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Home Controller
 * @ author : prog106 <prog106@haomun.com>
 * @property Testbiz $testbiz
 */
class Test extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/api/v1/testbiz', 'testbiz');

    } // }}}

    // index
    public function index() { // {{{
        $data=array();
//        $this->load->view('test',$data);
        load_admin_view('test');
    } // }}}

    public function to_address() { // {{{
        $data=array();
        $this->load->view('address',$data);
    } // }}}


    public function set_sido(){


        $sido=array(
            "서울특별시"=>11
        ,"부산광역시"=>26
        ,"대구광역시"=>27
        ,"인천광역시"=>28
        ,"광주광역시"=>29
        ,"대전광역시"=>30
        ,"울산광역시"=>31
        ,"세종특별자치시"=>36
        ,"경기도"=>41
        ,"강원도"=>42
        ,"충청북도"=>43
        ,"충청남도"=>44
        ,"전라북도"=>45
        ,"전라남도"=>46
        ,"경상북도"=>47
        ,"경상남도"=>48
        ,"제주특별자치도"=>50
        );

        foreach($sido as $k =>$v){
            $request_url = 'http://www.juso.go.kr/getAreaCode.do?from=city&to=county&valFrom='.$v;
            $post=array();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch );
//        echo $result;
            curl_close( $ch );
            $ob=simplexml_load_string($result);
            $ar=object2array($ob);

           for($i=0;$i<count($ar['name']);$i++){
               $in['sdg_sido_nm']=$k;
               $in['sdg_sido_no']=$v;
               $in['sdg_gu_nm']=$ar['name'][$i];
               $in['sdg_gu_no']=$ar['value'][$i];
// 차후 이중 인설트를 방지하기 위해 주석처리함(세종시는 구가 없음)
//               $this->testbiz->set_addr($in);
           }
        }
    }

    public function fn_post(){
        $request_post['type']="gu";
        $request_post['sdg_sido_no']="36";
       $ret= callrpc('api/user/get_sidogu',$request_post);

       print_r($ret);
    }

    public function fn_chrome(){
        $endpoint='{"endpoint":"https://fcm.googleapis.com/fcm/send/dRxgQjsdwYQ:APA91bEKonZgNl8138NSbHMP2G_VxjK7OUoir8pnffD10dU9-YJXi0KFhJrJJAsppnbbYwL6X6IFaqUhpgrWP94UDrhf2qLw_yplKYKitP6yLpSWEHie6d2rkxGOakKlJQhzv-rRN6bN","expirationTime":null,"keys":{"p256dh":"BEghF5jGH_iE6vZJ11rNAoWKpNO6CfZOE2FigJpIRKdTqCTbfxZqOL_VfN4qGPIY1lHrrUEL2Qu9i1at0_M17Xc","auth":"GfdIdfkep70Xm9zeNRATgQ"}}';
        $msg="저는 ^^ 입니다.\n하하하^!^http://naver.com";
        $return['ret']=send_chrome_fcm($endpoint,$msg);
        print_r($return);
    }

    public function fn_find_hospital(){
        //약국
        $parmacy_key="8P2MX8hgzyTH0SCBj%2BiTAM8jQKQhzHGObTeYtuktQWh4iZ3TPnL%2FGU5LZ0v7H9TlHiPNH8L1IpUdEFNRuKzECw%3D%3D";
        $ch = curl_init();
        $url = 'http://apis.data.go.kr/B552657/ErmctInsttInfoInqireService/getParmacyLcinfoInqire'; /*URL*/

        $queryParams = '?' . urlencode('ServiceKey') . '='.urlencode($parmacy_key); /*Service Key*/
//        $queryParams .= '&' . urlencode('ServiceKey') . '=' . urlencode('-'); /*공공데이터포털에서 받은 인증키*/
        $queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*페이지번호*/
        $queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /*한 페이지 결과 수*/

        echo urldecode($url);
        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);

        //병의원
        $hospital_key="";


    }

    public function fn_fcm() { // {{{
        $this->load->view('fcm');
    } // }}}

    public function fn_send_web(){
        $id="dHX-qWbp-N4:APA91bGMZ6KayfJ_uMTN46olsd99g4NTGS7A3skyv35Jl0yl63Xf8RIacEf20eVLe0Jrt5Bor2t4ieYIouVo5jsDvCzVjVi3s4-wdMj8uOq-vlvRWDCNrAlbMoYcFgAdvrL4LvowJQfx";
        $message = array(
            'to' => $id,//모든 세무사 디바이스 ID를 가져와 넣어줘야 함.
            'data' => array(
                "title" => "title",
                "body" => "msg",//견적 유형을 함께건달.

            ),
            'notification' => array(
                "title" => "title",
                "body" => "msg",
                "sound" => "default"
            ),
        );
        echo send_fcm($message,'3');
    }
}
?>





