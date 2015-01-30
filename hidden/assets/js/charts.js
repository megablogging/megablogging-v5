
var FlotCharts = function() {
    
    if (!jQuery.plot) { return; }

    // Function to handel Basic Charts
    var handelBasicChart = function () {
        var d1 = [];                
        for (var i = 0; i <= 20; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i <= 20; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }


        $.plot("#basicChart", [
            {label: "sin", data: d1, color: '#61c0ed'},
            {label: "cos", data: d2, color: '#f66764'}
        ], {
            series: {
                lines: {show: true},
                points: {show: true}
            },
            xaxis: {
                ticks: 10
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                hoverable: true,
                backgroundColor: {colors: ["#fff", "#fff"]},
                borderWidth: {
                    top: 1,
                    right: 1,
                    bottom: 2,
                    left: 2
                }
            },
            tooltip: true,
            tooltipOpts: {
                content: "'%s' of %x.1 is %y.4",
                shifts: {
                    x: 0,
                    y: -35
                }
            }
        });
    }
    
    // Function For Tracking Curves
    var handelTrackingCurves = function () {
  
        var sin = [],
                cos = [];
        for (var i = 0; i < 14; i += 0.1) {
            sin.push([i, Math.sin(i)]);
            cos.push([i, Math.cos(i)]);
        }

        plot = $.plot($("#trackingCurves"), [{
                data: sin,
                label: "sin = -0.00",
                color: '#61c0ed'
            }, {
                data: cos,
                label: "cos = -0.00",
                color: '#f66764'
            }], {
            series: {
                lines: {
                    show: true
                }
            },
            crosshair: {
                mode: "x"
            },
            grid: {
                hoverable: true,
                autoHighlight: false
            },
            yaxis: {
                min: -1.2,
                max: 1.2
            },
            tooltip: true,
            tooltipOpts: {
                content: "'%s' of %x.1 is %y.4",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        });

        var legends = $("#trackingCurves .legendLabel");
        legends.each(function() {
            // fix the widths so they don't jump around
            $(this).css('width', $(this).width());
        });

        var updateLegendTimeout = null;
        var latestPosition = null;

        function updateLegend() {
            updateLegendTimeout = null;

            var pos = latestPosition;

            var axes = plot.getAxes();
            if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max || pos.y < axes.yaxis.min || pos.y > axes.yaxis.max)
                return;

            var i, j, dataset = plot.getData();
            for (i = 0; i < dataset.length; ++i) {
                var series = dataset[i];

                // find the nearest points, x-wise
                for (j = 0; j < series.data.length; ++j)
                    if (series.data[j][0] > pos.x)
                        break;

                // now interpolate
                var y, p1 = series.data[j - 1],
                        p2 = series.data[j];
                if (p1 == null)
                    y = p2[1];
                else if (p2 == null)
                    y = p1[1];
                else
                    y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);

                legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
            }
        }

        $("#trackingCurves").bind("plothover", function(event, pos, item) {
            latestPosition = pos;
            if (!updateLegendTimeout)
                updateLegendTimeout = setTimeout(updateLegend, 50);
        });
    }
    
    // Function to handel Bar Chart
    var handelBarChart = function () {
        var dataforBar = [
            {
                data: [[0, 4]],
                color: "#94d401"
            },
            {
                data: [[1, 1]],
                color: "#01a5d8"
            },
            {
                data: [[2, 2]],
                color: "#a776ff"
            },
            {
                data: [[3, 4]],
                color: "#fb7977"
            },
            {
                data: [[4, 3]],
                color: "#fb933e"
            },
            {
                data: [[5, 5]],
                color: "#fdd235"
            }
        ];

        $.plot($("#barChart"), dataforBar, {
            series: {
                lines: {
                    fill: false
                },
                points: {show: false},
                bars: {
                    show: true,
                    align: 'center',
                    barWidth: 0.5,
                    fill: 1,
                    lineWidth: 1
                }
            },
            xaxis: {
                tickLength: 0,
                ticks: [
                    [0, "Rating 5"],
                    [1, "Rating 4"],
                    [2, "Rating 3"],
                    [3, "Rating 2"],
                    [4, "Rating 1"],
                    [5, "Not Closed"]]
            },
            yaxis: {
                min: 0
            },
            grid: {
                borderWidth: 0,
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        });
    }
    
    //  Function To handel Multi Bar Chart
    var handelMultiBarChart = function() {
         var d1_1 = [
            [1325376000000, 120],
            [1328054400000, 70],
            [1330560000000, 100],
            [1333238400000, 60],
            [1335830400000, 35]
        ];

        var d1_2 = [
            [1325376000000, 80],
            [1328054400000, 60],
            [1330560000000, 30],
            [1333238400000, 35],
            [1335830400000, 30]
        ];

        var d1_3 = [
            [1325376000000, 80],
            [1328054400000, 40],
            [1330560000000, 30],
            [1333238400000, 20],
            [1335830400000, 10]
        ];

        var d1_4 = [
            [1325376000000, 15],
            [1328054400000, 10],
            [1330560000000, 15],
            [1333238400000, 20],
            [1335830400000, 15]
        ];

        var data1 = [
            {
                label: "Product 1",
                data: d1_1,
                bars: {
                    show: true,
                    barWidth: 12 * 24 * 60 * 60 * 300,
                    fill: true,
                    lineWidth: 1,
                    order: 1,
                    fillColor: "#00a7db"
                },
                color: "#00a7db"
            },
            {
                label: "Product 2",
                data: d1_2,
                bars: {
                    show: true,
                    barWidth: 12 * 24 * 60 * 60 * 300,
                    fill: true,
                    lineWidth: 1,
                    order: 2,
                    fillColor: "#ff7071"
                },
                color: "#ff7071"
            },
            {
                label: "Product 3",
                data: d1_3,
                bars: {
                    show: true,
                    barWidth: 12 * 24 * 60 * 60 * 300,
                    fill: true,
                    lineWidth: 1,
                    order: 3,
                    fillColor: "#fb933e"
                },
                color: "#fb933e"
            },
            {
                label: "Product 4",
                data: d1_4,
                bars: {
                    show: true,
                    barWidth: 12 * 24 * 60 * 60 * 300,
                    fill: true,
                    lineWidth: 1,
                    order: 4,
                    fillColor: "#ffd03c"
                },
                color: "#ffd03c"
            }
        ];

        $.plot($("#multiBarChart"), data1, {
            xaxis: {
                min: (new Date(2011, 11, 15)).getTime(),
                max: (new Date(2012, 04, 18)).getTime(),
                mode: "time",
                timeformat: "%b",
                tickSize: [1, "month"],
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tickLength: 0, // hide gridlines
                axisLabel: 'Month',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelPadding: 5
            },
            yaxis: {
                axisLabel: 'Value',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelPadding: 5
            },
            grid: {
                hoverable: true,
                clickable: false,
                borderWidth: 1
            },
            tooltip: true,
            tooltipOpts: {
                content: "Sales: %y"
            },
            legend: {
                labelBoxBorderColor: "none",
                position: "left"
            },
            series: {
                shadowSize: 1
            }
        });
    }
    
    // Function to handel Hirizandal Bar Charts
    var handelHBarChart = function () {
        var dataforBar = [
            {
                data: [[0, 4]],
                color: "#90cf02"
            },
            {
                data: [[1, 1]],
                color: "#01a7db"
            },
            {
                data: [[2, 2]],
                color: "#a37afa"
            },
            {
                data: [[3, 4]],
                color: "#fd6d6a"
            },
            {
                data: [[4, 3]],
                color: "#fe913f"
            },
            {
                data: [[5, 5]],
                color: "#fdd235"
            }
        ];

        $.plot($("#hBarChart"), dataforBar, {
            series: {
                lines: {
                    fill: false
                },
                points: {show: false},
                bars: {
                    show: true,
                    align: 'center',
                    barWidth: 0.4,
                    horizontal: true,
                    fill: 1,
                    lineWidth: 1
                }
            },
            xaxis: {
                tickLength: 0,
                ticks: [
                    [0, "Rating 5"],
                    [1, "Rating 4"],
                    [2, "Rating 3"],
                    [3, "Rating 2"],
                    [4, "Rating 1"],
                    [5, "Not Closed"]]
            },
            yaxis: {
                min: 0
            },
            grid: {
                borderWidth: 0,
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "x: %x, y: %y"
            }
        });
    }
    
    // Function to Handel Area Chart
    var handleAreaChart = function() {
        var d1 = [[1262304000000, 6], [126, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
        var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

        var data1 = [
            {label: "Sales One", data: d1, points: {fillColor: "#fbc2a7", size: 1}, color: '#61c0ed'},
            {label: "Sales Two", data: d2, points: {fillColor: "#b5e1fc", size: 1}, color: '#f66764'}
        ];
        
        $.plot($("#areaChart"), data1, {
            xaxis: {
                min: (new Date(2009, 12, 1)).getTime(),
                max: (new Date(2010, 11, 1)).getTime(),
                mode: "time",
                tickSize: [1, "month"],
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tickLength: 0,
                axisLabel: 'Month',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelPadding: 5
            },
            yaxis: {
                axisLabel: 'Amount',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelPadding: 5
            },
            series: {
                lines: {
                    show: true,
                    fill: true
                },
                points: {
                    show: false
                }                               
            },
            
            grid: {
                borderWidth: 1,
                hoverable: true 
            },
            tooltip: true,
            tooltipOpts: {
                content: "Sales: %y"
            },
            legend: {
                labelBoxBorderColor: "none",
                position: "left"
            }
        });
    };
    
    //  Function To Handel Pie Chart
    var handelPieChart = function () {
        var dataforPie = [
            {
                label: "Not Completed",
                data: 150,
                color: "#df3e50"
            },
            {
                label: "Rating 1",
                data: 100,
                color: "#61c0ed"
            },
            {
                label: "Rating 2",
                data: 250,
                color: "#a468fe"
            },
            {
                label: "Rating 3",
                data: 250,
                color: "#f66764"
            },
            {
                label: "Rating 4",
                data: 250,
                color: "#ffc038"
            },
            {
                label: "Rating 5",
                data: 250,
                color: "#9fd148"
            }
        ];

        var options = {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
            legend: {
                show: true
            }
        };

        $.plot($("#pieChart"), dataforPie, options);
    }

    // Function To handel Donut Chart
    var handelDonetChart = function () {
        var dataforPie = [
            {
                label: "Not Completed",
                data: 150,
                color: "#df3e50"
            },
            {
                label: "Rating 1",
                data: 100,
                color: "#61c0ed"
            },
            {
                label: "Rating 2",
                data: 250,
                color: "#a468fe"
            },
            {
                label: "Rating 3",
                data: 250,
                color: "#f66764"
            },
            {
                label: "Rating 4",
                data: 250,
                color: "#ffc038"
            },
            {
                label: "Rating 5",
                data: 250,
                color: "#9fd148"
            }
        ];

        var options = {
            series: {
                pie: {
                    innerRadius: 0.5,
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
            legend: {
                show: true
            }
        };

        $.plot($("#donutChart"), dataforPie, options);
    };

    return {        
        init: function() {
            handelBasicChart();
            handelTrackingCurves();
            handelBarChart();
            handelMultiBarChart();
            handelHBarChart();
            handleAreaChart();
            handelPieChart();
            handelDonetChart();
        }
              
    };
}();

var MorrisChart = function (){
    
    var handelMorrisLineChart = function() {
        Morris.Line({
            element: 'morrisLine',
            data: [
                {y: '2007', a: 100, b: 90},
                {y: '2008', a: 75, b: 65},
                {y: '2009', a: 50, b: 40},
                {y: '2010', a: 75, b: 65},
                {y: '2011', a: 50, b: 40},
                {y: '2012', a: 75, b: 65},
                {y: '2013', a: 100, b: 90}
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            lineColors: ['#61c0ed', '#ffc038'],
            pointFillColors: ['#61c0ed','#ffc038']
        });
    };
    
    var handelMorrisAreaChart = function() {
        Morris.Area({
            element: 'morrisArea',
            data: [
                {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
                {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
                {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
                {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
                {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
                {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
                {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
                {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
                {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
                {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
            ],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 2,
            hideHover: 'auto',
            lineColors:['#a468fe', '#ffc038', '#9fd148'],
            pointFillColors: ['#a468fe', '#ffc038', '#9fd148']
        });
    };
    
    var handelMorrisBarChart = function() {
        Morris.Bar({
            element: 'morrisBar',
            data: [
                {device: 'iPhone', geekbench: 136},
                {device: 'iPhone 3G', geekbench: 137},
                {device: 'iPhone 3GS', geekbench: 275},
                {device: 'iPhone 4', geekbench: 380},
                {device: 'iPhone 4S', geekbench: 655},
                {device: 'iPhone 5', geekbench: 1571}
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto',
            barColors: ['#ffc038']
        });
    };
    
    var handelMorrisDonetChart = function() {
        Morris.Donut({
            element: 'morrisDonut',
            data: [
                {label: 'CSS', value: 25},
                {label: 'HTML', value: 40},
                {label: 'PS', value: 25},
                {label: 'jQuery', value: 10}
            ],
            colors:['#61c0ed','#f66764','#0090ff','#0a5f5c'],
            formatter: function(y) {
                return y + "%"
            }
        });
    };
    
    var handelMorrisAreaLineChart = function() {
        // Use Morris.Area instead of Morris.Line
        Morris.Area({
            element: 'morrisAreaLine',
            behaveLikeLine: true,
            data: [
                {x: '2011 Q1', y: 3, z: 3},
                {x: '2011 Q2', y: 2, z: 1},
                {x: '2011 Q3', y: 2, z: 4},
                {x: '2011 Q4', y: 3, z: 3}
            ],
            xkey: 'x',
            ykeys: ['y', 'z'],
            labels: ['Y', 'Z'],
            lineColors:['#a468fe', '#ffc038']
        });
    }
    
    return {
        init: function() {
            handelMorrisLineChart();
            handelMorrisAreaChart();
            handelMorrisBarChart();
            handelMorrisDonetChart();
            handelMorrisAreaLineChart();
        }
        
    }
}();    // Draggable Portlets