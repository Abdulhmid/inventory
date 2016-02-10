@extends('main')

@section('style')
  <link href="{!! asset('plugins/datepicker/datepicker3.css') !!} "rel="stylesheet" type="text/css"/>    
@stop

@section('content')
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  @include('module.dashboard._summary')

  <!-- Chart -->
  <div class="row">
    <div class="col-md-12">

    <div class="box">

      <div class="box-filter">
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible" id="alert" role="alert" style="display: none">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <i class="fa fa-exclamation"></i> <strong>Site</strong> or <strong>Period</strong> is required.
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible" id="alert-range" role="alert" style="display: none">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <i class="fa fa-exclamation"></i> Please select the right range.
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <div class="row">
                              <div class="col-md-1">
                                  <label>Range</label>
                              </div>
                              <div class="col-md-6">
                                  <div class="col-md-4">
                                      <select class="form-control">
                                        @for($i =1;$i<=12;$i++)
                                          <?php $month = date('F', mktime(0, 0, 0, $i, 10)); ?>
                                          <option value="{!! $i !!}">{!! $month !!}</option>
                                        @endfor
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      <select class="form-control">
                                        @for($i =1;$i<=12;$i++)
                                          <?php $month = date('F', mktime(0, 0, 0, $i, 10)); ?>
                                          <option value="{!! $i !!}">{!! $month !!}</option>
                                        @endfor
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      <input type="text" class="form-control datepickeryear" value="">
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <button type="button" id="show" class="btn btn-info">
                                      <i class="fa fa-search"></i> Show
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
          </div>
      </div>

      <div class="box-body">
            <div class="col-md-12" id="loading-chart">
                <p class="text-center"><i class="fa fa-cog fa-spin"></i> Loading</p>
            </div>
            <div class="clearfix"></div>
            <div id="chart" style=" height: 600px; width:100%"></div>
      </div>
    </div>


    </div><!-- /.col -->
  </div><!-- /.row -->


</section>

@stop

@section('script')
    <script src="{!! asset('plugins/highcharts/highcharts.js') !!} " type="text/javascript"></script>
    <script src="{!! asset('plugins/highcharts/highcharts-more.js') !!} " type="text/javascript"></script>

    <script type="text/javascript" src="{!! asset('plugins/datepicker/bootstrap-datepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/datepicker-format.js') !!}"></script>
    <script src="{!! asset('plugins/accounting/accounting.min.js') !!}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
          $('.datepickermonth').datepicker({
            minViewMode: 'months',
            autoclose : true
          });

          $('.datepickeryear').datepicker({
            minViewMode: 'years',
            format: 'yyyy',
            endDate: '+0d',
            autoclose : true
          });
          format();

          // getDataHighChart(from, to, year);
        });

        function formatNumber(number, currency) {
            var currency = typeof currency !== 'undefined' ? currency : true;
            var withCurrency = currency == true ? 'Rp' : '';


            return accounting.formatMoney(number, withCurrency, 0, ".", ",");
        }

        function getDataHighChart(from, to, year)
        {
            $('#loading-chart').show();
            $('#chart').hide();

            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{!! url(GLobalHelp::indexUrl()) !!}"+"/chart/"+from+"/"+to+"/"+year
            })
            .done(function( result ) {
               highChart(result);
            })
            .fail(function() {
                alert( "error occured" );
            });
        }

        function highChart(data)
        {
            $('#chart').highcharts({
                chart: {
                    type: 'column',
                    events : {
                        load: function () {
                            $(document).resize();
                        }
                    }
                },
                title: {
                    text: 'Income All Site'
                },
                subtitle: {
                    text: $('select[name=from] option:selected').text()
                    +" - "
                    +$('select[name=to] option:selected').text()
                    +" "
                    +$('select[name=year] option:selected').text()
                },
                credits : {
                    enabled : false
                },
                xAxis: {
                    categories: data.months,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Income'
                    }
                },
                tooltip: {
                    enabled : false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: 'Rp.{point.y:,.0f}'
                        }
                    }
                },
                legend: {
                    enabled: false
                },
                series: data.data

            });

            $('#loading-chart').hide();
            $('#chart').show();
        }
    </script>
@stop
