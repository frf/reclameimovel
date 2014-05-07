$(function() {
    var cache = {};

    $("#autocomplete_emp").autocomplete({
        minLength: 0,
        source: function(request, response) {
            console.log(request.term);
            var term = request.term;
            if (term in cache) {
                response(cache[ term ]);
                return;
            }
            $.getJSON("http://reclameimovel.com.br/api/empreendimento", request, function(data, status, xhr) {
                cache[ term ] = data;
               
                response($.map(data, function(item) {
                    return {
                        value: item.nome,
                        id:    item.id
                    }
                }));
            });
        },
        select: function( event, ui ) {
             console.log("SELECT");
             // console.log(event);
              console.log(ui.item.id + " - " + ui.item.value);
        }
    });

});
