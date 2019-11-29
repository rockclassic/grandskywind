<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Point Library 
 * @ author : prog106 <prog106@haomun.com>
 */
class Point {

    var $CI;
    var $db;

    public function __construct() { // {{{
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->db = $this->CI->db;
    } // }}}

    /*
    *   포인트를 적립/삭감 할수 있는 Library

    ***********************************************************************************************************
    *   적립으로 사용할 때 꼭 transaction 이 종료된 이후에 별도로 실행할 것
    *   에러가 발생하더라도 프로세스 진행에는 문제가 없도록 작접 : 회원가입완료 후 포인트 적립 에러 PASS
    *   사용예제)

        $this->db->trans_commit(); // 트랜잭션 종료

        // POINT 적립 로직 추가
        $this->load->library('Point');
        $this->point->signup($user_sql);

    *   적립 코드 : SIGNUP, LOGIN
    ***********************************************************************************************************


    ***********************************************************************************************************
    *   포인트 삭감으로 사용할 때 꼭 transaction 이 시작되기 전에 별도로 실행할 것
    *

        // POINT 적립 로직 추가
        $this->load->library('Point');
        $this->point->signup($user_sql);

        $this->db->trans_begin(); // 트랜잭션 시작

    *   삭감 코드 : LOGOUT, EXCHANGE, OUT
    ***********************************************************************************************************
    */







    /*
    *   포인트 적립 관련 함수들은 이곳부터 작성해 주세요.
    *   모든 쿠폰은 매월 말까지 유효기간 지정 조건
    */

    // 미사용 - 회원가입 축하 포인트 적립 : SIGNUP - 회원가입시에 기본적으로 생성되는 정보 : 최초생성
    public function signup($user_srl) { // {{{
        $code = 'SIGNUP'; // 코드
        $comment = '회원가입 적립';
        $point = 10000; // 충전포인트
        $limited_at = '9999-12-31';
        //return $this->save_point($user_srl, $code, $comment, $point, $limited_at);
    } // }}}

    // 미사용 - 로그인 할 때마다 포인트 적립 : LOGIN
    public function login($user_srl) { // {{{
        $code = 'LOGIN'; // 코드
        $comment = '로그인 적립';
        $point = 1000; // 충전포인트
        $limited_at = date("Y-m-t", mktime(0, 0, 1, date('m') + 6, 1, date('Y'))); // 6개월 후 말일까지
        $limited_at = date('Y-m-d'); // 오늘까지 - 테스트
        //return $this->save_point($user_srl, $code, $comment, $point, $limited_at);
    } // }}}

    // 쿠폰번호를 통한 포인트 적립 : COUPON
    public function coupon($user_srl, $coupon_name, $price) { // {{{
        $code = 'COUPON'; // 코드
        $comment = $coupon_name;
        $point = $price; // 충전포인트
        //$limited_at = date("Y-m-t", mktime(0, 0, 1, date('m') + 6, 1, date('Y'))); // 6개월 후 말일까지
        $limited_at = '9999-12-31';
        return $this->save_point($user_srl, $code, $comment, $point, $limited_at);
    } // }}}

    // 관리자 포인트 적립 : ADMSAVE
    public function admsave($user_srl, $admin_comment, $admin_point, $admin_expire_month=1) { // {{{
        $code = 'ADMSAVE'; // 코드
        $comment = $admin_comment;
        $point = $admin_point; // 충전포인트
        $limited_at = date("Y-m-t", mktime(0, 0, 1, date('m') + $admin_expire_month, 1, date('Y')));
        return $this->save_point($user_srl, $code, $comment, $point, $limited_at);
    } // }}}

    // 외부 이벤트를 통한 포인트 적립 : 동부화재 
    public function dongbu($user_srl, $dongbu_point) { // {{{
        $code = 'EVENT'; // 코드
        $comment = '동부화재 참여 포인트 적립';
        $point = $dongbu_point; // 충전포인트
        // $limited_at = date("Y-m-t", mktime(0, 0, 1, date('m') + $admin_expire_month, 1, date('Y')));
        $limited_at = '9999-12-31';
        return $this->save_point($user_srl, $code, $comment, $point, $limited_at);
    } // }}}




    /*
    *   포인트 삭감 관련 함수들은 이곳부터 작성해 주세요.
    */

    // 미사용 - 로그아웃 할 때마다 포인트 삭감 : LOGOUT
    public function logout($user_srl) { // {{{
        $code = 'LOGOUT'; // 코드
        $comment = '로그아웃 삭감';
        $point = -500; // 삭감포인트
        //return $this->remove_point($user_srl, $code, $comment, $point);
    } // }}}

    // 컬쳐랜드 상품권 교환 포인트 삭감 : EXCHANGE
    public function exchange($user_srl, $price) { // {{{
        $code = 'EXCHANGE'; // 코드
        $comment = '컬쳐랜드 상품권 교환';
        $point = $price * -1; // 삭감포인트
        return $this->remove_point($user_srl, $code, $comment, $point);
    } // }}}

    // 회원 탈퇴 할 때 포인트 삭감 : OUT
    public function out($user_srl, $user_point_remain) { // {{{
        $code = 'OUT'; // 코드
        $comment = '회원탈퇴 삭감';
        $point = $user_point_remain * -1; // 삭감포인트
        return $this->remove_point($user_srl, $code, $comment, $point);
    } // }}}

    // 관리자 포인트 삭감 : ADMREMOVE
    public function admremove($user_srl, $admin_comment, $admin_point) { // {{{
        $code = 'ADMREMOVE'; // 코드
        $comment = $admin_comment;
        $point = $admin_point * -1; // 삭감 포인트
        return $this->remove_point($user_srl, $code, $comment, $point);
    } // }}}

    // 게임아이템 구매시 포인트 삭감 : ITEMBUY
    public function itembuy($user_srl, $user_point_remain) { // {{{
        $code = 'ITEMBUY'; // 코드
        $comment = '게임아이템 구매 삭감';
        $point = $user_point_remain * -1; // 삭감포인트
        return $this->remove_point($user_srl, $code, $comment, $point);
    } // }}}








    // 포인트 적립
    private function save_point($user_srl, $code, $comment, $point, $limited_at='9999-12-31') { // {{{
        if(empty($user_srl) || empty($code) || empty($point)) return;
        try {
            $this->db->trans_begin();
            $sql = "INSERT INTO user_point (user_srl, user_point_code, user_point_comment, user_point, user_point_remain, created_at) SELECT ?, ?, ?, ?, IFNULL((SELECT user_point_remain FROM user_point WHERE user_srl = ? ORDER BY user_point_srl DESC LIMIT 1), 0) + ?, ?";
            $sql_param = array($user_srl, $code, $comment, $point, $user_srl, $point, YMD_HIS);
            $this->db->query($sql, $sql_param);
            $point_srl = $this->db->insert_id();

            if(!empty($point_srl)) {
                $sql = "INSERT INTO user_point_limit (user_srl, user_point_srl, user_limit_point, limited_at, created_at) VALUES (?, ?, ?, ?, ?)";
                $sql_param = array($user_srl, $point_srl, $point, $limited_at, YMD_HIS);
                $this->db->query($sql, $sql_param);
            } else {
                errorlog('회원 PK '.$user_srl.' - 포인트 확인 요망 : 적립실패');
                throw new Exception('포인트 에러! 관리자에게 문의하세요.');
            }
            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            alertmsg_move($e->getMessage());
            die;
        }
        return $point_srl;
    } // }}}

    // 포인트 삭감을 진행하는데 포인트가 모자랄 경우 진행이 안되어야 됨.
    // 포인트 삭감
    private function remove_point($user_srl, $code, $comment, $point) { // {{{
        if(empty($user_srl) || empty($code) || empty($point)) return;
        try {
            $this->db->trans_begin();
            $sql = "SELECT IFNULL(user_point_remain, 0), (SELECT IFNULL(SUM(user_limit_point), 0) FROM user_point_limit WHERE user_srl = user_point.user_srl AND user_limit_point > 0 AND limited_at >= date(NOW())) AS user_point_limit_remain FROM user_point WHERE user_srl = ? ORDER BY user_point_srl DESC LIMIT 1";
            $sql_param = array($user_srl);
            $result = $this->db->query($sql, $sql_param);
            $remain = $result->row_array();
            if($remain['user_point_limit_remain'] !== $remain['user_point_remain']) {
                errorlog('회원 PK '.$user_srl.' - 포인트 확인 요망 : 총포인트('.$remain['user_point_remain'].') != 유효기간포인드('.$remain['user_point_limit_remain'].')');
                throw new Exception('포인트 에러! 관리자에게 문의하세요.'); // 총포인트 != 유효기간 포인트 => 오류
            }
            if($remain['user_point_remain'] < $point*-1) throw new Exception('포인트가 부족합니다.');

            $sql = "INSERT INTO user_point (user_srl, user_point_code, user_point_comment, user_point, user_point_remain, created_at) VALUES (?, ?, ?, ?, ?, ?)";
            $sql_param = array($user_srl, $code, $comment, $point, $remain['user_point_remain'] + $point, YMD_HIS);
            $this->db->query($sql, $sql_param);
            $point_srl = $this->db->insert_id();

            if(!empty($point_srl)) {
                // 유효기간 적게 남은 순서로 가져오기
                $sql = "SELECT * FROM user_point_limit WHERE user_srl = ? AND user_limit_point > 0 AND limited_at >= date(NOW()) ORDER BY limited_at ASC, user_point_limit_srl ASC";
                $sql_param = array($user_srl);
                $result = $this->db->query($sql, $sql_param);
                $limit = $result->result_array();
                foreach($limit as $k => $v) {
                    if($point < 0) $point = $point * -1; // 주의) 삭감금액을 양수로 바꿔야만 수식이 제대로 진행됨
                    if($v['user_limit_point'] <= $point) {
                        $point -= $v['user_limit_point'];
                        $sql = "UPDATE user_point_limit SET user_limit_point = 0 WHERE user_point_limit_srl = ? AND user_srl = ?";
                        $sql_param = array($v['user_point_limit_srl'], $user_srl);
                        $this->db->query($sql, $sql_param);
                        if(empty($point)) break;
                    } else if($v['user_limit_point'] > $point) {
                        $remain_limit_point = $v['user_limit_point'] - $point;
                        $sql = "UPDATE user_point_limit SET user_limit_point = ? WHERE user_point_limit_srl = ? AND user_srl = ?";
                        $sql_param = array($remain_limit_point, $v['user_point_limit_srl'], $user_srl);
                        $this->db->query($sql, $sql_param);
                        $point = 0;
                        break;
                    }
                }
            } else throw new Exception('포인트가 부족합니다.');
            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            alertmsg_move($e->getMessage());
            die;
        }
        return $point_srl;
    } // }}}









    // 00 00 1 * * php /var/www/dev/gamecoupon/cli.php cli cron refresh_point > /dev/null 2>&1
    // 00 00 1 * * php /var/www/work/gamecoupon.com/cli.php cli cron refresh_point > /dev/null 2>&1
    // batch - 유효기간 포인트 삭제하기 - 전월말일 기준으로 업데이트 : 매월 1일 00:00:00 에 실행 - 모든 쿠폰은 매월 말까지 유효기간 지정 조건
    // 만일, 쿠폰 유효기간이 모두 다를 경우 매일 00:00:00 에 실행 - 전일 기준 쿠폰 삭제할 수 있도록 개발함
    public function batch_reset_limit_point() { // {{{
        $count = 0;
        $point = 0;
        $code = 'LIMIT';
        $comment = '유효기간 종료';
        try {
            $this->db->trans_begin();
            // user_point_limit 가져오기
            $sql = "SELECT user_srl, SUM(user_limit_point) AS remove_point, (SELECT user_point_remain FROM user_point WHERE user_srl = user_srl ORDER BY user_point_srl DESC LIMIT 1) AS remain_point, limited_at FROM user_point_limit WHERE user_limit_point > 0 AND limited_at <= DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) GROUP BY user_srl";
            $sql_param = array();
            $result = $this->db->query($sql, $sql_param);
            $reset = $result->result_array();
            if(empty($reset)) throw new Exception('데이터가 없습니다.');

            // 포인트 삭감 데이터 저장
            foreach($reset as $k => $v) {
                // insert_batch 로 처리하기
                $sql_param[$k]['user_srl'] = $v['user_srl'];
                $sql_param[$k]['user_point_code'] = $code;
                $sql_param[$k]['user_point_comment'] = $comment."(".$v['limited_at'].")";
                $sql_param[$k]['user_point'] = $v['remove_point'] * -1;
                $sql_param[$k]['user_point_remain'] = $v['remain_point'] - $v['remove_point'];
                $sql_param[$k]['created_at'] = YMD_HIS;
                $count++;
                $point += $v['remove_point'];
            }
            $this->db->insert_batch('user_point', $sql_param);

            // 유효기간 포인트 일괄 삭감
            $sql = "UPDATE user_point_limit SET user_limit_point = 0 WHERE user_limit_point > 0 AND limited_at <= DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";
            $sql_param = array();
            $this->db->query($sql, $sql_param);

            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
        }
        $return = array(
            'remove_count' => $count,
            'remove_point' => $point,
        );
        return $return;
    } // }}}









}
