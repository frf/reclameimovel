$(document).ready(function() {
    $("#adicionar").click(function() {
        if ($("#ide").val() != "") {
            window.location = '/adicionar/' + $("#ide").val();
        }
    });
    
     alert('HELLLOOO');
        $('#meta_title').html('content',META_TITLE);
        $('#meta_desc').attr('content',META_DESC);

});

function closeMsg(){    
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
