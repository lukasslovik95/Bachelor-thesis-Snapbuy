let is_appleMobile = false;
if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
  $('body').addClass('is-apple-mobile');
  is_appleMobile = true;
}

let is_mobile = false;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $('body').addClass('is-mobile');
  is_mobile = true;
}

/******** SCROLL AFTER REFRESH ********/
if ( $.cookie("animateScrollAfterRefresh")) {
  const target = $($.cookie("animateScrollAfterRefresh"));
  if(target.length) {
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 700, 'swing');
  }
  $.cookie("animateScrollAfterRefresh", null, { path: '/' } ); //clear cookie
}

if ( $.cookie("scrollAfterRefresh")) {
  $(document).scrollTop( $.cookie("scrollAfterRefresh") );
  $.cookie("scrollAfterRefresh", null, { path: '/' } ); //clear cookie
}

$('[data-scroll-after-refresh]').on('click',function(){
  $.cookie("animateScrollAfterRefresh", null );
  const target = $(this).data('scroll-after-refresh');
  if(target !== ""){
    $.cookie("animateScrollAfterRefresh", target, { path: '/' } );
  }else{
    $.cookie("scrollAfterRefresh", $(document).scrollTop(), { path: '/' } );
  }
});

scrollAfterRefresh = function(target) {
  if(target){
    $.cookie("animateScrollAfterRefresh", target, { path: '/' } );
  }else{
    $.cookie("scrollAfterRefresh", $(document).scrollTop(), { path: '/' } );
  }
};

/******** MOBILE MENU ********/
$('[role="menu-opener"]').click(function(){
  const dt = $($(this).data("target"));

  if($(this).hasClass('open')) {
    $(this).removeClass('open');
    $(dt).removeClass('open');
    $('body').removeClass('open-menu');
    window.history.go(-1);
  } else {
    $(this).addClass('open');
    $(dt).addClass('open');
    $('body').addClass('open-menu');
    window.history.replaceState({open_menu: 1, target: $(this).data("target")}, '', '');
    window.history.pushState({}, '', '');

    //Zamykanie po kliknieciu
    $(dt).find('.menu-scroll').click(function(){
      $(dt).removeClass('open');
      $('[role="menu-opener"]').removeClass('open');
      $('body').removeClass('open-menu');
    });
  }
});


window.onpopstate = function(event) {
  if (event.state && typeof event.state.open_menu !== 'undefined') {
    $('[role="menu-opener"]').removeClass('open');
    $(event.state.target).removeClass('open');
    $('body').removeClass('open-menu');
  }
};

/******** SUBMENU MOBILE ********/
$(document).on('click', '[role="submenu-opener"]', function(e){
  const dt = $($(this).data("target"));
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $(dt).removeClass('open');
  } else {
    $(this).addClass('active');
    $(dt).addClass('open');
    $(window).scrollTo(dt, 400, {offset:-40});
  }
});


/******** jquery.scrollTo ********/
//EXAMPLE: $(window).scrollTo('main', 400, {offset:-60});
$.extend($.scrollTo.defaults, {
  offset: 0,
  duration: 400
});

$(document).on('click', '[data-scroll-target]', function(e){
  let target = $(this).data('scroll-target');
	if (target === 'this') {
		target = $(this);
	}
  const duration = $(this).data('scroll-duration');
  const offset = $(this).data('scroll-offset');
  $(window).scrollTo(target ,duration ,{offset:offset});
  if($(this).data('scroll-hash') !== undefined){
    window.location.hash = target;
  }
  return false;
});

$(function() {
  $('#main-menu').smartmenus();
});

$(window).scroll(function(){
  const header = $('header.header'),
    scroll = $(window).scrollTop();

  if (scroll >= 300) header.addClass('fixed-header');
  else header.removeClass('fixed-header');
});

if ($(window).scrollTop() > 300) {
  $('header.header').addClass('fixed-header');
} else {
  $('header.header').removeClass('fixed-header');
}

$(document).ready(function(){

  /******** WINDOW SCROLL ********/
  const checkWindowScroll = function() {
    if ($(window).scrollTop() > 500) {
      $('#icoGoTop').show();
    }else {
      $('#icoGoTop').hide();
    }

    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      $('#icoGoTop').addClass('is-bottom');
      $('.chat-opener').addClass('is-bottom');
    }else{
      $('#icoGoTop').removeClass('is-bottom');
      $('.chat-opener').removeClass('is-bottom');
    }
  };
  checkWindowScroll();

  $(window).bind('scroll', function() {
    checkWindowScroll();
  });

  /******** BOOSTRAP MODAL ********/
  $('.modal').on('show.bs.modal', function() {
  });

  /************************* TOOLTIP BOOSTRAP **********************/
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    container: 'body',
    html:true
  });

  $(document).on('click', 'button[data-toggle="tooltip"], [href][data-toggle="tooltip"], [data-src][data-toggle="tooltip"], [data-href][data-toggle="tooltip"]', function(){
    $('.tooltip').tooltip('hide');
  });


  $(document).on('submit', 'form', function(){
    if ($(this).valid()) {
      const bs = $(this).find('.btn.btn-submit');
      const bsi = $(this).find('.btn.btn-submit i');

      bs.addClass('btn-disabled').removeAttr('onclick').removeAttr('href').unbind('click').prop('disabled', true);
      if (bsi.length) {
        bsi.removeClass().addClass('far fa-spinner-third fa-spin');
      }else {
        bs.append( "<i class='far fa-spinner-third fa-spin'></i>" );
      }
    }
  });

  setTimeout(function () {
    $('#preloader').fadeOut(); // will fade out the white DIV that covers the website.
  }, 4000);

});

/******** BOOSTRAP SELECTPICKER ********/
selectpickerOn = function() {
  $('.selectpicker').selectpicker({
    style: 'btn-select',
    liveSearchPlaceholder: 'szukaj...',
    noneSelectedText:'- wybierz -',
  });

  if(is_mobile && !is_appleMobile) {
    $('.selectpicker:not(".selectpicker[data-max-options]")').addClass("mobile-device");
  }

};
selectpickerOn();

//dodaj class "required" do diva wyżej gdy ukryty select ma również "required"
$(".selectpicker[required], .selectpicker.required").each(function() {
  $(this).closest('.bootstrap-select').addClass('required');
});
$(document).on('change', '.selectpicker[required], .selectpicker.required', function(){
  if ($(this).val()!== ''){
    $(this).closest('.bootstrap-select').removeClass('error').addClass('valid');
    $(this).removeClass('error');
  }else{
    $(this).closest('.bootstrap-select').removeClass('valid').addClass('error');
    $(this).addClass('error');
  }
});

/******** RIPPLE CLICK EFFECT ********/
const rippleEffect = function(clickElem, e) {
  const elem = $(clickElem);
  // Remove any old one
  $(".ripple").remove();

  // Setup
  let posX = elem.offset().left,
    posY = elem.offset().top,
    buttonWidth = elem.width(),
    buttonHeight =  elem.height();

  // Add the element
  elem.prepend("<span class='ripple'></span>");

  // Make it round!
  if(buttonWidth >= buttonHeight) {
    buttonHeight = buttonWidth;
  } else {
    buttonWidth = buttonHeight;
  }

  // Get the center of the element
  const x = e.pageX - posX - buttonWidth / 2;
  const y = e.pageY - posY - buttonHeight / 2;

  // Add the ripples CSS and start the animation
  $(".ripple").css({
    width: buttonWidth,
    height: buttonHeight,
    top: y + 'px',
    left: x + 'px'
  }).addClass("rippleEffect");
};

$(document).on('click', '.click-effect, .click-effect2, .btn', function(e){
  rippleEffect(this, e);
});

$(document).on('click', '.js-click-effect-parent', function(e){
  const elem = $(this).find('.click-effect, .click-effect2');
  if (elem.length) {
    rippleEffect(elem, e);
  }
});

/* VALIDATE MESSAGES */
$.extend(
  $.validator.messages, {
    required: "To pole jest wymagane.",
    remote: "Proszę o wypełnienie tego pola.",
    email: "Proszę o podanie prawidłowego adresu email.",
    url: "Proszę o podanie prawidłowego URL.",
    date: "Proszę o podanie prawidłowej daty.",
    dateISO: "Proszę o podanie prawidłowej daty (ISO).",
    number: "Proszę o podanie prawidłowej liczby.",
    digits: "Proszę o podanie samych cyfr.",
    creditcard: "Proszę o podanie prawidłowej karty kredytowej.",
    equalTo: "Proszę o podanie tej samej wartości ponownie.",
    accept: "Proszę o podanie wartości z prawidłowym rozszerzeniem.",
    maxlength: $.validator.format("Proszę o podanie nie więcej niż {0} znaków."),
    minlength: $.validator.format("Proszę o podanie przynajmniej {0} znaków."),
    rangelength: $.validator.format("Proszę o podanie wartości o długości od {0} do {1} znaków."),
    range: $.validator.format("Proszę o podanie wartości z przedziału od {0} do {1}."),
    max: $.validator.format("Proszę o podanie wartości mniejszej bądź równej {0}."),
    min: $.validator.format("Proszę o podanie wartości większej bądź równej {0}.")
  },
  $.validator.setDefaults({
    focusInvalid: false,
    invalidHandler: function(form, validator) {

      if (!validator.numberOfInvalids())
        return;

      $('html, body').animate({
        scrollTop: $(validator.errorList[0].element).offset().top -100
      }, 300);

    }
  })
);

jQuery.validator.addMethod("kodpocztowy", function(value, element) {
  return this.optional(element) || /^\d{2}-\d{3}$/.test(value);
}, "Wprowadź poprawny kod pocztowy (XX-XXX)");

jQuery.validator.addClassRules("validate-zip", {
  kodpocztowy: true
});

/******** FANCYBOX DEFAULT ********/
_refreshParent = false;
$.extend(jQuery.fancybox.defaults, {
  backFocus: false,
  protect: false,
  loop: true,
  afterShow: function() {
    $('.tooltip').tooltip('hide');
  },
  afterClose: function() {
    if (_refreshParent){
      addAjaxLoader('body');
      parent.location.reload();
      scrollAfterRefresh();
    }
  }
});

$('[data-type="ajax"]').fancybox({
  touch: false,
});

$('[data-type="iframe"]:not("[data-options]")').fancybox({
  modal: true,
});

//<![CDATA[
$(function(){
  if(!navigator.userAgent.match(/Trident\/7\./)) {
    /* WOW */
    wow = new WOW(
      {
        animateClass: 'animated',
        offset: 40,
        mobile: false,
        live: false
      }
    );
    wow.init();
  }
});//]]>
