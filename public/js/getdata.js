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
          $("#show-energy").html(data['energy']['total']);
          $("#show-energy-map").html(data['energy']['total']);
          $("#daily-energy").html(data['energy']['today']);
          $("#show_power").html(data['power']['current']);
          $("#show_max_power").html(data['power']['max']);

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
          url: urlget+'building',
          type: "post",
          data: {'building':building, 'floor':floor},
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

function floorlist(building,floor){
    $(document).ready(function(){
      var result;
        $.ajax({
          url: '../'+urlget+'building',
          type: "post",
          data: {'building':building, 'floor':floor ,'type':'floorlist'},
          dataType:'json',
          success: function(data){
            console.log(data);
            $('#'+building+"_show_energy_"+floor).html(data['energy']['total']);
            $('#'+building+"_daily-consumed_"+floor).html(data['energy']['today']);
            $('#'+building+"_show_power_"+floor).html(data['power']['current']);
            $('#'+building+"_show_max_power_"+floor).html(data['power']['max']);
          },
          error: function(e) {
            console.log(e.responseText);
          }
        });
    });
}

function floorpage(building,floor){
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
          url: '../../../../../'+urlget+'room',
          type: "post",
          data: {'id':device,'type':'device'},
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
