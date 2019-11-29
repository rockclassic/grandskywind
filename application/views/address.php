<script src="/assets/javascripts/jquery/jquery.form.min.js" type="text/javascript"></script>
<? if(defined('HTTPS_SET') && HTTPS_SET=="on"){?>
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<?}else{?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script charset="UTF-8" type="text/javascript" src="http://t1.daumcdn.net/postcode/api/core/180928/1538455030985/180928.js"></script>
<?}?><script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script>
    var themeObj = {
        //bgColor: "", //바탕 배경색
        // searchBgColor: "#0B65C8", //검색창 배경색
        //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
        //pageBgColor: "", //페이지 배경색
        //textColor: "", //기본 글자색
        // queryTextColor: "#FFFFFF" //검색창 글자색
        //postcodeTextColor: "", //우편번호 글자색
        //emphTextColor: "", //강조 글자색
        //outlineColor: "", //테두리
    };
    new daum.Postcode({
        theme: themeObj,
        oncomplete: function(data) {
            if(data.userSelectedType=="R"){
                // userSelectedType : 검색 결과에서 사용자가 선택한 주소의 타입
                // return type : R - roadAddress, J : jibunAddress
                // TestApp 은 안드로이드에서 등록한 이름
                window.mediplan.setAddress(data.zonecode, data.roadAddress, data.buildingName);
            }
            else{
                window.mediplan.setAddress(data.zonecode, data.jibunAddress, data.buildingName);
            }
        }
    }).open();
</script>