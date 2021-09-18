var buy_id;
var buy_check = false;

$('.mplusblock > .content > .buttons > button').click(function() {
	var _this = $(this),
		_this_id = _this.data('id');
	buy_id = _this_id;
	if(buy_id) $('.oferta-wrapper').fadeIn(250);
});

$('.oferta-wrapper > .oferta-content-wrapper > .oferta-content > .buttons > button').click(function() {
    var _this = $(this);
	type = 'plus';
	key = $('.mplusblock > .content > input[name="key"]').val();
	if(!buy_id) return;
	if(buy_check) return false;
	buy_check = true;
	_this.html('Пожалуйста, подождите');
	_this.attr('disabled', true);
	$.ajax({
		type: "POST",
        url: "/php/shop/buy.php",
        data: {
			id : buy_id,
            type : type,
			key : key
        },
        success: function(Data) {
			Data = JSON.parse(Data);
			switch (Data.answer) {
				case 'yes' : {
					location.href = Data.url;
					return false;
				}
				case 'login' : {
					location.href = Data.url;
					return false;
				}
				case 'closed' : {
					infoAlertorMini("Покупки в магазине будут доступны после открытия");
					break;
				}
			}
			buy_check = false;
			_this.html('Продолжить покупку');
			_this.attr('disabled', false);
        }          
    });
});