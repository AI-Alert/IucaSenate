if(document.querySelector('.menu__item--sub')) {
	let subMenuTitle = document.querySelectorAll('.menu__item--sub');

	for(let i = 0; i < subMenuTitle.length; i++) {
		let link = subMenuTitle[i].querySelector('a');
		console.log(link);
		let subMenu = subMenuTitle[i].querySelector('.submenu');  
		let newTitle = document.createElement('li');

		let href = '#';

		if( link.hasAttribute('href')) {
			let href = link.href;
		} 

	

		newTitle.innerHTML = `<a href="` + href + `" class="menu__title">`+ link.textContent + `</a>`;

		var theFirstChild = subMenu.firstChild;
		subMenu.insertBefore(newTitle, theFirstChild);
	}
}

$(function() {		

	

	if ($(window).width() > 991) {	

		$('.menu__item--sub').each(function(){
			$(this).append('<span class="menu__drop-btn"><img src="/wp-content/themes/mt_framework/assets/img/drop-down.svg" alt=">" class="svg"></span>')
		});		

		$(window).scroll(function(){		
			var scrollTop = 0;
			if ($(this).scrollTop() > scrollTop) {
				$(".header").addClass("is-fixed");										
			} else {
				$(".header").removeClass("is-fixed");						
			};
		});

		$(window).scroll(function(){					
			var menu = $('.menu-block');	
			if (menu.hasClass('is-visible')) {
				$('.menu-block').removeClass('is-visible');	
				$('.hamburger').removeClass("is-active");											
			};
		});

		var scrollTop = 0;
		if ($(this).scrollTop() > scrollTop) {
			$(".header").addClass("is-fixed");								
		} else {
			$(".header").removeClass("is-fixed");		
		};

		$('.hamburger').click(function() {	
			var menu = $('.menu-block');	
			if (!menu.hasClass('is-visible')) {
				$(this).addClass('is-active');
				menu.scrollTop(0);				
				menu.addClass('is-visible');					
			} else {
				$(this).removeClass('is-active');
				menu.removeClass("is-visible");						
			};
		});		

		$('.menu__drop-btn').click(function() {	
			var menu = $(this).closest('.menu__item');	
			if (!menu.hasClass('is-drop')) {
				menu.addClass('is-drop');	
				menu.find('.submenu').slideDown();									
			} else {
				menu.removeClass('is-drop');	
				menu.find('.submenu').slideUp();				
			};
		});			
		
	} else {	

		$('.navbar .hamburger').click(function() {
			var menu = $('.menu-block');		
			if (!menu.hasClass('visible')) {	
				$(this).addClass('is-active');		
				menu.addClass("visible").scrollTop(0);		
				$('.overlay').addClass('is-visible');
				$('body').addClass('noscroll');	
			} else {			
				$(this).removeClass('is-active');
				menu.removeClass('visible');	
				$('.overlay').removeClass('is-visible');
				$('body').removeClass('noscroll');
			};
		});	

		$('.overlay').click(function(){
			var menu = $('.menu-block');				
			menu.removeClass("visible");		
			$('.submenu').removeClass('slide');		
			$(this).removeClass('is-visible');
			$('.navbar .hamburger').removeClass('is-active');		
			$('body').removeClass('noscroll');
			$('.menu-block').removeClass('noscroll-y');		
		});	

		$('.menu__item--sub .menu__link').click(function(){
			event.preventDefault();
			$(this).closest('.menu__item').find('.submenu').addClass('slide').scrollTop(0);
			$('.menu-block').addClass('noscroll-y');
		});	

		$('.menu__back').click(function(){
			event.preventDefault();
			$(this).parent().removeClass('slide');
			$('.menu-block').removeClass('noscroll-y');
		});	

		$(window).scroll(function(){		
			var scrollTop = 0;
			if ($(this).scrollTop() > scrollTop) {
				$(".header").addClass("is-fixed");					
			} else {
				$(".header").removeClass("is-fixed");	
			};
		});		

		var scrollTop = 0;
		if ($(this).scrollTop() > scrollTop) {
			$(".header").addClass("is-fixed");					
		} else {
			$(".header").removeClass("is-fixed");	
		};

		$('.mobile-menu__hamburger').click(function() {
			var menu = $('.menu-block');		
			if (menu.hasClass('visible')) {	
				$('.navbar .hamburger').removeClass('is-active');				
				menu.removeClass("visible");		
				$('.overlay').removeClass('is-visible');
				$('body').removeClass('noscroll');	
			} else {						
				menu.addClass('visible').scrollTop(0);	
				$('.overlay').addClass('is-visible');
				$('body').addClass('noscroll');
			};
		});	

	};			

	function heroSlider() {
		$(".hero-block").slick({ 
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			speed: 400,
			arrows: false,						
			dots: true,
			draggable: true,
			swipe: true,			
			fade: true,
			autoplay: true,
			autoplaySpeed: 5000,
			asNavFor: '.hero__bgs'			
		});		
	};		

	function heroBgs() {
		$(".hero__bgs").slick({ 
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			speed: 400,
			arrows: false,
			dots: false,
			draggable: false,
			swipe: false,			
			fade: true
		});	
	};		

	if ($('.hero-block').length==1) {
		var heroSlides = $('.hero__info').length;
		if (heroSlides > 1)  {					
			heroSlider();
			heroBgs();
		};
	};	

	$('.team__job').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
	});		

	$('.kitchen__price').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
	});	

	$('.category__title').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
	});	

	function kitchensSlider() {

		$(".kitchens-block.is-slider").slick({ 
			slidesToShow: 2,
			slidesToScroll: 1,
			infinite: false,
			speed: 400,
			arrows: true,
			prevArrow: '.kitchens__slider-arrows .prev',
			nextArrow: '.kitchens__slider-arrows .forward',
			dots: false,
			draggable: true,
			swipe: true,			
			fade: false,			
			autoplay: false,			
			autoplaySpeed: 5000,			
			responsive: [	
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 1,
					centerMode: true,
					centerPadding: '20%'
				}
			},
			{
				breakpoint: 375,
				settings: {
					slidesToShow: 1,
					centerMode: true,
					centerPadding: '15%'
				}
			}]
		});	

	};		

	if ($('.kitchens-block').length==1) {
		var slides = $('.kitchens-block .kitchen').length;	
		if (slides > 2) {		
			$(".kitchens__slider-arrows").addClass('is-visible');	
			$(".kitchens-block").addClass('is-slider');	
			setTimeout(function(){
				kitchensSlider();
				$('.kitchen').matchHeight({
					byRow: true,
					property: 'height',
					target: null,
					remove: false
				});			
			}, 300);		
		};
	};	
	
	function aboutSlider() {
		$(".about__slider.is-slider").slick({ 
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			speed: 400,
			arrows: false,
			dots: true,
			draggable: true,
			swipe: true,			
			fade: true,			
			autoplay: false,			
			autoplaySpeed: 5000
		});
	};	

	if ($('.about__slider').length==1) {
		var slides = $('.about__multimedia').length;
		if (slides > 1)  {					
			$(".about__slider").addClass('is-slider');	
			aboutSlider();			
		};
	};	

	if(document.querySelector('.about-block')) {
		if($(window).width() < 1200) {
			const block = document.querySelector('.about-block'),
			element   = document.querySelector('.about .section-title');
			block.insertBefore(element, block.childNodes[1]);
		};		
	};		

	if(document.querySelector('.decision')) {
		if($(window).width() < 992) {
			const block = document.querySelector('.decision__info'),
			element   = document.querySelector('.decision__video');
			block.insertBefore(element, block.childNodes[1]);
		};		
	};	

	if(document.querySelector('.case-hero')) {
		if($(window).width() < 1200) {
			const block = document.querySelector('.case-hero-block'),
			element   = document.querySelector('.case-hero .section-title');
			block.insertBefore(element, block.childNodes[1]);
		};		
	};		

	$('.portfolio').each(function(){
		var foto = $(this).find('.portfolio__foto img').length;
		if (foto > 1)  {			
			$(this).find('.portfolio__foto').slick({ 
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				speed: 400,
				arrows: true,		
				prevArrow: $(this).find('.portfolio__slider-arrows .back'),
				nextArrow: $(this).find('.portfolio__slider-arrows .next'),				
				dots: false,
				draggable: true,
				swipe: true,			
				fade: true,
				autoplay: false,
				autoplaySpeed: 5000	
			});		
			$(this).find('.portfolio__slider-arrows').addClass('is-visible');
		};
	});

	function portfolioSlider() {
		$(".portfolio__slider").slick({ 
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			speed: 400,
			arrows: true,
			prevArrow: '.portfolio__slider-arrows .back',
			nextArrow: '.portfolio__slider-arrows .next',										
			dots: false,
			draggable: true,
			swipe: true,			
			fade: true,
			autoplay: false,
			autoplaySpeed: 5000,	
			responsive: [	
			{
				breakpoint: 576,
				settings: {
					adaptiveHeight: true
				}
			}]	
		});		
	};			

	if ($('.portfolio__slider').length==1) {
		var slides = $('.portfolio__slide').length;
		if (slides > 1)  {						
			$('.portfolio__slider-arrows').addClass('is-visible');			
			setTimeout(function(){
				portfolioSlider();
					$('.portfolio__slider .portfolio').matchHeight({
					byRow: true,
					property: 'height',
					target: null,
					remove: false
				});		
			}, 300);		
		};
	};		

	$(window).scroll(function(){	
		var scrollTop = $(window).height()*1;	
		if ($(this).scrollTop() > scrollTop) {			
			$(".up").addClass("is-visible");
		} else {			
			$(".up").removeClass("is-visible");
		};
	});		

	$('.up').click(function() {
		$('body,html').animate({scrollTop: 0}, 1000);
	});	

	//Маска для телефона
	$('input[type="tel"]').mask("+7 (999) 999-99-99", {	
		placeholder: "_"		
	});		
	
	$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.png'], a[href$='.webp']").click(function() {	
		event.preventDefault(); 
		var gallerybox = $(this).parent().find($("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.png'], a[href$='.webp']"));	
		if (gallerybox.length > 1) {
			var index = $(this).index();
			$.fancybox.open(gallerybox, {
				'index' : index,				
				loop: true
			});
		} else {		
			$.fancybox.open(gallerybox);
		}		
	});			

	$('.format-text table').each(function(){		
		var containerWidth = $(this).closest($('.container')).width(),
				tableWidth = $(this).width(),			
				result = tableWidth - containerWidth;	
		if (result > 0) {
			$(this).addClass('is-scroll');
			if($(window).width() > 1023) {
				$(this).mCustomScrollbar({
					theme: "my-theme",
					axis: 'x'
				});		
			}			
		};	
	});		

	$('[href="#callback"]').fancybox({
		touch: false,
		autoFocus: false
	});	

	$('button[data-href]').click(function(){
		event.preventDefault(); 
		var href = $(this).data("href");
		$.fancybox.open($(href), {
			touch: false,
			autoFocus: false
		})
	});	

	$('input, textarea').focus(function(){
		$(this).closest('.input-wrapper').addClass('focus');
	});

	$('input, textarea').focusout(function(){
		$(this).closest('.input-wrapper').removeClass('focus');
	});	

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	// $(".form").submit(function() {
	// 	var th = $(this);
	// 	if (!event.target.checkValidity()) {
	// 		event.preventDefault(); 
	// 		th.find("[required]").focus();
	// 	} else {
	// 		$.ajax({
	// 			type: "POST",
	// 			url: "mail.php",
	// 			data: th.serialize()
	// 		}).done(function() {
	// 			$.fancybox.close();
	// 			setTimeout(function(){
	// 				$('[href="#thanks"]')[0].click();		
	// 			}, 500);							
	// 			th.trigger("reset");										
	// 		});	
	// 		return false;
	// 	}
	// });		
	
	$.fancybox.defaults.beforeShow = function(){
		$('.header, .up.is-visible').addClass('open-popup');	
		windowResizeLabel = false;		
	};
	$.fancybox.defaults.afterClose = function(){
		$('.header, .up.is-visible').removeClass('open-popup');	
		windowResizeLabel = true;			
	};	

	$('.popup__close').click(function(){
		event.preventDefault(); 		
		$.fancybox.close();
	});	

	var windowResizeLabel = true;
	function windowResize() {
		var lastWidth = $(window).width();
		$(window).resize(function(){
			if($(window).width()!=lastWidth) {
				if(windowResizeLabel) {
					location.reload();
				}				
			};		
		});
	};
	windowResize();		

	// Replace all SVG images with inline SVG
	$('img.svg').each(function(){
		var $img = $(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
					// Get the SVG tag, ignore the rest
					var $svg = $(data).find('svg');

					// Add replaced image's ID to the new SVG
					if(typeof imgID !== 'undefined') {
						$svg = $svg.attr('id', imgID);
					}
					// Add replaced image's classes to the new SVG
					if(typeof imgClass !== 'undefined') {
						$svg = $svg.attr('class', imgClass+' replaced-svg');
					}

					// Remove any invalid XML tags as per http://validator.w3.org
					$svg = $svg.removeAttr('xmlns:a');

					// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
					if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
						$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
					}

					// Replace image with new SVG
					$img.replaceWith($svg);

				}, 'xml');
	});

	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });	


	$('.wpcf7').on('wpcf7mailsent', function() {
		$.fancybox.close();
		$.fancybox.open({
			src  : '#thanks',
			type : 'inline',
			toolbar  : false
		});    
	});

});


window.addEventListener('DOMContentLoaded', () => {
	

	if(document.querySelector('.wp-pagenavi')) {
		if(document.querySelector('.nextpostslink')) {
			document.querySelector('.nextpostslink').innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="svg replaced-svg" viewBox="0 0 16 16"><path d="M15.707 8.707a1 1 0 000-1.414L9.343.929A1 1 0 007.93 2.343L13.586 8l-5.657 5.657a1 1 0 101.414 1.414l6.364-6.364zM0 9h15V7H0v2z" fill="#92949E"></path></svg>`;
		} else {

			let nextArrow = document.createElement('span');
			nextArrow.classList.add('nextpostslink');
			nextArrow.innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="svg replaced-svg" viewBox="0 0 16 16"><path d="M15.707 8.707a1 1 0 000-1.414L9.343.929A1 1 0 007.93 2.343L13.586 8l-5.657 5.657a1 1 0 101.414 1.414l6.364-6.364zM0 9h15V7H0v2z" fill="#92949E"></path></svg>`;

			document.querySelector('.wp-pagenavi').appendChild(nextArrow);
		}
		
		if(document.querySelector('.previouspostslink')) {
			document.querySelector('.previouspostslink').innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="svg replaced-svg" viewBox="0 0 16 16"><path d="M15.707 8.707a1 1 0 000-1.414L9.343.929A1 1 0 007.93 2.343L13.586 8l-5.657 5.657a1 1 0 101.414 1.414l6.364-6.364zM0 9h15V7H0v2z" fill="#92949E"></path></svg>`;
		} else {
			let prevArrow = document.createElement('span');
			prevArrow.classList.add('previouspostslink');
			prevArrow.innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="svg replaced-svg" viewBox="0 0 16 16"><path d="M15.707 8.707a1 1 0 000-1.414L9.343.929A1 1 0 007.93 2.343L13.586 8l-5.657 5.657a1 1 0 101.414 1.414l6.364-6.364zM0 9h15V7H0v2z" fill="#92949E"></path></svg>`;
			prevArrow.style.order = '-1';
			document.querySelector('.wp-pagenavi').appendChild(prevArrow);
		}
	}


});