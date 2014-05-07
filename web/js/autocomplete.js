$(function() {

    $("#emp").autocomplete({
        minLength: 2,
        source: function(request, response) {
            console.log(request.term);
            var term = request.term;
            if (term in cache) {
                response(cache[ term ]);
                return;
            }
            $.getJSON("http://reclameimovel.com.br/api/empreendimento", request, function(data, status, xhr) {
                cache[ term ] = data;
                console.log(data);
                response(data);
            });
        }
    });

});
