var urlget = 'api/v1/view/';


function homepage(){
  $(document).ready(function(){
      $.ajax({
        url: urlget+'home',
        type: "post",
        data: {'key':'bems'},
        dataType:'json',
        success: function(data){
          // parse data from api and put in html page
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

function buildingpage(building){
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

function roompage(device){
    $(document).ready(function(){
      var result;
        $.ajax({
          url: '../../../../../'+urlget+'device',
          type: "post",
          data: {'id':device},
          dataType:'json',
          success: function(data){
            // console.log(data);
            result=data;
          },
          error: function(e) {
            console.log(e.responseText);
          }
        });
        return result;
    });
}
