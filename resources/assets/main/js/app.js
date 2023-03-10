!(function (e) {
    'use strict'
    jQuery(document).on('ready', function () {
        e('.text-slide-active').owlCarousel({
            loop: !0,
            margin: 0,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            autoplay: !0,
            autoplayTimeout: 6e3,
            responsive: {
                210: { items: 1 },
                320: { items: 1 },
                479: { items: 1 },
                768: { items: 1 },
                980: { items: 1 },
                1199: { items: 1 }
            }
        }),
            e('.active-story').owlCarousel({
                loop: !0,
                margin: 0,
                autoplay: !0,
                autoplayTimeout: 6e3,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 1 },
                    768: { items: 1 },
                    980: { items: 1 },
                    1199: { items: 1 }
                }
            }),
            e('.exparts-active').owlCarousel({
                loop: !0,
                margin: 0,
                autoplay: !0,
                autoplayTimeout: 6e3,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 1 },
                    768: { items: 1 },
                    980: { items: 1 },
                    1199: { items: 1 }
                }
            }),
            e('.pst-gallery-active').owlCarousel({
                loop: !0,
                margin: 0,
                autoplay: !0,
                autoplayTimeout: 4e3,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 1 },
                    768: { items: 1 },
                    980: { items: 1 },
                    1199: { items: 1 }
                }
            }),
            e('.text-slide-active').on('translate.owl.carousel', function () {
                e('.slide-content h1')
                    .removeClass('animated bounceIn')
                    .css('opacity', '0'),
                    e('.slide-content p')
                        .removeClass('animated flipInX')
                        .css('opacity', '0'),
                    e('.slide-content a.th-gradient')
                        .removeClass('animated slideInLeft')
                        .css('opacity', '0'),
                    e('.slide-content a.th-gradient2')
                        .removeClass('animated slideInRight')
                        .css('opacity', '0')
            }),
            e('.text-slide-active').on('translated.owl.carousel', function () {
                e('.slide-content h1')
                    .addClass('animated bounceIn')
                    .css('opacity', '1'),
                    e('.slide-content p')
                        .addClass('animated flipInX')
                        .css('opacity', '1'),
                    e('.slide-content a.th-gradient')
                        .addClass('animated slideInLeft')
                        .css('opacity', '1'),
                    e('.slide-content a.th-gradient2')
                        .addClass('animated slideInRight')
                        .css('opacity', '1')
            }),
            e('.healty_recipe_active').owlCarousel({
                loop: !0,
                margin: 15,
                mouseDrag: !0,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 1 },
                    768: { items: 2 },
                    980: { items: 2 },
                    1199: { items: 3 }
                }
            }),
            e('.related-services-active').owlCarousel({
                loop: !0,
                margin: 15,
                mouseDrag: !0,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 2 },
                    768: { items: 2 },
                    980: { items: 2 },
                    1199: { items: 3 }
                }
            }),
            e('.brands-active').owlCarousel({
                loop: !0,
                margin: 15,
                mouseDrag: !0,
                responsive: {
                    210: { items: 1 },
                    320: { items: 1 },
                    479: { items: 2 },
                    768: { items: 2 },
                    980: { items: 3 },
                    1199: { items: 4 }
                }
            }),
            e('.grid').imagesLoaded(function () {
                e('.grid').isotope({
                    itemSelector: '.grid-item',
                    percentPosition: !0,
                    masonry: { columnWidth: 1 }
                })
            }),
            e('.grid2').imagesLoaded(function () {
                e('.grid2').isotope({
                    itemSelector: '.grid-item2',
                    percentPosition: !0,
                    masonry: { columnWidth: 0 }
                })
            }),
            e('.filter-list').on('click', 'li', function () {
                e('.filter-list li').removeClass('active'),
                    e(this).addClass('active')
                var i = e(this).attr('data-filter')
                e('.grid2').isotope({ filter: i }), e(window).trigger('resize')
            }),
            e('.counter').counterUp({ delay: 10, time: 1e3 }),
            e(window).on('scroll', function () {
                e(window).scrollTop() < 200
                    ? e('.navbar').removeClass('sticky fadeInDown animated')
                    : e('.navbar').addClass('sticky fadeInDown animated')
            }),
            e('.review_text-active').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: !1,
                fade: !0,
                asNavFor: '.client-minithumb-active'
            }),
            e('.client-minithumb-active').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.review_text-active',
                dots: !1,
                arrows: !1,
                focusOnSelect: !0,
                vertical: !0,
                verticalSwiping: !0,
                responsive: [
                    {
                        breakpoint: 767.98,
                        settings: { vertical: !1, verticalSwiping: !1 }
                    }
                ]
            }),
            e('.rationSinglePrice').on('mouseover', function () {
                e('.rationSinglePrice').removeClass('active'),
                    e(this).addClass('active')
            }),
            e('.progress').each(function () {
                var i = e(this).attr('data-percent'),
                    t = e(this).prev('.progress-title'),
                    a = e(this).children('.progress-title')
                t.length > 0
                    ? t.css('width', i)
                    : a.length > 0 && a.css('width', i),
                    e(this).appear(function () {
                        e(this)
                            .find('.progress-bar')
                            .animate({ width: i }, 500)
                    })
            }),
            e('.img-popup').magnificPopup({
                type: 'image',
                gallery: { enabled: !0 }
            }),
            e('.playVideo ').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-fade'
            }),
            e.scrollUp({
                scrollText: '<i class="fa fa-angle-up"></i>',
                animation: 'slide'
            }),
            e('.menu-click').on('click', function () {
                return e('.main-menu > ul').toggleClass('show'), !1
            }),
            e(window).width() < 1199.98 &&
                e('.main-menu ul li.menu-item-has-children').on(
                    'click',
                    function () {
                        return (
                            e(this)
                                .children('ul.sub-menu')
                                .slideToggle(),
                            e(this).toggleClass('change-icon'),
                            !1
                        )
                    }
                ),
            e('.main-menu ul li, .main-menu ul ul li').on('click', function (
                e
            ) {
                e.stopPropagation()
            }),
            jQuery(window).load(function () {
                jQuery('.preloader-wrapper').fadeOut(300)
            }),
            e(function () {
                function i (i, t) {
                    i.each(function () {
                        var i = e(this),
                            a = i.attr('data-animation'),
                            s = i.attr('data-animation-delay')
                        i.css({
                            '-webkit-animation-delay': s,
                            '-moz-animation-delay': s,
                            'animation-delay': s
                        }),
                            (t || i).waypoint(
                                function () {
                                    i
                                        .addClass('animated')
                                        .css('visibility', 'visible'),
                                        i.addClass('animated').addClass(a)
                                },
                                { triggerOnce: !0, offset: '90%' }
                            )
                    })
                }
                i(e('.animation')),
                    i(e('.staggered-animation'), e('.staggered-animation-wrap'))
            })
    })
})(jQuery)
//# sourceMappingURL=app.js.map
