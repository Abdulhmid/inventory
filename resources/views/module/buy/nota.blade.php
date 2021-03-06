 <!DOCTYPE html>
<html>
  <head>
    <title>Laporan Pendapatan</title>
    <style type="text/css"></style>
    <link href="{!! asset('css/style-report.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap 3.3.2 -->
    <!-- <link href="{!! asset('plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />    -->
    <!-- <link href="{!! asset('plugins/bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css" />    -->
    <!-- Font Awesome Icons -->
    <!-- <link href="{!! asset('plugins/icon/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" /> -->
    <!-- Ionicons -->
    <!-- <link href="{!! asset('plugins/icon/ionicons/ionicons.min.css') !!}" rel="stylesheet" type="text/css" />      -->
    <!-- Theme style -->
    <!-- <link href="{!! asset('assets/css/AdminLTE/AdminLTE.min.css') !!}" rel="stylesheet" type="text/css" /> -->
  </head>
  <body>
    <div class="wrapper">
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header" style="">  
              <i class="fa fa-globe"></i> Nota Pembayaran <br/> <label style="font-size:13px;"> <?= date('Y-F-d h:i:s') ?> </label>
              <!-- <i class="pull-right"> <label style="font-size:13px;"><?= date('Y-F-d h:i:s') ?></label> </i> -->
            </h2>
          </div><!-- /.col -->
        </div><hr/>
        <div class="row">
          <div class="col-xs-12">
            Key Transaksi :  {{$keyTrans}}
          </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" width="100%" border="1">
                    <thead>
                        <tr align="center">
                          <th width="">Barang</th>
                          <th width="">QTY</th>
                          <th width="">Harga</th>
                          <th width="">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{--*/ $totalBuy = 0; /*--}}
                      @foreach($dataQuery as $key => $value)
                      <tr>
                        <td height="">{{$value['item']['name_items']}}</td>
                        <td height="">{{ GlobalHelp::idrFormat($value->qty)}}</td>
                        <td height="">{{ GlobalHelp::idrFormat($value->price_buy)}}</td>
                        <td height="" align="right">{{  GlobalHelp::idrFormat($value->qty*$value->price_buy) }}</td>
                      </tr>
                      {{--*/ $totalBuy += $value->qty*$value->price_buy; /*--}}
                      @endforeach
                      <tr>
                        <td>Total</td>
                        <td colspan="4" align="right">{{ GlobalHelp::idrFormat($totalBuy)}}</td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Note :<br/>
                    Nota Pembelian.
                </p>
            </div>
        </div>
    </div>

  </body>
</html>