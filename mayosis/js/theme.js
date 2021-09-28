!(function (t) {
    "use strict";
    function e(e) {
        var o = t(e);
        o.attr("style", "");
        var i = o.width(),
            a = o.height(),
            n = o.closest(".parallax-container-inner").width(),
            s = i / n,
            r = a / o.closest(".parallax-container-inner").height(),
            l = i / Math.min(s, r),
            c = -Math.abs((l - n) / 2);
        o.attr("style", "height: auto !important; width: " + l + "px !important; left: " + c + "px !important; top: 0px !important;");
    }
    var o, i;
    t(document).ready(function () {
        t(window).scroll(function () {
            50 < t(this).scrollTop() ? t("#back-to-top").fadeIn() : t("#back-to-top").fadeOut();
        }),
            t("#back-to-top").click(function () {
                return t("#back-to-top").tooltip("hide"), t("body,html").animate({ scrollTop: 0 }, 800), !1;
            }),
            t("#back-to-top").tooltip("show");
    }),
       
        t(document).ready(function () {
            t("#quote-carousel").carousel({ pause: !0, interval: 4e3 });
        }),
        (i = t('.edd_price_options input[type="radio"]')).click(function () {
            i.each(function () {
                t(this).closest(".edd_price_options ul li").toggleClass("item-selected active", this.checked).removeClass("active");
            });
        }),
        t("#menu-close").click(function (e) {
            e.preventDefault(), t("#sidebar-wrapper").toggleClass("active");
        }),
        t("#menu-toggle").click(function (e) {
            e.preventDefault(), t("#sidebar-wrapper").toggleClass("active");
        }),
        t(function () {
            t("input,textarea")
                .focus(function () {
                    t(this).data("placeholder", t(this).attr("placeholder")).attr("placeholder", "");
                })
                .blur(function () {
                    t(this).attr("placeholder", t(this).data("placeholder"));
                });
        }),
        (o = jQuery)('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
            if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
                var t = o(this.hash);
                if ((t = t.length ? t : o("[name=" + this.hash.slice(1) + "]")).length) return o("html, body").animate({ scrollTop: t.offset().top - 54 }, 1e3, "easeInOutExpo"), !1;
            }
        }),
        o(".js-scroll-trigger").click(function () {
            o(".navbar-collapse").collapse("hide");
        }),
       
        t(function () {
            t('[data-toggle="tooltip"]').tooltip(),
                t(".side-nav .collapse").on("hide.bs.collapse", function () {
                    t(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
                }),
                t(".side-nav .collapse").on("show.bs.collapse", function () {
                    t(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
                });
        });
    var a = ".parallax-container video";
    t(window).resize(function () {
        t(a).each(function () {
            e(t(this));
        }),
            t("iframe.vimeo-player-section").each(function () {
                var e,
                    o = t(this),
                    i = o.parent().width(),
                    a = o.parent().height();
                if ((o.data("vimeo-ratio") ? (e = o.attr("data-vimeo-ratio")) : ((e = o.data("height") / o.data("width")), o.attr("data-vimeo-ratio", e)), o.removeAttr("height width"), i * e >= a))
                    o.height(i * e)
                        .width("100%")
                        .css("margin-top", -(i * e - a) / 2)
                        .css("margin-left", 0);
                else {
                    var n = -(a / e - i) / 2;
                    o.height(a)
                        .width(a / e)
                        .css("margin-left", n)
                        .css("margin-top", 0);
                }
            }),
            t.getScript("//f.vimeocdn.com/js/froogaloop2.min.js", function () {
                t("iframe.vimeo-player-section").each(function () {
                    var e = t(this);
                    e.attr("src", e.attr("src"));
                    var o = $f(this);
                    o.addEvent("ready", function () {
                        o.api("setVolume", 0), o.api("play");
                    });
                });
            }),
            t(window).on("statechangecomplete", function () {
                t("iframe.vimeo-player-section").each(function () {
                    var t = $f(this);
                    t.addEvent("ready", function () {
                        t.api("setVolume", 0), t.api("play");
                    });
                });
            });
    }),
        t(".paratrue iframe").each(function () {
            11 == ie && 1e3 < parseInt(t(this).parent().height()) && t(this).closest(".parallax-container").removeClass("paratrue");
        });
    var n, s;
    t(window).resize(function () {
        t(".no-touch .has-anim .owl-carousel").each(function () {
            ($this = t(this)), $this.closest(".has-anim").addClass("notransition");
        }),
            setTimeout(function () {
                t(".no-touch .has-anim .owl-carousel").closest(".has-anim").removeClass("notransition");
            }, 300);
    }),
        (n = jQuery)(document).ready(function () {
            n("#mayosis-sidemenu li.has-sub>a").on("click", function () {
                n(this).removeAttr("href");
                var t = n(this).parent("li");
                t.hasClass("open")
                    ? (t.removeClass("open"), t.find("li").removeClass("open"), t.find("ul").slideUp())
                    : (t.addClass("open"),
                      t.children("ul").slideDown(),
                      t.siblings("li").children("ul").slideUp(),
                      t.siblings("li").removeClass("open"),
                      t.siblings("li").find("li").removeClass("open"),
                      t.siblings("li").find("ul").slideUp());
            }),
                n("#mayosis-sidemenu>ul>li.has-sub>a").append('<span class="holder"></span>');
        }),
        t(function () {
            t('a[href="#searchoverlay"]').on("click", function (e) {
                e.preventDefault(), t("#searchoverlay").addClass("open"), t('#searchoverlay > form > input[type="search"]').focus();
            }),
                t("#searchoverlay, #searchoverlay button.close").on("click keyup", function (e) {
                    (e.target != this && "close" != e.target.className && 27 != e.keyCode) || t(this).removeClass("open");
                });
        }),
        t(document).ready(function () {
            t("#mayosis-sidebarCollapse").on("click", function () {
                t("#mayosis-sidebar").toggleClass("active");
                t(".sidebar-wrapper").toggleClass("mcollapsed");
            });
        }),
        (s = jQuery)(window).on("load", function () {
            0 < s(".load-mayosis").length && s(".load-mayosis").fadeOut("slow");
        }),
        t(window).scroll(function () {
            1 < t(this).scrollTop() ? t(".stickyenabled").addClass("fixedheader") : t(".stickyenabled").removeClass("fixedheader");
        }),
        t(".burger, .overlaymobile").click(function () {
            t(".burger").toggleClass("clicked"), t(".overlaymobile").toggleClass("show"), t(".mobile--nav-menu").toggleClass("show"), t("body").toggleClass("overflow");
        });
})(jQuery),
    jQuery(document).ready(function (t) {
        "use strict";
        var e = t(".justified-grid").isotope({ itemSelector: ".justified-grid-item", layoutMode: "fitRows" }),
            o = t(".filters");
        o.on("click", "li", function (i) {
            o.find(".is-checked").removeClass("is-checked");
            var a = t(i.currentTarget);
            a.addClass("is-checked");
            var n = a.attr("data-filter");
            e.isotope({ filter: n });
        });
    }),
    jQuery(document).ready(function (t) {
        jQuery(".grid--filter--main span").click(function () {
            t(".active").not(t(this)).removeClass("active"), t(this).toggleClass("active");
        });
    }),
    jQuery(document).ready(function (t) {
        t(".humburger-ms").on("click", function () {
            t("#myNav").toggleClass("open");
        });
    }),
    jQuery(document).ready(function (t) {
        "use strict";
        var e = "";
        jQuery(".fil-cat").click(function () {
            (e = t(this).attr("data-rel")),
                t("#isotope-filter-recent").fadeTo(100, 0.1),
                t("#isotope-filter-recent .tile")
                    .not("." + e)
                    .fadeOut()
                    .removeClass("scale-anm"),
                setTimeout(function () {
                    t("." + e)
                        .fadeIn()
                        .addClass("scale-anm"),
                        t("#isotope-filter-recent").fadeTo(300, 1);
                }, 300);
        });
    }),
    jQuery(document).ready(function (t) {
        "use strict";
        var e = "";
        jQuery(".fil-cat").click(function () {
            (e = t(this).attr("data-rel")),
                t("#isotope-filter").fadeTo(100, 0.1),
                t("#isotope-filter .tile")
                    .not("." + e)
                    .fadeOut()
                    .removeClass("scale-anm"),
                setTimeout(function () {
                    t("." + e)
                        .fadeIn()
                        .addClass("scale-anm"),
                        t("#isotope-filter").fadeTo(300, 1);
                }, 300);
        });
    }),
    jQuery(document).ready(function (t) {
        t(
            ".download_cat_filter select,.mayosis_vendor_cat select,.mayosis-filter-title .product_filter_mayosis,.vendor--search-filter--box select,.mayofilter-orderby,.mayosis-filters-select,.mayosis-filters-select-small,.tutor-course-filter-form select"
        ).niceSelect(),
            t(".multiselect,#edd_checkout_form_wrap select,.edd_form select").niceSelect("destroy");
    }),
    jQuery(document).ready(function (t) {
        var e = 20;
        e += t(".admin-bar").length ? 32 : 0;
        var o = t(window).width();
        t(".mayosis-floating-share").each(function () {
            var e = t(".mayosis-floating-share").outerHeight(!0) + 50;
            t(this).css("height", t(".single-prime-layout").height() + (o > 1500 ? e : 0) + "px"), t(this).theiaStickySidebar({ minWidth: 768, updateSidebarHeight: !1, defaultPosition: "absolute", additionalMarginTop: 150 });
        });
    }),
    jQuery(function (t) {
        "use strict";
        if (t("body").is(".download-template-prime-download-template, .single-post")) {
            var e = function (t, e) {
                    var o = t.getBoundingClientRect(),
                        i = e.getBoundingClientRect();
                    return !(o.top > i.bottom || o.right < i.left || o.bottom < i.top || o.left > i.right);
                },
                o = 0;
            if (t(window).width() < 768) return !1;
            var i = [".bottom-post-footer-widget", ".main-footer", ".alignfull"],
                a = [],
                n = t(".mayosis-floating-share");
            t(i.join(",")).each(function () {
                a.push(this);
            }),
                t(window).on("scroll", function () {
                    var i = !1,
                        s = n.find(".theiaStickySidebar").get(0);
                    if (t(window).scrollTop() < o) i = !0;
                    else
                        for (var r in a)
                            if (e(s, a[r])) {
                                i = !0;
                                break;
                            }
                    i ? n.addClass("is-hidden") : n.removeClass("is-hidden");
                });
        }
    }),
  
    jQuery(document).ready(function (t) {
        function e(e) {
            t("video", this).get(0).play();
        }
        function o(e) {
            t("video", this).get(0).pause();
        }
        t(".format-video .mayosis--video--box,.format-video .product-masonry-item-content,.format-video .product-justify-item-content").hover(e, o);
        lity.handlers("video", function (t) {
            if ("string" == typeof t && t.indexOf(".mp4") > 0) {
                var e = '<video style="max-width: 100%;" autoplay playsinline>';
                return (e += '<source src="' + t + '" type="video/mp4">'), (e += "</video>");
            }
            return !1;
        });
    }),
    jQuery(document).ready(function (t) {
        Plyr.setup("#mayosisplayergrid"), Plyr.setup("#mayosisplayer");
    }),
    jQuery(document).ready(function (t) {
        var e = t(".gridbox");
        t(window).load(function () {
            e.imagesLoaded(function () {
                e.isotope({ itemSelector: ".element-item", layoutMode: "fitRows", transitionDuration: "0.8s" }),
                    setTimeout(function () {
                        e.isotope("layout");
                    }, 500),
                    t(".mayosis-filters-select").change(function () {
                        e.isotope({ filter: this.value });
                    }),
                    t(window).on("resize", function () {
                        e.isotope("layout");
                    }),
                    window.addEventListener(
                        "orientationchange",
                        function () {
                            e.isotope("layout");
                        },
                        !1
                    );
            });
        });
    }),
    jQuery(document).ready(function (t) {
        var e = t(".mayosis_tabbed_grid_featured");
        t(window).load(function () {
            e.imagesLoaded(function () {
                e.isotope({ itemSelector: ".element-item", layoutMode: "fitRows", transitionDuration: "0.8s" }),
                    setTimeout(function () {
                        e.isotope("layout");
                    }, 500),
                    t(".mayosis-filters-select").change(function () {
                        e.isotope({ filter: this.value });
                    }),
                    t(window).on("resize", function () {
                        e.isotope("layout");
                    }),
                    window.addEventListener(
                        "orientationchange",
                        function () {
                            e.isotope("layout");
                        },
                        !1
                    );
            });
        });
    }),
    jQuery(document).ready(function (t) {
        var e = t(".mayosis_tabbed_grid_recent");
        t(window).load(function () {
            e.imagesLoaded(function () {
                e.isotope({ itemSelector: ".element-item", layoutMode: "fitRows", transitionDuration: "0.8s" }),
                    setTimeout(function () {
                        e.isotope("layout");
                    }, 500),
                    t(".mayosis-filters-select").change(function () {
                        e.isotope({ filter: this.value });
                    }),
                    t(window).on("resize", function () {
                        e.isotope("layout");
                    }),
                    window.addEventListener(
                        "orientationchange",
                        function () {
                            e.isotope("layout");
                        },
                        !1
                    );
            });
        });
    }),
    jQuery(document).ready(function (t) {
        var e = t(".gridboxsmall");
        t(window).load(function () {
            e.imagesLoaded(function () {
                e.isotope({ itemSelector: ".grid-product-box", layoutMode: "fitRows", transitionDuration: "0.8s" }),
                    setTimeout(function () {
                        e.isotope("layout");
                    }, 500),
                    t(".mayosis-filters-select-small").change(function () {
                        e.isotope({ filter: this.value });
                    }),
                    t(window).on("resize", function () {
                        e.isotope("layout");
                    }),
                    window.addEventListener(
                        "orientationchange",
                        function () {
                            e.isotope("layout");
                        },
                        !1
                    );
            });
        });
    }),
    jQuery(document).ready(function (t) {
        var e = t(".product-masonry");
        t(window).load(function () {
            e.imagesLoaded(function () {
                e.isotope({ itemSelector: ".product-masonry-item", layoutMode: "masonry", transitionDuration: "0.8s" }),
                    setTimeout(function () {
                        e.isotope("layout");
                    }, 500),
                    t(".product-masonry-filter li a").on("click", function () {
                        t(".product-masonry-filter li a").removeClass("active"), t(this).addClass("active");
                        var o = t(this).attr("data-filter");
                        return (
                            t(".product-masonry").isotope({ filter: o }),
                            setTimeout(function () {
                                e.isotope("layout");
                            }, 700),
                            !1
                        );
                    }),
                    t(window).on("resize", function () {
                        e.isotope("layout");
                    }),
                    window.addEventListener(
                        "orientationchange",
                        function () {
                            e.isotope("layout");
                        },
                        !1
                    );
            });
        });
    }),
    jQuery(document).ready(function (t) {
        t(".statistic-counter").counterUp({ delay: 10, time: 2e3 });
    }),
    jQuery(document).ready(function (t) {
        t(".mayosis--video--box,.photo--section--image").fitVids();
    }),
    jQuery(document).ready(function (t) {
        t(".popr").popr();
    }),
    jQuery(document).ready(function () {
        $(".overlay_button_search").click(function () {
            $(".main_searchoverlay").addClass("open");
        });
    }),
    jQuery(document).ready(function () {
        $(".floating_play").click(function () {
            $(".floating_pause").show(), $(".floating_pause").css("display", "inline-block"), $(".floating_play").hide();
        }),
            $(".floating_pause").click(function () {
                $(".floating_play").show(), $(".floating_play").css("display", "inline-block"), $(".floating_pause").hide();
            });
    });
jQuery(document).ready(function () {
    var stickybar = $("#mayosis-sticky-bar");
    if (typeof stickybar.howdyDo === "function") {
        stickybar.howdyDo({ action: "push", effect: "slide", easing: "easeInBounce", duration: 200, delay: 200, barClass: "mayosis_fixed_notify", initState: "open", closeAnchor: '<i class="zil zi-cross"></i>' }),
            stickybar.effect("bounce", "medium");
    }
});
jQuery(document).ready(function () {
    new BeerSlider(document.getElementById("mayosis-before-after"), { start: 50 });
});
jQuery(document).ready(function () {
var scrollSpy = new bootstrap.ScrollSpy(document.body, {
  target: '#mainNav'
})
});
