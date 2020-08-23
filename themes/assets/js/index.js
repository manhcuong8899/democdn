$(document).on('ready', function() {

	$('.sort-dropdown ul.dropdown-menu li').click(function(){
		$('.sort-dropdown .sort-active').html($(this).text());
	});

	$('.grid-item .info-view-color li a').hover(function(e) {
		var $this = $(this);
		var img = $this.attr('data-img-big');
		$(this).closest('.info-view-color').closest('.info-product').closest('.item-box').find('.cover img').attr('src',img);
		
	});



	$('.box-hide').hide();
	$('.box-login').show();
	$('.btn_register').click(function(){
		openbox('box-register');
	});
	$('.btn_login').click(function(){
		openbox('box-login');
	});
	$('.btn_forgot').click(function(){
		openbox('box-forgot');
	});
	
	function openbox($box_show){
		$('.box-hide').hide();
		$('.'+$box_show).show();
	}

	$('.section-trending .owl-carousel').owlCarousel({
    	loop:true,
    	margin:10,
    	navSpeed:700,
    	items:1,
    	nav:true,
    	autoplay:true,
    	autoplaySpeed:2000, 
	});

	$('ul li.dropdown').hover(function() {
	  	$(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
	}, function() {
	  	$(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
	});
	
    
});
function get_price_number(string){
	var price = string.replace('$', '');
	return Number(price);
}

function fchat()
{
	var tchat=document.getElementById("tchat").value;
	if(tchat==0||tchat=='0')
	{
		document.getElementById("fchat").style.display="block";
		document.getElementById("tchat").value=1;}
	else{
		document.getElementById("fchat").style.display="none";
		document.getElementById("tchat").value=0;
	}
}

function btn_detail()
{
	var tchat=document.getElementById("tchat").value;
	if(tchat==0||tchat=='0')
	{
		document.getElementById("fchat").style.display="block";
		document.getElementById("tchat").value=1;}
	else{
		document.getElementById("fchat").style.display="none";
		document.getElementById("tchat").value=0;
	}
}

var userAgent, ieReg, ie;
userAgent = window.navigator.userAgent;
ieReg = /msie|Trident.*rv[ :]*11\./gi;
ie = ieReg.test(userAgent);

if(ie) {
  	$(".carousel-inner .item").each(function () {
    	var $container = $(this),
        	imgUrl = $container.find("img").prop("src");
    	if (imgUrl) {
      	$container.css("backgroundImage", 'url(' + imgUrl + ')').addClass("custom-object-fit");
    	}
  	});
}

//////////////////// SCROLL TOP ////////////////////
$("#back-top").hide();
$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 600) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});
	$('#back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
});