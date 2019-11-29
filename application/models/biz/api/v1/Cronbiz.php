<?php
/**
 * @ description : Cron model
 * @ author : jeromc
 * @property Commondao $commondao
 * @property Openssl_mem $openssl_mem
 */
class Cronbiz extends CI_Model {

    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    // 시도주소 가져오는 쿼리 by.jeromc 2018-11-01
    public function check_sample(){
        return "check_sample";

    }

    public function check_destroy_point(){

            $sql = "SELECT
                             p_idx,amount ,used_amount,(amount-used_amount) as sum_amount,expiredDt,ob_office_idx
                            FROM tbl_point
                            where expiredDt <= now()
                            and amount-used_amount >0
                            
                     ";
            $sql_param= array();
            $result = $this->commondao->get_query($sql, $sql_param);
            $in = 0;
            $sum_amount=0;
            foreach ($result as $row) {
                $in++;
                $where_up = array();
                $sql_param_up = array();

                $where_up['p_idx'] = $row['p_idx'];
                $sql_param_up['used_amount'] = $row['amount'];
                $sql_param_up['p_uptId'] = "cron";
                $sql_param_up['p_uptDt'] = YMD_HIS;
                $sum_amount=$sum_amount+$row['sum_amount'];

                 $this->commondao->update_table('tbl_point', $sql_param_up, $where_up);

                // 사용 로그용으로 저장한다. by.jeromc 2018-11-27
                $sql_param_in = array();
                $sql_param_in['ob_office_idx'] = $row['ob_office_idx'];
                $sql_param_in['p_dtype'] = 300;
                $sql_param_in['amount'] = 0;
                $sql_param_in['used_amount'] = 0;
                $sql_param_in['p_memo'] = " 포인트 소멸 [".$row['p_idx']."] : ".number_format($row['sum_amount']);
                $sql_param_in['p_type'] = "point";
                $sql_param_in['p_regId'] = "cron";
                $sql_param_in['p_uptId'] = "cron";
                $sql_param_in['p_regDt'] = YMD_HIS;
                $sql_param_in['p_uptDt'] = YMD_HIS;
                $sql_param_in['expiredDt'] = YMD_HIS;

                $point_id = $this->commondao->insert_table('tbl_point', $sql_param_in);
                echo $in." :: ".$point_id."\n";
            }
        echo "  ====== > 총 소멸 포안트  :: ".$in." :: ".$sum_amount."p\n";
    }
}
