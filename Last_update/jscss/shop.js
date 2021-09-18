var timeout;
var fullNumber;
var inNumber = false;
var buy_id;
var buy_number_server;
var buy_number_id;
var buy_check = false;

function scrollPlates() {
	$('.shop > .content > .plus-block > .plates-wrapper > .plates').stop().animate({top:-($('.shop > .content > .plus-block > .plates-wrapper > .plates').height() - $('.shop > .content > .plus-block > .plates-wrapper > .plates > .plate').height() * 4)}, 20000, 'swing', function() { 
		setTimeout(function(){
			$('.shop > .content > .plus-block > .plates-wrapper > .plates').stop().animate({top:0}, 30, 'swing', function() {
				scrollPlates();
			});
		}, 20);
	});
}

scrollPlates();

var inPrinted = false, trAmount = 0, moreEight = false;
var form_price = 0, form_server = 0, form_number = '';

function printNumbers(server = 0, price = 0, number = '') {
	if(inPrinted) return false;
	inPrinted = true;
	$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > button').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
	$.ajax({
		type: "POST",
        url: "/php/number.php",
        data: {
			price : price,
			number : number,
			server : server,
			tr_amount : trAmount
        },
        success: function(Data) {
			if(Data === 'fnumber') {
				infoAlertorMini("Неверный формат номера");
			}
			else if(Data === 'nnumber') {
				infoAlertorMini("Номеров не найдено");
			}
			else if(Data === 'timer') {
				infoAlertorMini("Пожалуйста, помедленнее");
			}
			else {
				$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > table > tr:not(title)').remove();
				$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > table').append(Data);
			}
			inPrinted = false;
			$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > button').html('Применить');
			if($('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > table > tr:not(title)').length >= 8) {
				moreEight = true;
				$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > .paginator > .page[name="next"]').show();
			}
			else $('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > .paginator > .page[name="next"]').hide();
			if(!trAmount) {
				$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > .paginator > .page[name="back"]').hide();
			}
			else $('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > .paginator > .page[name="back"]').show();
        }          
    });
}

$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > #numbers-form').submit(function() {
	var _this = $(this),
		_this_parent = _this.parent('.filters-wrapper');

	form_price = _this_parent.find('.filter[name="price"]').find('select').find('option:selected').data('value');
	form_server = _this_parent.find('.filter[name="server"]').find('select').find('option:selected').data('value');
	form_number = _this_parent.find('.filter[name="number"]').find('input').val();

	trAmount = 0;
	moreEight = false;
	printNumbers(form_server, form_price, form_number);

	return false;
});

$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > .paginator > .page').click(function() {
	var _this = $(this),
		_this_action = _this.data('action');
	if(!moreEight || !form_server) return false;
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
	printNumbers(form_server, form_price, form_number);
});

$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .numbers > table').on('click', 'td.buy > button', function() {
	var _this = $(this),
		_this_parent = _this.parent('.buy'),
		_this_id = _this_parent.data('id'),
		_this_server = _this_parent.data('server');
	
	if(!_this_id || !_this_server) return false;
	
	buy_number_id = _this_id;
	buy_number_server = _this_server;
	if(buy_number_id && buy_number_server) {
		$('.oferta-content > .number-text').html('Номер: ' + _this_parent.data('number') + ', сервер: ' + _this_parent.data('srv-name') + '<br>Номер нельзя будет активировать на другом сервере');
		$('.oferta-wrapper').fadeIn(250);
	}
});

$('.shop > .content > .static-packs > .pack.number > a > button').click(function(){
	openModal('numbers');
	$('.modal-wrapper.numbers > .modal-content-wrapper > .modal-content > .filters > .filters-wrapper > #numbers-form').submit();
	return false;
});



$('.oferta-wrapper > .oferta-content-wrapper > .oferta-content > .buttons > button').click(function() {
	var _this = $(this);
	type = 'shop';
	key = $('.shop > .content > input[name="key"]').val();
	if(!buy_id && (!buy_number_id || !buy_number_server)) return;
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
			buy_number_id : buy_number_id,
			buy_number_server : buy_number_server,
			key : key
        },
        success: function(Data) {
			buy_number_id = null;
			buy_number_server = null;
			buy_id = null;
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

var current_malina = 0;

$(document).ready(function() {
	wrapper = $('.shop > .content > .static-packs > .pack.malina > .content > .sum > .sum-two-wrapper:eq('+current_malina+')');
	$(".shop > .content > .static-packs > .pack.malina > a > button > h3 > span").html(wrapper.data('price'));
	$(".shop > .content > .static-packs > .pack.malina > a > button").attr('data-id', wrapper.data('id'));
});

$('.shop > .content > .static-packs > .pack.malina > .content > .sum > .arrow.left').click(function() { malinaSwiper('left'); });
$('.shop > .content > .static-packs > .pack.malina > .content > .sum > .arrow.right').click(function() { malinaSwiper('right'); });

function malinaSwiper(side) {
	wrapper = $('.shop > .content > .static-packs > .pack.malina > .content > .sum > .sum-two-wrapper');
	wrapper.removeClass('active');
	block_length = wrapper.length - 1;
	switch(side) {
		case 'left' : {
			if(current_malina <= 0) current_malina = block_length; else current_malina--;
			wrapper = wrapper.eq(current_malina);
			break;
		}
		case 'right' : {
			if(current_malina >= block_length) current_malina = 0; else current_malina++;
			wrapper = wrapper.eq(current_malina);
			break;
		}
	}
	wrapper.addClass('active');
	$(".shop > .content > .static-packs > .pack.malina > a > button > h3 > span").html(wrapper.data('price'));
	$(".shop > .content > .static-packs > .pack.malina > a > button").attr('data-id', wrapper.data('id'));
}