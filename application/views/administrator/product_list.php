<div class="row">
	<div class="col-md-12">
		<div class="align-items-start">
            <ul class="list-group" id="listProduct">
                <li class="list-group-item">Tidak ada produk. <a href="form">Tambah Produk Baru</a></li> 
            </ul>
        </div>
    </div>
</div>

<script>
    function loadData(){
        $.post('?get=data', {}, function(result){
            var x   = JSON.parse(result);
            var list = ``;
            if(x.result.length > 0){
                $.each(x.result, function(k,v){
                    var images  = ``;
                    $.each(JSON.parse(v.images), function(k1,v1){
                        images  += `<div class="w-25 pe-2"><img style="width:100%" src="<?php echo base_url(); ?>${v1.filepath}"></div>`;
                    });

                    list += `<li class="list-group-item">
                            <div class="row g-0">
                                <div class="col-md-3 px-3 border-end product-images d-flex">
                                    ${images}
                                </div>
                                <div class="col-md-6 px-3 border-end">
                                    <div class="card-body">
                                        <h4 class="card-title">${v.title}</h4>
                                        <small class="text-secondary">${v.description}</small>
                                        <div class="d-flex justify-content-between border-top pt-2">
                                            <div class="me-2">
                                                ${(v.published == '0' ? '<span class="badge bg-secondary">Draft</span>' : '<span class="badge bg-success">Published</span>')} 
                                                ${(v.popular == '0' ? '' : '<span class="badge bg-danger">Popular</span>')} 
                                            </div>
                                            <div class="me-2">
                                                <small title="tanggal dibuat" class="text-body-secondary text-muted"><i class="bi bi-clock"></i> ${v.created_at} </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <h3 class="money mb-5">${v.price}</h3>
                                        <a href="form?id=${v.id}" class="btn btn-sm btn-light"><i class="bi bi-search"></i> Lihat Produk</a>
                                        <a href="form?id=${v.id}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i> Update</a>
                                        <a href="button" data-id="${v.id}" class="btn btn-sm btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#appModal"><i class="bi bi-trash"></i> Hapus</a>
                                </div>
                            </div>
                    </li>`;
                });
                $("#listProduct").html(list);
            }
        });
    }

    $(document).on('click', '.btn-confirm-delete', function(){
        var id  = $('.modal [name=id]').val();

        $.post('?do=delete', {'id' : id}, function(result){
            var x   = JSON.parse(result);
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

    $(document).ready(function(){
        loadData();
    });
</script>