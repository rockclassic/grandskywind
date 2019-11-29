<?php
/**
 * @ description : Point model
 * @ author : jeromc
 * @property Commondao $commondao
 */
class Pointbiz extends CI_Model {
    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    // 관리자 로그 저장
    private function _save_admin($user_srl=null, $user_id,$comment) { // {{{
        $sql_param = array();
        $sql_param['admin_id'] = $user_id;
        $sql_param['user_srl'] = $user_srl;
        $sql_param['action_comment'] = $comment;
        $sql_param['user_log_ip_address'] = $_SERVER['REMOTE_ADDR'];
        $sql_param['action_date'] = YMD_HIS;
        $admin_srl = $this->commondao->insert_table('admin_log', $sql_param);
        if(empty($admin_srl)) except('데이터 저장 실패', true);
    } // }}}

    //  포인트 저장 by.jeromc 2018-11-26
    public function point_save($type,$office_id, $amount,$user_id,$expire_days=365,$dtype=190,$memo=null) { // {{{
        $return = array();
        $sql_param = array();
        $user_id=empty($user_id) ? $this->openssl_mem->aes_decrypt(USER_ID) : $user_id;

        try {
            $this->db2->trans_begin();
            if ($amount > 0) {
                if ($type == "save") { //적립
                    $sql_param['ob_office_idx'] = $office_id;
                    $sql_param['p_dtype'] = $dtype;
                    $sql_param['amount'] = $amount;
                    $sql_param['used_amount'] = 0;
                    $sql_param['p_memo'] = $memo ? $memo : "포인트 적립";
                    $sql_param['p_type'] = "point";
                    $sql_param['p_regId'] = $user_id;
                    $sql_param['p_uptId'] = $user_id;
                    $sql_param['p_regDt'] = YMD_HIS;
                    $sql_param['p_uptDt'] = YMD_HIS;
                    if (isset($expire_days) && $expire_days == "t") { //말
                        $sql_param['expiredDt'] = date('Y-m-t') . " 23:59:59";
                    } else {
                        $sql_param['expiredDt'] = date('Y-m-d', time() + $expire_days * 86400) . " 23:59:59";
                    }
                    $point_id = $this->commondao->insert_table('tbl_point', $sql_param);
                    if(empty($point_id)) except('데이터 저장 실패(1001)', true);
                    $return['msg'] = 'success';
                    $return['data'] = $point_id;
                    $this->_save_admin($office_id, $user_id,"포인트 적립 [" . $point_id . "] -- " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
                } else { //사용 및 소멸 use

                    $return = array();
                    $urpoint=$this->get_point($office_id);
                    if($urpoint['sum_amount']>=$amount) {
                        $sql = "SELECT
                             p_idx,amount ,used_amount,(amount-used_amount) as sum_amount,expiredDt
                            FROM tbl_point
                            where ob_office_idx=?
                            and expiredDt > now()
                            and amount-used_amount >0
                            
                     ";

                        $sql .= " order by expiredDt ,p_idx";
                        $sql_param = array($office_id);

                        $result = $this->commondao->get_query($sql, $sql_param);
                        $used_amount = $amount;
                        $in = 0;
                        foreach ($result as $row) {
                            $in++;
                            if ($row['sum_amount'] <= $used_amount) {
                                $used_amount -= $row['sum_amount'];
                                $row['used_amount'] += $row['sum_amount'];
                            } else {
                                $row['used_amount'] += $used_amount;
                                $used_amount = 0;
                            }

                            $where_up = array();
                            $sql_param_up = array();
                            $where_up['p_idx'] = $row['p_idx'];
                            $sql_param_up['used_amount'] = $row['used_amount'];
                            $sql_param_up['p_uptId'] = $user_id;
                            $sql_param_up['p_uptDt'] = YMD_HIS;
                            $log[]=$sql_param_up;
                            $log[]['p_idx']=$where_up['p_idx'];
                            $result = $this->commondao->update_table('tbl_point', $sql_param_up, $where_up);
                            if ($result == 0) except('데이터 저장에 오류가 있습니다.(1003)', true);
                            if ($result < 0) except('데이터 저장에 실패하였습니다.(1004)', true);

                            if ($used_amount == 0) break;
                        }

                        if ($in == 0) except('데이터 저장 실패(1002)', true);
                        // 사용 로그용으로 저장한다. by.jeromc 2018-11-27
                        $sql_param_in = array();
                        $sql_param_in['ob_office_idx'] = $office_id;
                        $sql_param_in['p_dtype'] = $dtype;
                        $sql_param_in['amount'] = 0;
                        $sql_param_in['used_amount'] = 0;
                        $sql_param_in['p_memo'] = $memo. " 포인트 사용 : ".$amount;
                        $sql_param_in['p_type'] = "point";
                        $sql_param_in['p_regId'] = $user_id;
                        $sql_param_in['p_uptId'] = $user_id;
                        $sql_param_in['p_regDt'] = YMD_HIS;
                        $sql_param_in['p_uptDt'] = YMD_HIS;
                        $sql_param_in['expiredDt'] = YMD_HIS;

                        $point_id = $this->commondao->insert_table('tbl_point', $sql_param_in);

                        $return['msg'] = 'success';
                        $return['data'] = $point_id;
                        $this->_save_admin($office_id, $user_id,"포인트 사용 [" .$point_id."/". $in . "] -- " . json_encode($log,JSON_UNESCAPED_UNICODE));
                    }else{
                        except('포인트 부족', true);
                    }
                }
            }
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;

    } // }}}

    // 포인트 가져오기 by.jeromc 2018-11-26
    public function get_point($office_id) { // {{{
        $sql_param = array($office_id);

        $sql ="
        select a.ob_office_idx, max(a.ob_officeNm) as ob_officeNm,max(a.ob_state) as ob_state,
                             ifnull(sum(b.amount),0) as t_amount,
                             ifnull(sum(b.used_amount),0) as used_amount,
                             ifnull(sum(if(b.expiredDt>now(),b.amount-b.used_amount,0)),0) as sum_amount,  
                             ifnull(sum(if(b.expiredDt>now() && b.expiredDt<date_add(now(), interval +7 day),b.amount-b.used_amount,0)),0) as sum_amount_week
                             from tbl_office_base as a 
                             left join tbl_point as b on a.ob_office_idx=b.ob_office_idx
                             where a.ob_office_idx=?
                             group by a.ob_office_idx 
        ";
        $return = $this->commondao->get_query($sql, $sql_param);
        return $return[0];
    } // }}}



}
