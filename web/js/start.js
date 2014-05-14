$(document).ready(function() {
    $("#adicionar").click(function() {
        if ($("#idnome").val() != "") {
            window.location = '/adicionar/' + $("#idnome").val();
        }
    });
    $("#adicionar_busca").click(function() {
            window.location = '/buscar';
    });
    $("<div id='imgReclamacao'>&nbsp;</div>").insertAfter("#reclamacao_youtube");
});

function closeMsg(){    
    $('.alert').alert('close');
}
/*
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=237093413164290&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/

function resize_image(input, width, height, id) {
        if (input.files[0].type.match(/image.*/)) {
            $("#message").html("");
            //console.log(input.files[0]);
            //jquery.crypt.js
            
            $("#imgReclamacao").append("<canvas id='resizer"+id+"'></canvas><canvas id='resizerView"+id+"'></canvas>");

            var canvas = $("#resizer"+id)[0].getContext('2d');
            var canvasView = $("#resizerView"+id)[0].getContext('2d');
            
            var widthView = 200;
            var heightView = 200;

            canvas.canvas.width = width;
            canvas.canvas.height = height;

            canvasView.canvas.width = widthView;
            canvasView.canvas.height = heightView;

            var img = new Image();
            img.src = URL.createObjectURL(input.files[0]);
            img.onload = function() {
                canvas.drawImage(img, 0, 0, width, height);
            }

            var imgView = new Image();
            imgView.src = URL.createObjectURL(input.files[0]);
            imgView.onload = function() {
                canvasView.drawImage(img, 0, 0, widthView, heightView);
            }

            $('#resizerView'+id).addClass('img-thumbnail');
            $('#resizerView'+id).show();
            
            
        } else {
            $("#message").html("File not a image");
        }
    }
