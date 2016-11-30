jQuery(document).ready(function() {
    /*mediaelement*/
    jQuery('audio,video').mediaelementplayer();

	//gallery
	if (jQuery("#Grid").length > 0){
	     jQuery('#Grid').mixitup({
			targetSelector: '.mix',
			targetDisplayGrid: 'inline-block',
			animateGridList: false
		});
	}  

	/* sections */
	jQuery( "h2.toggle" ).click(function(e) {
		if(jQuery(this).hasClass('closed')){
			jQuery(this).removeClass('closed');
			jQuery(this).addClass('opened');
			jQuery(this).next().slideDown('fast', function() {
				//e.preventDefault();     
				goToByScroll(jQuery(this).parent().attr("id"));
			});

			if(jQuery(this).parent().attr('id') == 'resume'){
				set_skill_percent()
			}
			if(jQuery(this).parent().attr('id') == 'contact'){
				google.maps.event.trigger(map, 'resize');
                map.setCenter(myLatlng);
			}
		} 
		else{
			jQuery(this).removeClass('opened');
			jQuery(this).addClass('closed');	
			jQuery(this).next('.item-cont').slideUp(800);
		}
        jQuery('li.active').click();
	});
	
	/* settings */
	jQuery('#settings-icon').click(function(){
		if(jQuery('#settings').hasClass('active')){
		   jQuery('#settings').animate({"left":"-210px"}, "slow").removeClass('active');
		} else {
		   jQuery('#settings').animate({"left":"0"}, "slow").addClass('active');
		}
	});
	
	/* profile */
	jQuery("#profile .col500").animate({'margin-left':"0%"},600);
    jQuery("#profile .col260").animate({'margin-right':"0%"},600);
	
	var isMobile = window.is_mobile;
	if(isMobile){
		//gallery items hover
		if(jQuery(window).width() > 979 ){ gallery_hover(50, 55); } 
		else if(jQuery(window).width() > 767 && jQuery(window).width() <= 979) { gallery_hover(35, 35); } //(min-width: 768px) and (max-width: 979px)
		else if(jQuery(window).width() > 480 && jQuery(window).width() <= 767) { gallery_hover(90, 75); } //(max-width: 767px)
		else if(jQuery(window).width() <= 480) { gallery_hover(50, 55); } //(max-width: 480px)
		
		jQuery(window).bind('resize', function () { 
			jQuery('.ptf-item').unbind('mouseenter').unbind('mouseleave');
			if(jQuery(window).width() > 979 ){ gallery_hover(50, 55); } 
		else if(jQuery(window).width() > 767 && jQuery(window).width() <= 979) { gallery_hover(35, 35); } //(min-width: 768px) and (max-width: 979px)
		else if(jQuery(window).width() > 480 && jQuery(window).width() <= 767) { gallery_hover(90, 75); } //(max-width: 767px)
		else if(jQuery(window).width() <= 480) { gallery_hover(50, 55); } //(max-width: 480px)
		});
	}
	else {
		//gallery items hover
		if(jQuery(window).width() > 979 ){ gallery_hover(50, 55); } 
		else if(jQuery(window).width() > 767 && jQuery(window).width() <= 979) { gallery_hover(35, 35); } //(min-width: 768px) and (max-width: 979px)
		else if(jQuery(window).width() > 480 && jQuery(window).width() <= 767) { gallery_hover(90, 75); } //(max-width: 767px)
		else if(jQuery(window).width() <= 480) { gallery_hover(50, 55); } //(max-width: 480px)
		
		jQuery(window).bind('resize', function () { 
			jQuery('.ptf-item').unbind('mouseenter').unbind('mouseleave');
			if(jQuery(window).width() > 979 ){ gallery_hover(50, 55); } 
			else if(jQuery(window).width() > 767 && jQuery(window).width() <= 979) { gallery_hover(35, 35); } //(min-width: 768px) and (max-width: 979px)
			else if(jQuery(window).width() > 480 && jQuery(window).width() <= 767) { gallery_hover(90, 75); } //(max-width: 767px)
			else if(jQuery(window).width() <= 480) { gallery_hover(50, 55); } //(max-width: 480px)
		});
	}
	
	//fancybox
	if (jQuery(".fancybox").length > 0){
		jQuery(".fancybox").fancybox({ padding: 0, fsBtn:false, autoSize: true, });
	}
	
	//page scroll up
	jQuery("#up").click(function() {
	  jQuery("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});
	
	//set #up position for pc screens
	position_up();
	
	jQuery(window).resize(function() {
		position_up();
	});
	
// contact form

jQuery('#submit').click(function(){
	
	
	jQuery('.alert_message').empty();
	jQuery('.alert_message').remove();
	jQuery.post(
		MyAjax.ajaxurl,
		{
			action : 'send_email',
			contact_name: jQuery('#contact_name').val(),
			email: jQuery('#email').val(),
			msg: jQuery('#comment').val()
		},
		function(response){		
			var errors = response.errors;
			if(errors){
				var message = "<div class='alert_message error'>Please check if you've filled all the fields with valid information. Thank you!</div>";
				jQuery(message).insertBefore(jQuery('#contact_form'));;
			}else{
				var message = "<div class='alert_message success'>Thank you for using my contact form! Your email was successfully sent!</div>";
				jQuery(message).insertBefore(jQuery('#contact_form'));;
			}
			clear_errors();
			for(var i = 0; i < errors.length; ++i){
				jQuery('#' + errors[i]).addClass('error');
				console.log(jQuery('#' + errors[i]).addClass('error'));
			}
		},
		"json"
	);
	return false;
});

function clear_errors(){
	jQuery('#contact_name').removeClass('error');
	jQuery('#email').removeClass('error');
	jQuery('#comment').removeClass('error');
}
	
});//end document ready


/* set skill percent
=========================================== */
function set_skill_percent(){
    jQuery('.skill-percent-line').each(function() {
        var width = jQuery(this).data( "width" );
        jQuery( this ).animate({width: width+'%'}, 1000 );

    });	
}

/* scroll to section by id
=========================================== */
function goToByScroll(id){
    id = id.replace("link", "");
    jQuery('html,body').animate({scrollTop: jQuery("#"+id).offset().top},'slow');
}

/* set #up position
=========================================== */
function position_up(){
  if (jQuery(window).width() < 1024) {
	jQuery('#up').css({right:'20px', bottom:'20px'});
  } else {
	 jQuery('#up').removeAttr('style');
  }
}

/* gallery hover
=========================================== */
function gallery_hover(pos_text, pos_btn){
	jQuery('.ptf-item').bind({
		mouseenter : function(e) {
			jQuery(this).find('.ptf-cover').stop().animate({"opacity":"1"},500); 
			jQuery(this).find('.ptf-button').stop().animate({ bottom: '+='+pos_btn+'px', 'opacity':1 }, 300, 'easeOutSine', function () {});
			jQuery(this).find('.ptf-details').stop().animate({ top: '+='+pos_text+'px', 'opacity':1 }, 300, 'easeOutSine', function () {});
		},
		mouseleave: function(e) {
			jQuery(this).find('.ptf-cover').stop().animate({"opacity":"0"},500); 
			jQuery(this).find('.ptf-button').stop().animate({ bottom: '0px', 'opacity':0 }, 300, 'easeOutSine', function () {});
			jQuery(this).find('.ptf-details').stop().animate({ top: '0px', 'opacity':0 }, 300, 'easeOutSine', function () {});
		}
	});
}

function gallery_hover_mobile(pos_btn, pos_text){
	jQuery('.ptf-item').bind({
		touchstart : function(e) {
			jQuery(this).find('.ptf-cover').stop().animate({"opacity":"1"},500); 
			jQuery(this).find('.ptf-button').stop().animate({ bottom: '+='+pos_btn+'px', 'opacity':1 }, 300, 'easeOutSine', function () {});
			jQuery(this).find('.ptf-details').stop().animate({ top: '+='+pos_text+'px', 'opacity':1 }, 300, 'easeOutSine', function () {});
		},
		touchend: function(e) {
			jQuery(this).find('.ptf-cover').stop().animate({"opacity":"0"},500); 
			jQuery(this).find('.ptf-button').stop().animate({ bottom: '0px', 'opacity':0 }, 300, 'easeOutSine', function () {});
			jQuery(this).find('.ptf-details').stop().animate({ top: '0px', 'opacity':0 }, 300, 'easeOutSine', function () {});
		}
	});
}