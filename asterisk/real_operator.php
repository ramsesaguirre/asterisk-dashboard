<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Number Operator (On-Off line)</title>

        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="jquery.timers.js"></script>
        <script type="text/javascript">
            var temp = null;
            jQuery(document).ready(function() {
                load_menu();
                jQuery(document).everyTime(2000, load_menu);
            });
            function load_menu() {
                jQuery.ajax({
                    type: "POST",
                    url: "api/operator.api.php",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var fresh_data = data.realData;
                        var tmp = JSON.stringify(fresh_data);
                        if (temp != tmp) {
                            temp = tmp;
                            drawGraph(fresh_data);
                        }
                    }
                });
            }

            function drawGraph(datagraphs) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Number Operator'
                        },
                        xAxis: {
                            categories: ['Number Operator']
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Total Call'
                            },
                            stackLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: 'bold',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                }
                            }
                        },
                        legend: {
                            align: 'right',
                            x: -70,
                            verticalAlign: 'top',
                            y: 20,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        tooltip: {
                            formatter: function() {
                                return '<b>' + this.x + '</b><br/>' +
                                        this.series.name + ': ' + this.y + '<br/>' +
                                        'Total: ' + datagraphs.sum;
                            }
                        },
                        plotOptions: {
                            column: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true,
                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                    style: {
                                        textShadow: '0 0 3px black, 0 0 3px black'
                                    }
                                }
                            }
                        },
                        series: [{
                                name: 'available',
                                data: [datagraphs.available]
                            }, {
                                name: 'offline',
                                data: [datagraphs.offline]
                            }, {
                                name: 'busy',
                                data: [datagraphs.busy]
                            }, {
                                name: 'sum operator',
                                data: [datagraphs.sum]
                            },]
                    });
                });
            }
        </script>

    </head>
    <body>
        <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>
        <div id = "wrapper">
            <div id="container" style="min-width: 310px; height: 400px"></div>
            <img src="loading.gif" id="loading" alt="loading" style="display:none;" />	
        </div>
    </body>
</html>