(function($) {
	'use strict';
	try {
		$(document).ready(function(){
			$('#menu').each(function(i){
				var myScroll = new iScroll('nav');
				var menu = SpSlidemenu('#thank', '#nav', '#menu', {direction: 'left'});
				// PC 에서 바로 닫혀버림
				$('#menu').bind("click",function(e){
					e.preventDefault();
				});
				// $('.btn_close, #thank').bind("click",function(e){
				// 	e.preventDefault();
				// 	menu.slideClose();
				// });
				$(window, document).scroll(function(){
					var that_scrollTop = $(this).scrollTop();
					$('header.header', document).css({'top': that_scrollTop});
				});
				$(window).resize(function(){
					setTimeout(function  () {
						myScroll.refresh();
					},1100);
				});
			});
			$('[main-swiper]').queue(function(){
				console.log('main-swiper : start');
				var swiper = new Swiper($(this), {
					wrapperClass: 'banner-visual',
					slideClass: 'banner-item',
					bulletActiveClass: 'on',
					pagination: '.navi-list',
					paginationClickable: true,
					slidesPerView: 'auto',
					centeredSlides: true,
					spaceBetween: 30
				});
			});
			$('[swiper]').queue(function(){
				console.log('swiper : start');
				var swiper = new Swiper($(this), {
					wrapperClass: 'banner-wrapper',
					slideClass: 'banner-item',
					bulletActiveClass: 'on',
					pagination: '.navi-list',
					paginationClickable: true
				});
			});
			$('[select-design]').queue(function(){
				var that = $(this);
				console.log('select-design : start');
				that.on('click', function(){
					$(this).toggleClass('selectbox_title_active');
					if($(this).hasClass('selectbox_title_active')){
						$(this).siblings('.selectbox_option').slideDown('fast', function() {
						});
					}else{
						$(this).siblings('.selectbox_option').slideUp('fast', function(){
						});
					}
				});
				var target_link = $(this).siblings('.selectbox_option').find('a');
					target_link.on('click', function(){
						target_link.removeClass('on');
						$(this).addClass('on');
						that.click();
					});
			});
			$('[tab-point]').queue(function(){
				console.log('tab-point : start');
				var target = $('[tab-target]');
				var that = $(this);
				
				that.on('change', 'input[type=radio]', function(e) {
					var target_id = $(this).data('target');
					$(target_id, target).show().siblings().hide();
				});
				$('input[type=radio]', that).each(function(i) {
					if($(this).attr('checked')){
						$(this).click().change();
					}
				});
			});
		});
		// //모달 관련 옵션.
		// default = {
		// 	'backgroundColor': '#000', // 배경색
		// 	'buttonClose': false, // 닫기 버튼 사용여부
		// 	'opacity': 0.75, // 배경 투명도
		// 	'zIndex': 100, // 모달 레이어번호
		// 	'beforeOpen': null, // 열기 전 이벤트
		// 	'afterOpen': null, // 열기 후 이벤트
		// 	'beforeClose': null, // 닫기 전 이벤트
		// 	'afterClose': null, // 닫기 후 이벤트
		// 	'class': null, // 직접 클래스 추가.
		// 	'width': null // 모달 고정된 크기
		// }
	} catch(e) {
		console.error(e);
	}
})(jQuery);
