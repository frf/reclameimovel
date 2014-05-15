$(document).ready(function() {
    $("#adicionar").click(function() {
        if ($("#idnome").val() != "") {
            window.location = '/adicionar/' + $("#idnome").val();
        }
    });
    $("#adicionar_busca").click(function() {
        window.location = '/buscar';
    });
    $("<div class='photos'>&nbsp;</div>").insertAfter("#reclamacao_youtube");
});

function closeMsg() {
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
/*
 function resize_image(input, width, height, id) {
 if (input.files[0].type.match(/image./)) {
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
 
 */

// Once files have been selected
document.querySelector('form input[type=file]').addEventListener('change', function(event) {

// Read files
    var files = event.target.files;

// Iterate through files
    for (var i = 0; i < files.length; i++) {

// Ensure it's an image
        if (files[i].type.match(/image.*/)) {

// Load image
            var reader = new FileReader();
            reader.onload = function(readerEvent) {
                var image = new Image();
                image.onload = function(imageEvent) {

// Add elemnt to page
                    var imageElement = document.createElement('img');
                    imageElement.classList.add('uploading');
                    imageElement.innerHTML = '<span class="progress"><span></span></span>';
                    var progressElement = imageElement.querySelector('span.progress span');
                    progressElement.style.width = 0;
                    document.querySelector('form div.photos').appendChild(imageElement);

// Resize image
                    var canvas = document.createElement('canvas'),
                            max_size = 1200,
                            width = image.width,
                            height = image.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);

// Upload image
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {

// Update progress
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = parseInt(event.loaded / event.total * 100);
                            progressElement.style.width = percent + '%';
                        }, false);

// File uploaded / failed
                        xhr.onreadystatechange = function(event) {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {

                                    imageElement.classList.remove('uploading');
                                    imageElement.classList.add('uploaded');
                                    imageElement.classList.add('img-thumbnail');
                                    imageElement.src = xhr.responseText;

                                    console.log('Image uploaded: ' + xhr.responseText);

                                } else {
                                    imageElement.parentNode.removeChild(imageElement);
                                }
                            }
                        }

// Start upload
                        xhr.open('post', '/adicionar/foto', true);
                        xhr.send(canvas.toDataURL('image/jpeg'));

                    }

                }

                image.src = readerEvent.target.result;

            }
            reader.readAsDataURL(files[i]);
        }

    }

// Clear files
    event.target.value = '';

});