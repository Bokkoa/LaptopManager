function filltable()
{
 
  $.ajax({
              type: 'GET',
              url: '/api/event',
              datatype: 'json',              
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(response) {
                var table = $("#datatable").DataTable();
                  res = JSON.parse(response);
                  data = res.data;

                    $.each(data, function(k, v){ 
                      console.log(v);
                      table.row.add( [v.id, v.created_at, v.entrance.hostname, 
                      v.employee, v.uid, v.asset ] ).draw( true );
                    });  
                    $("#datatable").DataTable();
              }
            });
}

$( document ).ready(function() {
  filltable();
});