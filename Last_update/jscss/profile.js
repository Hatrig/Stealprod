


var last_link_clicked;
var create_check = false, email_check = false, notify_check = false, delete_check = false;
var current_server = 1;

$(document).ready(function() {
	var temp_hash = location.hash;
	switch(temp_hash) {
		case '#notifications_settings' : {
			$('.profile > .content > .head > .notifications-settings > .settings-wrapper > .settings-buttons-wrapper > .settings-buttons button[name="notifications"]').trigger('click');
			break;
		}
		case '#settings' : {
			$('.profile > .content > .head > .notifications-settings > .settings-wrapper > button').trigger('click');
			break;
		}
		case '#password' : {
			$('.profile > .content > .head > .notifications-settings > .settings-wrapper > .settings-buttons-wrapper > .settings-buttons button[name="password"]').trigger('click');
			break;
		}
		case '#2fa' : {
			$('.profile > .content > .head > .notifications-settings > .settings-wrapper > .settings-buttons-wrapper > .settings-buttons button[name="fa2"]').trigger('click');
			break;
		}
		case '#2fa_ga' : {
			$('.profile > .content > .head > .notifications-settings > .settings-wrapper > .settings-buttons-wrapper > .settings-buttons button[name="fa2"]').trigger('click');
			$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > .methods-content > .method[name="ga"] > button[name="set"]').trigger('click');
			break;
		}
		case '#email' : {
			$('.profile > .content > .head > .links-wrapper > .links > .link.email').trigger('click');
			break;
		}
		case '#vk' : {
			$('.profile > .content > .head > .links-wrapper > .links > .link.vk').trigger('click');
			break;
		}
		case '#tg' : {
			$('.profile > .content > .head > .links-wrapper > .links > .link.telegram').trigger('click');
			break;
		}
		case '#discord' : {
			$('.profile > .content > .head > .links-wrapper > .links > .link.discord').trigger('click');
			break;
		}
		case '#characters' : {
			body = $("html, body"),
			to = $('#scroller[name="characters"]').offset().top - 50;
			body.stop().animate({scrollTop : to}, 500, 'swing');
			break;
		}
		case '#inventory' : {
			body = $("html, body"),
			to = $('#scroller[name="inventory"]').offset().top - 50;
			body.stop().animate({scrollTop : to}, 500, 'swing');
			break;
		}
		case '#referal' : {
			body = $("html, body"),
			to = $('#scroller[name="referal"]').offset().top - 50;
			body.stop().animate({scrollTop : to}, 500, 'swing');
			break;
		}
	}
	if(temp_hash.indexOf('#create_character_') != -1) {
		temp_hash_server = temp_hash.substr(-1);
		$('.profile > .content > .characters-wrapper > .servers > .server[name="'+temp_hash_server+'"]').trigger('click');
		$('.profile > .content > .characters-wrapper > .characters-content-wrapper > .characters-content[name="'+temp_hash_server+'"] > .character.new').trigger('click');
	}
});

$(window).scroll(function() {
  	var scrollTop = $(window).scrollTop();
  	if(scrollTop >= $('.profile-nav-wrapper').offset().top + $('.profile-nav-wrapper').height()) { 
    	$('.scroll-to-up-wrapper').fadeIn(350);
  	}
	else {
		$('.scroll-to-up-wrapper').fadeOut(350);
	}
});

$('.scroll-to-up-wrapper > .scroll-to-up').click(function() {
	var body = $("html, body");
	body.stop().animate({scrollTop : 0}, 500, 'swing');
});

/* 2FA START */

var in2FA = false;

function unset2FA(key) {
	if(!key) return false;
	if(in2FA) return false;
	in2FA = true;
	$.ajax({
		type: "POST",
        url: "/php/2fa/unset2FA.php",
        data: {
			key : key
        },
        success: function(Data) {
			in2FA = false;
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
			}
        }          
    });
}

function code2FA(key) {
	if(!key) return false;
	if(in2FA) return false;
	in2FA = true;
	$.ajax({
		type: "POST",
        url: "/php/2fa/code2FA.php",
        data: {
			key : key
        },
        success: function(Data) {
			in2FA = false;
			switch (Data) {
				case 'yes' : {
					$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method').fadeOut(250);
					$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.methods > .closer-block').fadeIn(250);
					$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method.code').fadeIn(250);
					break;
				}
				case 'links' : {
					infoAlertorMini("Необходимо привязать ВКонтакте или Telegram");	
					break;
				}
			}
        }          
    });
}

$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > .methods-content > .method > button').click(function(){
	var _this = $(this),
		_this_type = _this.parent('.method').data('name'),
		_this_action = _this.data('action');

	if(_this_action === 'unset') {
		_this_key = _this.siblings('.key').val();
		unset2FA(_this_key);
		return;
	}
	if(_this_type === 'code') {
		_this_key = _this.siblings('.key').val();
		code2FA(_this_key);
		return;
	}
	$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method').fadeOut(250);
	$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.methods > .closer-block').fadeIn(250);
	$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method.' + _this_type).fadeIn(250);
});

$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method > .closer-icon-method').click(function() {
	var _this = $(this),
		_this_parent = _this.parent('.method');
	_this_parent.fadeOut(250);
	$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.methods > .closer-block').fadeOut(250);
});

$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.methods > .closer-block').click(function(){
	var _this = $(this);
	_this.fadeOut(250);
	$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method').fadeOut(250);
});

$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content.method > .method-modal-content > form').submit(function(){
	var _this = $(this);
	var code = _this.find('.code').val(),
		key = _this.find('.key').val(),	
		type = _this.parent('.method-modal-content').parent('.modal-content.method').data('method');
	if(!code || !type || !key) return false;
	if(in2FA) return false;
	in2FA = true;
	$.ajax({
		type: "POST",
        url: "/php/2fa/set2FA.php",
        data: {
			code : code,
			key : key,
			type : type
        },
        success: function(Data) {
			in2FA = false;
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
				case 'code' : {
					infoAlertorMini("Введен неверный код");
					break;
				}
				case 'codef' : {
					infoAlertorMini("Неверный формат кода");
					break;
				}
				case 'admin' : {
					infoAlertorMini("Вам доступен только GA");
					break;
				}
			}
        }          
    });
	return false;
});

/* 2FA END */

/* ПРИВЯЗКИ START */

$('.profile > .content > .head > .links-wrapper > .links > .link').click(function() {
	var _this = $(this),
		_this_window = _this.find('.window');
	if(_this.is(last_link_clicked)) {
		_this.removeClass('active');
		_this_window.addClass('zoomOut').fadeOut(350);
		last_link_clicked = null;
	}
	else {
		$('.profile > .content > .head > .links-wrapper > .links > .link').removeClass('active');
		_this.addClass('active');
		$('.profile > .content > .head > .links-wrapper > .links > .link > .window').addClass('zoomOut').fadeOut(350);
		_this_window.removeClass('zoomOut').slideDown(350);
		last_link_clicked = _this;
	}
});

var temp_unlink_type;

$('.profile > .content > .head > .links-wrapper > .links > .link.vk > .window > .content > a.unlink').click(function() {
	unlink('vk');
});

$('.profile > .content > .head > .links-wrapper > .links > .link.telegram > .window > .content > a.unlink').click(function() {
	unlink('tg');
});

$('.profile > .content > .head > .links-wrapper > .links > .link.email > .window > .content > a.unlink').click(function() {
	unlink('email');
});

$('.profile > .content > .head > .links-wrapper > .links > .link.discord > .window > .content > a.unlink').click(function() {
	unlink('discord');
});

$('.modal-wrapper.unlink > .modal-content-wrapper > .modal-content > #unlinkcodeForm').submit(function() {
	unlinkHander(temp_unlink_type);
	return false;
});

function unlink(type) {
	if(type === 'vk') text = 'ВКонтакте';
	else if(type === 'tg') text = 'Telegram';
	else if(type === 'email') text = 'Email';
	else if(type === 'discord') text = 'Discord';
	else text = '';
	$('.modal-wrapper.unlink > .modal-content-wrapper > .modal-content > h2').html('Отвязать ' + text);
	temp_unlink_type = type;
	unlinkHander(temp_unlink_type);
}

function unlinkHander(type) {
	if(!type) return false;
	code = $('.modal-wrapper.unlink > .modal-content-wrapper > .modal-content > #unlinkcodeForm > input').val();
	key = $('.modal-wrapper.unlink > .modal-content-wrapper > .modal-content > #unlinkcodeForm').find('input[name="key"]').val();
	if(!key) return false;
	$.ajax({
		type: "POST",
		url: "/php/unlink.php",
		data: {
			type : type,
			code : code,
			key : key
		},
		success: function(Data) {
			switch(Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
				case 'codeyes' : {
					openModal('unlink');
					break;
				}
				case 'code' : {
					infoAlertorMini("Неверный код");
					break;
				}
				case 'admin' : {
					infoAlertorMini("Отвязка ВКонтакте/Discord недоступна");
					break;
				}
				case 'timer' : {
					infoAlertorMini("Пожалуйста, помедленнее");
					break;
				}
			}
		}          
	});
}

/* ПРИВЯЗКИ END */


/* УВЕДОМЛЕНИЯ START */

var settings_menu_status = false;

function openSettingsMenu(type) {
	var _this = $('.profile > .content > .head > .notifications-settings > .settings-wrapper > button'),
		wrapper = $('.profile > .content > .head > .notifications-settings > .settings-wrapper > .settings-buttons-wrapper');

	if(settings_menu_status) {
		_this.removeClass('active');
		wrapper.slideUp(350);
		settings_menu_status = false;
	}
	else if(type != 'close') {
		_this.addClass('active');
		wrapper.slideDown(350);
		settings_menu_status = true;
	}
}

$('.profile > .content > .head > .notifications-settings > .settings-wrapper > button').click(function() {
	openSettingsMenu();
});

$('.settings > .settings-wrapper > .settings-content button').click(function(){
	var _this = $(this),
		_this_name = _this.attr('name');

	switch(_this_name) {
		case 'notifications' : {
			openModal('notifysettings');
			break;
		}
		case 'fa2' : {
			openModal('fa2');
			break;
		}
		case 'password' : {
			openModal('password');
			break;
		}

		case 'nickname' : {
			openModal('nickname');
			break;
		}

		case 'balance' : {
			openModal('balance');
			break;
		}

		case 'vk' : {
			openModal('vk');
			break;
		}

		case 'buysteal' : {
			openModal('buysteal');
			break;
		}

		case 'filter' : {
			openModal('filter');
			break;
		}
	}

	openSettingsMenu('close');
});

$('.profile > .content > .profile-nav-wrapper button').click(function(){
	var _this = $(this),
		_this_name = _this.attr('name');

	switch(_this_name) {
		case 'dl__logs' : {
			openModal('dlogs');
			break;
		}
		case 'dl__steal' : {
			openModal('dl__steal');
			break;
		}
		case 'clogs' : {
			openModal('clearlogs');
			break;
		}

		case 'filter' : {
			openModal('filter');
			break;
		}

		case 'antispam' : {
			openModal('antispam');
			break;
		}

		case 'reg' : {
			openModal('reg');
			break;
		}

	}

	openSettingsMenu('close');
});

$('.modal-wrapper.notifysettings > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper .setting > .selector').click(function() {
	var _this = $(this),
		_this_setting = _this.parent('.setting');
	if(_this_setting.hasClass('active'))
		_this_setting.removeClass('active');
	else
		_this_setting.addClass('active');
});

$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper .setting > .selector').click(function() {
	var _this = $(this),
		_this_setting = _this.parent('.setting'),
		_this_setting_name = _this_setting.data('name');
	if(_this_setting.hasClass('active'))
		_this_setting.removeClass('active');
	else {
		$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper[name="methods"] .setting').removeClass('active');
		_this_setting.addClass('active');
		$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper[name="settings"] > .setting-wrapper').hide();
		$('.modal-wrapper.fa2 > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper[name="settings"] > .setting-wrapper.' + _this_setting_name).show();
	}
});

$('.modal-wrapper.notifysettings > .modal-content-wrapper > .modal-content > #notifySettingsForm').submit(function() {
	if(notify_check) return false;
	notify_check = true;
	var _this = $(this);
	var settingsMassive = [];
	for(var i = 0; i < $('.modal-wrapper.notifysettings > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper .setting').length; i++) {
		var temp_setting = $('.modal-wrapper.notifysettings > .modal-content-wrapper > .modal-content > form > .settings-content > .settings-wrapper .setting:eq('+i+')');
		var temp_setting_name = temp_setting.data('name');
		if(temp_setting.hasClass('active')) temp_setting_value = 1; else temp_setting_value = 0;
		settingsMassive.push({name : temp_setting_name, value : temp_setting_value});
	}
	settingsMassive = JSON.stringify(settingsMassive);
	var button = _this.find('button').val(),
		key = _this.find('input[name="key"]').val();
	if(settingsMassive == [] || !key || !button || button != 'Accept') return false;
	$.ajax({
		type: "POST",
        url: "/php/notificationsSettings.php",
        data: {
			settings : settingsMassive,
			key : key,
			button : button
        },
        success: function(Data) {
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
			}
			notify_check = false;
        }          
    });
	return false;
});

/* УВЕДОМЛЕНИЯ END */

$('.profile > .content > .characters-wrapper > .characters-content-wrapper > .characters-content > .character.new').click(function() {
	_this_value = $(this).data('value');
	_this_number = $(this).data('number');
	openModal('addchar');
	$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > h2 > span').html(_this_number);
	$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > h3 > span').html(_this_value);
	$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > form > .input > input').focus();
});

$('.profile > .content > .head > .links-wrapper > .links > .link.email > .window > .content button').click(function() {
	openModal('email');
	$('.modal-wrapper.email > .modal-content-wrapper > .modal-content > form > .input > input').focus();
});

$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > form > .sex-line > .sex').click(function() {
	var _this = $(this),
		value = parseInt(_this.data('value'));
	$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > form > .sex-line > .sex').removeClass('active');
	switch(value) {
		case 0 : {
			$('.modal-wrapper > .modal-content-wrapper > .modal-content > .img.sex').removeClass('female').addClass('male');
			break;
		}
		case 1 : {
			$('.modal-wrapper > .modal-content-wrapper > .modal-content > .img.sex').removeClass('male').addClass('female');
			break;
		}
	}
	_this.addClass('active');
});

var past_server = 1;

$('.profile > .content > .characters-wrapper > .servers > .server').click(function() {
	var _this = $(this),
		_this_server = _this.data('value');
	current_server = _this_server;
	$('.profile > .content > .characters-wrapper > .servers > .server').removeClass('active');
	_this.addClass('active');
	if(_this_server > past_server) {
		$('.profile > .content > .characters-wrapper > .characters-content-wrapper').removeClass('fadeInRight fadeInLeft').addClass('fadeOutLeft absolute').fadeOut(600);
		$('.profile > .content > .characters-wrapper > .characters-content-wrapper[name="'+_this_server+'"]').fadeIn(600).removeClass('fadeOutLeft fadeOutRight absolute').addClass('fadeInRight');
	}
	else if(_this_server < past_server) {
		$('.profile > .content > .characters-wrapper > .characters-content-wrapper').removeClass('fadeInRight fadeInLeft').addClass('fadeOutRight absolute').fadeOut(600);
		$('.profile > .content > .characters-wrapper > .characters-content-wrapper[name="'+_this_server+'"]').fadeIn(600).removeClass('fadeOutLeft fadeOutRight absolute').addClass('fadeInLeft');
	}
	past_server = _this_server;
});

$('.profile > .content > .characters-wrapper > .characters-content-wrapper > .characters-content').on('click', '.character > .head > .control-icon', function() {
	var _this = $(this),
		_this_control = _this.parent('.head').siblings('.infos').find('.control-wrapper');
	
	if(_this.hasClass('active')) {
		_this_control.fadeOut(250);
		_this.removeClass('active');
	}
	else {
		_this_control.fadeIn(250);
		_this.addClass('active');
	}
});

var change_password_check = false;

$('.modal-wrapper.password > .modal-content-wrapper > .modal-content > #passwordForm').submit(function() {
	if(change_password_check) return false;
	change_password_check = true;
	var _this = $(this);
	var oldpasswordInput = _this.find('.input[name="oldpassword"]'),
		oldpassword = oldpasswordInput.find('input').val(),
		newpasswordInput = _this.find('.input[name="newpassword"]'),
		newpassword = newpasswordInput.find('input').val(),
		renewpasswordInput = _this.find('.input[name="renewpassword"]'),
		renewpassword = renewpasswordInput.find('input').val(),
		key = _this.find('input[name="key"]').val();
	if(!key || !oldpassword || !newpassword || !renewpassword) return false;
	$.ajax({
		type: "POST",
        url: "/php/changePassword.php",
        data: {
			oldpassword : oldpassword,
			newpassword : newpassword,
			renewpassword : renewpassword,
			key : key
        },
        success: function(Data) {
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
				case 'fopass' : {
					infoAlertorMini("Неверный формат пароля");
					alertor(null, null, oldpasswordInput);
					break;
				}
				case 'fnpass' : {
					infoAlertorMini("Неверный формат пароля");
					alertor(null, null, newpasswordInput);
					break;
				}
				case 'frnpass' : {
					infoAlertorMini("Неверный формат пароля");
					alertor(null, null, renewpasswordInput);
					break;
				}
				case 'notold' : {
					infoAlertorMini("Новый пароль не может быть равен старому");
					alertor(null, null, newpasswordInput);
					break;
				}
				case 'oldpass' : {
					infoAlertorMini("Неверный текущий пароль");
					alertor(null, null, oldpasswordInput);
					break;
				}
				case 'newpass' : {
					infoAlertorMini("Введенные пароли не совпадают");
					alertor(null, null, newpasswordInput);
					alertor(null, null, renewpasswordInput);
					break;
				}
			}
			change_password_check = false;
        }          
    });
	return false;
});

var del_char_id, del_server, del_key;

$('.profile > .content > .characters-wrapper > .characters-content-wrapper > .characters-content').on('click', '.character > .infos > .control-wrapper > .control > button', function() {
	var _this = $(this),
		_this_action = _this.data('action'),
		_this_char = _this.parent('.control').data('cid'),
		_this_server = _this.parent('.control').data('server'),
		key = $('.profile > .content > .characters-wrapper > input[name="dkey"]').val();
	if(!_this_char || !_this_server || !key || !_this_action) return false;
	del_char_id = _this_char;
	del_server = _this_server;
	del_key = key;
	if(_this_action === 'delete') {
		$('.oferta-wrapper.delete-character').fadeIn(250);
	}
	else if(_this_action === 'undelete') {
		if(delete_check) return false;
		delete_check = true;
		key = $('.profile > .content > .characters-wrapper > input[name="undkey"]').val();
		$.ajax({
			type: "POST",
			url: "/php/character/undeleteCharacter.php",
			data: {
				char_id : del_char_id,
				server : del_server,
				key : key
			},
			success: function(Data) {
				switch (Data) {
					case 'yes' : {
						location.href = '/profile';
						break;
					}
				}
				delete_check = false;
			}          
		});
	}
});

$('.oferta-wrapper.delete-character > .oferta-content-wrapper > .oferta-content > .buttons > button').click(function() {
	var _this_char = del_char_id,
		_this_server = del_server,
		key = del_key;
	if(!_this_char || !_this_server || !key) return false;
	if(delete_check) return false;
	delete_check = true;
	$.ajax({
		type: "POST",
        url: "/php/character/deleteCharacter.php",
        data: {
			char_id : _this_char,
			server : _this_server,
			key : key
        },
        success: function(Data) {
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					break;
				}
			}
			delete_check = false;
        }          
    });
});

$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > #addCharForm > .input[name="name"] > input').mouseenter(function() {
	var _this = $(this);

	_this.attr('placeholder', 'В формате: Ivan_Petrov');
});

$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > #addCharForm > .input[name="name"] > input').mouseleave(function() {
	var _this = $(this);

	_this.attr('placeholder', 'Введите никнейм');
});

$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > #addCharForm > .input[name="name"] > input').on('input', function() {
	var _this = $(this),
		_this_value = _this.val();

	if(_this_value) _this.val(_this_value.replace(" ", "_"));
});


$('.modal-wrapper.addchar > .modal-content-wrapper > .modal-content > #addCharForm').submit(function() {
	var _this = $(this);
	var nameInput = _this.find('.input[name="name"]'),
		name = nameInput.find('input').val(),
		sex = parseInt(_this.find('.sex-line > .sex.active').data('value')),
		server = parseInt($('.profile > .content > .characters-wrapper > .servers > .server.active').data('value')),
		button = _this.find('button').val(),
		key = _this.find('input[name="key"]').val();
	if(!name || !key || !button || (sex != 0 && sex != 1) || !server || button != 'Add') return false;
	if(create_check) return false;
	create_check = true;
	_this.find('button').html(malinovka_loader_white);
	_this.find('button').attr('disabled', true);
	$.ajax({
		type: "POST",
        url: "/php/character/createCharacter.php",
        data: {
			name : name,
			sex : sex,
			server : server,
			key : key,
			button : button
        },
        success: function(Data) {
			switch (Data) {
				case 'yes' : {
					location.href = '/profile';
					return false;
				}
				case 'name' : {
					infoAlertorMini("Данный никнейм занят");
					alertor(null, null, nameInput);
					break;
				}
				case 'fname' : {
					infoAlertorMini("Неверный формат никнейма<br>Пример: Ivan_Petrov");
					alertor(null, null, nameInput);
					break;
				}
				case 'admin' : {
					infoAlertorMini("Создание персонажа будет доступно после открытия");
					break;
				}
			}
			create_check = false;
			_this.find('button').html('Создать');
			_this.find('button').attr('disabled', false);
        }          
    });
	return false;
});

$('.modal-wrapper.email > .modal-content-wrapper > .modal-content > #emailForm').submit(function() {
	var _this = $(this);
	var emailInput = _this.find('.input[name="email"]'),
		email = emailInput.find('input').val(),
		button = _this.find('button').val(),
		key = _this.find('input[name="key"]').val();
	if(!key || !button || !email || button != 'Add') return false;
	if(email_check) return false;
	email_check = true;
	_this.find('button').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
	_this.find('button').attr('disabled', true);
	$.ajax({
		type: "POST",
        url: "/php/linkEmail.php",
        data: {
			email : email,
			key : key,
			button : button
        },
        success: function(Data) {
			_this.find('button').html('Привязать');
			switch (Data) {
				case 'yes' : {
					$('.modal-wrapper.email > .modal-content-wrapper > .modal-content > #emailForm').slideUp(300);
					text = '<h3>На указанный Email выслано письмо с дальнейшими инструкциями</h3>';
					$('.modal-wrapper.email > .modal-content-wrapper > .modal-content').append(text);
					break;
				}
				case 'email' : {
					infoAlertorMini("Данный Email занят");
					alertor(null, null, emailInput);
					break;
				}
				case 'emailf' : {
					infoAlertorMini("Неверный формат Email");
					alertor(null, null, emailInput);
					break;
				}
				case 'timer' : {
					infoAlertorMini("Отправлять Email можно раз в минуту");
					break;
				}
			}
			email_check = false;
			_this.find('button').attr('disabled', false);
        }          
    });
	return false;
});

$('.profile > .content > .referal > .referal-wrapper > button').click(function(){
	openModal('referals');
	$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > #referals-form').submit();
	return false;
});

var inPrinted = false, trAmount = 0, moreEight = false;
var form_login = '';

function printReferals() {
	if(inPrinted) return false;
	inPrinted = true;
	$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > button').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
	$.ajax({
		type: "POST",
        url: "/php/myReferals.php",
        data: {
			login : form_login,
			tr_amount : trAmount
        },
        success: function(Data) {
			if(Data === 'flogin') {
				infoAlertorMini("Неверный формат логина");
			}
			else if(Data === 'nlogin') {
				infoAlertorMini("Реферал не найден");
			}
			else if(Data === 'timer') {
				infoAlertorMini("Пожалуйста, помедленнее");
			}
			else {
				$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > table > tr:not(title)').remove();
				$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > table').append(Data);
			}
			inPrinted = false;
			$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > button').html('Применить');
			if($('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > table > tr:not(title)').length >= 8) {
				moreEight = true;
				$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > .paginator > .page[name="next"]').show();
			}
			else $('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > .paginator > .page[name="next"]').hide();
			if(!trAmount) {
				$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > .paginator > .page[name="back"]').hide();
			}
			else $('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > .paginator > .page[name="back"]').show();
        }          
    });
}

$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > #referals-form').submit(function() {
	var _this = $(this),
		_this_parent = _this.parent('.filters-wrapper');

	form_login = _this_parent.find('.filter[name="login"]').find('input').val();

	trAmount = 0;
	moreEight = false;
	printReferals(form_login);

	return false;
});

$('.modal-wrapper.referals > .modal-content-wrapper > .modal-content > .referals > .paginator > .page').click(function() {
	var _this = $(this),
		_this_action = _this.data('action');
	if(!moreEight) return false;
	switch(_this_action) {
		case 'back' : {
			if(trAmount < 8) break;
			trAmount -= 8;
			break;
		}
		case 'next' : {
			trAmount += 8;
			break;
		}
	}
	printReferals(form_login);
});



