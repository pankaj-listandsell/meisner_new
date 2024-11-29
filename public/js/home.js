window.lazyLoadOptions = {
    elements_selector: ".lazy",
};

// Listen to the initialization event and get the instance of LazyLoad
window.addEventListener('LazyLoad::Initialized', function (event) {
    window.lazyLoadInstance = event.detail.instance;
}, false);

jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ){
        if ( ns.includes("noPreventDefault") ) {
            this.addEventListener("touchstart", handle, { passive: false });
        } else {
            this.addEventListener("touchstart", handle, { passive: true });
        }
    }
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.bravo_format_money = function ($money) {

    if (!$money) {
        //return bookingCore.free_text;
    }
    //if (typeof bookingCore.booking_currency_precision && bookingCore.booking_currency_precision) {
    //    $money = Math.round($money).toFixed(bookingCore.booking_currency_precision);
    //}

    $money = bravo_number_format($money / bookingCore.currency_rate, bookingCore.booking_decimals, bookingCore.decimal_separator, bookingCore.thousand_separator);
    var $symbol = bookingCore.currency_symbol;
    var $money_string = '';

    switch (bookingCore.currency_position) {
        case "right":
            $money_string = $money + $symbol;
            break;
        case "left_space":
            $money_string = $symbol + " " + $money;
            break;

        case "right_space":
            $money_string = $money + " " + $symbol;
            break;
        case "left":
        default:
            $money_string = $symbol + $money;
            break;
    }

    return $money_string;
}

window.bravo_number_format = function (number, decimals, dec_point, thousands_sep) {


    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

window.bravo_handle_error_response = function (e) {
    switch (e.status) {
        case 401:
            // not logged in
            $('#login').modal('show');
            break;
    }
};

// Form validation
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});

var bookingCoreApp = {
    showSuccess: function (configs) {
        var args = {};
        if (typeof configs == 'object') {
            args = configs;
        } else {
            args.message = configs;
        }
        if (!args.title) {
            args.title = i18n.success;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showError: function (configs) {
        var args = {};
        if (typeof configs == 'object') {
            args = configs;
        } else {
            args.message = configs;
        }
        if (!args.title) {
            args.title = i18n.warning;
        }
        args.centerVertical = true;
        bootbox.alert(args);
    },
    showAjaxError: function (e) {
        var json = e.responseJSON;
        if (typeof json != 'undefined') {
            if (typeof json.errors != 'undefined') {
                var html = '';
                _.forEach(json.errors, function (val) {
                    html += val + '<br>';
                });

                return this.showError(html);
            }
            if (json.message) {
                return this.showError(json.message);
            }
        }
        if (e.responseText) {
            return this.showError(e.responseText);
        }
    },
    showAjaxMessage: function (json) {
        if (json.message) {
            if (json.status) {
                this.showSuccess(json);
            } else {
                this.showError(json);
            }
        }
    },
    showConfirm: function (configs) {
        var args = {};
        if (typeof configs == 'object') {
            args = configs;
        }
        args.buttons = {
            confirm: {
                label: '<i class="fa fa-check"></i> ' + i18n.confirm,
            },
            cancel: {
                label: '<i class="fa fa-times"></i> ' + i18n.cancel,
            }
        };
        args.centerVertical = true;
        bootbox.confirm(args);
    }
};

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function post_request(endpoint, data) {
    return fetch(bookingCore.url + endpoint, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    })
}


jQuery(function ($) {

    // footer menu
    // $(".foot_list li").on('click', function (e) {
    //     $(".foot_list li").removeClass("active");
    //     $(this).addClass("active");
    //     $('.fmenu_content, .fmenu_content div').hide();
    //     var idname = $(this).attr('id');
    //     $('.'+idname).show();
    //     $('.fmenu_content').show();
    // });


    // Add click event handler to each menu item
    $('.foot_list li').click(function() {
        var index = $(this).index();

        // Toggle the display of the selected content div
        $('.fmenu_content div').eq(index).toggle();

        // Hide all other content divs
        $('.fmenu_content div').not(':eq(' + index + ')').hide();
        // Add 'active' class to the clicked tab
        $(this).toggleClass('active');

        // Remove 'active' class from other tabs
        $('.foot_list li').not(this).removeClass('active');
    });



    // on click menu open
    $(".bravo-menu ul.main-menu li.mega_menu_li > a, .bravo-menu ul.main-menu li.anfrage_form > a").on('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior
        console.log("clicked");

        var $clickedSubMenu = $(this).closest("li").find(".children-menu");
        // Remove 'show' class from all children-menu elements except the clicked one
        $(".children-menu").not($clickedSubMenu).removeClass("show");

        $(this).closest("li").find(".children-menu").toggleClass("show");
    });

    $(document).on('click', function (e) {
        var $menu = $('.bravo-menu ul.main-menu li .children-menu');
        if ($menu.hasClass('show') && !$(e.target).closest('.main-menu, .children-menu').length) {
            $menu.removeClass('show');
        }
    });

    // Function to handle scrolling the page
    $(window).on('scroll', function () {
        $('.children-menu').removeClass('show');
    });

    // Owl Carousel
    var owlr = $(".owl-carousel.referenzen");
    owlr.owlCarousel({
        items: 6,
        margin: 10,
        loop: false,
        nav: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },
            1366:{
                items: 5
            }
        }
    });
    var owlre = $(".owl-carousel.reviews");
    owlre.owlCarousel({
        items: 2,
        margin: 10,
        loop: false,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1366:{
                items: 2
            }
        }
    });


    function parseErrorMessage(e) {
        var html = '';
        if (e.responseJSON) {
            if (e.responseJSON.errors) {
                return Object.values(e.responseJSON.errors).join('<br>');
            }
        }
        return html;
    }

    $(".bravo-form-search-all.carousel_v2").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 1,
            lazyLoad:true,
            loop: true,
            margin: 0,
            nav: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            animateOut: 'fadeOut'
        })
    });


    $(".bravo_fullHeight").each(function () {
        var height = $(document).height();
        if ($(document).find(".bravo-admin-bar").length > 0) {
            height = height - $(".bravo-admin-bar").height();
        }
        $(this).css('min-height', height);
    });

    // Date Picker Range
    $('.form-date-search').each(function () {
        var single_picker = false;
        if ($(this).hasClass("is_single_picker")) {
            single_picker = true;
        }
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_out_input = $('.check-out-input', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            singleDatePicker: single_picker,
            autoApply: true,
            disabledPast: true,
            customClass: '',
            widthSingle: 300,
            onlyShowCurrentMonth: true,
            minDate: today,
            opens: bookingCore.rtl ? 'right' : 'left',
            locale: {
                format: "YYYY-MM-DD",
                direction: bookingCore.rtl ? 'rtl' : 'ltr',
                firstDay: daterangepickerLocale.first_day_of_week
            }
        };
        if (typeof daterangepickerLocale == 'object') {
            options.locale = _.merge(daterangepickerLocale, options.locale);
        }
        check_in_out.daterangepicker(options,
            function (start, end, label) {
                check_in_input.val(start.format(bookingCore.date_format));
                check_in_render.html(start.format(bookingCore.date_format));
                check_out_input.val(end.format(bookingCore.date_format));
                check_out_render.html(end.format(bookingCore.date_format));
            });
        date_wrapper.click(function (e) {
            check_in_out.trigger('click');
        });
    });

    // Date Picker
    $('.date-picker').each(function () {
        var options = {
            "singleDatePicker": true,
            opens: bookingCore.rtl ? 'right' : 'left',
            locale: {
                format: bookingCore.date_format,
                direction: bookingCore.rtl ? 'rtl' : 'ltr',
                firstDay: daterangepickerLocale.first_day_of_week
            }
        };
        if (typeof daterangepickerLocale == 'object') {
            options.locale = _.merge(daterangepickerLocale, options.locale);
        }
        $(this).daterangepicker(options);
    });


    function ajax_error_to_string(e) {
        if (typeof e.responseJSON !== 'undefined') {
            if (e.responseJSON.errors) {
                var html = [];
                for (var k in e.responseJSON.errors) {
                    html.push(e.responseJSON.errors[k].join("<br/>"));
                }

                return html.join("<br/>");
            }

            if (e.responseJSON.message) {
                return e.responseJSON.message;
            }
        }
    }

    //Login
    $('.bravo-form-login [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-login');
        var redirect = form.find('input[name=redirect]').val();

        $.ajax({
            url: bookingCore.url + '/login',
            data: {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'remember': form.find('input[name=remember]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
                'redirect': form.find('input[name=redirect]').val()
            },
            method: 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            dataType: 'json',
            success: function (data) {
                if (data.two_factor) {
                    return window.location.href = bookingCore.url + '/two-factor-challenge';
                }
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for (var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-' + item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                    return;
                }
                if (data.message) {
                    form.find('.message-error').show().html('<div class="alert alert-success">' + data.message + '</div>');
                }
                if (typeof BravoReCaptcha !== 'undefined') {
                    BravoReCaptcha.reset('login');
                    BravoReCaptcha.reset('login_normal');

                }
                if (redirect.trim('/')) {
                    window.location.href = bookingCore.url_root + form.find('input[name=redirect]').val();
                } else {
                    window.location.reload();
                }

            },
            error: function (e) {
                form.find('.icon-loading').hide();
                var html = ajax_error_to_string(e);
                if (typeof BravoReCaptcha !== 'undefined') {
                    BravoReCaptcha.reset('login');
                    BravoReCaptcha.reset('login_normal');

                }
                if (html) {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + html + '</div>');
                }
            }
        });
    })
    $('.bravo-form-register [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-register');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': bookingCore.routes.register,
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'first_name': form.find('input[name=first_name]').val(),
                'last_name': form.find('input[name=last_name]').val(),
                'phone': form.find('input[name=phone]').val(),
                'term': form.find('input[name=term]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for (var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-' + item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');

                    }
                }
                if (typeof BravoReCaptcha !== 'undefined') {
                    BravoReCaptcha.reset('register');
                    BravoReCaptcha.reset('register_normal');
                }
                if (data.redirect !== undefined) {
                    window.location.href = data.redirect
                }
            },
            error: function (e) {
                form.find('.icon-loading').hide();
                if (typeof e.responseJSON !== "undefined" && typeof e.responseJSON.message != 'undefined') {
                    form.find('.message-error').show().html('<div class="alert alert-danger">' + e.responseJSON.message + '</div>');
                }

                if (typeof BravoReCaptcha !== 'undefined') {
                    BravoReCaptcha.reset('register');
                    BravoReCaptcha.reset('register_normal');
                }
            }
        });
    })
    $('#register').on('show.bs.modal', function (event) {
        $('#login').modal('hide')
    })
    $('#login').on('show.bs.modal', function (event) {
        $('#register').modal('hide')
    });

    var onSubmitSubscribe = false;
    //Subscribe box
    $('.bravo-subscribe-form').submit(function (e) {
        e.preventDefault();

        if (onSubmitSubscribe) return;

        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }

                if (json.status) {
                    me.find('input').val('');
                }

            },
            error: function (e) {
                console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (parseErrorMessage(e)) {
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                } else if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });

    //Menu
    $(".bravo-more-menu").click(function () {
        $(this).trigger('bravo-trigger-menu-mobile');
    });
    $(".bravo-menu-mobile .b-close").click(function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    });
    $(document).on("click", ".bravo-effect-bg", function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    })
    $(document).on("bravo-trigger-menu-mobile", ".bravo-more-menu", function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(".bravo-menu-mobile").addClass("active");
            $('body').css('overflow', 'hidden').append("<div class='bravo-effect-bg'></div>");
        } else {
            $(".bravo-menu-mobile").removeClass("active");
            $("body").css('overflow', 'initial').find(".bravo-effect-bg").remove();
        }
    });
    $(".bravo-menu-mobile .g-menu ul li .fa").click(function (e) {
        e.preventDefault();
        $(this).closest('li').toggleClass('active');
    });
    $(".bravo-menu-mobile").each(function () {
        var h_profile = $(this).find(".user-profile").height();
        var h1_main = $(window).height();
        $(this).find(".g-menu").css("max-height", h1_main - h_profile - 15);
    });

    $(".bravo-more-menu-user").click(function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").addClass("active");
        $("body").css('overflow', 'hidden').append("<div class='bravo-effect-user-bg'></div>");
    });
    $(document).on("click", ".bravo-effect-user-bg,.bravo-close-menu-user", function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").removeClass("active");
        $('body').css('overflow', 'initial').find(".bravo-effect-user-bg").remove();
    })

    // $('[data-toggle="tooltip"]').tooltip();
    // $('.dropdown-toggle').dropdown();

    $('.bravo-video-popup').click(function () {
        let video_url = $(this).data("src");
        let target = $(this).data("target");
        $(target).find(".bravo_embed_video").attr('src', video_url + "?autoplay=0&amp;modestbranding=1&amp;showinfo=0");
        $(target).on('hidden.bs.modal', function () {
            $(target).find(".bravo_embed_video").attr('src', "");
        });
    });


    var onSubmitContact = false;
    //Contact box
    $('.bravo-contact-block-form').submit(function (e) {
        e.preventDefault();
        if (onSubmitContact) return;
        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');
        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitContact = false;
                me.removeClass('loading');
                if (json.message) {
                    me.find('.form-mess').html('<div class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</div>');
                }
                if (json.status) {
                    me.find('input').val('');
                    me.find('textarea').val('');
                    me.find('input[type=checkbox]').prop('checked', false);
                    me.find('.captcha-img').html(json.data);
                }

                if (json.error === true) {
                    if (json.messages !== undefined) {
                        var errorHtml = "<ul>";
                        for (var item in json.messages) {
                            errorHtml += '<li>'+json.messages[item]+'</li>';
                        }
                        errorHtml += "</ul>";
                        me.find('.message-alert').show().html(errorHtml);
                    }
                }
                /*if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('contact');
                }*/
            },
            error: function (e) {
                onSubmitContact = false;
                me.removeClass('loading');
                if (parseErrorMessage(e)) {
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                } else if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

                if (typeof e.responseJSON !== 'undefined') {
                    var html = ajax_error_to_string(e);
                    if (html) {
                        me.find('.message-alert').show().html('<div class="alert alert-danger">' + html + '</div>');
                    }
                    if (e.responseJSON.captcha_img) {
                        me.find('.captcha-img').html(e.responseJSON.captcha_img);
                    }
                }
                /*if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('contact');
                }*/

            }
        });
        return false;
    });

    $('.btn-submit-enquiry').click(function (e) {

        e.preventDefault();
        let form = $(this).closest('.enquiry_form_modal_form');

        $.ajax({
            url: bookingCore.url + '/booking/addEnquiry',
            data: form.find('textarea,input,select').serialize(),
            dataType: 'json',
            type: 'post',
            beforeSend: function () {
                form.find('.message_box').html('').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (res) {
                if (res.errors) {
                    res.message = '';
                    for (var k in res.errors) {
                        res.message += res.errors[k].join('<br>') + '<br>';
                    }
                }
                if (res.message) {
                    if (!res.status) {
                        form.find('.message_box').append('<div class="text text-danger">' + res.message + '</div>').show();
                    } else {
                        form.find('.message_box').append('<div class="text text-success">' + res.message + '</div>').show();
                    }
                }

                form.find('.icon-loading').hide();

                if (res.status) {
                    form.find('textarea').val('');
                }

                if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('enquiry_form');
                }
            },
            error: function (e) {
                if (typeof BravoReCaptcha != "undefined") {
                    BravoReCaptcha.reset('enquiry_form');
                }
                form.find('.icon-loading').hide();
            }
        })
    })

    /*$('.bc_popup').modal('show').on('hidden.bs.modal', function () {
        var id = $(this).attr('id');
        setCookie(id, 1, parseInt($(this).data('days')));
    })*/

});

/*jQuery(function ($) {

    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('.notification-icon');
    var notificationsCount = parseInt(notificationsCountElem.html());
    var notifications = notificationsWrapper.find('ul.dropdown-list-items');

    if (bookingCore.pusher_api_key && bookingCore.pusher_cluster) {
        var pusher = new Pusher(bookingCore.pusher_api_key, {
            encrypted: true,
            cluster: bookingCore.pusher_cluster
        });
    }

    $(document).on("click", ".markAsRead", function (e) {
        e.stopPropagation();
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).attr('href');
        $.ajax({
            url: bookingCore.markAsRead,
            data: {'id': id},
            method: "post",
            success: function (res) {
                window.location.href = url;
            }
        })
    });
    $(document).on("click", ".markAllAsRead", function (e) {
        e.stopPropagation();
        e.preventDefault();
        $.ajax({
            url: bookingCore.markAllAsRead,
            method: "post",
            success: function (res) {
                $('.dropdown-notifications').find('li.notification').removeClass('active');
                notificationsCountElem.text(0);
                notificationsWrapper.find('.notif-count').text(0);
            }
        })
    });

    var callback = function (data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = '<li class="notification active">'
            + '<div class="media">' +
            '   <a class="markAsRead p-0" data-id="' + data.idNotification + '" href="' + data.link + '">'
            + '    <div class="media-left">'
            + '      <div class="media-object">' + data.avatar
            + '      </div>'
            + '    </div>'
            + '    <div class="media-body">'
            + '      ' + data.message + ''
            + '      <div class="notification-meta">'
            + '        <small class="timestamp">about a few seconds ago</small>'
            + '      </div>'
            + '    </div>'
            + '  </a>' +
            '</div>'
            + '</li>';
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.text(notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
    };

    if (bookingCore.isAdmin > 0 && bookingCore.pusher_api_key) {
        var channel = pusher.subscribe('admin-channel');
        channel.bind('App\\Events\\PusherNotificationAdminEvent', callback);
    }

    if (bookingCore.currentUser > 0 && bookingCore.pusher_api_key) {
        var channelPrivate = pusher.subscribe('user-channel-' + bookingCore.currentUser);
        channelPrivate.bind('App\\Events\\PusherNotificationPrivateEvent', callback);
    }

    if ($('.tabs-box').length) {
        $('.tabs-box .tab-buttons .tab-btn').on('click', function (e) {
            e.preventDefault();
            var target = $($(this).attr('data-tab'));
            if ($(target).is(':visible')) {
                return false;
            } else {
                target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                $(this).addClass('active-btn');
                target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab animated fadeIn');
                $(target).fadeIn(300);
                $(target).addClass('active-tab animated fadeIn');
            }
        });
    }

});*/


$(window).scroll(function(){
    var sticky = $('.bravo_header'),
        scroll = $(window).scrollTop();

    if (scroll >= 100){
        sticky.addClass('header--sticky');
    }
    else{
        sticky.removeClass('header--sticky');
    }
});

$(function(){
    $.scrollUp({
        scrollText: '<div>' +
            '<i class="icon-up-open-big scrolltop-icon"></i>' +
            '<span class="scrolltop-text">'+bookingCore.scrollText+'</span>' +
            '</div>',
    });
});

$(document).ready(function(){
    if($('.page-template-content').length>0 || $('.bravo-contact-block').length>0){
        $('.bravo_header').addClass('p-abs');
    }else{
        if($('.bravo_header').hasClass('p-abs')){
            $('.bravo_header').removeClass('p-abs');
        }
    }

    $('#rd_more').click(function(e){
        $('#rd_less').css("display", "block");
        $('#rd_more').css("display", "none");
        $('.hm_more_content').css({"height": "100%", "-webkit-mask-image": "none"});
    });
    $('#rd_less').click(function(e){
        $('#rd_less').css("display", "none");
        $('#rd_more').css("display", "block");
        $('.hm_more_content').css({"height": "490px", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
    });

    $('#rd_mo').click(function(e){
        e.preventDefault();
        $('#rd_ls').css("display", "block");
        $('#rd_mo').css("display", "none");
        $('.rd_mo_less_section').css({"height": "100%", "-webkit-mask-image": "none"});
    });
    $('#rd_ls').click(function(e){
        e.preventDefault();
        $('#rd_ls').css("display", "none");
        $('#rd_mo').css("display", "block");
        $('.rd_mo_less_section').css({"height": "430px", "-webkit-mask-image": "linear-gradient(to bottom,#000 71%,rgba(0,0,0,0))"});
    });
});

const currentYear = new Date().getFullYear();
$('.currentYear').html(currentYear);
