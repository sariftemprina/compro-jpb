<div class="row">
    <div class="col-md-4" id="image-form">
        <div class="mb-3">
            <label for="" class="form-label">Judul</label>
            <input type="text" class="form-control form-control-sm" name="input-title" id="">
        </div>
        <div class="mb-3 ">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6 border-end border-black">
                        <div class="image-holder text-center" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
                            <div class="pt-3">
                                <p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
                                <span class="m-0 p-0">Add Image / Drop Here </span>
                            </div>
                        </div>
                        <input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:50%;height:100%;opacity:0;z-index:9">
                        <input type="hidden" class="img-base64 d-non" name="img-base64">
                    </div>
                    <div class="col-md-6">
                        <textarea class="border border-0 form-control form-control-sm" name="img-caption" placeholder="Caption" style="resize: none;height:100%"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 form-text">
            Pastikan ukuran gambar tidak melebihi 2048px atau lebih dari 4mb
        </div>                    
        <div class="mb-3">
            <div class="col-md-6">
				<label for="" class="form-label">Jenis</label>
				<select class="form-control form-control-sm" name="input-type">
					<option value="slide">Slide</option>
					<option value="kategori">Kategori</option>
					<option value="partner">Partner</option>
				</select>
			</div>
        </div>
        <button class="mt-3 btn btn-sm btn-primary btn-upload"><i class="bi bi-upload"></i> Upload Image</button>
    </div>
    <div class="col-md-8" id="image-list">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="slide" data-bs-toggle="tab" data-bs-target="#slide-tab-pane" type="button" role="tab" aria-controls="slide-tab-pane" aria-selected="true">Slide</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kategori" data-bs-toggle="tab" data-bs-target="#kategori-tab-pane" type="button" role="tab" aria-controls="kategori-tab-pane" aria-selected="false">Kategori</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="partner" data-bs-toggle="tab" data-bs-target="#partner-tab-pane" type="button" role="tab" aria-controls="partner-tab-pane" aria-selected="false">Partner</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="slide-tab" tabindex="0">
                <div class="align-items-start table-responsive datatable-custom">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer xtable" id="table-images">
                        <thead>
                            <tr>
                                <th style="width:200px">Images</th>
                                <th>Title</th>
                                <th>Caption</th>
                                <th style="width:200px">Created At</th>
                                <th style="width:120px"><i class="bi bi-three-dots"></i></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadData(){
        var param = $('.nav-link.active').attr('id');

        $.post('<?php echo base_url(); ?>administrator/images?get=data', {'type' : param}, function(result){
            var x   = JSON.parse(result);
            var tbl = ``;

            if(x.result.length > 0){
                $.each(x.result, function(k,v){
                    tbl += `<tr>
                                <td><a href="<?php echo base_url(); ?>${v.filepath}"><img style="height:100px;" src="<?php echo base_url(); ?>${v.filepath}"></a></td>
                                <td>${v.title}</td>
                                <td>${v.caption}</td>
                                <td>${v.created_at}</td>
                                <td><button data-id="${v.id}" class="btn btn-sm btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#appModal"><i class="bi bi-trash3"></i> Delete</button></td>
                            </tr>`;
                });
            }else{
                tbl += `<tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>`;
            }
            $("#table-images tbody").html(tbl);
            $('.xtable').dataTable();

        });
    }

    $(document).on('click', '.nav-link', function(e){
        loadData();
    });

    $(document).on('click', '.btn-upload', function(e){
        var title = $('[name=input-title]').val();
        var img = $('[name=img-base64]').val();
        var caption = $('[name=img-caption]').val();
        var type = $('[name=input-type]').val();

        $.post('<?php echo base_url(); ?>administrator/images?do=upload', {'img':  img, 'caption' : caption, 'title' : title, 'type' : type}, function(result){
            var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
            loadData();
        });
    });


    $(document).ready(function(){
        loadData();
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
        $("#appModal .modal-body").html(`Lanjutkan menghapus produk? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).on('change', '.img-file', function(e){
        var logo    = toBase64(e);
		var elm		= $(this);
        logo.then(function(result){
			elm.closest('.card').find('.image-holder').html(`<img src='${result}' class='rounded-start' style='width:100%;height:100%;object-fit: cover;'>`).removeClass('placeholder');
            elm.closest('.card').find('.img-base64').val(result);
        });
    });

</script>