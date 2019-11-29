<script>
$(document).ready(function(){
    $('.input-file').each(function() {
        $(this).change(function() {
            var img = $(this).data('image');
            if(window.FileReader){  // modern browser
                var filename = $(this)[0].files[0].name;
            }
            else {  // old IE
                var filename = $(this).val().split('/').pop().split('\\').pop();  // 파일명만 추출
            }
            var url = '/uploadfile/image/'+$(this).data('path')+'/';
            var formData = new FormData();
            formData.append('imageData', $(this)[0].files[0]);
            var data = formData;
            ajax_post_file(url, data, function(ret) {
                if(ret.result == 'ok') {
                    $('#'+img).val(ret.final_name);
                    $('#review_'+img).attr('src', ret.final_thumb_name);
                } else {
                    alert(ret.msg);
                }
            });
        });
    });
    $('.input-file-multi').each(function() {
        $(this).change(function() {
            var img = $(this).data('image');
            var imglen = parseInt($(this)[0].files.length);
            var multi = $(this).data('multi');
            if(imglen > multi) {
                alert('이미지는 최대 '+multi+'개까지 등록할 수 있습니다.');
                return false;
            }
            var url = '/uploadfile/image/'+$(this).data('path')+'/multi/';
            var formData = new FormData();
            for(var i=0;i<multi;i++) {
                formData.append('imageData'+i, $(this)[0].files[i]);
            }
            var data = formData;
            ajax_post_file(url, data, function(ret) {
                if(ret.result == 'ok') {
                    $('#review_'+img).html('');
                    $('#'+img).val(ret.final_name);
                    $.each(ret.final_thumb_name, function(k,v) {
                        $('#review_'+img).append(v+' ');
                    });
                } else {
                    alert(ret.msg);
                }
            });
        });
    });
    $("#period_start, #period_end").datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNames: ['일','월','화','수','목','금','토'],
        dayNamesShort: ['일','월','화','수','목','금','토'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        showMonthAfterYear: true,
        //changeMonth: true,
        //changeYear: true,
        yearSuffix: '년'
    });
    $('.addr1').change(function() { get_address($(this), ''); });
    $('.species_code').change(function() { get_breed($(this), ''); });
    $('.btn_search').click(function() { $('#search_form').submit(); });
    $('.getdate').click(function() {
        $('#period_start').val(get_date($(this).data('days')));
        $('#period_end').val(get_date());
    });
    //$('#period_start').val(get_date());
    //$('#period_end').val(get_date());
    $('.how').click(function() { alert('기능 추가 설명 필요'); });
    $('#check_all').click(function() { $('input:checkbox[name='+$(this).data('check')+'\\[\\]]').prop('checked', $(this).prop('checked')==true); });
});
</script>
