$(function() {
    $(".js-menu").each(function() {
        $(this).singlePageNav({
            offset: $header.outerHeight(),
            images: 'img.js-lazy:not(.loaded)'
        });
    });
    $(".js-menu a").on('click', function() {
        var $el = $(this);
   

    }); 
    $(".js-menu-footer a:not(.current)").on('click', function() {
        $('.js-menu').not($(this).parent()).find('li').eq($(this).parent().index()).find('a').trigger('click')       
    })

    function getScrollbarWidth() {
      const outer = document.createElement('div');
      outer.style.visibility = 'hidden';
      outer.style.overflow = 'scroll'; 
      outer.style.msOverflowStyle = 'scrollbar'; 
      document.body.appendChild(outer);
      const inner = document.createElement('div');
      outer.appendChild(inner);
      const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);
      outer.parentNode.removeChild(outer);
      return scrollbarWidth;

    }
    var $flagFix = false;
    var $flagFixO = false,
        y_offsetWhenScrollDisabled
    $win.scroll(function() {
        y_offsetWhenScrollDisabled = $win.scrollTop();
        if (y_offsetWhenScrollDisabled > 0) {
            $('#header').addClass('fixed');
            $flagFix = true;
        } else {
            if (!$body.is('.open-header') && !$flagFixO) {
                $('#header').removeClass('fixed');
                $flagFix = false;

            }
        }
    });

    var $offsetTop;
    lockScroll = function() {
        if ($flagFix) {
            $flagFixO = true;
        }
        $flagFix2 = true;
        $offsetTop = y_offsetWhenScrollDisabled;
        $('html').css('margin-top', -$offsetTop);
        $body.addClass('scrollDisabled');
        $header.addClass('fixed');

        $width = getScrollbarWidth()
        $('body, html').css('padding-right', $width)
    }

    unlockScroll = function() {


        $('html').css('margin-top', '');
        $body.removeClass('scrollDisabled');
        $('body, html').css('padding-right', '')
        setTimeout(function() {

        $('html, body').animate({
            scrollTop: $offsetTop
        }, 0);

        })
        $flagFixO = false
    }
   // toggle mob menu
    $('.js-button-nav').click(function() {
        var $el = $(this);
        $el.toggleClass('active');
        $('body').toggleClass('open-header');
        $('#mainNav').toggleClass('active');
        if ($('body').is('.open-header')) {
            lockScroll();
        } else {
            setTimeout(function() {
                unlockScroll();
            }, 400);
        }
        return false;
    });
    
 });