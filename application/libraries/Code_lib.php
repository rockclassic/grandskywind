<?php
/**
 * @ description : Code Library
 * @ author : prog106 <prog106@haomun.com>
 */
class Code_lib {

    var $coin_code;
    var $tr_type;
    var $tr_code;
    var $cash;
    var $coin;
    var $user_deny;
    var $withdraw_status;
    var $log_code;
    var $withdraw_level_info; // 1일 기준

    public function __construct() { // {{{
        $this->coin_code = array(
            //'KRW' => 'Won',

            // BTC
            'BTC' => 'Bitcoin',
            'ETH' => 'Ethereum',    // TODO: 추후삭제
            'BCC' => 'BitConnect',
            'BTG' => 'BitGold',
            'LTC' => 'Litecoin',
            'QTUM' => 'Qtum',
            'DASH' => 'Dash',
            'ZEC' => 'Zcash',
            'IOP' => 'Internet of people',
            'VTC' => 'Vertcoin',
            'NEO' => 'Neo',
            'XVG' => 'Verge',

            // XRP
            'XRP' => 'Ripple',

            // 독립코인
            'STEEM' => 'Steem',
            'ADA' => 'Cardano ADA',
            'XML' => 'Stellar Lumens',
            'XMR' => 'Monero',
            'IOTA' => 'IOTA',
            'XEM' => 'NEM',
            'LISK' => 'Lisk',

            // ETC
            'ETC' => 'Ethereum Classic',

            // MANA : 코인 묶음 - ETH 계열 ETH-PARETO
//            'ETH' => 'Ethereum',
            'BNG' => 'Bang',
            'EOS' => 'EOS',
            'TRX' => 'Tronix',
            'OMG' => 'OmiseGO',
            'BNB' => 'Binance',
            'PPT' => 'Populous',
            'SNT' => 'Status Network',
            'MKR' => 'Maker',
            'ZRX' => '0xProject',
            'DGD' => 'Digix Global',
            'REP' => 'Auger',
            'BAT' => 'Basic Attention Token',
            'GNT' => 'GOLEM',
            'KNC' => 'Kyber Network Crystal',
            'FUN' => 'FunFair',
            'BNT' => 'Bancor Network',
            'REQ' => 'Request',
            'QSP' => 'Quantstamp',
            'SAN' => 'Santiment',
            'ICN' => 'ICONOMI',
            'GNO' => 'Gnosis',
            'RDN' => 'Raiden',
            'ENJ' => 'EnjinCoin',
            'CVC' => 'Civic',
            'ANT' => 'Aragon Network',
            'RLC' => 'iEx.ec',
            'MCO' => 'Monaco',
            'AST' => 'AirSwap',
            'AMB' => 'Amber',
            'MTL' => 'MetalPay',
            'RCN' => 'Ripio Credit Network',
            'MLN' => 'Melon',
            'EDG' => 'Edgeless',
            'WINGS' => 'Wings',
            'DNT' => 'district0x',
            'CDT' => 'CoinDash',
            'NET' => 'NimiqNetwork',
            'LUN' => 'Lunyr',
            'ADT' => 'AdToken',
            'TKN' => 'Tokencard',
            '1ST' => 'FirstBlood',
            'HMQ' => 'Humaniq',
            'CFI' => 'Cofound.it',
            'NMR' => 'Numeraire',
            'SWT' => 'Swarm City',
            'HGT' => 'HelloGold',
            'PLU' => 'Xaurum',
            'VSL' => 'vSlice',
            'IND' => 'Indorse',
            'FYN' => 'FundYourselfNow',
            'SUB' => 'Substratum',
            'POE' => 'Po.et',
            'MTN' => 'MedToken',
            'ENG' => 'Enigma',
            'SNM' => 'SONM',
            'VEN' => 'VeChain',
            'CMT' => 'CyberMiles',
            'CTR' => 'Centra',
            'MDA' => 'Moeda Loyalty Points',
            'ELF' => 'ELF',
            'EDO' => 'Eidoo',
            'IPL' => 'InsurePal',
            'AID' => 'AidCoin',
            'AVT' => 'AVT',
            'PAY' => 'TenXPay',
            'WTC' => 'Walton',
            'GTO' => 'Gifto',
            'PXS' => 'Pundi X',
            'LNK' => 'Link Platform',
            'AXP' => 'aXpire',
            'CXO' => 'CargoX',
            'MAN' => 'MATRIX AI Network',
            'CPC' => 'CPChai',
            'POWR' => 'PowerLedger',
            'QASH' => 'Qash',
            'SALT' => 'Salt',
            'TENX' => 'TenXPay',
            'MANA' => 'Decentraland',
            'TAAS' => 'Taas Fund',
            'BCAP' => 'Blockchain Capital',
            'TIME' => 'ChronoBank',
            'TRST' => 'WeTrust',
            'XAUR' => 'Pluton',
            'DICE' => 'Etheroll',
            'WABI' => 'WaBi',
            'FUEL' => 'Fuel Token',
            'SXUT' => 'Spectre.ai U-Token',
            'SXDT' => 'Spectre.ai D-Token',
            'DATA' => 'DATAcoin',
            'LINK' => 'ChainLink Token',
            'POLY' => 'Polymath',
            'TRAC' => 'Trace',
            'FOTA' => 'FOTA',
            'AURA' => 'Aurora DAO',
            'ETHOS' => 'Ethos',
            'STORJ' => 'Storj',
            'SNGLS' => 'SingularDTV',
            'STORM' => 'Storm',
            'YOYOW' => 'YOYOW',
            'CREDO' => 'Credo Token',
            'GUPPY' => 'Matchpool',
            'PARETO' => 'Pareto Network Token',


            /*'BCH' => 'Bitcoin Cash',
            'XRP' => 'Ripple',
            'DASH' => 'Dash',
            'LTC' => 'Litecoin',
            'XMR' => 'Monero',
            'NEO' => 'NEO',
            'XEM' => 'NEM',
            'MIOTA' => 'IOTA',
            'ETC' => 'Ethereum Classic',
            'QTUM' => 'Qtum',
            'ZEC' => 'Zcash',
            'LSK' => 'Lisk',
            'ADA' => 'Cardano',
            'HSR' => 'Hshare',
            'XLM' => 'Stellar Lumens',
            'BCC' => 'BitConnect',
            'WAVES' => 'Waves',
            'STRAT' => 'Stratis',
            'ARK' => 'Ark',
            'STEEM' => 'Steem',
            'BTS' => 'BitShares',
            'BCN' => 'Bytecoin',
            'KMD' => 'Komodo',
            'DCR' => 'Decred',
            'VTC' => 'Vertcoin',
            'PIVX' => 'PIVX',
            'MONA' => 'MonaCoin',
            'FCT' => 'Factom',
            'BTCD' => 'BitcoinDark',
            'ETN' => 'Electroneum',
            'SC' => 'Siacoin',
            'DOGE' => 'Dogecoin',
            'GBYTE' => 'Byteball Bytes',
            'ETP' => 'Metaverse ETP',
            'SYS' => 'Syscoin',
            'GAME' => 'GameCredits',
            'BLOCK' => 'Blocknet',
            'LKK' => 'Lykke',
            'GXS' => 'GXShares',
            'XVG' => 'Verge',
            'MNX' => 'MinexCoin',
            'DGB' => 'DigiByte',
            'PURA' => 'Pura',
            'NXT' => 'Nxt',
            'VEN' => 'VeChain',
            'PART' => 'Particl',
            'ZEN' => 'ZenCash',
            'XZC' => 'ZCoin',
            'KCS' => 'KuCoin Shares',
            'NXS' => 'Nexus',
            'UBQ' => 'Ubiq',
            'NEBL' => 'Neblio',
            'FAIR' => 'FairCoin',
            'NAV' => 'NAV Coin',
            'CNX' => 'Cryptonex',
            'BDL' => 'Bitdeal',
            'IOC' => 'I/O Coin',
            'PPC' => 'Peercoin',
            'XCP' => 'Counterparty',
            'NLC2' => 'NoLimitCoin',
            'GRS' => 'Groestlcoin',
            'ACT' => 'Achain',
            'B3' => 'B3Coin',
            'NLG' => 'Gulden',
            'VIA' => 'Viacoin',
            'CLOAK' => 'CloakCoin',
            'OK' => 'OKCash',
            'LEO' => 'LEOcoin',
            'POT' => 'PotCoin',
            'RDD' => 'ReddCoin',
            'RISE' => 'Rise',
            'EMC' => 'Emercoin',
            'XEL' => 'Elastic',
            'SKY' => 'Skycoin',
            'ATB' => 'ATBCoin',
            'BAY' => 'BitBay',
            'NMC' => 'Namecoin',
            'AEON' => 'Aeon',
            'DMD' => 'Diamond',
            'LBC' => 'LBRY Credits',
            'CRW' => 'Crown',
            'SIB' => 'SIBCoin',
            'DCT' => 'DECENT',
            'STCN' => 'Stakecoin',
            'ION' => 'ION',
            'FTC' => 'Feathercoin',
            'XRB' => 'RaiBlocks',
            'BLK' => 'BlackCoin',
            'ECN' => 'E-coin',
            'PPY' => 'Peerplays',
            'RBY' => 'Rubycoin',
            'TOA' => 'ToaCoin',
            'SMART' => 'SmartCash',
            'TCC' => 'The ChampCoin',
            'GRC' => 'GridCoin',
            'EMC2' => 'Einsteinium',
            'EXP' => 'Expanse',
            'BTX' => 'Bitcore',*/
        );
        $this->tr_type = array(
            'LIMIT' => '지정가', // 지정한 가격으로 체결
            'MARKET' => '시장가', // 호가에 자동으로 전량 체결
            'LIMIT_FOK' => '지정가(FOK)', // 지정가(호가)에 수량부족시 전량 취소
            'MARKET_FOK' => '시장가(FOK)', // 호가에 자동으로 전량 체결. 수량부족으로 미체결 발생시 전량 취소
            'LIMIT_IOC' => '지정가(IOC)', // 지정가(호가)에 체결 후 미체결 취소
            'MARKET_IOC' => '시장가(IOC)', // 호가에 자동으로 전량 체결. 미체결 발생시 미체결만 취소
        );
        $this->tr_code = array(
            'POSSIBLE' => '매도/매수 가능 수량 남음',
            'COMPLETE' => '매도/매수 완료(매도/매수 가능 수량 없음)',
            'BID' => '매수',
            'ASK' => '매도',
        );
        $this->cash = array(
            'OUT_TRASK' => '[삭감] 매도요청 체결',
            'OUT_TRBID' => '[삭감] 매수요청 체결',
            'OUT_WD' => '[삭감] 캐쉬 출금요청',
            'IN_ACCOUNT' => '[적립] 계좌입금 적립',
            'IN_WD_CANCEL' => '[적립] 캐쉬 출금취소',
            'IN_TR_CANCEL' => '[적립] 코인 구매 취소',
            'IN_TR' => '[적립] 거래체결',
            'CHANGE' => '[변동] 캐쉬 변동',
        );
        $this->coin = array(
            'OUT_TRASK' => '[삭감] 매도요청 체결',
            'OUT_TRBID' => '[삭감] 매수요청 체결',
            'OUT_WD' => '[삭감] 코인 출금요청',
            'IN_ACCOUNT' => '[적립] 코인 계좌입금 적립',
            'IN_WD_CANCEL' => '[적립] 코인 출금취소',
            'IN_TR_CANCEL' => '[적립] 코인 판매 취소',
            'IN_TR' => '[적립] 거래체결',
            'CHANGE' => '[변동] 코인 변동',
        );
        $this->wallet = array(
            'MOVE' => '[이동]',
            'MINUS' => '[삭감]',
            'PLUS' => '[적립]',
            'TRADE' => '주문',
            'ORDER' => '체결',
            'WITHDRAW' => '출금',
            'CHARGE' => '충전',
            'ASK' => '매도',
            'BID' => '매수',
            'CANCEL' => '취소',

            'MOVE_TRADE' => '[이동] 주문요청',
            'MOVE_TRADE_CANCEL' => '[이동] 주문취소',
            'MINUS_ORDER' => '[삭감] 체결',
            'PLUS_ORDER' => '[적립] 체결',
        );
        $this->user_deny = array(
            'ALL' => array(
                'status' => '정상',
                'comment' => '로그인+출금+거래 가능',
            ),
            'WITHDRAW' => array(
                'status' => '출금 가능',
                'comment' => '로그인+출금 가능 / 거래 불가능',
            ),
            'LOGIN' => array(
                'status' => '로그인 가능',
                'comment' => '로그인 가능 / 출금+거래 불가능',
            ),
            'BLOCK' => array(
                'status' => '서비스차단',
                'comment' => '로그인+출금+거래 불가능',
            ),
            'QUIT' => array(
                'status' => '탈퇴',
                'comment' => '로그인+출금+거래 불가능',
            ),
        );
        $this->withdraw_status = array(
            'REQUEST' => '출금접수',
            'SENDING' => '출금중',
            'HOLDING' => '출금보류',
            'ERROR' => '출금오류',
            'CANCEL' => '출금취소',
            'COMPLETE' => '출금완료',
        );
        $this->log_code = array(
            'PLUS' => '[적립]',
            'MINUS' => '[삭감]',
            'MOVE' => '[이동]',
            'CHARGE' => '충전',
            'WITHDRAW' => '출금',
            'ORDER' => '체결',
            'TRADE' => '주문',
            'CANCEL' => '취소',
            'ASK' => '매도',
            'BID' => '매수',
        );
        $this->withdraw_level_info = array(
            /*'KRW' => array(
                '1' => 0,
                '2' => 0,
                '3' => 50000000,
                '4' => 100000000,
            ),*/
            'BTC' => array(
                '1' => 0,
                '2' => 10, //0.1,
                '3' => 10,
                '4' => 50,
            ),
            'ETH' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
            'QTUM' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
            'DASH' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
            'XVG' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
            'BNG' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
            'XEM' => array(
                '1' => 0,
                '2' => 3,
                '3' => 100,
                '4' => 1000,
            ),
        );
    } // }}}

    public function get_code() { // {{{
        $return = array();
        $return['msg'] = 'success';
        $return['data'] = array(
            'coin_code' => $this->coin_code,
            'tr_type' => $this->tr_type,
            'tr_code' => $this->tr_code,
            'cash' => $this->cash,
            'coin' => $this->coin,
            'user_deny' => $this->user_deny,
            'withdraw_status' => $this->withdraw_status,
        );
        return $return;
    } // }}}

    public function coin_code() { // {{{
        return $this->coin_code;
    } // }}}

    public function tr_type() { // {{{
        return $this->tr_type;
    } // }}}

    public function tr_code() { // {{{
        return $this->tr_code;
    } // }}}

    public function cash() { // {{{
        return $this->cash;
    } // }}}

    public function coin() { // {{{
        return $this->coin;
    } // }}}

    public function user_deny() { // {{{
        return $this->user_deny;
    } // }}}

    public function withdraw_status() { // {{{
        return $this->withdraw_status;
    } // }}}

    public function log_code() { // {{{
        return $this->log_code;
    } // }}}

    public function withdraw_level_info() { // {{{
        return $this->withdraw_level_info;
    } // }}}

}
