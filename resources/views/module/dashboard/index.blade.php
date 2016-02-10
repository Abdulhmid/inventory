@extends('main')

@section('content')
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Jenis Barang</span>
          <span class="info-box-number">90<small>%</small></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Toal Penjualan</span>
          <span class="info-box-number">41,410</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Asset</span>
          <span class="info-box-number">760</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

  </div><!-- /.row -->

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
                                      <select name="from" class="form-control select2">
                                          <option value="" > - Select Month -</option>
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      <select name="to" class="form-control select2">
                                          <option value="" > - Select Month -</option>
                                      </select>
                                  </div>
                                  <div class="col-md-4">
                                      <select name="year" class="form-control filter-year select2">
                                      </select>
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

    <script type="text/javascript">
        $(document).ready(function(){
          getDataHighChart(from, to, year);
        });

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
