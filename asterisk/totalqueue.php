<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Total Queue</title>
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
                        getMonthData(parseInt(month) + 1, year);
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
                        getYearData(year);
                    }
                });
                $(".date-picker-year").focus(function() {
                    $(".ui-datepicker-month").hide();
                });

            });
        </script>
        <script type="text/javascript">
            getTodayData();

            function getTodayData() {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalqueue.today.api.php",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var queue_data = data.total_queue;
                        drawgraphToday(queue_data);
                    }
                });
            }

            function getMonthData(month, year) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalqueue.month.api.php?month=" + month + "&year=" + year,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var queue_data = data.total_queue_month;
                        drawgraphMonth(queue_data);
                    }
                });
            }

            function getYearData(sentYear) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/totalqueue.year.api.php?year=" + sentYear,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var queue_data = data.totalqueue_by_year;
                        drawgraphYear(queue_data);
                    }
                });
            }

            function drawgraphToday(val) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Total Queue (Per Day)'
                        },
                        xAxis: {
                            categories: [val.date]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Caller(s) / Second(s)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                                name: 'Caller',
                                data: [val.caller]
                            }, {
                                name: 'Average Time',
                                data: [val.average_time]
                            }]
                    });
                });
            }

            function drawgraphMonth(valmonth) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Total Queue Month'
                        },
                        xAxis: {
                            categories: valmonth.date
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Second(s)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                                name: 'Average Time (Per Month)',
                                data: valmonth.average_per_month
                            }]
                    });
                });
            }

            function drawgraphYear(valyear) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Total Queue year ' + [valyear.year]
                        },
                        xAxis: {
                            categories: valyear.by_month
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Second(s)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                                name: 'Average Time',
                                data: valyear.average_call
                            }]
                    });
                });
            }

        </script>
    </head>
    <body>
        <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>

        <button onclick="getTodayData()" id="button_today" value="Today">Today</button>
        <input type="button" id="datepicker" value="Select Month">
        <input type="button" name="startDate" id="startDate" class="date-picker-year" value="Select Year">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
