<div class="row">
    <div class="col-md-4" id="image-form">
        <div class="mb-3">
            <label for="" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control form-control-sm" name="username" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control form-control-sm" name="email" id="">
        </div>
        <div class="mb-3 row">
            <div class="col-6">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" id="">
            </div>
            <div class="col-6">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" class="form-control form-control-sm" name="cpassword" id="">
            </div>
        </div>
        <div class="mb-3 ">
            <label for="" class="form-label">Avatar</label>
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-12 border-end border-black">
                        <div class="image-holder text-center" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
                            <div class="pt-3">
                                <p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
                                <span class="m-0 p-0">Add Image / Drop Here </span>
                            </div>
                        </div>
                        <input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
                        <input type="hidden" class="img-base64 d-non" name="img-base64">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 form-text">
            Pastikan ukuran gambar tidak melebihi 2048px atau lebih dari 4mb
        </div>   
        <button class="mt-3 btn btn-sm btn-primary btn-upload"><i class="bi bi-upload"></i> Simpan</button>
    </div>
    <div class="col-md-8" id="image-list">
        <div class="align-items-start table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer xtable" id="table-images">
                <thead>
                    <tr>
                        <th style="width:200px">Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
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
<script>
    function loadData(){
        var param = $('.nav-link.active').attr('id');

        $.post('?get=data', {'type' : param}, function(result){
            var x   = JSON.parse(result);
            var tbl = ``;

            if(x.result.length > 0){
                $.each(x.result, function(k,v){
                    tbl += `<tr>
                                <td><a href="<?php echo base_url(); ?>${v.filepath}"><img style="height:100px;" src="<?php echo base_url(); ?>${v.avatar}"></a></td>
                                <td>${v.username}</td>
                                <td>${v.email}</td>
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
        var username    = $('[name=username]').val();
        var email       = $('[name=email]').val();
        var password    = $('[name=password]').val();
        var cpassword   = $('[name=cpassword]').val();
        var avatar      = $('[name=img-base64]').val();

        $.post('?do=submit', {'username':  username, 'email' : email, 'password' : password, 'cpassword' : cpassword, 'avatar' : avatar}, function(result){
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