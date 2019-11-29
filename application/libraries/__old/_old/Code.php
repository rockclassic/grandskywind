<?php
/**
 * @ description : Code Library 코드 관련 라이브러리
 * @ author : hjowth <hjowth@inkomaro.com>
**/
class Code {
    var $CI;
    var $db;
    // var $codes_by_sorting;
    // var $codes_by_code;
    // var $type_list;
    var $user_type_list;
    var $steps_code; // 각 Action 별 사용자 표시 단계명과 그에 해당하는 Code
    var $all_steps_code; // 각 Action 별 사용자 표시 단계명과 그에 해당하는 Code

    public function __construct() { // {{{
        $this->CI =& get_instance();
        // $this->type_list = array('INV', 'SALE', 'COIN', 'STEPI', 'STEPS');
        $this->user_type_list = array('INVEST', 'LOAN', 'BUY', 'SELL', 'CANCEL');
        // $this->CI->load->database();
        // $this->db = $this->CI->db;
        // $this->_set_code();

        // 거래현황 조회의 STEP 표시에 사용되는 코드
        $this->steps_code = array(
            'LOAN' => array(
                '등록신청' => array('STEPI_REGIST', 'STEPI_DELIVERY'), // // 투자 상품 등록, 투자자 입금 완료/대출자 배송 송장 등록 전
                '배송중' => array('STEPI_CHECK'), // 대출자 배송 송장 등록 완료, 투자자 검증 전
                '환매대기' => array('STEPI_LOAN'), // 대출금 입금완료, 대출금 상환 전까지, 이자가 입금되는 기간
                '환매검증' => array('STEPI_REDELIVERY', 'STEPI_RECHECK'), // (STEPI_REDELIVERY: 대출금 상환입금 완료, 투자자 배송 송장 등록 전), (STEPI_RECHECK: 투자자 배송 송장 등록 완료, 대출자 물건 확인 전)
                // '거래완료' => array('STEPI_FINISH') // 대출자 검증 완료(투자금 회수), 환매 포기
            ),
            'INVEST' => array(
                '투자신청' => array('STEPI_DELIVERY'), // 투자자 입금 완료, 대출자 배송 송장 등록 전
                '배송검증' => array('STEPI_CHECK'), // 대출자 배송 송장 등록 완료, 투자자 검증 전
                '투자기간' => array('STEPI_LOAN'), // 대출금 입금완료, 대출금 상환 전까지, 이자가 입금되는 기간
                '환매중' => array('STEPI_REDELIVERY', 'STEPI_RECHECK'), // (STEPI_REDELIVERY: 대출금 상환입금 완료, 투자자 배송 송장 등록 전), (STEPI_RECHECK: 투자자 배송 송장 등록 완료, 대출자 물건 확인 전)
                '환매실패' => array('STEPI_FINISH-NOTREBUY') // 환매 포기 (환매 포기만 표기하기 위해 )
                // '거래완료' => array('STEPI_FINISH') // 대출자 검증 완료(투자금 회수), 환매 포기 (환매 포기만 표기한다)
            ),
            'BUY' => array(
                '상품구매' => array('STEPS_DELIVERY'), // 판매자 배송전, 구매자 입금 완료
                '검증중' => array('STEPS_CHECK'), // 판매자 배송 완료, 구매자 확인 전
                // '거래완료' => array('STEPS_FINISH') // 구매자 검증 완료, 판매자 대금입금 완료
            ),
            'SELL' => array(
                '등록단계' => array('STEPS_REGIST'), // ㅍ판매자 상품 등록 완료 
                '배송중' => array('STEPS_DELIVERY', 'STEPS_CHECK'), // 판매자 배송전/구매자 입금 완료, 판매자 배송 완료/구매자 확인 전
                // '거래완료' => array('STEPS_FINISH') // 구매자 검증 완료, 판매자 대금입금 완료
            ),
            'CANCEL' => array(
                '취소진행' => array('STEPC_DELIVERY', 'STEPC_CHECK'), // 관리자 취소 승인 완료 : 배송 등록 전 + // 구매자가 배송 등록 / 판매자 승인 전 
            )
        );

        //admin 거래현황 조회의 STEP 표시에 사용되는 코드
        $this->all_steps_code = array(
            'LOAN' => array(
                '등록신청' => array('STEPI_REGIST', 'STEPI_DELIVERY'), // // 투자 상품 등록, 투자자 입금 완료/대출자 배송 송장 등록 전
                '배송중' => array('STEPI_CHECK'), // 대출자 배송 송장 등록 완료, 투자자 검증 전
                '환매대기' => array('STEPI_LOAN'), // 대출금 입금완료, 대출금 상환 전까지, 이자가 입금되는 기간
                '환매검증' => array('STEPI_REDELIVERY', 'STEPI_RECHECK'), // (STEPI_REDELIVERY: 대출금 상환입금 완료, 투자자 배송 송장 등록 전), (STEPI_RECHECK: 투자자 배송 송장 등록 완료, 대출자 물건 확인 전)
                '거래완료' => array('STEPI_FINISH') // 대출자 검증 완료(투자금 회수), 환매 포기
            ),
            'INVEST' => array(
                '투자신청' => array('STEPI_DELIVERY'), // 투자자 입금 완료, 대출자 배송 송장 등록 전
                '배송검증' => array('STEPI_CHECK'), // 대출자 배송 송장 등록 완료, 투자자 검증 전
                '투자기간' => array('STEPI_LOAN'), // 대출금 입금완료, 대출금 상환 전까지, 이자가 입금되는 기간
                '환매중' => array('STEPI_REDELIVERY', 'STEPI_RECHECK'), // (STEPI_REDELIVERY: 대출금 상환입금 완료, 투자자 배송 송장 등록 전), (STEPI_RECHECK: 투자자 배송 송장 등록 완료, 대출자 물건 확인 전)
                '거래완료' => array('STEPI_FINISH') // 대출자 검증 완료(투자금 회수), 환매 포기 (환매 포기만 표기한다)
            ),
            'BUY' => array(
                '상품구매' => array('STEPS_DELIVERY'), // 판매자 배송전, 구매자 입금 완료
                '검증중' => array('STEPS_CHECK'), // 판매자 배송 완료, 구매자 확인 전
                '거래완료' => array('STEPS_FINISH') // 구매자 검증 완료, 판매자 대금입금 완료
            ),
            'SELL' => array(
                '등록단계' => array('STEPS_REGIST'), // ㅍ판매자 상품 등록 완료 
                '배송중' => array('STEPS_DELIVERY', 'STEPS_CHECK'), // 판매자 배송전/구매자 입금 완료, 판매자 배송 완료/구매자 확인 전
                '거래완료' => array('STEPS_FINISH') // 구매자 검증 완료, 판매자 대금입금 완료
            ),
            'CANCEL' => array(
                '취소요청' => array('STEPC_DELIVERY'), // 관리자 취소 승인 완료 : 배송 등록 전
                '배송중' => array('STEPC_CHECK'), // 구매자가 배송 등록 / 판매자 검증 전
                '취소완료' => array('STEPC_FINISH') // 판매자 검증 완료(취소완료)
            ),
        );
    } // }}}
    /*
    private function _set_code(){
        $this->db->select('CODE.code, CODE.code_name, CODE.description, CODE.type, CODE.sorting');
        $this->db->where('CODE.status', 'use');
        $this->db->order_by('CODE.type, CODE.sorting');
        $res = $this->db->get('codes CODE');
        $result = $res->result_array();
        if(!empty($result)){
            foreach($result as $code_row){
                $this->codes_by_code[$code_row['type']][$code_row['code']] = $code_row;
                $this->codes_by_sorting[$code_row['type']][$code_row['sorting']] = $code_row;
            }
        }
    }

    // $type 에 해당하는 코드 array를 리턴
    public function get_codes($type, $sorting=FALSE){
        if($sorting === TRUE){ 
            return $this->codes_by_sorting[$type];
        }
        else{
            return $this->codes_by_code[$type];
        }
    }

    // $type, $code 에 해당하는 코드 정보 리턴
    public function get_code($type, $code){
        if(in_array($type, $this->type_list)){
            return $this->codes_by_code[$type][$code];
        }
        else{
            return FALSE;
        }
    }*/

    // user_type = INVEST:투자자, LOAN:대출자, BUY:구매자, SALE:판매자
    public function get_steps($user_type){ // {{{
        if(in_array($user_type, $this->user_type_list)){
            return $this->steps_code[$user_type];
        }
    } // }}}

    // user_type = INVEST:투자자, LOAN:대출자, BUY:구매자, SALE:판매자
    public function get_all_steps($user_type){ // {{{
        if(in_array($user_type, $this->user_type_list)){
            return $this->all_steps_code[$user_type];
        }
    } // }}}

    // 상품리스트에서 표시되는 Invest product list steps
    public function get_open_invest_steps(){ // {{{
        return array('STEPI_REGIST', 'STEPI_DELIVERY', 'STEPI_CHECK');
    } // }}}

    // 상품리스트에서 표시되는 sale product list steps
    public function get_open_sale_steps(){ // {{{
        return array('STEPS_REGIST');
    } // }}}

    //관리자에서 강제 cancel이 가능한 invest_steps
    public function get_cancle_invest_steps(){ // {{{
        return array('STEPI_DELIVERY', 'STEPI_CHECK', 'STEPI_LOAN', 'STEPI_REDELIVERY', 'STEPI_RECHECK');
    } // }}}

    //관리자에서 강제 cancel이 가능한 sale_steps
    public function get_cancle_sale_steps(){ // {{{
        return array('STEPS_DELIVERY', 'STEPS_CHECK');
    } // }}}

    //관리자에서 강제 삭제가 가능한 steps
    public function get_delete_steps(){ // {{{
        return array('STEPI_REGIST', 'STEPS_REGIST');
    } // }}}

    // 은행 리스트 가져오기 type : BANK , data : bank_code => bank_name
    public function get_bank() { // {{{
        $sql = "SELECT code, code_name, description FROM codes WHERE type = 'BANK' AND status = 'use' ORDER BY sorting ASC";
        if(empty($this->db)){
            $this->CI->load->database();
            $this->db = $this->CI->db;
        }
        $result = $this->db->query($sql);
        $return = array();
        foreach($result->result_array() as $k => $v) {
            $return[$v['code']] = $v['code_name'];
        }
        return $return;
    } // }}}

    // cs_type CODE 가져오기 type : CS , data : cs_code => cs_code_name
    public function get_cs() { // {{{
        $sql = "SELECT code, code_name, description FROM codes WHERE type = 'CS' AND status = 'use' ORDER BY sorting ASC";
        if(empty($this->db)){
            $this->CI->load->database();
            $this->db = $this->CI->db;
        }
        $result = $this->db->query($sql);
        $return = array();
        foreach($result->result_array() as $k => $v) {
            $return[$v['code']] = $v['code_name'];
        }
        return $return;
    } // }}}

    // term
    public function get_term($type='all') { // {{{
        $sql = "SELECT
                    T.term_srl, T.term_title, T.term_text,
                    C.code, C.code_name, C.sorting
                FROM terms T
                    INNER JOIN codes C ON T.term_code = C.code AND C.status = 'use'
                WHERE 1=1
                    AND T.term_status = 'use'
                    AND T.status = 'use'
                    ORDER BY C.sorting ASC";
        if(empty($this->db)){
            $this->CI->load->database();
            $this->db = $this->CI->db;
        }
        $result = $this->db->query($sql);
        $return = array();
        foreach($result->result_array() as $k => $v) {
            if(strpos($v['code'], 'THANK_') !== false && in_array($type, array('all', 'term'))) {
                $return[$v['code_name']][$v['code']] = array('term_srl' => $v['term_srl'], 'title' => $v['term_title'], 'term_text' => $v['term_text']);
            } else if(strpos($v['code'], 'AUTH_') !== false && in_array($type, array('all', 'auth'))) {
                $return[$v['code_name']][$v['code']] = array('term_srl' => $v['term_srl'], 'title' => $v['term_title'], 'term_text' => $v['term_text']);
            }
        }
        return $return;
    } // }}}


    // 투자 상품과 관련된 상태별 action/status (거래현황의 lists,view에서 사용)
    public function get_invest_action($invest_type, $product, $view_type='list') { // {{{
        $result = array(
            'status' => null,
            'list' =>  array(),
            'view' =>  array(),
        );

        /*if($product['cs_status'] === 'Y'){
            $result = array(
                'status' => 'CS 접수',
                'list' =>  array(
                    'type'=>'status', 
                    'label'=>'CS 접수', 
                ),
                'view' =>  array(
                    array(
                        'type'=>'status', 
                        'label'=>'CS 접수', 
                    )
                ),
            );
            return $result[$view_type];
        }*/

        if($invest_type === 'LOAN'){ // 대출자
            if($product['invest_status'] === 'STEPI_REGIST'){ // 등록
                $result = array(
                    'status' => '입찰 등록',
                    // [list] 1. 상태
                    'list' =>  array(
                        'type'=>'status', 
                        'label'=>'입찰등록', 
                    ),
                    // [view] 1. 수정 버튼
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'상품 수정', 
                            'link' => '/my/investaction/form/'.$product['prod_srl']
                        )
                    )
                );
                
            }
            else if($product['invest_status'] === 'STEPI_DELIVERY'){ // 투자진행중 
                $result = array(
                    'status' => '배송 대기',
                    // [list] 1. 배송 등록 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>$product['delivery_type']==='direct'?'배송완료':'배송등록', 
                        'link' => '/my/investaction_form/inv_send/'.$product['prod_srl']
                    ),
                    // [view] 1. 배송 등록 버튼
                    // [view] 2. 거래 거절 버튼 [INV_DENY]
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>$product['delivery_type']==='direct'?'배송완료':'배송등록', 
                            'link' => '/my/investaction_form/inv_send/'.$product['prod_srl']
                        ),
                        array(
                            'type'=>'link', 
                            'label'=>'취소', 
                            'link' => '/my/investaction_form/inv_send/'.$product['prod_srl'],
                        )
                    )
                );
            }
            else if($product['invest_status'] === 'STEPI_CHECK'){ // 검증
                $result = array(
                    'status' => '배송중',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송중', 
                    ),
                    // [view] 기능 없음
                    'view' => array(),
                );
            }
            else if($product['invest_status'] === 'STEPI_LOAN'){ // 대출완료
                $result = array(
                    'status' => '투자기간',
                    // [list] 1. 투자 기간중 : 상태 - 기능 없음
                    // [list] 2. 환매 기간중 : 환매하기 버튼
                    // [list] 3. 환매 기간 종료 : 상태 - 기능 없음
                    'list' => array(),
                    // [view] 1. 투자 기간중 : 기능 없음
                    // [view] 2-1. 환매 기간중 : 환매하기 버튼
                    // [view] 2-2. 환매 기간중 : 환매포기 버튼
                    // [view] 4. 환매 기간 종료 : 기능 없음
                    'view' => array()
                );

                if(strtotime($product['invest_end_datetime']) > time()){ // 투자 기간중
                    $datetime_start = date_create($product['invest_start_datetime']);
                    $datetime_end = date_create($product['invest_end_datetime']);
                    $datetime_now = date_create(YMD_HIS);
                    $remain_interval = date_diff($datetime_now, $datetime_end);
                    $remain_interval_text = $remain_interval->format('%a일 %h시 %i분');
                    $remain_interval_percent = round((strtotime($product['invest_end_datetime']) - time()) / (strtotime($product['invest_end_datetime']) - strtotime($product['invest_start_datetime'])) * 100);

                    if(strtotime($product['invest_return_start_datetime']) <= time() && strtotime($product['invest_return_datetime']) >= time()){ //투자기간 내 환매 기간중
                        $result['list'] = array(
                            'type' => 'link',
                            'label' => '환매하기',
                            'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                            'extra_info' => '환매기한, '.$remain_interval_text
                        );

                        $result['view'] = array(
                            array(
                                'type' => 'link',
                                'label' => '환매하기',
                                'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                            ),
                            // array(
                            //     'type'=>'link', 
                            //     'label' => '환매포기',
                            //     'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                            // ),
                        );
                    }
                    else{
                        $result['list'] = array(
                            'type' => 'status',
                            'label' => '<span class="standby">대기중</span>',
                            'extra_info' => '환매대기, '.$remain_interval_text
                        );
                    }
                }
                else if(strtotime($product['invest_return_start_datetime']) <= time() && strtotime($product['invest_return_datetime']) >= time()){ // 투자기간 종료 & 환매 기간중
                    $datetime_return = date_create($product['invest_return_datetime']);
                    $datetime_now = date_create(YMD_HIS);
                    $remain_interval = date_diff($datetime_now, $datetime_return);
                    $remain_interval_text = $remain_interval->format('%a일 %h시 %i분');
                    $result['list'] = array(
                        'type' => 'link',
                        'label' => '환매하기',
                        'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                    );

                    $result['view'] = array(
                        array(
                            'type' => 'link',
                            'label' => '환매하기',
                            'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                        ),
                        // array(
                        //     'type'=>'link', 
                        //     'label' => '환매포기',
                        //     'link' => '/my/investaction_form/inv_rebuy/'.$product['prod_srl'],
                        // ),
                    );
                }
                else{
                    $result['list'] = array(
                        'type' => 'status',
                        'label' => '환매 종료 처리 중',
                    );
                }

                
            }
            else if($product['invest_status'] === 'STEPI_REDELIVERY'){ // 환매진행
                $result = array(
                    'status' => '배송 전',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송 전', 
                    ),
                    // [view] 1. 신고 버튼 : INV_CSRETURN (송장 미등록)
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'신고하기', 
                            //'link' => '/my/investaction/csreturn_form/'.$product['prod_srl']
                            'link' => '/cs/form/?cs_type=CS_DELIVERY&prod_srl='.$product['prod_srl'].'&prod_type=invest'
                        )
                    )
                );

            }
            else if($product['invest_status'] === 'STEPI_RECHECK'){ // 환매검증
                $result = array(
                    'status' => '환매검증',
                    // [list] 1. 검증하기 (완료처리) 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'검증하기', 
                        'link' => '/my/investaction_form/inv_finish/'.$product['prod_srl'],
                    ),
                    // [view] 1. 검증하기 (완료처리) 버튼 : INV_FINISH
                    // [view] 2. 신고 버튼 : INV_CSPRODUCT (물품 이상)
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'검증하기', 
                            'link' => '/my/investaction_form/inv_finish/'.$product['prod_srl']
                        ),
                        array(
                            'type'=>'link', 
                            'label'=>'신고하기', 
                            //'link' => '/my/investaction/csproduct_form/'.$product['prod_srl']
                            'link' => '/cs/form/?cs_type=CS_DELIVERY&prod_srl='.$product['prod_srl'].'&prod_type=invest'
                        )
                    )
                );
            }
            else if($product['invest_status'] === 'STEPI_FINISH'){ // 투자완료 (환매성공, 환매실패, 즉시구매)
                // 기능 없음
            }
        }
        else if($invest_type === 'INVEST'){ // 투자자
            if($product['invest_status'] === 'STEPI_DELIVERY'){ // 투자진행중 
                $result = array(
                    'status' => '투자신청',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'투자취소 ', 
                        'link' => '/my/investaction_form/inv_cancel/'.$product['prod_srl']
                    ),
                    // [view] 기능 없음
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'투자취소', 
                            'link' => '/my/investaction_form/inv_cancel/'.$product['prod_srl'],
                        )
                    ),
                );
                
            }
            else if($product['invest_status'] === 'STEPI_CHECK'){ // 검증
                $result = array(
                    'status' => '배송 검증',
                    // [list] 1. 배송 검증 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'검증하기 ', 
                        'link' => '/my/investaction_form/inv_accept/'.$product['prod_srl']
                    ),
                    // [view] 1. 배송 검증 버튼
                    // [view] 2. 거래신고/취소요청 버튼 : INV_CSCANCEL (물품이상 등의 신고) ->  신고 후 취소 진행 프로세스 확인 필요
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'검증하기', 
                            'link' => '/my/investaction_form/inv_accept/'.$product['prod_srl']
                        ),
                        array(
                            'type'=>'link', 
                            'label'=>'거래신고/취소요청', 
                            //'link' => '/my/investaction/cscancel_form/'.$product['prod_srl']
                            'link' => '/cs/form/?cs_type=CS_CANCEL&prod_srl='.$product['prod_srl'].'&prod_type=invest'
                        )
                    )
                );
            }
            else if($product['invest_status'] === 'STEPI_LOAN'){ // 대출완료
                $result = array(
                    'status' => '투자기간',
                    // [list] 1. 투자 기간중 : 상태 - 기능 없음
                    // [list] 2. 환매 기간중 : 상태 - 기능 없음
                    // [list] 3. 환매 기간 종료 : 상태 - 기능 없음
                    'list' => array(),
                    // [view] 1. 투자 기간중 : 기능 없음
                    // [view] 2. 환매 기간중 : 기능 없음
                    // [view] 3. 환매 기간 종료 : 기능 없음
                    'view' => array()
                );

                if(strtotime($product['invest_end_datetime']) > time()){ // 투자 기간중
                    $datetime_start = date_create($product['invest_start_datetime']);
                    $datetime_end = date_create($product['invest_end_datetime']);
                    $datetime_now = date_create(YMD_HIS);
                    $remain_interval = date_diff($datetime_now, $datetime_end);
                    $remain_interval_text = $remain_interval->format('%a일 %h시 %i분');
                    $remain_interval_percent = round((strtotime($product['invest_end_datetime']) - time()) / (strtotime($product['invest_end_datetime']) - strtotime($product['invest_start_datetime'])) * 100);

                    if(strtotime($product['invest_return_start_datetime']) <= time() && strtotime($product['invest_return_datetime']) >= time()){ //투자기간 내 환매 기간중
                        $result['list'] = array(
                            'type' => 'status',
                            'label' => $remain_interval_text.' :: 환매중',
                        );
                    }
                    else{
                        $result['list'] = array(
                            'type' => 'status',
                            'label' => $remain_interval_text.' :: '.$remain_interval_percent.'% 남음',
                            'percent' => $remain_interval_percent,
                        );
                    }
                }
                else if(strtotime($product['invest_return_start_datetime']) <= time() && strtotime($product['invest_return_datetime']) >= time()){ // 투자기간 종료 & 환매 기간중
                    $datetime_return = date_create($product['invest_return_datetime']);
                    $datetime_now = date_create(YMD_HIS);
                    $remain_interval = date_diff($datetime_now, $datetime_return);
                    $remain_interval_text = $remain_interval->format('%a일 %h시 %i분');
                    $result['list'] = array(
                        'type' => 'status',
                        'label' => $remain_interval_text.' :: 환매중',
                    );
                }
                else{
                    $result['list'] = array(
                        'type' => 'status',
                        'label' => '환매 종료 처리 중',
                    );
                }
            }
            else if($product['invest_status'] === 'STEPI_REDELIVERY'){ // 환매진행
                $result = array(
                    'status' => '배송 대기',
                    // [list] 1. 배송 등록 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>$product['return_delivery_type']==='direct'?'배송 완료':'배송 등록', 
                        'link' => '/my/investaction_form/inv_return/'.$product['prod_srl']
                    ),
                    // [view] 1. 배송 등록 버튼 
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>$product['return_delivery_type']==='direct'?'배송 완료':'배송 등록', 
                            'link' => '/my/investaction_form/inv_return/'.$product['prod_srl']
                        )
                    ),
                );
            }
            else if($product['invest_status'] === 'STEPI_RECHECK'){ // 환매검증
                $result = array(
                    'status' => '환매중',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송 중', 
                    ),
                    // [view] 1. 신고 버튼 : INV_CSFINISH (검증 불이행?)
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'신고', 
                            //'link' => '/my/investaction/csfinish_form/'.$product['prod_srl']
                            'link' => '/cs/form/?cs_type=CS_DELIVERY&prod_srl='.$product['prod_srl'].'&prod_type=invest'
                        )
                    )
                );
            }
            else if($product['invest_status'] === 'STEPI_FINISH'){ // 투자완료 (환매성공, 환매실패, 즉시구매)
                $result = array(
                    'status' => '종료',
                    // [list] 1. 환매 성공 : 기능 없음
                    // [list] 2. 환매 실패 : 땡큐마켓 등록 버튼
                    // [list] 3. 즉시 구매 : 기능 없음
                    'list' => array(),
                    // [view] 1. 환매 성공 : 기능 없음
                    // [view] 2. 환매 실패 : 땡큐마켓 등록 버튼
                    // [view] 3. 즉시 구매 : 기능 없음
                    'view' => array()
                );

                if($product['invest_finish_status'] === 'notrebuy'){
                    $result['list'] = array(
                        'type'=>'link', 
                        'label'=>'땡큐마켓 등록', 
                        'link' => '/sale/form/new/'.$product['prod_srl']
                    );
                    $result['view'] = array(
                            array(
                            'type'=>'link', 
                            'label'=>'땡큐마켓 등록', 
                            'link' => '/sale/form/new/'.$product['prod_srl']
                        )
                    );
                }
                else{
                    $result['list'] = array(
                        'type'=>'status', 
                        'label'=>'종료', 
                    );
                    $result['view'] = array(
                        'type'=>'link', 
                        'label'=>'종료', 
                    );
                }
            }
        }
        
        return $result[$view_type];
    } // }}}

    // 마켓 판매 상품과 관련된 상태별 action/status (거래현황의 lists,view에서 사용)
    public function get_sale_action($sale_type, $product, $view_type='list') { // {{{
        $result = array(
            'status' => null,
            'list' =>  array(),
            'view' =>  array(),
        );

        if($sale_type === 'SELL'){ // 판매자
            if($product['sale_status'] === 'STEPS_REGIST'){ // 등록
                $result = array(
                    'status' => '상품 등록',
                    // [list] 1. 상태
                    'list' =>  array(
                        'type'=>'status', 
                        'label'=>'상품등록', 
                    ),
                    // [view] 1. 수정 버튼
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'상품 수정', 
                            'link' => '/my/saleaction/form/'.$product['prod_srl']
                        ),
                        array(
                            'type'=>'link', 
                            'label'=>'등록 취소 ', 
                            'link' => '/my/saleaction_form/sale_delete/'.$product['prod_srl']
                        )
                    )
                );
                
            }
            else if($product['sale_status'] === 'STEPS_DELIVERY'){ // 투자진행중 
                $result = array(
                    'status' => '배송 대기',
                    // [list] 1. 배송 등록 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'배송등록', 
                        'link' => '/my/saleaction_form/sale_send/'.$product['prod_srl']
                    ),
                    // [view] 1. 배송 등록 버튼
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'배송등록', 
                            'link' => '/my/saleaction_form/sale_send/'.$product['prod_srl']
                        )
                    )
                );
            }
            else if($product['sale_status'] === 'STEPS_CHECK'){ // 검증
                $result = array(
                    'status' => '배송중',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송중', 
                    ),
                    // [view] 기능 없음
                    'view' => array(),
                );
            }
            else if($product['sale_status'] === 'STEPS_FINISH'){ // 판매완료
                //기능 없음
                $result['status'] = '판매완료';
            }
        }
        else if($sale_type === 'BUY'){ // 구매자
            if($product['sale_status'] === 'STEPS_DELIVERY'){ // 배송 대기 
                $result = array(
                    'status' => '배송 대기',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'구매취소 ', 
                        'link' => '/my/saleaction_form/sale_cancel/'.$product['prod_srl']
                        // 'link' => '/cs/form?cs_type=CS_CANCEL&prod_srl='.$product['prod_srl'].'&prod_type=sale'
                    ),
                    // [view] 기능 없음
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'구매취소 ', 
                            'link' => '/my/saleaction_form/sale_cancel/'.$product['prod_srl']
                            // 'link' => '/cs/form?cs_type=CS_CANCEL&prod_srl='.$product['prod_srl'].'&prod_type=sale'
                        )
                    ),
                );
                
            }
            else if($product['sale_status'] === 'STEPS_CHECK'){ // 검증
                $result = array(
                    'status' => '배송 검증',
                    // [list] 1. 배송 검증 버튼
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'검증하기 ', 
                        'link' => '/my/saleaction_form/sale_finish/'.$product['prod_srl']
                    ),
                    // [view] 1. 배송 검증 버튼
                    // [view] 2. 거래신고/취소요청 버튼 : INV_CSCANCEL (물품이상 등의 신고) ->  신고 후 취소 진행 프로세스 확인 필요
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'검증하기', 
                            'link' => '/my/saleaction_form/sale_finish/'.$product['prod_srl']
                        ),
                        array(
                            'type'=>'link', 
                            'label'=>'거래신고/취소요청', 
                            //'link' => '/my/saleaction/cscancel_form/'.$product['prod_srl']
                            'link' => '/cs/form/?cs_type=CS_DELIVERY&prod_srl='.$product['prod_srl'].'&prod_type=sale'
                        )
                    )
                );
            }
            else if($product['sale_status'] === 'SALE_FINISH'){ // 투자완료 (환매성공, 환매실패, 즉시구매)
                //기능 없음
                $result['status'] = '판매완료';
            }
        }

        return $result[$view_type];
    } // }}}

    // 마켓 판매 상품과 관련된 상태별 action/status (거래현황의 lists,view에서 사용)
    public function get_cancel_action($cancel_type, $cancel_product, $view_type='list') { // {{{
        $result = array(
            'status' => null,
            'list' =>  array(),
            'view' =>  array(),
        );

        if($cancel_type === 'BUY'){ // 구매자, 반송해야되는 사람
            if($cancel_product['cancel_status'] === 'STEPC_DELIVERY'){ // 배송 등록...
                $result = array(
                    'status' => '배송 하기',
                    // [list] 1. 상태
                    'list' =>  array(
                        'type'=>'link', 
                        'label'=>'배송 하기', 
                        'link' => '/my/cancelaction_form/cancel_send/'.$cancel_product['canc_prod_srl']
                    ),
                    // [view] 1. 수정 버튼
                    'view' => array(
                        array(
                        'type'=>'link', 
                        'label'=>'배송 하기', 
                        'link' => '/my/cancelaction_form/cancel_send/'.$cancel_product['canc_prod_srl']
                        )
                    )
                );
            }
            else if($cancel_product['cancel_status'] === 'STEPC_CHECK'){ // 배송중
                $result = array(
                    'status' => '배송 중',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송 중', 
                    ),
                    // [view] 기능 없음
                    'view' => array(),
                );
            }
            else if($cancel_product['cancel_status'] === 'STEPC_FINISH'){ // 판매완료
                //기능 없음
                $result['status'] = '취소완료';
            }
        }
        else if($cancel_type === 'SELL'){ // 판매자, 받아야되는사람
            if($cancel_product['cancel_status'] === 'STEPC_DELIVERY'){ // 배송중
                $result = array(
                    'status' => '배송 대기',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'status', 
                        'label'=>'배송 대기', 
                    ),
                    // [view] 기능 없음
                    'view' => array(),
                );
            }
            else if($cancel_product['cancel_status'] === 'STEPC_CHECK'){ // 배송중
                $result = array(
                    'status' => '검증 하기',
                    // [list] 1. 상태
                    'list' => array(
                        'type'=>'link', 
                        'label'=>'검증 하기', 
                        'link' => '/my/cancelaction_form/cancel_accept/'.$cancel_product['canc_prod_srl']
                    ),
                    // [view] 기능 없음
                    'view' => array(
                        array(
                            'type'=>'link', 
                            'label'=>'검증 하기', 
                            'link' => '/my/cancelaction_form/cancel_accept/'.$cancel_product['canc_prod_srl']
                        )
                    ),
                );
            }
            else if($cancel_product['cancel_status'] === 'STEPC_FINISH'){ // 판매완료
                //기능 없음
                $result['status'] = '취소완료';
            }
        }

        return $result[$view_type];
    } // }}}

    public function get_deli_comp_name(){ // {{{
        return array(
            '대한통운', '로젠택배', '옐로우캡', '우체국택배', '현대택배', '이거리스트필요'
        );
    } // }}}
}
?>
