<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="" class="form-label">Text</label>
            <input type="text" class="form-control form-control-sm" name="text" id="" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Url</label>
            <input type="text" class="form-control form-control-sm" name="url" id="" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Index</label>
                    <select class="form-control form-control-sm" id="" name="index">
                        
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Urutan</label>
                    <input type="text" class="form-control form-control-sm" name="sort" id="" aria-describedby="emailHelp">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <a class="btn btn-sm btn-primary btn-submit">Simpan</a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="align-items-start table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer xtable" id="table-menu">
                <thead>
                    <tr>
                        <th style="width:200px">ID Menu</th>
                        <th style="width:200px">Text</th>
                        <th>Url</th>
                        <th>Index Menu</th>
                        <th>Urutan</th>
                        <th style="width:200px">Created At</th>
                        <th style="width:120px"><i class="bi bi-three-dots"></i></th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function loadData(){
        $.post('?get=data', {}, function(result){
            var x   = JSON.parse(result);
            var option  = `<option value="0">-Menu Utama-</option>`;
            var tbl     = ``;
            var arr     = [];
            if(x.result.length > 0){
                $.each(x.result, function(k,v){
                    option  += `<option value="${v.id}">${v.text}</option>`;
                    tbl     += `<tr>
                                <td>${v.id}</td>
                                <td>${v.text}</td>
                                <td>${v.url}</td>
                                <td>${v.text_index}</td>
                                <td>${v.sort}</td>
                                <td>${v.created_at}</td>
                                <td><a title="delete" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appModal" data-id="${v.id}" class="btn btn-xs btn-danger mx-2 btn-delete"><i class="bi bi-trash"></i></a></td>
                    </tr>`;
                    arr.push(v);
                });
            }
            $('[name="index"]').html(option);
            $('#table-menu tbody').html(tbl);
            $('.xtable').dataTable();
        });
    }

    $(document).on('click', '.btn-submit', function(e){
        var text    = $('[name=text]').val();
        var url     = $('[name=url]').val();
        var index   = $('[name=index]').val();
        var sort    = $('[name=sort]').val();

        $.post('<?php echo base_url(); ?>administrator/menu?do=submit', {'text':  text, 'url' : url, 'index' : index, 'sort' : sort}, function(result){
            var x   = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
            loadData();
        });
    });


    $(document).on('click', '.btn-confirm-delete', function(){
        var id  = $('.modal [name=id]').val();

        $.post('?do=delete', {'id' : id}, function(result){
            var x   = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
            loadData();
            $("#appModal").modal('hide')
        });
    });

    $(document).on('click', '.btn-delete', function(){
        var id  = $(this).data('id');
        $("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i> Konfirmasi`);
        $("#appModal .modal-body").html(`Lanjutkan menghapus menu? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).ready(function(){
        loadData();
    });

</script>