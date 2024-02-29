$(document).ready(function() {
    $('input[name="search_query"]').autocomplete({
      source: function(request, response) {
        $.ajax({
          url: 'autocomplete.php',
          method: 'GET',
          data: { query: request.term },
          success: function(data) {
            response(JSON.parse(data));
          }
        });
      }
    });
  });


  
  