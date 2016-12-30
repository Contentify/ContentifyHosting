@extends('layouts.backend')

@section('pageType', 'dashboard')
@section('pageName', 'Dashboard')

@section('styles')
    @parent

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/vendor/datepicker.css') }}">
@stop


@section('scripts')
    @parent

    <script src="{{ asset('assets/backend/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/jquery.flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/backend/js/vendor/jquery.flot/jquery.flot.tooltip.js') }}"></script>
@stop

@section('dataPeriod')
    <div class="period-select hidden-xs">
        <form class="input-daterange">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <i class="fa fa-calendar-o"></i>
                </span>
                <input name="start" id="startdate" type="text" class="form-control datepicker" placeholder="{{ Carbon\Carbon::createFromFormat('m-d-Y', date('m-d-Y'))->subDay(7)->format('m-d-Y') }}">
            </div>
                        
            <p class="pull-left">to</p>

            <div class="input-group input-group-sm">
                <span class="input-group-addon">
                    <i class="fa fa-calendar-o"></i>
                </span>
                <input name="end" id="enddate" type="text" class="form-control datepicker" placeholder="{{ Carbon\Carbon::createFromFormat('m-d-Y', date('m-d-Y'))->format('m-d-Y') }}">
            </div>
        </form>
    </div>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="metrics clearfix">
        <div class="metric">
            <span class="field">Total users</span>
            <span class="data totalusers">{{ $users }}</span>
        </div>
        <div class="metric">
            <span class="field">New sign ups</span>
            <span class="data signups">{{ $signups }}</span>
        </div>
        <div class="metric">
            <span class="field">Sales this month</span>
            <span class="data sales">$674.00</span>
        </div>
        <div class="metric">
            <span class="field">Total Sales</span>
            <span class="data totalsales">$3,823.90</span>
        </div>
    </div>

    <div class="chart">
        <h3>
            New users

            <div class="total pull-right hidden-xs">
                <span class="signups">{{ $signups }}</span> total
            </div>
        </h3>
        <div id="signups-chart"></div>
    </div>          
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Flot Charts
    var chart_border_color = "#efefef";
    var chart_color = "#b0b3e3";

    // data chart
    var d = {{ $userCharts }};
    // options chart
    var options = {
        xaxis : {
            mode : "time",
            timeformat: "%Y/%m/%d",
            tickLength : 10,
            alignTicksWithAxis: 1,
        },
        yaxis : {
            max: {!! $signups !!}+3,
        },
        series : {
            lines : {
                show : true,
                lineWidth : 2,
                fill : true,
                fillColor : {
                    colors : [{
                        opacity : 0.04
                    }, {
                        opacity : 0.1
                    }]
                }
            },
            shadowSize : 0
        },
        selection : {
            mode : "x"
        },
        grid : {
            hoverable : true,
            clickable : true,
            tickColor : chart_border_color,
            borderWidth : 0,
            borderColor : chart_border_color,
        },
        tooltip : true,
        colors : [chart_color]
    };

    // initialize chart
    var plot = $.plot($("#signups-chart"), [d], $.extend(options, {
        tooltipOpts : {
            content : "Signups on <b>%x</b>: <span class='value'>%y</span>",
            defaultTheme : false,
            shifts: {
                x: -75,
                y: -70
            }
        }
    }));

    // Range Datepicker
    $('.input-daterange').datepicker({
        autoclose: true,
        orientation: 'right top',
        format: 'mm-dd-yyyy',
    })
    //Listen for the change even on the input
    .on('changeDate', dateChanged);

    // function get stats of period given
    function dateChanged(ev) {
        $(this).datepicker('hide');
        if ($('#startdate').val() != '' && $('#enddate').val() != '') {
            var startdate = $('#startdate').val()
            var enddate = $('#enddate').val()
            var baseUrl = '{!! url('/') !!}'
            var url = baseUrl + '/backend/dashboard/stats/' + startdate + '/' + enddate + '/'
            Messenger().run({
                action: $.ajax,
                successMessage: 'All statistics are updated! ' + startdate + ' to ' + enddate,
                errorMessage: 'We can\'t get statistics for your period given',
                progressMessage: 'Retrieve statistics...'
            }, {
              /* These options are provided to $.ajax, with success and error wrapped */
              url: url,
              dataType: "json",

              success: function(data){
                $('.signups').html(data.signups)
                var data = data.userCharts
                $(ResetChartSignups(data))
              }
            });
        }
    }

    // function draw new chart with new data
    function ResetChartSignups(data) {
        plot.setData([data])
        plot.setupGrid();
        plot.draw();
    }

});
</script>

@endsection


