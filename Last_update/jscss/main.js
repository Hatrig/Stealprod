$('.loader').addClass('started');

var malinovka_loader = "<div class='malinovka-loader'><div class='smoke'></div></div>";
var malinovka_loader_white = "<div class='malinovka-loader white'><div class='smoke'></div></div>";

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

function DateToNotifies(length = 0) {
	if(length) length--;
	else $('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification:eq(0) > .texts > p.date').html(new Date($('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification:eq(0) > .texts > p.date').html() * 1000).format('d.m.y H:i'));
	for(var i = 0; i < $('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification:gt('+length+')').length; i++) {
		var	_this_not = $('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification:gt('+length+'):eq('+i+')'),
			_this_not_date = _this_not.find('.texts > p.date');
		_this_not_date.html(new Date(_this_not_date.html() * 1000).format('d.m.y H:i'));
	}
}
DateToNotifies();

$(document).ready(function() {
	var temp_notify = getCookie('temp_notify');
	var temp_text = '';
	if(!temp_notify) return;
	switch(temp_notify) {
		case 'ticket' : temp_text = 'Ваше обращение отправлено администрации!'; break;
		case 'delete_ticket' : temp_text = 'Ваше обращение удалено!'; break;
		case 'chat' : temp_text = 'Ваше сообщение отправлено!'; break;
		case 'character' : temp_text = 'Новый персонаж успешно создан!'; break;
		case 'delete_character' : temp_text = 'Персонаж будет удален через 24 часа!'; break;
		case 'undelete_character' : temp_text = 'Успешная отмена удаления персонажа!'; break;
		case 'vk_link' : temp_text = 'Успешная привязка ВКонтакте!'; break;
		case 'tg_link' : temp_text = 'Успешная привязка Telegram!'; break;
		case 'email_link' : temp_text = 'Успешная привязка Email!'; break;
		case 'discord_link' : temp_text = 'Успешная привязка Discord!'; break;
		case 'notification_settings' : temp_text = 'Настройки уведомлений сохранены!'; break;
		case 'set2fa' : temp_text = 'Успешная установка защиты!'; break;
		case 'unset2fa' : temp_text = 'Защита аккаунта отключена!'; break;
		case 'change_password' : temp_text = 'Успешная смена пароля!'; break;
		default : temp_text = 'Произошла ошибка!'; break;
	}
	infoAlertor(temp_text);
	deleteCookie('temp_notify');
});
	
$(window).on("load",function(){
	$('.loader').removeClass('started').addClass('ended');
	setTimeout(function() {
		$('.loader').fadeOut('slow');
	}, 400);
});

function MobileMenuClosenator() {
	if($('.mobile-menu').is(':visible')) {
		$("html,body").css("overflow","auto");
		$('.mobile-bar').removeClass('active');
		$('.mobile-menu').fadeOut(250);
	}
	else {
		$("html,body").css("overflow","hidden");
		$('.mobile-bar').addClass('active');
		$('.mobile-menu').fadeIn(250);
	}
}

$('.mobile-bar, .mobile-menu > .mobile-menu-content-wrapper > .closer').click(function(){
	MobileMenuClosenator();
});

var inLoadedNotify = false;
$(".header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content").scroll(function() {
	var _this = $(this),
		_this_height = _this.find('.notification').length * _this.find('.notification').height() + _this.find('h3').length * _this.find('h3').height(),
		_this_scroll = _this.scrollTop(),
		_this_notifies = _this.find('.notification').length;
	if(_this_scroll >= _this_height - _this.find('.notification').height() * 2 && !inLoadedNotify && _this_notifies >= 10) {
		inLoadedNotify = true;
		$.ajax({
			type: "POST",
			url: "/php/notificationLoader.php",
			data: {
				number : _this_notifies,
				token : '9PECxV'
			},
			success: function(Data) {
				setTimeout(function() {
					inLoadedNotify = false;
				}, 1000);
				if(Data) {
					_this.append(Data);
					DateToNotifies(_this_notifies);
					Readablenator();
				}
			}          
		});
	}
});

$('.header > .header-content > .control.one button').hover(function() {
	var _this = $(this);
	$('.header > .header-content > .control.one button').removeClass('active');
	_this.addClass('active');
});

$('.header > .header-content > .control > .notifications > .icon, .header > .header-content > .control > .notifications > .circle').click(function() {
	var _this = $(this),
		_this_parent = _this.parent('.notifications'),
		_this_circle = _this_parent.find('.circle'),
		_this_amount = _this_circle.find('p'),
		_this_content = _this_parent.find('.notifications-wrapper');
	if(_this_parent.hasClass('active')) {
		_this_parent.removeClass('active');
		_this_content.addClass('zoomOut').fadeOut(350);
	}
	else {
		Closablenator($('.header > .header-content > .control > .settings.active'));
		_this_parent.addClass('active');
		_this_content.removeClass('zoomOut').slideDown(350);
		Readablenator();
		/*
		_this_circle.fadeOut(150, function() {
			_this_amount.html(0);
		});
		*/
		_this_content.find('.notifications-content').focus();
	}
});

$('.header > .header-content > .control > .settings > .icon').click(function() {
	var _this = $(this),
		_this_parent = _this.parent('.settings'),
		_this_content = _this_parent.find('.settings-wrapper');
	if(_this_parent.hasClass('active')) {
		_this_parent.removeClass('active');
		_this_content.addClass('zoomOut').fadeOut(350);
	}
	else {
		Closablenator($('.header > .header-content > .control > .notifications.active'));
		_this_parent.addClass('active');
		_this_content.removeClass('zoomOut').slideDown(350);
		/*
		_this_circle.fadeOut(150, function() {
			_this_amount.html(0);
		});
		*/
		_this_content.find('.settings-content').focus();
	}
});

jQuery(function($) {
	$(document).click(function(e) {
		var _this = $(e.target);
		if(!_this.hasClass('notClosable')) {
			Closablenator($('.closable.active'));
		}
	});
});

function Closablenator(object) {
	var _this = object,
		_this_content = _this.find('.thisContent');
	if(_this.hasClass('active')) {
		_this.removeClass('active');
		_this_content.addClass('zoomOut').fadeOut(350);
	}
}

function Readablenator() {
	if(!$('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification.unchecked').length) return;
	var ids = [];
	for(var i = 0; i < $('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification.unchecked').length; i++) {
		var _this = $('.header > .header-content > .control > .notifications > .notifications-wrapper > .notifications-content > .notification.unchecked:eq('+i+')'),
			_this_id = _this.data('id');
		ids.push(_this_id);
	}
	$.ajax({
		type: "POST",
		url: "/php/notificationChecker.php",
		data: {
			ids : ids,
			token : '9PECxV'
		},
		success: function(Data) {
			if(Data) {
				$('.header > .header-content > .control > .notifications > .circle').fadeOut(150, function() {
					$('.header > .header-content > .control > .notifications > .circle > p').html(0);
				});
			}
		}          
	});
}

function infoAlertor(text) {
	var _alert = $('.info-alert'),
		_text = _alert.find('h3');
	
	_text.html(text);
	_alert.addClass('active');
	setTimeout(function() {
		_alert.removeClass('active');
	}, 2500);
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

$('.header > .header-content > .control > .settings > .settings-wrapper > .settings-content button[name="exit"], .mobile-menu > .menu li[name="exit"]').click(function() {
	$.ajax({
		url: "/php/exit.php",
		async: false,
		success: function(Data) {
			if(Data) location.reload();
		}          
	});
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

