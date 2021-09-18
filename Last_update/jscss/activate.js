var currentStep = 1,
	allSteps = 3;
var playerLogin = 'Ключ';
var inFormed = false;

function setStep (step, pastStep) {
	var number = parseInt(step.attr('name'));
	if(number == currentStep) return;
	$('.register > .content > .elems-wrapper > .elems-header > .step').removeClass('active').addClass('hidden');
	step.removeClass('hidden').addClass('active');
	pastStep.addClass('past');
	currentStep = number;
}

function nextStep () {
	if(currentStep != allSteps) {
		setStep($('.register > .content > .elems-wrapper > .elems-header > .step[name="'+(currentStep + 1)+'"]'), $('.register > .content > .elems-wrapper > .elems-header > .step[name="'+currentStep+'"]'));
		if(currentStep == 3) {
			$('.register > .content > .elems-wrapper > .elems-content > #finish > h3 > span[name="login"]').html(playerLogin);
		}
	}
}

function finishRegister () {
	nextStep();
	$('.register > .content > h3[name="rules"]').hide();
	$('.register > .content > .elems-wrapper > .elems-content > .step-content[name="1"]').removeClass('fadeInRight fadeInleft').addClass('fadeOutLeft hidden').fadeOut(750);
	$('.register > .content > .elems-wrapper > .elems-content > .step-content[name="2"]').removeClass('fadeOutLeft fadeOutRight hidden').addClass('fadeInRight').fadeIn(750);
}

$('.register > .content > .elems-wrapper > .elems-content > form#registerLoginForm').submit(function() {
	if(currentStep != 3 && !inFormed) {
		inFormed = true;
		var login = $('.register > .content > .elems-wrapper > .elems-content > form#registerLoginForm > .input[name="login"]'),
			loginInput = login.find('input'),
			loginValue = loginInput.val();
		var password = $('.register > .content > .elems-wrapper > .elems-content > form#registerLoginForm > .input[name="password"]'),
			passwordInput = password.find('input'),
			passwordValue = passwordInput.val();
		var buttonValue = $('.register > .content > .elems-wrapper > .elems-content > form#registerLoginForm > button').val();
		if(loginValue) {
			var checkerResult = checker(buttonValue, loginValue, passwordValue);
			if(checkerResult === true) {
				if(!passwordValue) {
					playerLogin = loginValue;
					loginInput.attr('disabled', true);
					login.removeClass('zoomOut').addClass('zoomOut hidden').fadeOut(750);
					nextStep();
					passwordInput.attr('placeholder', playerLogin + ", введите пароль");
					resizer(passwordInput);
					passwordInput.attr('disabled', false);
					password.removeClass('zoomIn hidden').addClass('zoomIn').fadeIn(750);
					passwordInput.focus();
				}
				else
				if(loginValue && passwordValue) {
					$('.register > .content > .elems-wrapper > .elems-content > #finish > h3 > span[name="pwd"]').html(passwordValue);
					finishRegister();
				} 
			}
			else {
				if(checkerResult == 'login') {
					if(!$('.register > .content > .elems-wrapper > .elems-content > form > .input > .alert').hasClass('fadeIn')) {
						$('.register > .content > .elems-wrapper > .elems-content > form > .input > .alert').removeClass('zoomOut').addClass('fadeIn').fadeIn(750, function () {
							setTimeout(function() {
								$('.register > .content > .elems-wrapper > .elems-content > form > .input > .alert').removeClass('fadeIn').addClass('zoomOut').fadeOut(750);
							}, 500);
						});
					}
				}
			}
		}
		setTimeout(function() {
			inFormed = false;
		}, 500);
	}
	return false;
});

function checker (button, name, password) {
	if(name && password) return createAccount(button, name, password);
	var answer;
	$.ajax({
		type: "POST",
		async: false,
        url: "../php/activate.php",
        data: {
			login: name,
			button: button,
			type: 'check'
        },
        success: function(Data) {
			switch (Data) {
				case 'yes' : {
					answer = true;
					break;
				}
				case 'errorkey' : {
					infoAlertorMini("Не верный ключ активации");
					answer = false;
					break;
				}
				default : {
					infoAlertorMini('Неизвестная ошибка');
					answer = false;
					break;
				}
			}
        }          
    });
	switch(answer) {
		case true : return true;
		default : return answer;
	}
}

function createAccount (button, name, password) {
	var answer;
	$.ajax({
		type: "POST",
		async: false,
        url: "../php/activate.php",
        data: {
			login: name,
			password: password,
			button: button,
			type: 'create'
        },
        success: function(Data) {
        	Data = JSON.parse(Data);
        	var response = Data.response;
        	var idbase = Data.baseid;
        	$('.register > .content > .elems-wrapper > .elems-content > #finish > h3 > span[name="idbase"]').html(idbase);
			switch (response) {
				case 'yes' : {
					infoAlertorMini("Активация успешно завершена.");
					answer = true;
					break;
				}
				case 'no' : {
					infoAlertorMini("Ошибка активации.");
					answer = false;
					break;
				}
				default : {
					answer = false;
					break;
				}
			}
        }          
    });
	switch(answer) {
		case true : return true;
		default : return false;
	}
}

$('.register > .content > .elems-wrapper > .elems-content > form > .input > input').on('input', function() {
	resizer($(this));
});

function resizer (_this) {
	_this_icon = _this.siblings('.icon');
	if(_this.val().length >= 20 || _this.attr('placeholder').length >= 20) {
		_this.addClass('widthed');
		_this_icon.addClass('lefted');
	}
	else {
		_this.removeClass('widthed');
		_this_icon.removeClass('lefted');
	}
}