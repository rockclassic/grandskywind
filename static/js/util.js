function open_layer() {
    var height = $(document).height();
    $('.back_layer').height(height);
    $('.back_layer').show();
    $('#open_layer').show();
    function resize_layer() {
        var pop_height = $(window).height()/2 - $('#open_layer').height()/2;
        $('.pop_layer').css({"top" :  pop_height});
    }
    $(window).on('resize', function() { resize_layer(); });
    resize_layer();
}

function close_layer() {
    $('.back_layer').hide();
    $('#open_layer').hide();
}

function ax_post(url, data, callback, callback_done ,callback_fail, datatype){
    if(!callback){
        callback = function(ret){
            if(ret.result == 'ok'){
                if(ret.msg){
                    alert(ret.msg);
                }else{
                    alert('성공');
                }
            }else{
                if(ret.msg){
                    alert(ret.msg);
                }else{
                    alert('실패');
                }
            }
        }
    }
    if(!datatype){
        datatype = 'json'
    }
    open_layer();
    //$("button, .btn").attr("disabled","disabled");
    $.post(url, data, callback, datatype)
        .done(function(ret){
            if(callback_done) callback_done(ret);
            close_layer();
            //$("button, .btn").removeAttr("disabled");
        })
        .fail(function(){
            if(callback_fail) callback_fail();
        });
}

function ax_post_file(url, data, callback, callback_done ,callback_fail, datatype){
    if(!callback){ //success
        callback = function(ret){
            if(ret.result == 'ok'){
                if(ret.msg){
                    alert(ret.msg);
                }else{
                    alert('성공');
                }
            }else{
                if(ret.msg){
                    alert(ret.msg);
                }else{
                    alert('실패');
                }
            }
        }
    }
    if(!datatype){
        datatype = 'json'
    }

    open_layer();
    //$("button, .btn").attr("disabled","disabled");

    $.ajax({
        'url': url,
        'type': 'POST',
        'dataType': datatype,
        'contentType': false,
        'processData': false,
        'data': data,
        'success': callback
    })
    .done(function(ret){
        if(callback_done) callback_done(ret);
        close_layer();
        //$("button, .btn").removeAttr("disabled");
    })
    .fail(function(){
        if(callback_fail) callback_fail();
    });
}

function ax_get(url, callback, callback_done, callback_fail, datatype){
    if(!datatype){
        datatype = 'json'
    }
    $.get(url, callback, datatype)
        .done(function(data){
            if(callback_done) callback_done(data);
        })
        .fail(function(){
            if(callback_fail) callback_fail();
        });
}

function in_array(needle, haystack, argStrict) {
  //  discuss at: http://phpjs.org/functions/in_array/
  //   example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
  //   returns 1: true
  //   example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
  //   returns 2: false
  //   example 3: in_array(1, ['1', '2', '3']);
  //   example 3: in_array(1, ['1', '2', '3'], false);
  //   returns 3: true
  //   returns 3: true
  //   example 4: in_array(1, ['1', '2', '3'], true);
  //   returns 4: false

  var key = '',
    strict = !! argStrict;

  //we prevent the double check (strict && arr[key] === ndl) || (!strict && arr[key] == ndl)
  //in just one for, in order to improve the performance 
  //deciding wich type of comparation will do before walk array
  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }

  return false;
}

//ex url = update_query_string(url, 'a', 'b') => url?a=b
function update_query_string(url, key, value) {
    if (!url) url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
        hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            return url.replace(re, '$1' + key + "=" + value + '$2$3');
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
                url += '#' + hash[1];
            return url;
        }
    }
    else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
                url += '#' + hash[1];
            return url;
        }
        else
            return url;
    }
}

//ex $("input.number").digits();
$.fn.digits = function(){ 
    $(this).keyup(function(event) {

        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "")
                        .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        });
    });
}

//ex var new_value = commify(old_value);
function commify(value){
    return value.replace(/\D/g, "")
                .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
}

/*
    엔터로 버튼 클릭하기...
    $("#sg_name").enterTrigger("#search_btn");
    sg_name(아마 input)에 값을 넣고 엔터를 치면 search_btn을 클릭한 것과 같은 효과
*/
(function($){
    $.fn.enterTrigger = function(options){
        var settings = $.extend({
            btn : "#search_btn",
        }, options)
        $(document).on("keypress", this.selector ,function(e){
            if(e.which == 13){
                $(settings.btn).trigger("click");
                e.preventDefault();
            }
        });
        return this;
    };
}(jQuery));

function IsNumeric(input)
{
    return (input - 0) == input && (''+input).trim().length > 0;
}

/*
 * 쿠키 저장하기
 * name : 쿠키명
 * expired : 유지 시간 분단위
 */
function SetCookie(name, value, expired, path)
{
    var date = new Date();
    var minutes = expired;
    if(!path) path = '/';
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    $.cookie(name, value, { expires: date, path: path });
}

/*
 * 쿠키 지우기
 * name : 쿠키명
 */
function DeleteCookie(name, path)
{
    if(!path) path = '/';
    $.removeCookie(name, { path: path });
}

function formatnumber(v1,v2){
    var str = new Array();
    v1 = String(v1);
    for(var i=1;i<=v1.length;i++){
        if(i % v2) str[v1.length-i] = v1.charAt(v1.length-i);
        else str[v1.length-i] = ','+v1.charAt(v1.length-i);
    }
    return str.join('').replace(/^,/,'');
}

