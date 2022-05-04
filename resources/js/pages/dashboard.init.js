/*
File: Dashboard Init Js File
*/

$(document).ready(function() {
    // charts

    $('.js-apex-prod').each(function( index ) {
                        
        let val = $(this).data('salesPercent');
        let el = $(this);
        
        let options = {
            series: [val],
            chart: {
            type: 'radialBar',
            width: 60,
            height: 60,
            
            sparkline: {
                enabled: true
                }
            },

            colors: ['#556ee6'],
            
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: '60%'
                    },
                    track: {
                        margin: 0
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: 4,
                            fontSize: '13px',
                            fontFamily: '"Poppins",sans-serif'
                        }
                    }
                }
            }
        }

        var chart = new ApexCharts(el[0], options);
        chart.render();

    });
});


