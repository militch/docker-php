(function($, window) {
  'use strict';

  var $doc = $(document),
    win = $(window),
    body = $('body'),
    adminbar = $('#wpadminbar'),
    cc = $('.click-capture'),
    header = $('.header'),
    wrapper = $('#wrapper'),
    mobile_menu = $('#mobile-menu'),
    mobile_toggle = $('.mobile-toggle-holder');

  var SITE = SITE || {};

  gsap.defaults({
    ease: "power1.out"
  });
  gsap.config({
    nullTargetWarn: false
  });

  function thb_toggleClass(selector, cls) {
    $(selector).toggleClass(cls);
  }

  SITE = {
    thb_scrolls: {},
    h_offset: 0,
    init: function() {
      var self = this,
        obj;

      function initFunctions() {
        for (obj in self) {
          if (self.hasOwnProperty(obj)) {
            var _method = self[obj];
            if (_method.selector !== undefined && _method.init !== undefined) {
              if ($(_method.selector).length > 0) {
                _method.init();
              }
            }
          }
        }
      }
      initFunctions();
    },
    header: {
      selector: '.header',
      init: function() {
        var base = this,
          container = $(base.selector),
          offset = 100;

        if (Headroom.cutsTheMustard) {
          container.headroom({
            offset: offset,
            onTop: function() {
              $('.header-wrapper').css('height', function() {
                return container.outerHeight(true) + 'px';
              });
            },
          });
        }
        win.on('scroll.fixed-header', function() {
          base.scroll();
        }).trigger('scroll.fixed-header');

      },
      scroll: function() {
        var base = this,
          container = $(base.selector),
          wOffset = win.scrollTop(),
          stick = 'fixed',
          fixed_offset = 0;

        if ($('.subheader').length) {
          fixed_offset = $('.subheader').outerHeight();
        }

        if (wOffset > fixed_offset) {
          if (!header.hasClass(stick)) {
            header.addClass(stick);
            body.addClass('header-sticky');
          }
        } else {
          if (header.hasClass(stick)) {
            header.removeClass(stick);
            body.removeClass('header-sticky');
          }
        }
      }
    },
    fullMenu: {
      selector: '.thb-full-menu',
      init: function() {
        var base = this,
          container = $(base.selector),
          children = container.find('.menu-item-has-children:not(.menu-item-mega-parent)');

        /* Sub-Menus */
        children.each(function() {
          var _this = $(this),
            menu = _this.find('>.sub-menu, .sub-menu.thb_mega_menu'),
            li = menu.find('>li>a'),
            tabs = _this.find('.thb_mega_menu li'),
            tl = gsap.timeline({
              paused: true,
              onStart: function() {
                gsap.set(menu, {
                  display: 'block'
                });
              },
              onReverseComplete: function() {
                gsap.set(menu, {
                  display: 'none'
                });
              }
            });

          if (menu.length) {
            tl.to(menu, {
              duration: 0.15,
              autoAlpha: 1
            }, "start");
          }

          if (li.length) {
            tl.to(li, {
              duration: 0.075,
              opacity: 1,
              stagger: 0.02
            }, "start");
          }

          _this.hoverIntent(
            function() {
              _this.addClass('sfHover');
              tl.timeScale(1).restart();
            },
            function() {
              _this.removeClass('sfHover');
              tl.timeScale(1.5).reverse();
            }
          );
        });
      }
    },
    mobileMenu: {
      selector: '#mobile-menu',
      init: function() {
        var base = this,
          container = $(base.selector),
          behaviour = container.data('behaviour'),
          arrow = behaviour === 'thb-submenu' ? container.find('li.menu-item-has-children>a') : container.find('li.menu-item-has-children>a>span');

        arrow.on('click', function(e) {
          var that = $(this),
            parent = that.parents('a').length ? that.parents('a') : that,
            menu = parent.next('.sub-menu');

          if (parent.hasClass('active')) {
            parent.removeClass('active');
            menu.slideUp('200');
          } else {
            parent.addClass('active');
            menu.slideDown('200');
          }
          e.stopPropagation();
          e.preventDefault();
        });
      }
    },
    shopSidebar: {
      selector: '.widget_tag_cloud .tag-link-count',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.each(function() {
          var count = $.trim($(this).html());
          count = count.substring(1, count.length - 1);
          $(this).html(count);
        });
      }
    },
    shop_toggle: {
      selector: '#thb-shop-filters',
      init: function() {
        var base = this,
          container = $(base.selector),
          side_filters = $('#side-filters'),
          tl = gsap.timeline({
            paused: true,
            reversed: true,
            onStart: function() {
              wrapper.addClass('open-cc');
            },
            onReverseComplete: function() {
              wrapper.removeClass('open-cc');
              gsap.set(side_filters, {
                clearProps: "transform"
              });
            }
          }),
          items = $('.widgets', side_filters),
          close = $('.thb-close', side_filters);

        tl
          .set(side_filters, {
            display: 'block'
          }, "start")
          .to(side_filters, {
            duration: 0.3,
            x: '0'
          }, "start")
          .to(cc, {
            duration: 1,
            autoAlpha: 1
          }, "start")
          .to(close, {
            duration: 0.3,
            scale: 1
          }, "start+=0.2");

        if (items.length) {
          tl.from(items, {
            duration: 0.4,
            autoAlpha: 0,
            stagger: 0.1
          }, "start+=0.2");
        }

        container.on('click', function() {
          if (tl.reversed()) {
            tl.timeScale(1).play();
          } else {
            tl.timeScale(1.2).reverse();
          }

          return false;
        });
        $doc.keyup(function(e) {
          if (e.keyCode === 27) {
            if (tl.progress() > 0) {
              tl.reverse();
            }
          }
        });
        cc.add(close).on('click', function() {
          if (tl.progress() > 0) {
            tl.reverse();
          }
          return false;
        });
      }
    },
    mobile_toggle: {
      selector: '.mobile-toggle-holder',
      init: function() {
        var base = this,
          container = $(base.selector),
          tl = gsap.timeline({
            paused: true,
            reversed: true,
            onStart: function() {
              wrapper.addClass('open-cc');
            },
            onReverseComplete: function() {
              wrapper.removeClass('open-cc');
              gsap.set(mobile_menu, {
                clearProps: "transform"
              });
            }
          }),
          items = $('.thb-mobile-menu>li', mobile_menu),
          secondary_items = $('.thb-secondary-menu>li', mobile_menu),
          mobile_footer = $('.menu-footer>*', mobile_menu),
          close = $('.thb-mobile-close', mobile_menu),
          speed = 0.2,
          offset = "start+=" + ((speed / 3) * 2);

        tl
          .to(mobile_menu, {
            duration: speed,
            x: '0'
          }, "start")
          .to(close, {
            duration: speed,
            scale: 1
          }, "start+=0.2")
          .to(cc, {
            duration: speed,
            autoAlpha: 1
          }, "start")
          .to(items, {
            duration: ((speed / 3) * 4),
            autoAlpha: 1,
            stagger: (speed / 3)
          }, offset)
          .fromTo(secondary_items.add(mobile_footer), {
            duration: speed,
            autoAlpha: 0,
            stagger: (speed / 3)
          }, {
            autoAlpha: 1
          }, offset);


        container.on('click', function() {
          if (tl.reversed()) {
            tl.timeScale(1).play();
          } else {
            tl.timeScale(1.2).reverse();
          }
          return false;
        });

        $doc.keyup(function(e) {
          if (e.keyCode === 27) {
            if (tl.progress() > 0) {
              tl.reverse();
            }
          }
        });
        cc.add(close).on('click', function() {
          if (tl.progress() > 0) {
            tl.reverse();
          }
          return false;
        });
      }
    },
    quickCart: {
      selector: '.thb-quick-cart',
      cartTl: false,
      init: function() {
        var base = this,
          container = $(base.selector);

        var _this = container,
          target = $('.thb-secondary-cart', header);

        base.cartTl = gsap.timeline({
          paused: true,
          reversed: true,
          onStart: function() {
            _this.addClass('active');
          },
          onReverseComplete: function() {
            _this.removeClass('active');
          }
        });

        base.cartTl
          .to(target, {
            duration: 0.25,
            display: 'block',
            autoAlpha: 1
          });


        _this.find('.thb-quick-cart-inner').on('click', function() {
          if (themeajax.settings.is_cart || themeajax.settings.is_checkout) {
            window.location = themeajax.settings.cart_url;
          } else {
            if (base.cartTl.reversed()) {
              base.cartTl.timeScale(1).play();
            } else {
              base.cartTl.timeScale(1.2).reverse();
            }
          }
          return false;
        });
        $doc.keyup(function(e) {
          if (e.keyCode === 27) {
            if (base.cartTl.progress() > 0) {
              base.cartTl.reverse();
            }
          }
        });
        header.add($('#wrapper [role="main"]')).on('click', function() {
          if (base.cartTl.progress() > 0) {
            base.cartTl.reverse();
          }
        });

      }
    },
    slick: {
      selector: '.thb-carousel',
      init: function(el) {
        var base = this,
          container = el ? el : $(base.selector);

        container.each(function() {
          var _this = $(this),
            data_columns = _this.data('columns') ? _this.data('columns') : 3,
            thb_columns = data_columns.length > 2 ? parseInt(data_columns.substr(data_columns.length - 1)) : data_columns,
            children = _this.find('.columns'),
            columns = data_columns.length > 2 ? (thb_columns === 5 ? 5 : (12 / thb_columns)) : data_columns,
            fade = (_this.data('fade') ? true : false),
            navigation = (_this.data('navigation') === true ? true : false),
            autoplay = (_this.data('autoplay') === true ? true : false),
            pagination = (_this.data('pagination') === true ? true : false),
            infinite = (_this.data('infinite') === false ? false : true),
            autoplay_speed = _this.data('autoplay-speed') ? _this.data('autoplay-speed') : 4000,
            disablepadding = (_this.data('disablepadding') ? _this.data('disablepadding') : false),
            vertical = (_this.data('vertical') === true ? true : false),
            asNavFor = _this.data('asnavfor'),
            adaptiveHeight = _this.data('adaptive') === true ? true : false,
            rtl = body.hasClass('rtl'),
            prev_text = '',
            next_text = '';

          var args = {
            dots: pagination,
            arrows: navigation,
            infinite: infinite,
            speed: 1000,
            rows: 0,
            fade: fade,
            slidesToShow: columns,
            adaptiveHeight: adaptiveHeight,
            slidesToScroll: 1,
            rtl: rtl,
            slide: ':not(.post-gallery):not(.btn):not(.onsale):not(.thb-product-icon):not(.thb-product-zoom):not(.thb-carousel-image-link):not(.woocommerce-product-gallery__trigger)',
            autoplay: autoplay,
            autoplaySpeed: autoplay_speed,
            touchThreshold: themeajax.settings.touch_threshold,
            pauseOnHover: true,
            accessibility: false,
            focusOnSelect: false,
            prevArrow: '<button type="button" class="slick-nav slick-prev"><span></span></button>',
            nextArrow: '<button type="button" class="slick-nav slick-next"><span></span></button>',
            responsive: [{
                breakpoint: 1068,
                settings: {
                  slidesToShow: columns,
                }
              },
              {
                breakpoint: 736,
                settings: {
                  slidesToShow: 1,
                }
              }
            ]
          };
          if (asNavFor && $(asNavFor).is(':visible')) {
            args.asNavFor = asNavFor;
          }
          if (_this.data('fade')) {
            args.fade = true;
          }
          if (_this.hasClass('product-images')) {
            args.infinite = false;
            // Zoom Support
            if (typeof wc_single_product_params !== 'undefined') {
              if (window.wc_single_product_params.zoom_enabled && $.fn.zoom) {
                _this.on('afterChange', function(event, slick, currentSlide) {
                  var zoomTarget = slick.$slides.eq(currentSlide),
                    galleryWidth = zoomTarget.width(),
                    zoomEnabled = false,
                    image = zoomTarget.find('img');

                  if (image.data('large_image_width') > galleryWidth) {
                    zoomEnabled = true;
                  }
                  if (zoomEnabled) {
                    var zoom_options = $.extend({
                      touch: false
                    }, window.wc_single_product_params.zoom_options);

                    if ('ontouchstart' in window) {
                      zoom_options.on = 'click';
                    }

                    zoomTarget.trigger('zoom.destroy');
                    zoomTarget.zoom(zoom_options);
                    zoomTarget.trigger('mouseenter.zoom');
                  }

                });
              }
            }

          }
          if (_this.hasClass('product-thumbnails')) {
            args.infinite = false;
            args.focusOnSelect = true;
            if (_this.parents('.thb-product-detail').hasClass('thb-product-thumbnail-style2')) {
              args.variableWidth = true;
            }

            if (_this.parents('.thb-product-detail').hasClass('thb-product-thumbnail-style1')) {
              args.vertical = true;
              args.responsive[0].settings.vertical = true;
              args.responsive[1].settings.vertical = false;
              args.responsive[1].settings.slidesToShow = 4;
            }
          }
          if (_this.hasClass('products')) {
            args.responsive[1].settings.slidesToShow = 2;
          }

          _this.slick(args);
        });
      }
    },
    product_lightbox: {
      selector: '.woocommerce-product-gallery__trigger',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.on('click', function() {
          $('#product-images').find('.slick-current>a').trigger('click');
          return false;
        });
      }
    },
    product_wishlist: {
      selector: '.yith-wcwl-add-to-wishlist, #yith-wcwl-form',
      init: function() {
        var base = this,
          container = $(base.selector),
          wishlist = $('.thb-quick-wishlist');

        if (!wishlist.length) {
          return;
        }

        function thb_check_wishlist_count() {
          $.ajax(themeajax.url, {
            data: {
              action: 'thb_update_wishlist_count',
            },
            success: function(data) {
              if (!$('.thb-wishlist-count', wishlist).length) {
                $('.thb-item-icon-wrapper', wishlist).append('<span class="count thb-wishlist-count">' + data + '</span>');
              } else {
                $('.thb-wishlist-count', wishlist).html(data);
              }
            }
          });
        }

        body.on('added_to_wishlist removed_from_wishlist', thb_check_wishlist_count);

        $('.remove_from_wishlist').on('click', thb_check_wishlist_count);
      }
    },
    accordion: {
      selector: '.thb-accordion',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.each(function() {
          var _this = $(this),
            accordion = _this.hasClass('has-accordion'),
            sections = _this.find('.vc_tta-panel'),
            scrolling = _this.data('scroll');


          _this.on('click', '.vc_tta-panel-heading a', function() {
            var that = $(this),
              parent = that.parents('.vc_tta-panel');

            that.parents('.vc_tta-panel').toggleClass('active');
            if (accordion) {
              sections.not(parent).removeClass('active');
              sections.not(parent).find('.vc_tta-panel-body').slideUp('400');
            }

            parent.find('.vc_tta-panel-body').slideToggle('400');

            return false;
          });

        });
      }
    },
    search_toggle: {
      selector: '.thb-quick-search',
      searchTl: false,
      init: function() {
        var base = this,
          container = $(base.selector);

        var _this = container,
          target = $('.thb-header-inline-search', header),
          field = $('.search-field', target);

        base.searchTl = gsap.timeline({
          paused: true,
          reversed: true,
          onComplete: function() {
            setTimeout(function() {
              field.get(0).focus();
            }, 0);
          }
        });

        base.searchTl
          .to(target, {
            duration: 0.25,
            scaleY: 1
          });


        _this.on('click', function() {
          if (base.searchTl.reversed()) {
            base.searchTl.timeScale(1).play();
          } else {
            base.searchTl.timeScale(1.2).reverse();
          }
          return false;
        });
        $doc.keyup(function(e) {
          if (e.keyCode === 27) {
            if (base.searchTl.progress() > 0) {
              base.searchTl.reverse();
            }
          }
        });
        cc.add($('#wrapper [role="main"]')).on('click', function() {
          if (base.searchTl.progress() > 0) {
            base.searchTl.reverse();
            return false;
          }
        });

      }
    },
    tabs: {
      selector: '.thb-tabs',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.each(function() {
          var _this = $(this),
            accordion = _this.hasClass('has-accordion'),
            animation = _this.data('animation'),
            active_section = _this.data('active-section') ? _this.data('active-section') : 1,
            index = 0,
            sections = _this.find('.vc_tta-panel'),
            horizontal = _this.hasClass('thb-horizontal-tabs') && win.width() > 1067,
            active = sections.eq(index),
            menu = $('<ul class="thb-tab-menu" />').prependTo(_this);

          sections.each(function() {
            var tab_link = $(this).find('.vc_tta-panel-heading a');

            tab_link.wrap('<li class="vc_tta-panel-heading" />');

            $(this).find('li.vc_tta-panel-heading').appendTo(menu);

            $(this).find('.vc_tta-panel-heading').remove();
          });

          $('.vc_tta-panel-heading', menu).eq(0).find('a').addClass('active');
          sections.eq(0).addClass('visible');

          $(this).on('click', '.vc_tta-panel-heading a', function(e) {
            var that = $(this),
              index = that.parents('.vc_tta-panel-heading').index(),
              this_active = sections.eq(index);

            sections.not(this_active).hide();
            this_active.show();

            win.trigger('scroll.thb-animation');

            if (this_active.find('.thb-carousel')) {
              this_active.find('.thb-carousel').slick('setPosition');
            }
            if (this_active.find('.thb-masonry')) {
              this_active.find('.thb-masonry').isotope('layout');
              win.trigger('resize');
            }

            _this.find('.vc_tta-panel-heading a').removeClass('active');

            that.addClass('active');

            return false;
          });
          if (active_section > 1) {
            _this.find('.vc_tta-panel-heading a').removeClass('active');
            _this.find('.vc_tta-panel-heading').eq(active_section - 1).find('a').addClass('active');
            _this.find('.vc_tta-panel').removeClass('visible');
            _this.find('.vc_tta-panel').eq(active_section - 1).addClass('visible');
          }
        });
      }
    },
    magnificInline: {
      selector: '.mfp-inline',
      init: function() {
        var base = this,
          container = $(base.selector);


        container.magnificPopup({
          type: 'inline',
          tLoading: themeajax.l10n.lightbox_loading,
          mainClass: 'mfp-zoom-in',
          fixedBgPos: true,
          fixedContentPos: true,
          removalDelay: 400,
          closeBtnInside: true,
          closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
        });

      }
    },
    magnificGallery: {
      selector: '.mfp-gallery, .post-content .gallery, .post-content .wp-block-gallery',
      init: function(el) {
        var base = this,
          container = el ? el : $(base.selector),
          link_selector = 'a:not(.thb-pin-it)[href$=".png"],a:not(.thb-pin-it)[href$=".jpg"],a:not(.thb-pin-it)[href$=".jpeg"],a:not(.thb-pin-it)[href$=".gif"]';

        container.each(function() {
          $(this).magnificPopup({
            delegate: link_selector,
            type: 'image',
            tLoading: themeajax.l10n.lightbox_loading,
            mainClass: 'mfp-zoom-in',
            removalDelay: 400,
            fixedContentPos: false,
            closeBtnInside: false,
            closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
            gallery: {
              enabled: true,
              arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir% mfp-prevent-close">' + themeajax.svg.prev_arrow + '</button>',
              tCounter: '<span class="mfp-counter">' + themeajax.l10n.of + '</span>'
            },
            image: {
              verticalFit: true,
              titleSrc: function(item) {
                return item.img.attr('alt');
              }
            },
            callbacks: {
              imageLoadComplete: function() {
                var _this = this;
                _.delay(function() {
                  _this.wrap.addClass('mfp-image-loaded');
                }, 10);
              },
              beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
              },
              open: function() {
                $.magnificPopup.instance.next = function() {
                  var _this = this;
                  _this.wrap.removeClass('mfp-image-loaded');

                  setTimeout(function() {
                    $.magnificPopup.proto.next.call(_this);
                  }, 125);
                };

                $.magnificPopup.instance.prev = function() {
                  var _this = this;
                  this.wrap.removeClass('mfp-image-loaded');

                  setTimeout(function() {
                    $.magnificPopup.proto.prev.call(_this);
                  }, 125);
                };
              }
            }
          });
        });
      }
    },
    magnificImage: {
      selector: '.mfp-image',
      init: function() {
        var base = this,
          container = $(base.selector),
          groups = [],
          groupNames = [],
          args = {
            type: 'image',
            mainClass: 'mfp-zoom-in',
            tLoading: themeajax.l10n.lightbox_loading,
            removalDelay: 400,
            fixedContentPos: false,
            closeBtnInside: false,
            closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
            callbacks: {
              imageLoadComplete: function() {
                var _this = this;
                _.delay(function() {
                  _this.wrap.addClass('mfp-image-loaded');
                }, 10);
              },
              beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
              }
            }
          },
          gallery_args = {
            type: 'image',
            tLoading: themeajax.l10n.lightbox_loading,
            mainClass: 'mfp-zoom-in',
            removalDelay: 400,
            fixedContentPos: false,
            gallery: {
              enabled: true,
              arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir% mfp-prevent-close">' + themeajax.svg.prev_arrow + '</button>',
              tCounter: '<span class="mfp-counter">' + themeajax.l10n.of + '</span>'
            },
            image: {
              verticalFit: true,
              titleSrc: function(item) {
                return item.img.attr('alt');
              }
            },
            callbacks: {
              imageLoadComplete: function() {
                var _this = this;
                _.delay(function() {
                  _this.wrap.addClass('mfp-image-loaded');
                }, 10);
              },
              beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
              },
              open: function() {
                $.magnificPopup.instance.next = function() {
                  var _this = this;
                  _this.wrap.removeClass('mfp-image-loaded');

                  setTimeout(function() {
                    $.magnificPopup.proto.next.call(_this);
                  }, 125);
                };

                $.magnificPopup.instance.prev = function() {
                  var _this = this;
                  this.wrap.removeClass('mfp-image-loaded');

                  setTimeout(function() {
                    $.magnificPopup.proto.prev.call(_this);
                  }, 125);
                };
              }
            }
          };

        container.each(function() {
          var _this = $(this),
            groupID = _this.data('thb-group');


          if (_this.parents('.blocks-gallery-item').length) {
            return;
          }

          if (groupID && groupID !== '') {
            groupNames.push(groupID);
          } else {
            _this.magnificPopup(args);
          }
        });
        var uniq_groups = _.uniq(groupNames);
        $.each(uniq_groups, function(key, value) {
          groups.push($('.mfp-image[data-thb-group="' + value + '"]'));
        });
        if (uniq_groups.length) {
          $.each(groups, function(key, value) {
            var _gallery = value;
            _gallery.magnificPopup(gallery_args);
          });
        }

      }
    },
    magnificVideo: {
      selector: '.mfp-video',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.magnificPopup({
          type: 'iframe',
          tLoading: themeajax.l10n.lightbox_loading,
          closeBtnInside: false,
          closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
          mainClass: 'mfp-zoom-in',
          removalDelay: 400,
          fixedContentPos: true
        });

      }
    },
    loginForm: {
      selector: '.thb-overflow-container',
      init: function() {
        var base = this,
          container = $(base.selector),
          ul = $('ul', container),
          links = $('a', ul);

        links.on('click', function() {
          var _this = $(this);
          if (!_this.hasClass('active')) {
            links.removeClass('active');
            _this.addClass('active');

            $('.thb-form-container', container).toggleClass('register-active');
          }
          return false;
        });
      }
    },
    productAjaxAddtoCart: {
      selector: '.thb-single-product-ajax-on.single-product .product-type-variable form.cart, .thb-single-product-ajax-on.single-product .product-type-simple form.cart',
      init: function() {
        var base = this,
          container = $(base.selector),
          btn = $('.single_add_to_cart_button', container);

        if (typeof wc_add_to_cart_params !== 'undefined') {
          if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
            return;
          }
        }
        $doc.on('submit', 'body.single-product form.cart', function(e) {
          e.preventDefault();
          var _this = $(this),
            btn_text = btn.eq(0).text();

          if (btn.is('.disabled') || btn.is('.wc-variation-selection-needed')) {
            return;
          }

          var data = {
            product_id: _this.find("[name*='add-to-cart']").val(),
            product_variation_data: _this.serialize()
          };

          $.ajax({
            method: 'POST',
            data: data.product_variation_data,
            dataType: 'html',
            url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add-to-cart=' + data.product_id + '&thb-ajax-add-to-cart=1'),
            cache: false,
            headers: {
              'cache-control': 'no-cache'
            },
            beforeSend: function() {
              body.trigger('adding_to_cart');
              btn.addClass('disabled').text(themeajax.l10n.adding_to_cart);
            },
            success: function(data) {
              var parsed_data = $.parseHTML(data);

              var thb_fragments = {
                '.thb-cart-amount': $(parsed_data).find('.thb-cart-amount').html(),
                '.thb-cart-count': $(parsed_data).find('.thb-cart-count').html(),
                '.thb_prod_ajax_to_cart_notices': $(parsed_data).find('.thb_prod_ajax_to_cart_notices').html(),
                '.widget_shopping_cart_content': $(parsed_data).find('.widget_shopping_cart_content').html()
              };

              $.each(thb_fragments, function(key, value) {
                $(key).html(value);
              });
              body.trigger('wc_fragments_refreshed');
              btn.removeClass('disabled').text(btn_text);
            },
            error: function(response) {
              body.trigger('wc_fragments_ajax_error');
              btn.removeClass('disabled').text(btn_text);
            }
          });
        });
      }
    },
    variations: {
      selector: 'form.variations_form',
      init: function() {
        var base = this,
          container = $(base.selector),
          slider = $('#product-images'),
          thumbnails = $('#product-thumbnails'),
          org_image_wrapper = $('.first', slider),
          org_image = $('img', org_image_wrapper),
          org_link = $('a', org_image_wrapper),
          org_image_link = org_link.attr('href'),
          org_image_src = org_image.attr('src'),
          org_thumb = $('.first img', thumbnails),
          org_thumb_src = org_thumb.attr('src'),
          price_container = $('p.price', '.product-information').eq(0),
          org_price = price_container.html();

        container.on('show_variation', function(e, variation) {
          if (variation.price_html) {
            price_container.html(variation.price_html);
          }

          if (!slider.length) {
            return;
          }
          if (variation.hasOwnProperty("image") && variation.image.src) {
            org_image.attr("src", variation.image.src).attr("srcset", "");
            org_thumb.attr("src", variation.image.thumb_src).attr("srcset", "");
            org_link.attr("href", variation.image.full_src);

            if (slider.hasClass('slick-initialized')) {
              slider.slick('slickGoTo', 0);
            }
            if (typeof wc_single_product_params !== 'undefined') {
              if (wc_single_product_params.zoom_enabled === '1') {
                org_image.attr("data-src", variation.image.full_src);
              }
            }
          }
        }).on('reset_image', function() {
          price_container.html(org_price);
          if (!slider.length) {
            return;
          }
          org_image.attr("src", org_image_src).attr("srcset", "");
          org_thumb.attr("src", org_thumb_src).attr("srcset", "");
          org_link.attr("href", org_image_link);

          if (typeof wc_single_product_params !== 'undefined') {
            if (wc_single_product_params.zoom_enabled === '1') {
              org_image.attr("data-src", org_image_src);
            }
          }
        });
        if (container.find('.single_variation').is(':visible')) {
          if (container.find('.single_variation .woocommerce-variation-price').html()) {
            price_container.html(container.find('.single_variation .woocommerce-variation-price').html());
          }
        }
      }
    },
    multiple_errors: {
      selector: '.woocommerce-notices-wrapper',
      elements: '.woocommerce-message, .woocommerce-info, .woocommerce-success, .woocommerce-error',
      init: function() {
        var base = this,
          parent = $(base.selector),
          set_top = function() {
            var container = $(base.elements, base.selector).last(),
              prev_el = container.prevAll(base.elements);
            if (prev_el.length) {
              container.css({
                'top': function() {
                  var top = container[0].getBoundingClientRect().top;
                  return top + prev_el.outerHeight() + 10 + 'px';
                }
              });
            }
          };
        body.on('updated_cart_totals', set_top);
      }
    },
    quantity: {
      selector: '.quantity:not(.hidden)',
      init: function() {
        var base = this,
          container = $(base.selector);

        base.initialize();
        body.on('updated_cart_totals', function() {
          base.initialize();
        });
      },
      initialize: function() {
        // Quantity buttons
        $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<div class="plus"></div>').prepend('<div class="minus"></div>').end().find('input[type="number"]').attr('type', 'text');
        $('.plus, .minus').on('click', function() {
          // Get values
          var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

          // Format values
          if (!currentVal || currentVal === '' || currentVal === 'NaN') {
            currentVal = 0;
          }
          if (max === '' || max === 'NaN') {
            max = '';
          }
          if (min === '' || min === 'NaN') {
            min = 0;
          }
          if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') {
            step = 1;
          }

          // Change the value
          if ($(this).is('.plus')) {

            if (max && (max === currentVal || currentVal > max)) {
              $qty.val(max);
            } else {
              $qty.val(currentVal + parseFloat(step));
            }

          } else {

            if (min && (min === currentVal || currentVal < min)) {
              $qty.val(min);
            } else if (currentVal > 0) {
              $qty.val(currentVal - parseFloat(step));
            }

          }

          // Trigger change event
          $qty.trigger('change');
          return false;
        });
      }
    },
    shop: {
      selector: '.products .product, .wc-block-grid__products .product',
      init: function() {
        var base = this,
          container = $(base.selector),
          product,
          text;

        $('body')
          .on('adding_to_cart', function(e, $button) {
            if (!$button) {
              return;
            }
            product = $button.closest('.product');
            text = $button.text();

            $button.text(themeajax.l10n.adding_to_cart);

          })
          .on('added_to_cart', function(e, fragments, cart_hash, $button) {
            if ($button) {
              $button.text(text);
            }
            var product_title = product.find('.woocommerce-loop-product__title a').text();

            $('.thb-woocommerce-notices-wrapper').html('<div class="thb-temp-message">' + product_title + ' ' + themeajax.l10n.has_been_added + '</div>');
          });
      }
    },
    widget_nav_menu: {
      selector: '.widget_nav_menu, .widget_pages, .widget_product_categories',
      init: function() {
        var base = this,
          container = $(base.selector),
          items = container.find('.menu-item-has-children, .page_item_has_children, .cat-parent');

        items.each(function() {
          var _this = $(this),
            link = $('>a', _this),
            menu = _this.find('>.sub-menu, >.children');

          menu.before('<div class="thb-arrow"><i class="thb-icon-down-open-mini"></i></div>');

          $('.thb-arrow', _this).on('click', function(e) {
            var that = $(this),
              parent = that.parents('li').eq(0);
            if (parent.hasClass('active')) {
              parent.removeClass('active');
              menu.slideUp('200');
            } else {
              parent.addClass('active');
              menu.slideDown('200');
            }
            e.stopPropagation();
            e.preventDefault();
          });
          if (link.attr('href') === '#') {
            link.on('click', function(e) {
              var that = $(this),
                menu = that.next('.sub-menu');
              if (that.hasClass('active')) {
                that.removeClass('active');
                menu.slideUp('200');
              } else {
                that.addClass('active');
                menu.slideDown('200');
              }
              e.preventDefault();
            });
          }
        });
      }
    },
    alignfull: {
      selector: '.alignfull',
      init: function() {
        function setalignfull_max() {
          var scrollbarWidth = window.innerWidth - document.body.clientWidth;

          if (scrollbarWidth > 0) {
            $('.alignfull').css({
              'max-width': 'calc(100vw - ' + scrollbarWidth + 'px)',
              'margin-left': 'calc(50% - 50vw + ' + scrollbarWidth / 2 + 'px)'
            });
          }
        }
        setalignfull_max();
      }
    },
    toTop: {
      selector: '#scroll_to_top',
      init: function() {
        var base = this,
          container = $(base.selector);

        container.on('click', function() {
          gsap.to(win, {
            duration: 1,
            scrollTo: {
              y: 0,
              autoKill: false
            }
          });
          return false;
        });
        win.on('scroll', _.debounce(function() {
          base.control();
        }, 20));
      },
      control: function() {
        var base = this,
          container = $(base.selector);

        if (win.scrollTop() > 200) {
          container.addClass('active');
        } else {
          container.removeClass('active');
        }
      }
    },
  };

  $(function() {
    SITE.init();
  });
})(jQuery, this);
