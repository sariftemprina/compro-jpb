<div class="row">
	<div class="col-md-4">
        <form>
		<div class="align-items-start">
            <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" class="form-control form-control-sm" name="name" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Institusi</label>
                <input type="text" class="form-control form-control-sm" name="company" id="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Isi</label> 
                <textarea class="form-control form-control-sm" name="content" id="" rows="6"></textarea>
            </div>
            <div class="mb-3">
                <label for="customRange3" class="form-label">Star Rating </label>
                <input type="range" class="d-block form-range" min="1" max="5" step="1" name="star" oninput="this.nextElementSibling.value = this.value" style="width:50%"> <output>3</output>
            </div>
            <div class="mb-3 ">
                <label for="" class="form-label">Photo</label> 
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
                            <input type="hidden" class="img-base64 d-none" name="img-base64">
                        </div>
                        <div class="col-md-6">
                            <textarea class="border border-0 form-control form-control-sm" name="img-caption" placeholder="Caption" style="resize: none;height:100%"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-submit btn-sm btn-primary btn-submit">Simpan</button>
            </div>
        </div>

        </form>
    </div>
	<div class="col-md-8">
		<div class="align-items-start">
            <ul class="list-group" id="listTestimonial">
                <li class="list-group-item">Tidak ada testimonial. <a href="javascript:void()">Tambah Baru</a></li> 
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
                    var btn     = ``;
                    var star    = '';
                    var starClass    = '';
                    if(v.deleted_at == null){
                        var btn = `<a title="delete" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appModal" data-id="${v.id}" class="btn btn-xs btn-danger mx-2 btn-delete"><i class="bi bi-trash"></i></a>`;
                    }
                    for(i=0;i<5;i++){
                        starClass = (i < v.star) ? 'bi-star-fill text-primary' : 'bi-star';

                        star += `<i class="bi ${starClass}"></i> `;
                    }

                    list += `<li class="list-group-item">
                            <div class="row g-0">
                                <div class="col-md-2 px-3 border-end product-images d-flex">
                                    ${(v.photo == null) ? '' : '<img src="<?php echo base_url('/'); ?>'+v.photo+'" class="w-100 h-100">'}
                                </div>
                                <div class="col-md-8 px-3 border-end">
                                    <div class="card-body">
                                        <h4 class="card-title">${v.name} - ${v.company}</h4>
                                        <div class="row">
                                            <div class="col-md-8 px-3 border-end">
                                                <small class="text-secondary">${v.content}</small>
                                            </div>
                                            <div class="col-md-4 px-3 align-top text-left">
                                                <small class="text-secondary">${star}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 px-3">
                                    ${btn} 
                                </div>
                            </div>
                    </li>`;
                });
                $("#listTestimonial").html(list);
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
        $("#appModal .modal-body").html(`Lanjutkan menghapus testimonial? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).on('click', '.btn-submit', function(e){
        tinyMCE.triggerSave();
        
        var param = {}; 
        param.name = $("[name=name]").val(); 
        param.company = $("[name=company]").val();
        param.content = $("[name=content]").val();
        param.star = $("[name=star]").val();
        param.imgbase64 = $("[name=img-base64]").val();

        $.post('?do=submit', param, function(result){
            var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
        });
    });

    $(document).on('change', '.img-file', function(e){
        var logo    = toBase64(e);
		var elm		= $(this);
        logo.then(function(result){
			elm.closest('.card').find('.image-holder').html(`<img src='${result}' class='rounded-start' style='width:100%;height:100%;object-fit: cover;'>`).removeClass('placeholder');
            elm.closest('.card').find('.img-base64').val(result);
        });
    });

    $(document).ready(function(){
        loadData();
    });
</script>