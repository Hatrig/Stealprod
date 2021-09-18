$('#users_count').animate({ num: $('#users_count').text()/* - начало */ }, {
    duration: 3000,
    step: function (num){
        this.innerHTML = (num).toFixed(0)
    }
});

$('#logs_count').animate({ num: $('#logs_count').text()/* - начало */ }, {
    duration: 3000,
    step: function (num){
        this.innerHTML = (num).toFixed(0)
    }
});

$('#members').animate({ num: $('#members').text()/* - начало */ }, {
    duration: 3000,
    step: function (num){
        this.innerHTML = (num).toFixed(0)
    }
});

$('#group_members').animate({ num: $('#group_members').text()/* - начало */ }, {
    duration: 3000,
    step: function (num){
        this.innerHTML = (num).toFixed(0)
    }
});

$('.loader').addClass('started');

var stealprod_loader = "<div class='stealprod-loader'><div class='smoke'></div></div>";
var stealprod_loader_white = "<div class='stealprod-loader white'><div class='smoke'></div></div>";

var href = window.location.pathname;
	for(var i = 0; i < $('.header > .header-content > .menu li').length; i++) {
		var object = $('.header > .header-content > .menu li:eq('+i+')');
		if('/' + object.attr('name') === href || '/' + object.attr('name') + '/' === href) 
		{
			object.addClass('active');
			break;
		}
		else {
			continue;
		}
	}
	for(var i = 0; i < $('.mobile-menu > .mobile-menu-content-wrapper > .mobile-menu-content > .menu li').length; i++) {
		var object = $('.mobile-menu > .mobile-menu-content-wrapper > .mobile-menu-content > .menu li:eq('+i+')');
		if('/' + object.attr('name') === href || '/' + object.attr('name') + '/' === href) 
		{
			object.addClass('active');
			break;
		}
		else {
			continue;
		}
	}

    $(window).on("load",function(){
        $('.loader').removeClass('started').addClass('ended');
        setTimeout(function() {
            $('.loader').fadeOut('slow');
        }, 400);
    });

$(document).keydown(function(e) {
    if(e.keyCode === 27 ) {
        e.preventDefault();
        $('.oferta-wrapper').fadeOut(250);
        $('.full-image-wrapper').fadeOut(250);
        closeModal();
        return false;
    }
});

$('.full-image-wrapper > .full-image-content-wrapper > .closer').click(function() {
    $('.full-image-wrapper').fadeOut(250);
});

$('.oferta-wrapper > .oferta-content-wrapper > .closer, .oferta-wrapper > .oferta-content-wrapper > .oferta-content > .buttons > h3').click(function(){
    $('.oferta-wrapper').fadeOut(250);
});

$('.modal-wrapper > .modal-content-wrapper > .closer, .modal-wrapper > .modal-content-wrapper > .modal-content > .closer-icon').click(function() {
    closeModal();
});

function closeModal() {
    //$("html,body").css("overflow", "auto");
    $('.modal-wrapper').fadeOut(250);
}

function openModal(name) {
    //$("html,body").css("overflow", "hidden");
    $('.modal-wrapper.'+name+'').fadeIn(250);
}

function infoAlertorMini(text = 'Неизвестная ошибка') {
    var _alert = $('.info-alert-mini'),
        _text = _alert.find('.info-alert-mini-content').find('h3');

    _text.html(text);
    _alert.fadeIn(300).addClass('active');
    setTimeout(function() {
        _alert.removeClass('active').fadeOut(300);
    }, 2500);
}

function alertor(form = null, text = null, input = null) {
    if(form && text) {
        var textor = form.find('.alert-text');
        if(textor.is(':hidden')) {
            textor.find('p').html(text);
            textor.fadeIn(750);
            setTimeout(function() {
                textor.fadeOut(750);
            }, 2500);
        }
    }
    if(input) {
        var alert = input.find('.alert');
        if(!alert.hasClass('fadeIn')) {
            alert.removeClass('zoomOut').addClass('fadeIn').fadeIn(750, function () {
                setTimeout(function() {
                    alert.removeClass('fadeIn').addClass('zoomOut').fadeOut(750);
                }, 500);
            });
        }
    }
}