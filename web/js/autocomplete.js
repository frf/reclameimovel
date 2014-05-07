$(function() {

    $("#emp").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "http://reclameimovel.com.br/api/empreendimento",
                dataType: "jsonp",
                data: {
                    featureClass: "P",
                },
                success: function(data) {
                    console.log(data);
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            console.log(event);
            console.log(ui);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });

});
