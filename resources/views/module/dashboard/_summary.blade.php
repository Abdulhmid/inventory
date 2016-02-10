<div class="row">
    <div class="col-lg-4 col-xs-8">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <span id="items"></span>
                </h3>
                <span id="loading-items"><i class="fa fa-spinner fa-2x fa-pulse"></i></span>

                <p>Total Barang</p>
            </div>
            <div class="icon">
                <i class="ion ion-soup-can"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-8">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><span id="asset"></span></h3>
                <span id="loading-asset"><i class="fa fa-spinner fa-2x fa-pulse"></i></span>

                <p>Total Asset</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-8">
        <div class="small-box bg-red">
            <div class="inner">
                <h3><span id="income"></span></h3>
                <span id="loading-income"><i class="fa fa-spinner fa-2x fa-pulse"></i></span>

                <p>Total Pendapatan</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>
</div>

@section('script')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {


            $.get("{!! url('count-items') !!}", function (data) {
                        console.log(data);
                        $('#items').text(data);
                    })
                    .always(function () {
                        $('#loading-items').show()
                    })
                    .done(function () {
                        $('#loading-items').hide();
                    });

            $.get("{!! url('count-asset') !!}", function (data) {
                        $('#currency').remove();
                        $('#asset')
                                .text(formatNumber(data, false))
                                .before('<small style="color: #fff" id="currency"><sup>Rp. </sup></small>');
                    })
                    .always(function () {
                        $('#loading-asset').show()
                    })
                    .done(function () {
                        $('#loading-asset').hide();
                    });

            $.get("{!! url('count-income') !!}", function (data) {
                        $('#currency').remove();
                        $('#income')
                                .text(formatNumber(data, false))
                                .before('<small style="color: #fff" id="currency"><sup>Rp. </sup></small>');
                    })
                    .always(function () {
                        $('#loading-income').show()
                    })
                    .done(function () {
                        $('#loading-income').hide();
                    });

            /* End */



            // $.get("{!! url('dashboard/count-motor') !!}", function (data) {
            //             $('#motor').text(formatNumber(data, false));
            //         })
            //         .always(function () {
            //             $('#loading-motor').show()
            //         })
            //         .done(function () {
            //             $('#loading-motor').hide();
            //         });

            // $.get("{!! url('dashboard/count-other-vehicle') !!}", function (data) {
            //             $('#other').text(formatNumber(data, false));
            //         })
            //         .always(function () {
            //             $('#loading-other').show()
            //         })
            //         .done(function () {
            //             $('#loading-other').hide();
            //         });


        });
    </script>

@endsection