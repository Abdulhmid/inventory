<!-- Modal -->
<div class="modal fade modal-delete-alert" id="modal-delete-alert-id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= Form::open(['url' => '', 'class' => 'modal-form-delete', 'method' => 'GET']) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>
            </div>
            <?= Form::close() ?>
        </div>
    </div>
</div>