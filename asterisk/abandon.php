<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Abandon Called</title>
        <script src="jquery-1.10.2.js"></script>
        <link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="month.css">
        <script src="jquery-ui.js"></script>
        <script>
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
                        onSelectMonth(parseInt(month) + 1, year);
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
                        onSelectYear(year);
                    }
                });
                $(".date-picker-year").focus(function() {
                    $(".ui-datepicker-month").hide();
                });

            });
        </script>
        <script type="text/javascript">
            nowData();

            function nowData() {
                $('select[id="d_month"]').val(0);
                jQuery.ajax({
                    type: "POST",
                    url: "api/abandon.today.api.php",
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var val_data = data.abandon_today;
                        drawgraphToday(val_data);
                    }
                });
            }

            function onSelectMonth(m, y) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/abandon.month.api.php?month=" + m + "&year=" + y,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var val_data = data.abandon_month;
                        drawgraphMonth(val_data);
                    }
                });
            }

            function onSelectYear(y) {
                jQuery.ajax({
                    type: "POST",
                    url: "api/abandon.year.api.php?year=" + y,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    success: function(data) {
                        var val_data = data.abandon_year;
                        drawgraphYear(val_data);
                    }
                });
            }

            function drawgraphToday(valdata) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Abandon Call today : ' + valdata.date
                        },
                        xAxis: {
                            categories: [valdata.date]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Seconds'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} sec</b></td></tr>',
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
                                data: [valdata.average]
                            }, {
                                name: 'Call',
                                data: [valdata.call]
                            }]
                    });
                });

            }

            function drawgraphMonth(monthdata) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Abandon Call(Per Month)'
                        },
                        xAxis: {
                            categories: monthdata.date
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Seconds'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} sec</b></td></tr>',
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
                                data: monthdata.average

                            }]
                    });
                });

            }

            function drawgraphYear(yeardata) {
                $(function() {
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Abandon Call Year ' + yeardata.year
                        },
                        xAxis: {
                            categories: yeardata.month
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Seconds'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} sec</b></td></tr>',
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
                                data: yeardata.average
                            }]
                    });
                });

            }


        </script>
    </head>
    <body>
        <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>
        <input type="button" id="datepicker" value="Select Month">
        <button onclick="nowData()" id="button_today" value="Today">Today</button>
        <input type="button" name="startDate" id="startDate" class="date-picker-year" />
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </body>
</html>
