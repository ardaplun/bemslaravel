function mainchart(container){

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
                  stacking: 'normal',
                },
                line: {
                  stacking: 'normal',
                }
              },
              tooltip: {
                formatter: function() {
                  var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
                  var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");

                  if (this.series.name == 'today') {
                      return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
                  } else {
                      return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
                  }
                }
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
                plotLines: [{ // Light air
                          value: 210,
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
                      }, { // Light breeze
                          value: 230,
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
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 27,	24.9,	26.5,	23.8,	16.9,	17.5,	16.1,	16.9],
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
                data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8,27,	24.9,	26.5,	23.8,	16.9,	17.5,	16.1,	16.9],
                zIndex: 2
              }, {
                name: 'today',
                type: 'column',
                dataGrouping: {enabled: false},
                color: "rgba(112, 220, 26, 1)", //green

                data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	148.2,	150,	148.5,	147.2,	161.9,173.1, 191,	199.8,	183.9,	178,	172.1,	165.2,	164.3,	159, 156.3, 154.5,	141.7,	142.9,	126,	119.2,	115.7,	107.4, 101.7,	98.9,	86.3,	80.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1],
              }]
            });
          return chart;

}

function buildingchart(container){

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
          formatter: function() {
            var dateToday = moment().format("dddd, MMMM Do YYYY, h:mm:ss a");
            var dateYesterday = moment().subtract(1, 'day').format("dddd, MMMM Do YYYY, h:mm:ss a");

            if (this.series.name == 'today') {
                return '<span style="font-size:x-small;">' +dateToday+'</span><br>'+'<br /><span style="color:rgba(150, 150, 150, 1);">'+this.series.name+': </span><b>'+this.y +' kW</b></span>';
            } else {
                return '<span>'+dateYesterday+'</span><br>'+this.series.name+': </span><b>'+this.y+' kW</b></span>';
            }
          }
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

          data: [15.2,	15.7,	19.5,	18.2,	16.8,	15.2,	15.4,	18.8, 20.8,	20.1, 20.2,	19.3,	19,	19.4,	21.5,	19.3, 18.8,	18,	17.7,	19.2,	17.1,	17.2,	17.3,	18.2, 19.1,	21.8,	20.7,	23.9,	39,	43.4,	46.2,	53.3, 57.2,	70.2,	74.2,	79.2, 94,	102.1,	109.5,	109.5, 114.6,	116.7,	126.2,	130.9,	135.8,	130.3,	130.8,	135.7, 137.1,	143.8,	88.2,	90,	98.5,	97.2,	81.9,83.1, 81,	89.8,	73.9,	78,	72.1,	85.2,	84.3,	89, 96.3, 94.5,	91.7,	92.9,	96,	99.2,	95.7,	91.4, 91.7,	78.9,	76.3,	70.3,	77.2,	77,	76.3,	71.8, 68.3,	59.9,	52.6,	54.2,	49.9,	49.4,	52.4, 49.1,0,0,0,0,0,0,0,0],
        }]
          });
        return chart;

}
function Donutchart(container,title){

      var chart = new Highcharts.Chart({
        chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        renderTo: container,
        type: 'pie',
        marginTop:-40
    },
    title: {
        text: title,
        style: {
          fontWeight: 'lighter',

            }
    },
    tooltip: {
        enabled:false,
    },
    credits:{
        enabled:false,
    },
    exporting:{
        enabled:false,
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
            enabled: true,
            size:'100%',
            format: '<span>{point.percentage:.1f} %</span><br /> {point.name}',
            style: {
              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        size: '40%',
        innerSize: '60%',
        allowPointSelect:false,
        states: {
            hover: {
                enabled: false
            }
        },
        data: [{

            name: 'Underground',
            y: 6.33
        }, {
            name: '1st Floor',
            y: 24.03,
        }, {
            name: '2nd  Floor',
            y: 20.38
        }, {
            name: '3rd Floor',
            y: 34.77
        }, {
            name: '4th floor',
            y: 8.91
        }]
    }]
          });
        return chart;

}
