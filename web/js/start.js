/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
  
 $(function() { 
    $(".collapse").collapse(); 
 });
 */

FB.init({
    appId: '237098739830424',
    status: true, cookie: false, xfbml: false, oauth: true
});

function logaSistema(dados) {

    var tipoUrlInterna = "";

    //console.log("LOGANDO COM USUARIO DO FACE NO MS");

    if ($("#tipo").val() == "") {
        window.location = "http://minhasaude.me/erro";
        return false;
    }
    $.post("http://minhasaude.me/authface/login-face", {json: dados, tipo: $("#tipo").val()},
    function(data, status) {
        if (status == "success") {
            if (data.return) {

                if (data.tipo == "N") {
                    tipoUrlInterna = "nutricionista";
                } else if (data.tipo == "P") {
                    tipoUrlInterna = "paciente";
                } else {
                    tipoUrlInterna = "";
                }

                window.location = "http://minhasaude.me/" + tipoUrlInterna;
            } else {
                console.log("Erro de login");
            }
        }
    });
}
function statusFacebook() {
    
    //console.log("statusFacebook");               
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.api('/me', function(response) {
                //console.log(JSON.stringify(response));
                logaSistema(JSON.stringify(response));
            });
        } else if (response.status === 'not_authorized') {
            //console.log("statusFacebook:"  + response.status + " - " + tipoUrl); 
            loginFacebook(tipoUrl); // nao autorizado, solicitar login 
        } else {
            //console.log("statusFacebook:" + response.status + " - " + tipoUrl);
            loginFacebook(tipoUrl); // nao autorizado, solicitar login 
        }
    });
}

function loginFacebook(tipoUrl) {
    //console.log("loginFacebook=" + tipoUrl);
    $("#msgFace").css({'color': '#000000'});
    $("#loadingface").show();
    $("#msgFace").html('Aguarde estamos conectando no facebook...');
    $("#msgFace").addClass('importantRule');
    $("#loadingface").hide();

    FB.login(function(response) {
        //console.log("checkResponse=" + response);
        if (response.authResponse) {
            statusFacebook();
            //window.location = "http://minhasaude.me/"+tipoUrl; 
        } else {
            $("#msgFace").removeClass('importantRule');
            $("#msgFace").css({'color': '#000000'});
            $("#loadingface").hide();
            $("#msgFace").html('Infelizmente você não nos deixou conectar, obrigado quem sabe mais tarde.');
        }
    }, {scope: 'email,basic_info,publish_stream,user_photos,friends_about_me'});

    $("#msgFace").css({'color': '#000000'});
    $("#loadingface").show();
    $("#msgFace").html('Clique em ok na tela que abriu, e venha conhecer nossos serviços.');
    //alert("Atenção verifique seu bloqueador de pop-up, e tente novamente.");
}

$(document).ready(function() {
    $("#target").click(function() {
        alert("Handler for .click() called.");
    });
    statusFacebook();
});
