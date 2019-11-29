<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Settle Library 
 * @ author : prog106 <prog106@haomun.com>
 */
class Settle {
    var $CI;
    var $db;
    var $return;
    var $within_pk;
    public function __construct() { // {{{
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->db = $this->CI->db;
        $this->return = array(
            'msg' => 'error',
            'data' => null,
        );
        $this->within_pk = '4';
    } // }}}

    // 게임사 정산 - 게임별 정산 방식으로 진행
    public function game_settle($set_date=null) { // {{{
        // 정산 날짜 정리하기 - 8월에 실행하면 7월분내역을 정산
        $settle_date = (!empty($set_date)) ? $set_date : date('Y-m', mktime(23,59,59,date('m', time())-1, 1, date('Y', time())));
        try {
            $this->db->trans_begin();

            // 게임사 기준 정산 정보를 저장 - settle_game
            $sql = "INSERT INTO settle_game (comp_srl, game_srl, coup_srl, coup_num, set_game_det_price, created_at) 
                    (SELECT
                        G.comp_srl,
                        CP.game_srl,
                        CN.coup_srl,
                        CN.coup_num,
                        CN.coup_price,
                        '".YMD_HIS."'
                    FROM coupon_numbers CN
                        INNER JOIN coupons CP ON CN.coup_srl = CP.coup_srl
                        INNER JOIN games G ON CP.game_srl = G.game_srl
                    WHERE 1=1
                        AND CN.coup_date IS NULL
                        AND CN.coup_price IS NOT NULL)
            ";
            $sql_param = array();
            $res = $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('게임사 정산 대상 정보가 없습니다.'); 

            // coupon_numbers 정보 업데이트
            $sql = "UPDATE
                        coupon_numbers
                    SET
                        coup_date = ?
                    WHERE 1=1
                        AND coup_date IS NULL
                        AND coup_price IS NOT NULL
            ";
            $sql_param = array();
            $sql_param['coup_date'] = date('Y-m-d'); // 실제 진행된 날짜를 저장
            $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('게임사 정산 : 쿠폰 정산 날짜 업데이트에 실패하였습니다.'); 

            // settle 정보 저장 & settle_detail 정보 저장
            $sql = "SELECT
                        *,
                        C.comp_bank
                    FROM settle_game SG
                        INNER JOIN company C ON SG.comp_srl = C.comp_srl
                    WHERE 1=1
                        AND SG.set_game_det_month IS NULL
            ";
            $res = $this->db->query($sql, $sql_param);
            $result = $res->result_array();
            $price_info = array(); // 회사별 금액정보 저장
            $comp_info = array(); // 회사별 쿠폰정보 저장
            $game_info = array(); // 게임별 쿠폰정보 저장
            $coup_info = array(); // 쿠폰별 금액정보 저장
            $bank_info = array(); // 회사별 은행정보 저장
            foreach($result as $k => $v) {
                $price_info[$v['comp_srl']] += $v['set_game_det_price'];
                $game_price_info[$v['game_srl']] += $v['set_game_det_price'];
                $game_comp_info[$v['game_srl']] = $v['comp_srl'];
                $game_coup_info[$v['game_srl']][$v['coup_srl']] += $v['set_game_det_price'];
                $comp_info[$v['coup_srl']] = $v['comp_srl'];
                $game_info[$v['coup_srl']] = $v['game_srl'];
                $coup_info[$v['coup_srl']] += $v['set_game_det_price'];
                $bank_info[$v['comp_srl']] = $v['comp_bank'];
            }

            // settle 저장
            $set_comp = array();
            foreach($game_price_info as $k => $v) {
                $sql_param = array();
                $sql_param['comp_srl'] = $game_comp_info[$k];
                $sql_param['comp_type'] = 'game';
                $sql_param['game_srl'] = $k;
                $sql_param['set_bank'] = $bank_info[$game_comp_info[$k]];
                $sql_param['set_month'] = $settle_date;
                $sql_param['set_price'] = $v;
                $sql_param['created_at'] = YMD_HIS;
                //$set_srl = $this->commondao->insert_table('settle', $sql_param);
                $this->db->insert('settle', $sql_param);
                $set_srl = $this->db->insert_id();
                if(empty($set_srl)) throw new Exception('정산정보 저장에 실패하였습니다. ('.$k.')');
                //$set_comp[$k] = $set_srl;

                // settle_detail 저장
                foreach($game_coup_info[$k] as $kk => $vv) {
                    $sql_param = array();
                    $sql_param['set_srl'] = $set_srl;
                    $sql_param['comp_srl'] = $game_comp_info[$k];
                    $sql_param['comp_type'] = 'game';
                    $sql_param['game_srl'] = $k;
                    $sql_param['coup_srl'] = $kk;
                    $sql_param['set_det_month'] = $settle_date;
                    $sql_param['set_det_price'] = $vv;
                    $sql_param['created_at'] = YMD_HIS;
                    //$result = $this->commondao->insert_table('settle_detail', $sql_param);
                    $this->db->insert('settle_detail', $sql_param);
                    $result = $this->db->insert_id();
                    if(empty($result)) throw new Exception('정산 세부 정보 저장에 실패하였습니다. ('.$k.')');
                }
            }

            // 게임사 정산 완료 업데이트
            $sql = "UPDATE
                        settle_game
                    SET
                        set_game_det_month = ?
                    WHERE 1=1
                        AND set_game_det_month IS NULL
                        AND set_game_det_price IS NOT NULL
            ";
            $sql_param = array();
            $sql_param['set_game_det_month'] = $settle_date;
            $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('게임사 정산 : 쿠폰 정산 날짜 최종 업데이트에 실패하였습니다.'); 

            $this->return['msg'] = 'success';
            $this->return['data'] = true; // 업데이트 성공
            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            $this->return['data'] = $e->getMessage(); 
        }
        return $this->return;
    } // }}}

    // 파트너사 정산
    public function partner_settle($set_date=null) { // {{{
        // 정산 날짜 정리하기 - 8월에 실행하면 7월분내역을 정산
        $settle_date = (!empty($set_date)) ? $set_date : date('Y-m', mktime(23,59,59,date('m', time())-1, 1, date('Y', time())));
        try {
            $this->db->trans_begin();

            // 파트너사 기준 정산 정보를 저장 - settle_partner
            $sql = "INSERT INTO settle_partner (comp_srl, game_srl, coup_srl, coup_num, set_part_det_price, created_at) 
                    (SELECT
                        PC.comp_srl,
                        G.game_srl,
                        CN.coup_srl,
                        CN.coup_num,
                        CN.coup_partner_price,
                        '".YMD_HIS."'
                    FROM coupon_numbers CN
                        INNER JOIN coupons CP ON CN.coup_srl = CP.coup_srl
                        INNER JOIN games G ON CP.game_srl = G.game_srl
                        INNER JOIN partner_coupons PC ON CN.coup_num_srl = PC.coup_num_srl
                    WHERE 1=1
                        AND CN.coup_partner_date IS NULL
                        AND CN.coup_partner_price IS NOT NULL)
            ";
            $sql_param = array();
            $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('파트너사 정산 대상 정보가 없습니다.'); 

            // coupon_numbers 정보 업데이트
            $sql = "UPDATE
                        coupon_numbers
                    SET
                        coup_partner_date = ?
                    WHERE 1=1
                        AND coup_partner_date IS NULL
                        AND coup_partner_price IS NOT NULL
            ";
            $sql_param = array();
            $sql_param['coup_partner_date'] = date('Y-m-d'); // 실제 진행된 날짜를 저장
            $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('파트너사 정산 : 쿠폰 정산 날짜 업데이트에 실패하였습니다.'); 

            // 위드인 이슈 처리
            $sql = "SELECT
                        comp_srl
                    FROM company
                    WHERE 1=1
                        AND parent_comp_srl = ?
            ";
            $sql_param = array();
            $sql_param['parent_comp_srl'] = $this->within_pk; // 위드인 회사 PK
            $res = $this->db->query($sql, $sql_param);
            $result = $res->result_array();
            $within = array();
            foreach($result as $k => $v) {
                $within[] = $v['comp_srl'];
            }

            // settle 정보 저장 & settle_detail 정보 저장
            $sql = "SELECT
                        *,
                        C.comp_bank
                    FROM settle_partner SP
                        INNER JOIN company C ON SP.comp_srl = C.comp_srl
                    WHERE 1=1
                        AND SP.set_part_det_month IS NULL
            ";
            $res = $this->db->query($sql, $sql_param);
            $result = $res->result_array();
            $price_info = array(); // 회사별 금액정보 저장
            $comp_info = array(); // 회사별 쿠폰정보 저장
            $game_info = array(); // 게임별 쿠폰정보 저장
            $coup_info = array(); // 쿠폰별 금액정보 저장
            $bank_info = array(); // 회사별 은행정보 저장
            foreach($result as $k => $v) {
                $price_info[$v['comp_srl']] += $v['set_part_det_price'];
                $comp_info[$v['comp_srl']][$v['coup_srl']] = $v['comp_srl'];
                $game_info[$v['comp_srl']][$v['coup_srl']] = $v['game_srl'];
                $coup_info[$v['comp_srl']][$v['coup_srl']] += $v['set_part_det_price'];
                $bank_info[$v['comp_srl']] = $v['comp_bank'];
                if(in_array($v['comp_srl'], $within)) $price_info[$this->within_pk] += $v['set_part_det_price']; // 위드인 이슈 처리
            }

            // settle 저장
            $set_comp = array();
            foreach($price_info as $k => $v) {
                $sql_param = array();
                $sql_param['comp_srl'] = $k;
                $sql_param['comp_type'] = 'partner';
                $sql_param['set_bank'] = $bank_info[$k];
                $sql_param['set_month'] = $settle_date;
                $sql_param['set_price'] = $v;
                $sql_param['created_at'] = YMD_HIS;
                //$set_srl = $this->commondao->insert_table('settle', $sql_param);
                $this->db->insert('settle', $sql_param);
                $set_srl = $this->db->insert_id();
                if(empty($set_srl)) throw new Exception('정산정보 저장에 실패하였습니다. ('.$k.')');
                $set_comp[$k] = $set_srl;
            }

            // settle_detail 저장
            foreach($coup_info as $k => $v) {
                foreach($v as $kk => $vv) {
                    $sql_param = array();
                    $sql_param['set_srl'] = $set_comp[$comp_info[$k][$kk]];
                    $sql_param['comp_srl'] = $comp_info[$k][$kk];
                    $sql_param['comp_type'] = 'partner';
                    $sql_param['game_srl'] = $game_info[$k][$kk];
                    $sql_param['coup_srl'] = $kk;
                    $sql_param['set_det_month'] = $settle_date;
                    $sql_param['set_det_price'] = $vv;
                    $sql_param['created_at'] = YMD_HIS;
                    //$result = $this->commondao->insert_table('settle_detail', $sql_param);
                    $this->db->insert('settle_detail', $sql_param);
                    $result = $this->db->insert_id();
                    if(empty($result)) throw new Exception('정산 세부 정보 저장에 실패하였습니다. ('.$k.')');
                }
            }

            // 게임사 정산 완료 업데이트
            $sql = "UPDATE
                        settle_partner
                    SET
                        set_part_det_month = ?
                    WHERE 1=1
                        AND set_part_det_month IS NULL
                        AND set_part_det_price IS NOT NULL
            ";
            $sql_param = array();
            $sql_param['set_game_det_month'] = $settle_date;
            $this->db->query($sql, $sql_param);
            $result = $this->db->affected_rows();
            if(empty($result)) throw new Exception('게임사 정산 : 쿠폰 정산 날짜 최종 업데이트에 실패하였습니다.'); 

            $this->return['msg'] = 'success';
            $this->return['data'] = true; // 업데이트 성공
            $this->db->trans_commit();
        } catch(Exception $e) {
            $this->db->trans_rollback();
            $this->return['data'] = $e->getMessage(); 
        }
        return $this->return;
    } // }}}

}
