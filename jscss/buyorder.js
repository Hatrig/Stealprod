$('.shop > .content > .packs-line-wrapper > .packs-line-content > .pack > .desc > .buy > a > button, .shop > .content > .static-packs > .pack > a > button, .shop > .content > .static-packs > .pack.car').click(function() {
	var _this = $(this),
		_this_id = _this.data('id');
	buy_id = _this_id;
	// CLEO
	if(buy_id == 1) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('70');
		$('#order').val('cleo');
		$('#desc').val('Покупка ключа CLEO на сайте Stealprod');
		$('#name').html('Покупка ключа CLEO');
	}
    
    //asi
	if(buy_id==2) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('80');
		$('#order').val('asi');
		$('#desc').val('Покупка ключа ASI на сайте Stealprod');
		$('#name').html('Покупка ключа ASI');
	}

	//sf
	if(buy_id==3) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('70');
		$('#order').val('sf');
		$('#desc').val('Покупка ключа SF на сайте Stealprod');
		$('#name').html('Покупка ключа SF');
	}

	//dll
	if(buy_id==4) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('80');
		$('#order').val('dll');
		$('#desc').val('Покупка ключа DLL на сайте Stealprod');
		$('#name').html('Покупка ключа DLL');
	}

	//csasi
	if(buy_id==5) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('150');
		$('#order').val('csasi');
		$('#desc').val('Покупка ключа CLEO,ASI на сайте Stealprod');
		$('#name').html('Покупка ключа CLEO,ASI');
	}

	//all
	if(buy_id==6) {
		$('.oferta-content > .number-text').html('');
		$('.oferta-wrapper').fadeIn(250);
		$('#price').val('250');
		$('#order').val('all');
		$('#desc').val('Покупка ключа CLEO,ASI,SF,DLL на сайте Stealprod');
		$('#name').html('Покупка ключа CLEO,ASI,SF,DLL');
	}
});