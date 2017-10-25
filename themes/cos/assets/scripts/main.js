/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

  var a = $(window).width() > 768 ? !0 : !1;
  $(window).resize(function() {
    a = $(window).width() > 768 ? !0 : !1;
  });
  $(function() {
      $('.ft-nav dt').click(function(event) {
        if(!a){
          var menu = $(this).next("dd");
          $(this).toggleClass('selected');
          $(menu).stop().slideToggle();
        }
      });
      $('.ft-nav dt a').click(function(event){
        if(!a)event.preventDefault();
        // return false;
      });

      $('.btn-menu').click(function() {
        if(a) return false;
        var gnav = $(".gnav");
        $(gnav).addClass("selected");
        // $(gnav).stop().show();
      });
      $('.btn-close,.gnav').click(function(e) {
        if(a) return false;
        var gnav = $(".gnav");
        $(gnav).removeClass("selected");
        // $(gnav).stop().hide();
      });
      $('.gnav a').click(function(event){
        event.stopPropagation();  
      });
  });

  // $(function(){ 
  //   if(!a) {gnav_resize();}
  // });
  // $(window).resize(function() {
  //   a = $(window).width() > 768 ? !0 : !1;
  //   if(!a) {
  //     gnav_resize();
  //   }else{
  //     $(".gnav").css({'height':'100px'});
  //   }
  // });

  function gnav_resize(){
    // var gn_width = $(document).width();
    // var gn_height = $(document).height();
    // $(".gnav").css({'height':gn_height+'px'});
  }













  // $(function() {
  // 	$('.tabs__button span').click(function() {
  // 		var index = $('.tabs__button span').index(this);
  // 		$('.tabs__content').css('display','none');
  // 		$('.tabs__content').eq(index).css('display','block');
  // 		$('.tabs__button span').removeClass('selected');
  // 		$(this).addClass('selected');
  // 	});
  // });

  // $(function() {
  //   $('.page-top__btn-top').click(function() {
  //     $('html,body').animate({scrollTop: 0}, 500, 'swing');
  //   });
  // });

  // $(function () {
  //     $(".parent").click(function() {
  //         $(".main-menu--sub-menu").toggleClass('hide');
  //         if ($(".main-menu--sub-menu").hasClass('hide')) {
  //           $(".main-menu--link").addClass('normal');
  //         } else {
  //           $(".main-menu--link").removeClass('normal');
  //         }
  //     });
  // });
  // $(function () {
  //     $(".parent").hover(function() {
  //         $(".main-menu--sub-menu").removeClass('hide');
  //         if ($(".main-menu--sub-menu").hasClass('hide')) {
  //           $(".main-menu--link").addClass('normal');
  //         } else {
  //           $(".main-menu--link").removeClass('normal');
  //         }
  //     });
  // });

})(jQuery); // Fully reference jQuery after this point.
