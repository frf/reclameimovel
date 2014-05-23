var deviceAgent = navigator.userAgent.toLowerCase();
var agentID = deviceAgent.match(/(iphone|ipod|ipad|android)/);

$(document).ready(function() {
    $("#adicionar").click(function() {
        if ($("#idnome").val() != "") {
            window.location = '/adicionar/' + $("#idnome").val();
        }
    });
    $("#deleteImg").click(function() {
        console.log(this);
    });
    $("#logoClick").click(function() {
        window.location = '/';
    });
    $("#moradorClick").click(function() {
        window.location = '/morador';
    });
    $("#adicionar_busca").click(function() {
        window.location = '/';
    });
    
    $("#user_cpf").mask("999.999.999-99",{clearIfNotMatch: true});    // Máscara para CNPJ
   
    $("#user_telCelular").mask("(99)9?9999-9999");    // Máscara para CNPJ
    $("#user_telResidencial").mask("(99)9999-9999");    // Máscara para CNPJ
    $("#user_telContato").mask("(99)9999-9999?9");    // Máscara para CNPJ
    
    if (agentID) {    
        //$("#tituloSite").hide();
        //$("#tituloSite").css({'display':'none'});
    }
});

function closeMsg() {
    $('.alert').alert('close');
}
 
 (function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id))
 return;
 js = d.createElement(s);
 js.id = id;
 js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=237093413164290&version=v2.0";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
 
 
