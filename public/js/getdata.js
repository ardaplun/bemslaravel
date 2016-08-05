var urlget = 'api/v1/view/';


function homepage(){
  $(document).ready(function(){
      $.ajax({
        url: urlget+'home',
        type: "post",
        data: {'building':'lol'},
        dataType:'json',
        success: function(data){
          console.log(data);
          console.log(data['e_total']);
          $("#show-energy").html(data['e_total']);
          $("#show-energy-map").html(data['e_total']);
          $("#daily-energy").html(data['e_today']);
          $("#show_power").html(data['p_current']);
          $("#show_max_power").html(data['p_max']);

        },
        error: function(e) {
          console.log(e.responseText);
        }
      });
  });
}

function buildingpage(container){
    $(document).ready(function(){
        $.ajax({
          url: urlget+'index',
          type: "post",
          data: {'building':'lol'},
          dataType:'json',
          success: function(data){
            console.log(data);
          },
          error: function(e) {
            console.log(e.responseText);
          }
        });
    });
}

function floorpage(container){
    $(document).ready(function(){
        $.ajax({
          url: urlget+'index',
          type: "post",
          data: {'building':'lol'},
          dataType:'json',
          success: function(data){
            console.log(data);
          },
          error: function(e) {
            console.log(e.responseText);
          }
        });
    });
}

function roompage(container){
    $(document).ready(function(){
        $.ajax({
          url: urlget+'index',
          type: "post",
          data: {'building':'lol'},
          dataType:'json',
          success: function(data){
            console.log(data);
          },
          error: function(e) {
            console.log(e.responseText);
          }
        });
    });
}
