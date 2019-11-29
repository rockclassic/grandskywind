<!--<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>-->
<!--<script  src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=uM2XupCoWF1KRFPpHZkZ&submodules=geocoder"></script>-->
<!--<link href="/assets/toastr/toastr.min.css" media="all" rel="stylesheet" type="text/css" />-->
<!--<script src="/assets/toastr/toastr.min.js" type="text/javascript"></script>-->
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
    주소 1<input id="addr1" readonly/>
<br><br>
    주소 2<input id="addr2"/>
<br><br>


    좌표 <input id="latx" readonly/><input id="laty" readonly/>
&nbsp;&nbsp;
<button onclick="searchAddressToCoordinate()" >좌표검색</button>
<br>
<br>
<br>
<div id="map" style="width: 300px;height: 300px"></div>
<br>
<br>
<br>


    <input  id="startdate"/>
<br><br>
<input id="start_date" type="text" data-date-format="yyyy-mm-dd" />

<script>
    $( function() {
        $("#start_date").datepicker({
            dateFormat: "yy-mm-dd",
        });
    } );

var map = new naver.maps.Map("map", {
center: new naver.maps.LatLng(37.3595316, 127.1052133),
zoom: 10,
mapTypeControl: true
});

var infoWindow = new naver.maps.InfoWindow({
anchorSkew: true
});

map.setCursor('pointer');

// search by tm128 coordinate
function searchCoordinateToAddress(latlng) {
var tm128 = naver.maps.TransCoord.fromLatLngToTM128(latlng);

infoWindow.close();

naver.maps.Service.reverseGeocode({
location: tm128,
coordType: naver.maps.Service.CoordType.TM128
}, function(status, response) {
if (status === naver.maps.Service.Status.ERROR) {
return alert('Something Wrong!');
}

var items = response.result.items,
htmlAddresses = [];

for (var i=0, ii=items.length, item, addrType; i<ii; i++) {
item = items[i];
addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]';

htmlAddresses.push((i+1) +'. '+ addrType +' '+ item.address);
}

infoWindow.setContent([
'<div style="padding:10px;min-width:200px;line-height:150%;">',
    '<h4 style="margin-top:5px;">검색 좌표</h4><br />',
    htmlAddresses.join('<br />'),
    '</div>'
].join('\n'));

infoWindow.open(map, latlng);
});
}

// result by latlng coordinate
function searchAddressToCoordinate() {
    var address=$("#addr1").val();
naver.maps.Service.geocode({
address: address
}, function(status, response) {
if (status === naver.maps.Service.Status.ERROR) {
return alert('Something Wrong!');
}

var item = response.result.items[0],
addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]',
point = new naver.maps.Point(item.point.x, item.point.y);
console.log(item);
$("#latx").val(item.point.x);
$("#laty").val(item.point.y);

infoWindow.setContent([
'<div style="padding:10px;min-width:200px;line-height:150%;font-size:10px">',
    addrType +' '+ item.address ,
    '</div>'
].join('\n'));


map.setCenter(point);
infoWindow.open(map, point);
});
}

function initGeocoder() {
map.addListener('click', function(e) {
searchCoordinateToAddress(e.coord);
});

$('#address').on('keydown', function(e) {
var keyCode = e.which;

if (keyCode === 13) { // Enter Key
searchAddressToCoordinate($('#address').val());
}
});

$('#submit').on('click', function(e) {
e.preventDefault();

searchAddressToCoordinate($('#address').val());
});

searchAddressToCoordinate('정자동 178-1');
}

// naver.maps.onJSContentLoaded = initGeocoder;

``


var url = '/crm/test/get_list';
var data = {user_srl:"aaa",user_srl2:"bbb"};
ajax_post(url, data, function(ret) {
    console.log(ret);
    if(ret.msg == 'success') {
        toastr.success('1Hello world callback');
        toastr.info('2Hello world callback');
        toastr.warning('3Hello world callback');
        toastr.error('4Hello world callback');
    } else {
        toastr.error('error : '+ret.data);
    }
});
    showSpinner();


</script>