var urlget = 'api/v1/view/';
var BASE_URL = window.location.origin+'/bemslaravel/public/';

function overview(building){

    return $.ajax({
        url: BASE_URL+urlget+'home',
        type: "post",
        data: {'building':building},
        dataType:'json',
        // beforeSend : startProcess(),
        // success: function(data){
        //   // parse data from api and put in html page
        //   $("#show-energy").html(data['energy']['total']);
        //   $("#show-energy-map").html(data['energy']['total']);
        //   $("#daily-energy").html(data['energy']['today']);
        //   $("#show_power").html(data['power']['current']);
        //   $("#show_max_power").html(data['power']['max']);
        //
        // },
        error: function(e) {
          console.log(e.responseText);
        }
      });

}

function maps(){

    return $.ajax({
        url: urlget+'maps',
        type: "post",
        // data: {},
        dataType:'json',
        // beforeSend : startProcess(),
        // success: function(data){
        //   // parse data from api and put in html page
        //   $("#show-energy").html(data['energy']['total']);
        //   $("#show-energy-map").html(data['energy']['total']);
        //   $("#daily-energy").html(data['energy']['today']);
        //   $("#show_power").html(data['power']['current']);
        //   $("#show_max_power").html(data['power']['max']);
        //
        // },
        error: function(e) {
          console.log(e.responseText);
        }
      });

}
function homepage(building){

    return $.ajax({
        url: urlget+'home',
        type: "post",
        data: {'building':building},
        dataType:'json',
        // beforeSend : startProcess(),
        // success: function(data){
        //   // parse data from api and put in html page
        //   $("#show-energy").html(data['energy']['total']);
        //   $("#show-energy-map").html(data['energy']['total']);
        //   $("#daily-energy").html(data['energy']['today']);
        //   $("#show_power").html(data['power']['current']);
        //   $("#show_max_power").html(data['power']['max']);
        //
        // },
        error: function(e) {
          console.log(e.responseText);
        }
      });

}

function buildingpage(building,data){
    $(document).ready(function(){
        $.ajax({
          url: BASE_URL+urlget+'building',
          type: "post",
          data: {'building':building, 'data':data,'type':'buildingpage'},
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
//
// function floorlist(building,floor){
//     $(document).ready(function(){
//       var result;
//         $.ajax({
//           url: '../'+urlget+'building',
//           type: "post",
//           data: {'building':building, 'floor':floor ,'type':'floorlist'},
//           dataType:'json',
//           success: function(data){
//             // parse data from api and put in html page
//             result=data;
//             $('#'+building+"_show_energy_"+floor).html(data['energy']['total']);
//             $('#'+building+"_daily-consumed_"+floor).html(data['energy']['today']);
//             $('#'+building+"_show_power_"+floor).html(data['power']['current']);
//             $('#'+building+"_show_max_power_"+floor).html(data['power']['max']);
//           },
//           error: function(e) {
//             console.log(e.responseText);
//           }
//         });
//         return result;
//     });
// }

function floorlist(building,floor){

      return $.ajax({
          url: '../'+urlget+'building',
          type: "post",
          data: {'building':building, 'floor':floor ,'type':'floorlist'},
          dataType:'json',
          // success: function(data){
          //   // parse data from api and put in html page
          //
          //   $('#'+building+"_show_energy_"+floor).html(data['energy']['total']);
          //   $('#'+building+"_daily-consumed_"+floor).html(data['energy']['today']);
          //   $('#'+building+"_show_power_"+floor).html(data['power']['current']);
          //   $('#'+building+"_show_max_power_"+floor).html(data['power']['max']);
          // },
          error: function(e) {
            console.log(e.responseText);
          }
        });
}

function floorpage(building,floor,time){
        return $.ajax({
                url: '../../../'+urlget+'floor',
                type: "post",
                data: {'building':building, 'floor':floor ,'type':'floorpage','time':time},
                dataType:'json',

                error: function(e) {
                  console.log(e.responseText);
                }
          });

}
function roompage(room,time){
      // var result;
        return $.ajax({
          url: BASE_URL+urlget+'room',
          type: "post",
          data: {'room':room,'type':'roompage','time':time},
          dataType:'json',
          // success: function(data){
          //   // console.log(data);
          //   result=data;
          // },
          error: function(e) {
            console.log(e.responseText);
          }
        });
        // return result;

}

function roomdetail(device){

      return $.ajax({
          url: BASE_URL+urlget+'room',
          type: "post",
          data: {'id':device,'type':'device'},
          dataType:'json',
          // success: function(data){
          //   // console.log(data);
          //   result=data;
          // },
          error: function(e) {
            console.log(e.responseText);
          }
        });
        // return result;

}
