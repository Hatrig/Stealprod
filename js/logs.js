function ajax_get_data(page){
    var f_url = './php/logs.php?page='+page;//адрес, по которому вызывается функция
    $.ajax({
        type: "GET",
        url: f_url,
        data: page,
        success: function(data){
            $("#data").html(data);//в DOM с id="data" будем выводить данные
            //ajax_get_pages(page);//выводим страницы
        }
    });
}

document.forms.filterForm.filterButton.onclick = function(e){
    e.preventDefault();
    var fil = document.forms.filterForm.filter__inp.value;
    var page = 1;
    $('#data').empty();
    ajax_get_filter(fil, page);
    document.getElementById('filter-modal').style.display='none';
}

function ajax_get_filter(filter, page){
    var f_url = './php/logs.php?filter__inp=' + filter + '&page=' + page;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#data").html(data);
        }
    });
}

document.forms.logsClear.clear__button.onclick = function(e){
    e.preventDefault();
    var f_url = './php/logs.php?clearlogs=1';
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            location.reload();
        }
    });
}

document.forms.banIp.ban__button.onclick = function(e){
    e.preventDefault();
    var banip = document.forms.banIp.banip__inp.value;
    var f_url = './php/profile.php?banip__inp='+banip;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#resban").html(data);
            location.reload();
        }
    });
}

document.forms.unbanIp.unban__button.onclick = function(e){
    e.preventDefault();
    var f_url = './php/profile.php?unbanip__inp=1';
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#resunban").html(data);
            location.reload();
        }
    });
}


document.forms.checkIp.checkip__button.onclick = function(e){
    e.preventDefault();
    var checkip = document.forms.checkIp.checkip__inp.value;
    var f_url = './php/checkip?ip='+checkip;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#ipinfo").html(data);
        }
    });
}

document.forms.settingsForm.set__button.onclick = function(e){
    e.preventDefault();
    var setRepeat = document.getElementById("nonrep");
    setRepeat =  setRepeat.className;
    if(setRepeat.indexOf("active") > -1) {setRepeat = 1;} else {setRepeat = 0;}
    var setDid = document.getElementById("topdids");
    setDid = setDid.className;
    if(setDid.indexOf("active") > -1) {setDid = 1;} else {setDid = 0;}
    var setTServ = document.getElementById("topservers");
    setTServ = setTServ.className;
    if(setTServ.indexOf("active") > -1) {setTServ = 1;} else {setTServ = 0;}
    var f_url = './php/profile.php?setrepeat='+setRepeat+'&setDid='+setDid+'&setTServ='+setTServ;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#setinfo").html(data);
            location.reload();
        }
    });
}

document.forms.passwordForm.password__button.onclick = function(e){
    e.preventDefault();
    var oldpassword = document.forms.passwordForm.oldpassword__inp.value;
    var newpassword = document.forms.passwordForm.newpassword__inp.value;
    var repeatnewpassword = document.forms.passwordForm.newpasswordrepeat__inp.value;
    var f_url = './php/profile?oldpassword='+oldpassword+'&newpassword='+newpassword+'&repeatnewpassword='+repeatnewpassword;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#pwdinfo").html(data);
            if(data.indexOf("успешно") > -1) {
                location.reload();
            }
        }
    });
}

document.forms.nicknameForm.nickname__button.onclick = function(e){
    e.preventDefault();
    var nickname = document.forms.nicknameForm.nickname__inp.value;
    var f_url = './php/profile?nickname='+nickname;
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#nickinfo").html(data);
            if(data.indexOf("успешно") > -1) {
                location.reload();
            }
        }
    });
}

document.forms.vkFormOt.vk__button.onclick = function(e){
    e.preventDefault();
    var f_url = './php/profile?vkout=1';
    $.ajax({
        type: "GET",
        url: f_url,
        success: function(data){
            $("#vkout").html(data);
            if(data.indexOf("успешно") > -1) {
                location.reload();
            }
        }
    });
}

document.forms.vkFormPr.vkPr.onclick = function(e){
    e.preventDefault();
    var f_url = 'https://vk.me/stlprd';
    window.open(f_url);
}

$('.group_button button').click(function(){
    var _this = $(this),
        _this_name = _this.attr('name');

    switch(_this_name) {
        case 'dl__steal' : {
            openModal('dl__steal');
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
    }

    openSettingsMenu('close');
});

$('.another_setting button').click(function(){
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

        case 'notifications' : {
            openModal('notifysettings');
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