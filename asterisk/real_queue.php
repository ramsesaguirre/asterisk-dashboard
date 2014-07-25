<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Number waiting in queue</title>

        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
            drawgraph();
            var values = 0;
            function drawgraph() {
                $(function() {
                    $(document).ready(function() {
                        Highcharts.setOptions({
                            global: {
                                useUTC: false
                            }
                        });

                        var chart;
                        $('#container').highcharts({
                            chart: {
                                type: 'spline',
                                animation: Highcharts.svg, // don't animate in old IE
                                marginRight: 10,
                                events: {
                                    load: function() {

                                        // set up the updating of the chart each second
                                        var series = this.series[0];
                                        setInterval(function() {
                                            var x = (new Date()).getTime(), // current time
                                                    y = sentdata();
                                            series.addPoint([x, y], true, true);
                                        }, 3000);
                                    }
                                }
                            },
                            title: {
                                text: 'Number waiting in Queue'
                            },
                            xAxis: {
                                type: 'datetime',
                                tickPixelInterval: 150
                            },
                            yAxis: {
                                title: {
                                    text: 'จำนวนคนที่รอสาย'
                                },
                                plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#60952E'
                                    }]
                            },
                            tooltip: {
                                formatter: function() {
                                    return '<b>' + this.series.name + '</b><br/>' +
                                            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                                            'Waiting Queue : ' + Highcharts.numberFormat(this.y, 0);
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            exporting: {
                                enabled: false
                            },
                            series: [{
                                    name: 'จำนวนคนที่รอในสาย',
                                    data: (function() {
                                        // generate an array of random data
                                        var data = [],
                                                time = (new Date()).getTime(),
                                                i;

                                        for (i = -10; i <= 0; i++) {
                                            data.push({
                                                x: time + i * 1000,
                                                y: sentdata()
                                            });
                                        }
                                        return data;
                                    })()
                                }]
                        });
                    });

                });
            }

            function sentdata() {
                jQuery.ajax({
                    type: "POST",
                    url: "numQueue.api.php",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        values = data.queue.num_queue;
                    }
                });
                return values;
            }

        </script>
    </head>
    <body>
        <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
