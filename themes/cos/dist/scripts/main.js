!function(n){var i={common:{init:function(){},finalize:function(){}},home:{init:function(){},finalize:function(){}},about_us:{init:function(){}}},t={fire:function(n,t,e){var o,c=i;t=void 0===t?"init":t,o=""!==n,o=o&&c[n],o=o&&"function"==typeof c[n][t],o&&c[n][t](e)},loadEvents:function(){t.fire("common"),n.each(document.body.className.replace(/-/g,"_").split(/\s+/),function(n,i){t.fire(i),t.fire(i,"finalize")}),t.fire("common","finalize")}};n(document).ready(t.loadEvents);var e=n(window).width()>768;n(window).resize(function(){e=n(window).width()>768}),n(function(){n(".ft-nav dt").click(function(i){if(!e){var t=n(this).next("dd");n(this).toggleClass("selected"),n(t).stop().slideToggle()}}),n(".ft-nav dt a").click(function(n){e||n.preventDefault()}),n(".btn-menu").click(function(){if(e)return!1;var i=n(".gnav");n(i).addClass("selected")}),n(".btn-close,.gnav").click(function(i){if(e)return!1;var t=n(".gnav");n(t).removeClass("selected")}),n(".gnav a").click(function(n){n.stopPropagation()})})}(jQuery);
//# sourceMappingURL=main.js.map