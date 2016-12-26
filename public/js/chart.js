var now = new Date;
var utc_timestamp = Date.UTC(now.getFullYear(),now.getMonth(), now.getDate(),0,0,0,0);
// var tmp=moment().startOf('day').format("HH:MM");
// var time=[];
// for (var i = 0; i < 96; i++) {
//   time[i]=tmp+'-';
// }
Highcharts.setOptions({
  lang: {
    decimalPoint: '.',
    thousandsSep: ','
  }
});
function mainchart(container,data){
// console.log(time);
            var chart = new Highcharts.Chart({
              chart: {
                margin: [15, 10, 60, 40],
                //backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
                //zoomType: 'xy'
                renderTo: container,
                //height: 300,
                pinchType:'none',
                zoomType:'none',
              },
              title: {
                text: ''
              },

              navigator : {
                enabled : false
              },
                scrollbar : {
                enabled : false
              },
              rangeSelector: {
                  enabled: false
                },
              exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },

              plotOptions: {
                column: {
                  //pointPlacement: 'between',
                  pointPadding: 1,
                  groupPadding: 1,
                  borderWidth: 1,
		                grouping:false
                },

                line: {
                  stacking: 'normal',
                }
              },
              tooltip: {
                formatter: function() {
                  if (this.points[2]) {
                      return '<span style="font-size:x-small;">'+moment(data.time[this.points[0].point.x][0]).format("dddd, MMMM Do YYYY HH:mm")+'-'+moment(data.time[this.points[0].point.x][1]).format("HH:mm")+'</span><br>'+'<br /><span style="color:rgba(112, 220, 26, 1);">'+this.points[2].series.name+': </span><b>'+this.points[2].y +' kW</b></span>'+
				'<br>'+this.points[1].series.name+': </span><b>'+this.points[1].y+' kW</b></span>';
                  } else {
                      return '<span style="font-size:x-small;">'+moment(data.time[this.points[0].point.x][0]).format("dddd, MMMM Do YYYY HH:mm")+'-'+moment(data.time[this.points[0].point.x][1]).format("HH:mm")+'</span><br>'+'<br /><span style="color:rgba(112, 220, 26, 1);">'+
				'<br>'+this.points[1].series.name+': </span><b>'+this.points[1].y+' kW</b></span>';
                  }
                },shared:true
              },
              xAxis: [{
                ordinal: false,
                //tickInterval: scale,
                crosshair: true,
                //staggerLines: 1,
                title: {
                  text: "time (hrs.)",
                  style: {
                    color: 'gray'//"#2f7ed8"
                  },
                  align: 'high'
                },
                categories: ['0', '', '', '', '', '', '', '', '2', '', '', '', '', '', '', '', '4', '', '', '', '', '', '', '', '6', '', '', '', '', '', '', '', '8', '', '', '', '', '', '', '', '10', '', '', '', '', '', '', '', '12', '', '', '', '', '', '', '', '14', '', '', '', '', '', '', '', '16', '', '', '', '', '', '', '', '18', '', '', '', '', '', '', '', '20', '', '', '', '', '', '', '', '22', '', '', '', '', '', '', '', ]
              }],
              yAxis: [{ // Primary yAxis
                plotLines: [{ // warning
                          value: data.alert.warning_level,
                          color : 'rgba(255, 200, 0,1)',
                          dashStyle : 'solid',
                          zIndex: 4,
                          width : 2,
                          label: {
                              text: 'warning',
                              align: 'right',
                              x: -10,
                              style: {
                                  color: 'rgba(255, 200, 0, 1)',  fontWeight: 'bold' ,borderWidth:0.1}
                          }
                      }, { // alert
                          value: data.alert.alert_level,
                          width:1,
                          color: 'rgba(220, 20, 60, 1)',
                          dashStyle : 'solid',
                          width : 2,
                          zIndex: 4,
                          label: {
                              text: 'alert',
                              align: 'right',
                              x: -10,
                              style: { color: 'rgba(220, 20, 60, 1)',  fontWeight: 'bold'  }

                          }
                      }],
                //labels: {
                //  style: {
                    //color: Highcharts.getOptions().colors[1]
                //    color: 'gray'//"#2f7ed8"
                //  }
                //},
                title: {
                  text: 'power (kW)',
                  style: {
                    color: 'gray' //Highcharts.getOptions().colors[1]
                  }
                },
                offset: 20,
                tickPosition: "outside",
                // tickInterval: Math.round((max/1.05)/50,0)*10,
                // minorTickInterval: (Math.round((max/1.05)/50,0)*10)/2,
                tickWidth: 0,
                tickColor: "black", // The same as your gridLine color
                labels: {
                  align: 'left',
                  x: 0,
                  y: 5 // Position labels above their gridLine/tickMark
                },
              }],
              legend: {
                enabled: false
              },
              series: [{
                name: 'yesterday',
                type: 'column',
                zIndex: 1,
                dataGrouping: {enabled: false},
                //pointRange: period,
                data: data.yst_bar,
                color: "rgba(171, 168, 168, 0.5)",
              }, {
                type: 'line',
                name: 'yesterday',
                marker: {enabled: false},
                enableMouseTracking: true,
                dataGrouping: {enabled: false},
                lineWidth: 1,
                //color: "rgba(171, 168, 168, 0.5)",
                color: "rgba(111, 108, 108, 0.5)", //gray
                data: data.yst_line,
                zIndex: 2
              }, {
                name: 'today',
                type: 'column',
                dataGrouping: {enabled: false},
                color: "rgba(112, 220, 26, 1)", //green
                data: data.today,
		              zIndex:3
              }]
            });
          return chart;

}

function buildingchart(container,data){

      var chart = new Highcharts.Chart({
        chart: {
          backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
          renderTo: container,
          marginBottom:40,
          marginLeft:50,
          pinchType:'none',
          zoomType:'none',
        },
        title: {
          text: ''
        },
        navigator : {
          enabled : false
        },
          scrollbar : {
          enabled : false
        },
        rangeSelector: {
            enabled: false
          },
        exporting: {
              enabled: false
          },
          credits: {
              enabled: false
          },

        plotOptions: {
          column: {
            //pointPlacement: 'between',
            pointPadding: 1,
            groupPadding: 1,
            borderWidth: 1,
            stacking: 'normal',
          },
          line: {
            stacking: 'normal',
          }
        },
        tooltip: {
          // formatter: function() {
          //   var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
          //   var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");
          //
          //   if (this.series.name == 'today') {
          //       return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
          //   } else {
          //       return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
          //   }
          // }
          enabled:false
        },
        xAxis: [{
          ordinal: false,
          //tickInterval: scale,
          crosshair: true,
          //staggerLines: 1,
          title: {
            text: "time (hrs.)",
            style: {
              color: 'gray'//"#2f7ed8"
            },
            align: 'high',
            y:-15,
          },
          categories: ['0', '', '', '', '', '', '', '', '2', '', '', '', '', '', '', '', '4', '', '', '', '', '', '', '', '6', '', '', '', '', '', '', '', '8', '', '', '', '', '', '', '', '10', '', '', '', '', '', '', '', '12', '', '', '', '', '', '', '', '14', '', '', '', '', '', '', '', '16', '', '', '', '', '', '', '', '18', '', '', '', '', '', '', '', '20', '', '', '', '', '', '', '', '22', '', '', '', '', '', '', '','24' ]
        }],
        yAxis: [{ // Primary yAxis

          //labels: {
          //  style: {
              //color: Highcharts.getOptions().colors[1]
          //    color: 'gray'//"#2f7ed8"
          //  }
          //},
          title: {
            text: 'power (kW)',
            style: {
              color: 'gray' //Highcharts.getOptions().colors[1]
            }
          },
          offset: 20,
          max: 200,
          tickPosition: "outside",
          // tickInterval: Math.round((max/1.05)/50,0)*10,
          // minorTickInterval: (Math.round((max/1.05)/50,0)*10)/2,
          tickWidth: 0,
          tickColor: "black", // The same as your gridLine color
          labels: {
            align: 'left',
            x: 0,
            y: 5 // Position labels above their gridLine/tickMark
          },
        }],
        legend: {
          enabled: false
        },
        series: [ {
          name: 'today',
          type: 'column',
          dataGrouping: {enabled: false},
          color: "rgba(112, 220, 26, 1)", //green

          // data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	88.2,	90,	98.5,	97.2,	81.9,83.1, 81,	89.8,	73.9,	78,	72.1,	85.2,	84.3,	89, 96.3, 94.5,	91.7,	92.9,	96,	99.2,	95.7,	91.4, 91.7,	78.9,	76.3,	70.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1,0,0,0,0,0,0,0,0],
          data: data,
        }]
          });
        return chart;

}

function currentGauge(container,data,datapf,type){
    if (type == 'current') {
      var yname = 'Current';
      var variabel = 'A';
    } else if (type == 'thd') {
      var yname = 'Total Harmonic Distortion';
      var variabel = '%';
    } else if (type == 'pv') {
      var yname = 'Power Factor';
      var variabel = '%';
    }
      var chart = new Highcharts.Chart({
        chart: {
            type: 'solidgauge',
            renderTo: container,
            plotBorderWidth: 1,
            backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
            plotBackgroundImage: null,
        },

        title: {
          text:'',
        },

        pane: [{
          startAngle: -90,
          endAngle: 90,
          background: {
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
              innerRadius: '60%',
              outerRadius: '100%',
              shape: 'arc'
          },
          center: ['17%', '60%'],
          size: 130
        }, {
          startAngle: -90,
          endAngle: 90,
          background: {
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
              innerRadius: '60%',
              outerRadius: '100%',
              shape: 'arc'
          },
          center: ['50%', '60%'],
          size: 130
        }, {
          startAngle: -90,
          endAngle: 90,
          background: {
              backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
              innerRadius: '60%',
              outerRadius: '100%',
              shape: 'arc'
          },
          center: ['83%', '60%'],
          size: 130
        }],

        tooltip: {
            enabled: false
        },

        yAxis: [{
            min: 0,
            max: 90,
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            labels: {
                y: 16
            },
            pane: 0,
            title: {
                text: '<span style="font-size:1em">Power Factor: '+datapf[0]+' %</span>',
                y: 80
            }
        }, {
            min: 0,
            max: 90,
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            labels: {
                y: 16
            },
            pane: 1,
            title: {
                text: '<span style="font-size:1em">Power Factor: '+datapf[1]+' %</span>',
                y: 80
            }
        }, {
            min: 0,
            max: 90,
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            labels: {
                y: 16
            },
            pane: 2,
            title: {
                text: '<span style="font-size:1em">Power Factor: '+datapf[2]+' %</span>',
                y: 80
            }
        }],

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: -10,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Channel A',
            data: [data[0]],
            yAxis: 0,
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:1.3em;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:0.8em;color:silver">(Amphere)</span></div>'
            },
        }, {
            name: 'Channel B',
            data: [data[1]],
            yAxis: 1,
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:1.3em;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:0.8em;color:silver">(Amphere)</span></div>'
            },
        }, {
            name: 'Channel C',
            data: [data[2]],
            yAxis: 2,
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:1.3em;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:0.8em;color:silver">(Amphere)</span></div>'
            },
        }]

    });
        return chart;
}
// function currentGauge(container,data,type){
//     if (type == 'current') {
//       var yname = 'Current';
//       var variabel = 'A';
//     } else if (type == 'thd') {
//       var yname = 'Total Harmonic Distortion';
//       var variabel = '%';
//     } else if (type == 'pv') {
//       var yname = 'Power Factor';
//       var variabel = '%';
//     }
//       var chart = new Highcharts.Chart({
//         chart: {
//             type: 'gauge',
//             renderTo: container,
//             plotBorderWidth: 1,
//             backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
//             plotBackgroundImage: null,
//         },
//
//         title: {
//           text:'',
//         },
//
//         pane: [{
//             startAngle: -60,
//             endAngle: 60,
//             background: null,
//             center: ['17%', '80%'],
//             size: 130
//         }, {
//             startAngle: -60,
//             endAngle: 60,
//             background: null,
//             center: ['50%', '80%'],
//             size: 130
//         }, {
//             startAngle: -60,
//             endAngle: 60,
//             background: null,
//             center: ['83%', '80%'],
//             size: 130
//         }],
//
//         tooltip: {
//             enabled: false
//         },
//
//         yAxis: [{
//             min: 0,
//             max: 50,
//             minorTickPosition: 'outside',
//             tickPosition: 'outside',
//             labels: {
//                 rotation: 'auto',
//                 distance: 15
//             },
//             plotBands: [{
//                 from: 30,
//                 to: 50,
//                 color: '#C02316',
//                 innerRadius: '100%',
//                 outerRadius: '105%'
//             }],
//             pane: 0,
//             title: {
//                 text: '('+variabel+')<br/><span style="font-size:8px">Channel A</span>',
//                 // y:
//             }
//         }, {
//             min: 0,
//             max: 50,
//             minorTickPosition: 'outside',
//             tickPosition: 'outside',
//             labels: {
//                 rotation: 'auto',
//                 distance: 15
//             },
//             plotBands: [{
//                 from: 30,
//                 to: 50,
//                 color: '#C02316',
//                 innerRadius: '100%',
//                 outerRadius: '105%'
//             }],
//             pane: 1,
//             title: {
//                 text: '('+variabel+')<br/><span style="font-size:8px">Channel B</span>',
//                 // y: 12
//             }
//         }, {
//             min: 0,
//             max: 50,
//             minorTickPosition: 'outside',
//             tickPosition: 'outside',
//             labels: {
//                 rotation: 'auto',
//                 distance: 15
//             },
//             plotBands: [{
//                 from: 30,
//                 to: 50,
//                 color: '#C02316',
//                 innerRadius: '100%',
//                 outerRadius: '105%'
//             }],
//             pane: 2,
//             title: {
//                 text: '('+variabel+')<br/><span style="font-size:8px">Channel C</span>',
//                 // y: 12
//             }
//         }],
//
//         plotOptions: {
//             gauge: {
//                 dataLabels: {
//                     enabled: false
//                 },
//                 dial: {
//                     radius: '100%'
//                 }
//             }
//         },
//         credits: {
//             enabled: false
//         },
//         series: [{
//             name: 'Channel A',
//             data: [data[0]],
//             yAxis: 0
//         }, {
//             name: 'Channel B',
//             data: [data[1]],
//             yAxis: 1
//         }, {
//             name: 'Channel C',
//             data: [data[2]],
//             yAxis: 2
//         }]
//
//     });
//         return chart;
// }

function daychart(container,data,type){
    if (type == 'power') {
      var yname = 'Power (kW)';
    } else {
      var yname = 'Energy (kWh)';
    }
      var chart = new Highcharts.Chart({
        chart: {
          backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
          renderTo: container,
          marginBottom:40,
          marginLeft:50,
          pinchType:'none',
          zoomType:'none',
        },
        title: {
          text: ''
        },
        navigator : {
          enabled : false
        },
          scrollbar : {
          enabled : false
        },
        rangeSelector: {
            enabled: false
          },
        exporting: {
              enabled: false
          },
          credits: {
              enabled: false
          },

        plotOptions: {
          column: {
            //pointPlacement: 'between',
            pointPadding: 1,
            groupPadding: 1,
            borderWidth: 1,
            stacking: 'normal',
          },
          line: {
            stacking: 'normal',
          }
        },
        tooltip: {
          // formatter: function() {
          //   var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
          //   var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");
          //
          //   if (this.series.name == 'today') {
          //       return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
          //   } else {
          //       return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
          //   }
          // }
          enabled:false
        },
        xAxis: [{
          ordinal: false,
          //tickInterval: scale,
          crosshair: true,
          //staggerLines: 1,
          title: {
            text: "time (hrs.)",
            style: {
              color: 'gray'//"#2f7ed8"
            },
            align: 'high',
            y:-15,
          },
          categories: ['0', '', '', '', '', '', '', '', '2', '', '', '', '', '', '', '', '4', '', '', '', '', '', '', '', '6', '', '', '', '', '', '', '', '8', '', '', '', '', '', '', '', '10', '', '', '', '', '', '', '', '12', '', '', '', '', '', '', '', '14', '', '', '', '', '', '', '', '16', '', '', '', '', '', '', '', '18', '', '', '', '', '', '', '', '20', '', '', '', '', '', '', '', '22', '', '', '', '', '', '', '','24' ]
        }],
        yAxis: [{ // Primary yAxis

          //labels: {
          //  style: {
              //color: Highcharts.getOptions().colors[1]
          //    color: 'gray'//"#2f7ed8"
          //  }
          //},
          title: {
            text: yname,
            style: {
              color: 'gray' //Highcharts.getOptions().colors[1]
            }
          },
          offset: 20,
          // max: 200,
          tickPosition: "outside",
          // tickInterval: Math.round((max/1.05)/50,0)*10,
          // minorTickInterval: (Math.round((max/1.05)/50,0)*10)/2,
          tickWidth: 0,
          tickColor: "black", // The same as your gridLine color
          labels: {
            align: 'left',
            x: 0,
            y: 5 // Position labels above their gridLine/tickMark
          },
        }],
        legend: {
          enabled: false
        },
        series: [ {
          name: 'today',
          type: 'column',
          dataGrouping: {enabled: false},
          color: "rgba(112, 220, 26, 1)", //green

          // data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	88.2,	90,	98.5,	97.2,	81.9,83.1, 81,	89.8,	73.9,	78,	72.1,	85.2,	84.3,	89, 96.3, 94.5,	91.7,	92.9,	96,	99.2,	95.7,	91.4, 91.7,	78.9,	76.3,	70.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1,0,0,0,0,0,0,0,0],
          data: data,
        }]
          });
        return chart;

}

function monthchart(container,data,ytype){
      if (ytype=='power') {
        var yname = 'Power (kW)';
      } else {
        var yname = 'Energy (kWh)';
      }
      var chart = new Highcharts.Chart({
        chart: {
          backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
          renderTo: container,
          marginBottom:40,
          marginLeft:50,
          pinchType:'none',
          zoomType:'none',
        },
        title: {
          text: ''
        },
        navigator : {
          enabled : false
        },
          scrollbar : {
          enabled : false
        },
        rangeSelector: {
            enabled: false
          },
        exporting: {
              enabled: false
          },
          credits: {
              enabled: false
          },

        plotOptions: {
          column: {
            //pointPlacement: 'between',
            pointPadding: 1,
            groupPadding: 1,
            borderWidth: 1,
            stacking: 'normal',
          },
          line: {
            stacking: 'normal',
          }
        },
        tooltip: {
          // formatter: function() {
          //   var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
          //   var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");
          //
          //   if (this.series.name == 'today') {
          //       return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
          //   } else {
          //       return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
          //   }
          // }
          enabled:false
        },
        xAxis: [{
          ordinal: false,
          //tickInterval: scale,
          crosshair: true,
          //staggerLines: 1,
          title: {
            text: "time (day.)",
            style: {
              color: 'gray'//"#2f7ed8"
            },
            align: 'high',
            y:-5,
          },
          categories: ['1','','3','','5','','7','','9','','11','','13','','15','','17','','19','','21','','23','','25','','27','','29','','']
          // type : 'category',
        }],
        yAxis: [{ // Primary yAxis

          //labels: {
          //  style: {
              //color: Highcharts.getOptions().colors[1]
          //    color: 'gray'//"#2f7ed8"
          //  }
          //},
          title: {
            text: yname,
            style: {
              color: 'gray' //Highcharts.getOptions().colors[1]
            }
          },
          // max: 200,
          offset: 20,
          tickPosition: "outside",
          // tickInterval: Math.round((max/1.05)/50,0)*10,
          // minorTickInterval: (Math.round((max/1.05)/50,0)*10)/2,
          tickWidth: 0,
          tickColor: "black", // The same as your gridLine color
          labels: {
            align: 'left',
            x: 0,
            y: 5 // Position labels above their gridLine/tickMark
          },
        }],
        legend: {
          enabled: false
        },
        series: [ {
          name: 'today',
          type: 'column',
          dataGrouping: {enabled: false},
          color: "rgba(112, 220, 26, 1)", //green

          // data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	88.2,	90,	98.5,	97.2,	81.9,83.1, 81,	89.8,	73.9,	78,	72.1,	85.2,	84.3,	89, 96.3, 94.5,	91.7,	92.9,	96,	99.2,	95.7,	91.4, 91.7,	78.9,	76.3,	70.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1,0,0,0,0,0,0,0,0],
          data: data,
        }]
          });
        return chart;

}
function yearchart(container,data,ytype){
      if (ytype=='power') {
        var yname = 'Power (kW)';
      } else {
        var yname = 'Energy (kWh)';
      }
      var chart = new Highcharts.Chart({
        chart: {
          backgroundColor: { linearGradient: { x1: 0, y1: 1, x2: 0, y2: 0  }, stops: [[0, '#F9FAFC'],[0.5, '#E6E6E6'],[1, '#E6E6E6']]   },
          renderTo: container,
          marginBottom:40,
          marginLeft:50,
          pinchType:'none',
          zoomType:'none',
        },
        title: {
          text: ''
        },
        navigator : {
          enabled : false
        },
          scrollbar : {
          enabled : false
        },
        rangeSelector: {
            enabled: false
          },
        exporting: {
              enabled: false
          },
          credits: {
              enabled: false
          },

        plotOptions: {
          column: {
            //pointPlacement: 'between',
            pointPadding: 1,
            groupPadding: 1,
            borderWidth: 1,
            stacking: 'normal',
          },
          line: {
            stacking: 'normal',
          }
        },
        tooltip: {
          // formatter: function() {
          //   var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
          //   var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");
          //
          //   if (this.series.name == 'today') {
          //       return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
          //   } else {
          //       return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
          //   }
          // }
          enabled:false
        },
        xAxis: [{
          ordinal: false,
          //tickInterval: scale,
          crosshair: true,
          //staggerLines: 1,
          title: {
            text: "time (month.)",
            style: {
              color: 'gray'//"#2f7ed8"
            },
            align: 'high',
            y:-5,
          },
          categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        }],
        yAxis: [{ // Primary yAxis

          //labels: {
          //  style: {
              //color: Highcharts.getOptions().colors[1]
          //    color: 'gray'//"#2f7ed8"
          //  }
          //},
          title: {
            text: yname,
            style: {
              color: 'gray' //Highcharts.getOptions().colors[1]
            }
          },
          // max: 200,
          offset: 20,
          tickPosition: "outside",
          // tickInterval: Math.round((max/1.05)/50,0)*10,
          // minorTickInterval: (Math.round((max/1.05)/50,0)*10)/2,
          tickWidth: 0,
          tickColor: "black", // The same as your gridLine color
          labels: {
            align: 'left',
            x: 0,
            y: 5 // Position labels above their gridLine/tickMark
          },
        }],
        legend: {
          enabled: false
        },
        series: [ {
          name: 'today',
          type: 'column',
          dataGrouping: {enabled: false},
          color: "rgba(112, 220, 26, 1)", //green

          // data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	88.2,	90,	98.5,	97.2,	81.9,83.1, 81,	89.8,	73.9,	78,	72.1,	85.2,	84.3,	89, 96.3, 94.5,	91.7,	92.9,	96,	99.2,	95.7,	91.4, 91.7,	78.9,	76.3,	70.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1,0,0,0,0,0,0,0,0],
          data: data,
        }]
          });
        return chart;

}
function Donutchart(container,title,datadonut){
      Highcharts.setOptions({
      //  colors: ['#64E572', '#24CBE5','#50B432','#ED561B', '#DDDF00',   '#FF9655', '#FFF263','#6AF9C4',]
       colors :['#40A4E2','#E87F00','#9B5BB9','#F4C400','#2BCB6B','#EA4E35','#334960','#95A5A5','#06BB9C','#ECF0F1',
                        '#1A81BC','#D65501','#8D48B2','#F4C400','#24AC5A','#C23B25','#2C3E52','#BEC3C7','#07A084','#7E8C8D']
      });
      var chart = new Highcharts.Chart({
        chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        renderTo: container,
        type: 'pie',
        lang: {
    			thousandsSep: ','
    		},
        options3d: {
                enabled: true,
                alpha: 45
        },
        style: {
                fontFamily: "Helvetica"
            }
        // marginTop:90
    },
    title: {
        text: '<div style="font-size:large; font-weight:bold; z-index:0; text-transform:uppercase;">'+title+'</div>',

        style: {
          fontWeight: 'lighter',

        },
        verticalAlign: 'middle',
        floating: true
    },
    tooltip: {
        enabled:true,
        headerFormat: '<span style="font-size:larger; font-weight:bold; text-transform:uppercase; color:{point.color};">{point.key}</span><br/>',
        pointFormat: 'energy: <b>{point.y:,.2f} kWh. ({point.percentage:.1f}%)</b>',
    },
    credits:{
        enabled:false,
    },
    exporting:{
        enabled:false,
    },
    plotOptions: {
        pie: {
            innerSize: 200,
            depth: 45,
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              distance: 20,
              connectorWidth: 2,
              size:"100%",
              format: '<span style="color:{point.color};font-size:2em">{point.percentage:.1f} %</span><br /> {point.name} : {point.y:,.2f} kWh',
              style: {
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
            }
        }
    },
    series: [{
        name: 'Floor',
        colorByPoint: true,
        size: '60%',
        innerSize: '70%',
        allowPointSelect:false,
        states: {
            hover: {
                enabled: false
            }
        },
        data: datadonut
    }]
          });
        return chart;

}

function Sensorchart(container){

      var chart = new Highcharts.Chart({
        chart: {
              type: 'spline',
              renderTo: container,
                  alignTicks: false,
              backgroundColor:'transparent',
               useUTC: false
          },
          title: {
               text: ''
          },
          navigator : {
              enabled : false
          },     rangeSelector: {
              enabled: false
          },
          exporting: {
              enabled: false
          },
          credits: {
              enabled: false
          },
          legend:{
                  enabled:false
          },
          xAxis: {
              type: 'datetime',
              labels: {
                  overflow: 'justify'
              },
               tickInterval: 3600 * 2000
          },
          yAxis: {
            title: {
              text: 'Power (kW)',
              style: {
                  color:"#FF9800"
              }
          },
                  lineWidth: 1,
                  lineColor:"#FF9800",
                  plotLines: [{
                      value: 0,
                      width: 1,

                      color: '#FF9800'
                  }],labels: {

                      style: {
                          color: "#FF9800"
                  },
                  minorGridLineWidth: 0,
                  gridLineWidth: 0,
                  alternateGridColor: null,
              },
              },



          tooltip: {
              valueSuffix: ' kW'
          },
          plotOptions: {
              spline: {
                  lineWidth: 1.5,
                  states: {
                      hover: {
                          lineWidth: 1.5
                      }
                  },
                  marker: {
                      enabled: false
                  },
                  pointInterval: 900000, // one hour
                  pointStart: utc_timestamp
              }
          },
          series: [],
          navigation: {
              menuItemStyle: {
                  fontSize: '10px'
              }
          }
          });
        return chart;
}
