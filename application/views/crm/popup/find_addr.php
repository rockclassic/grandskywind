<!--<script src="/assets/javascripts/jquery/jquery.form.min.js" type="text/javascript"></script>-->

<? if(defined('HTTPS_SET') && HTTPS_SET=="on"){?>
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<?}else{?>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script charset="UTF-8" type="text/javascript" src="http://t1.daumcdn.net/postcode/api/core/180928/1538455030985/180928.js"></script>
<?}?>
<!--<script  src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=uM2XupCoWF1KRFPpHZkZ&submodules=geocoder"></script>
<link href="/assets/toastr/toastr.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="/assets/toastr/toastr.min.js" type="text/javascript"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" type="text/javascript"></script>-->
<script>
    function addr_open() {
        var width = 500; //팝업의 너비
        var height = 600; //팝업의 높이
        var themeObj = {
            //bgColor: "", //바탕 배경색
            searchBgColor: "#0B65C8", //검색창 배경색
            //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
            //pageBgColor: "", //페이지 배경색
            //textColor: "", //기본 글자색
            queryTextColor: "#FFFFFF" //검색창 글자색
            //postcodeTextColor: "", //우편번호 글자색
            //emphTextColor: "", //강조 글자색
            //outlineColor: "", //테두리
        };
        new daum.Postcode({
            theme: themeObj,
            width: width, //생성자에 크기 값을 명시적으로 지정해야 합니다.
            height: height,
            oncomplete: function(data) {
                console.log(data);
                $("#post").val(data.zonecode);
                $("#addr1").val(data.address);
                searchAddressToCoordinate();
            }
        }).open({
            popupName: 'postcodePopup',
            left: (window.screen.width / 2) - (width / 2),
            top: (window.screen.height / 2) - (height / 2)
        });
    }

</script>
우편번호 <input id="post" readonly/>
&nbsp;&nbsp;
<button onclick="addr_open()" >주소검색</button>
<br><br>
주소 <input id="addr1" style="width: 500px"  value="<?=$addr?>" readonly/>

<br><br>
좌표 <input id="lati" readonly/><input id="long" readonly/>
&nbsp;&nbsp;
<button onclick="closeWindow()" >좌표넘기고 닫기</button>
<br><br>
<div id="map" style="width: 300px;height: 300px"></div>
<br>
<script>

    var map = new naver.maps.Map("map", {
        center: new naver.maps.LatLng(37.3595316, 127.1052133),
        zoom: 10,
        mapTypeControl: true
    });

    var infoWindow = new naver.maps.InfoWindow({
        anchorSkew: true
    });

    map.setCursor('pointer');



    // result by latlng coordinate
    function searchAddressToCoordinate() {
        var address=$("#addr1").val();
        if(!address){
            toastr.error('주소가 입력되지 않았습니다.');
            return;
        }
        naver.maps.Service.geocode({
            address: address
        }, function(status, response) {
            if (status === naver.maps.Service.Status.ERROR) {
                return alert('Something Wrong!');
            }

            var item = response.result.items[0],
                addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]',
                point = new naver.maps.Point(item.point.x, item.point.y);
            $("#long").val(item.point.x);
            $("#lati").val(item.point.y);


            infoWindow.setContent([
                '<div style="padding:10px;min-width:200px;line-height:150%;font-size:10px">',
                addrType +' '+ item.address ,
                '</div>'
            ].join('\n'));


            //map.setCenter(point);

            infoWindow.open(map, point);
            var html=$("#map");
            html.children().each(function(index,item) {
                this.id = "chr_"+index;
            });
            exportCanvasAsPNG("map");
            exportCanvasAsPNG("chr_0");
            exportCanvasAsPNG("chr_1");
            exportCanvasAsPNG("chr_2");
            exportCanvasAsPNG("chr_3");
            exportCanvasAsPNG("chr_4");


        });
    }


    function closeWindow() {

        <?if($x&&$y){?>
        $(opener.document).find("#<?=$x?>").val($("#lati").val());
        $(opener.document).find("#<?=$y?>").val($("#long").val());
        $(opener.document).find("#<?=$x?>").focus();
        window.close();
        <?}else{?>
        alert("넘길 좌표의 인덱스가 없습니다. 다시 확인 해 주세요.");
        window.close();
        <?}?>
    }



    <?if(!empty($addr)){?>
    searchAddressToCoordinate('<?=$addr?>');
    <?}?>


    function exportCanvasAsPNG(id) {
        var html=$("#"+id);

        var img=html2canvas(html,{
            // allowTaint: true,
            // taintTest: false,
            onrendered: function (canvas) {
                html.append(canvas);
                getCanvas = canvas;

                var src = canvas.toDataURL("image/png");

                src = src.replace('data:image/png;base64,', '');
                var finalImageSrc = 'data:image/png;base64,' + src;

                var url = '/crm/popup/makeImg';
                var data = {'data':finalImageSrc,'id':id};

                ajax_post(url, data, function(ret) {

                    if(ret.msg == 'success') {
                        toastr.success('진행 상태가 변경되었습니다.');

                    } else {
                        toastr.error('error : '+ret.data);

                    }
                });
                }
            });


    }
    function ajax_post(url, data, callback, callback_done, callback_fail, datatype){
        // console.log("#11");
        if(!datatype) {
            var contenttype = 'application/json; charset=utf-8';
            datatype = 'json';
        }
        $.ajax({
            'url': url,
            'type': 'POST',
            'dataType': datatype,
            'contentType': contenttype,
            'processData': false,
            'data': JSON.stringify(data),
            'success': callback
        })
            .done(function(ret){
                if(callback_done) callback_done(ret);
            })
            .fail(function(){
                if(callback_fail) callback_fail();
            });
    }
</script>
