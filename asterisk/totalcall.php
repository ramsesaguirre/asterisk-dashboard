<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Total Called (Per day)</title>
        <script src="jquery-1.10.2.js"></script>
        <link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="month.css">
        <script src="jquery-ui.js"></script>
        
        <script type="text/javascript">
            $(function() {
                $('#datepicker').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    onClose: function(dateText, inst) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1));
                        getMonth(parseInt(month) + 1, year);
                    }
                });
            });
            $(function() {
                $('.date-picker-year').datepicker({
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: ' yy',
                    onClose: function(dateText, inst) {
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year));
                        getYear(year);
                    }
                });
                $(".date-picker-year").focus(function() {
                    $(".ui-datepicker-month").hide();
                });

            });
        </script>
        
        <script type="text/javascript">
            getToday();

            function getToday() {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalcall.today.api.php",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var sentdata = data.total_called;
                        drawbargraphToday(sentdata);
                    }
                });
            }

            function getMonth(month, year) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalcall.month.api.php?month=" + month + "&year=" + year,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var sentdata = data.total_call_month;
                        drawbargraphMonth(sentdata);
                    }
                });
            }

            function getYear(year) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalcall.year.api.php?year=" + year,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var sentdata = data.total_call_year;
                        drawbargraphYear(sentdata);
                    }
                });
            }

            function drawbargraphToday(valdata) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Total Called Per Day'
                        },
                        xAxis: {
                            categories: [valdata.date],
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Calls / Second(S)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 100,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'Average Time',
                                data: [valdata.avg_time]
                            }, {
                                name: 'Caller',
                                data: [valdata.caller]
                            }]
                    });
                });
            }

            function drawbargraphMonth(valdatamonth) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Total Called Per Month'
                        },
                        xAxis: {
                            categories: valdatamonth.date,
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Second(S)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 100,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'Average Time(sec)',
                                data: valdatamonth.average_per_month
                            }]
                    });
                });
            }

            function drawbargraphYear(valdatayear) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Total Called Year' + valdatayear.year
                        },
                        xAxis: {
                            categories: valdatayear.by_month,
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Second(S)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 100,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'Average Time(sec)',
                                data: valdatayear.average_call
                            }]
                    });
                });
            }

        </script>
    </head>
    <body>
        <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>

        <button onclick="getToday()" id="button_today" value="Today">Today</button>
        <input type="button" id="datepicker" value="Select Month">
        <input type="button" name="startDate" id="startDate" class="date-picker-year" value="Select Year">
        <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
