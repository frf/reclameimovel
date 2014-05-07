$(function() {

    function log( message ) {
        $( "<div>" ).text( message ).prependTo( "#log" );
        $( "#log" ).scrollTop( 0 );
    }

    $("#emp").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "http://reclameimovel.com.br/api/empreendimento",
                dataType: "jsonp",
                data: {
                    featureClass: "P",
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            id: item.id,
                            value: item.nome
                        }
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            log(ui.item ?
                    "Selected: " + ui.item.id :
                    "Nothing selected, input was " + this.value);
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });

});
