"use strict";

var draw = Chart.controllers.line.prototype.draw;
Chart.controllers.lineShadow = Chart.controllers.line.extend({
    draw: function () {
        draw.apply(this, arguments);
        var ctx = this.chart.chart.ctx;
        var _stroke = ctx.stroke;
        ctx.stroke = function () {
            ctx.save();
            ctx.shadowColor = '#00000075';
            ctx.shadowBlur = 10;
            ctx.shadowOffsetX = 8;
            ctx.shadowOffsetY = 8;
            _stroke.apply(this, arguments)
            ctx.restore();
        }
    }
});

var options = {
    chart: {
        height: 350,
        type: 'area',
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    series: [{
        name: 'New Clients',
        data: [20, 120, 38, 100, 42, 109, 32]
    }, {
        name: 'Old Clients',
        data: [11, 32, 125, 40, 135, 52, 41]
    }],

    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
        labels: {
            style: {
                colors: '#9aa0ac',
            }
        }
    },
    yaxis: {
        labels: {
            style: {
                color: '#9aa0ac',
            }
        }
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
}

var chart = new ApexCharts(
    document.querySelector("#chart6"),
    options
);

chart.render();

var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                30,
                50,
                20,
            ],
            backgroundColor: [
                '#191d21',
                '#63ed7a',
                '#ffa426',
            ],
            label: 'Dataset 1'
        }],
        labels: [
            'Black',
            'Green',
            'Yellow',
        ],
    },
    options: {
        responsive: true,
        legend: {
            position: 'bottom',
            display: false
        },
    }
});

var ctx = document.getElementById('line-chart3').getContext("2d");

var gradientStroke = ctx.createLinearGradient(0, 0, 700, 0);
gradientStroke.addColorStop(0, 'rgba(255, 204, 128, 1)');
gradientStroke.addColorStop(0.5, 'rgba(255, 152, 0, 1)');
gradientStroke.addColorStop(1, 'rgba(239, 108, 0, 1)');

var gradientStroke2 = ctx.createLinearGradient(0, 0, 700, 0);
gradientStroke2.addColorStop(0, 'rgba(35, 189, 184, 1)');
gradientStroke2.addColorStop(0.5, 'rgba(48, 195, 191, 1)');
gradientStroke2.addColorStop(1, 'rgba(64, 202, 197, 1)');

var myChart = new Chart(ctx, {
    type: 'lineShadow',
    data: {
        labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
        type: 'line',
        defaultFontFamily: 'Poppins',
        datasets: [{
            label: "Income",
            data: [0, 30, 10, 120, 50, 63, 10],
            borderColor: gradientStroke,
            pointBorderColor: gradientStroke,
            pointBackgroundColor: gradientStroke,
            pointHoverBackgroundColor: gradientStroke,
            pointHoverBorderColor: gradientStroke,
            pointBorderWidth: 5,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 1,
            fill: false,
            borderWidth: 4,
        }, {
            label: "Expense",
            data: [0, 50, 40, 80, 40, 79, 120],
            borderColor: gradientStroke2,
            pointBorderColor: gradientStroke2,
            pointBackgroundColor: gradientStroke2,
            pointHoverBackgroundColor: gradientStroke2,
            pointHoverBorderColor: gradientStroke2,
            pointBorderWidth: 5,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 1,
            fill: false,
            borderWidth: 4,
        }]
    },


    options: {
        legend: {
            position: "bottom",
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20,
                    fontColor: "#9aa0ac", // Font Color
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }

            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    fontColor: "#9aa0ac", // Font Color
                }
            }]
        }
    }
});


