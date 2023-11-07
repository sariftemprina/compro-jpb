<div class="row">
	<div class="col-md-6">
		<div class="align-items-start">
            <div class="mb-3">
                <label for="" class="form-label">Judul</label>
                <input type="text" class="form-control form-control-sm" name="title" id="" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Isi</label> 
                <textarea class="tiny form-control form-control-sm" name="description" id="description"></textarea>
            </div>
        </div>
    </div>
	<div class="col-md-6">
        <div class="mb-3">
            <label for="" class="form-label">Gambar Utama</label>
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
            <div class="form-text">
                Pastikan ukuran gambar tidak melebihi 2048px atau lebih dari 4mb
            </div>                    
        </div>
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="" class="form-label">Category</label>
                <select class="form-control form-control-sm" id="" name="category">
                    <option value="informasi">Informasi</option>
                    <option value="event">Event</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Status</label>
                <select class="form-control form-control-sm" id="" name="published">
                    <option value="0">Draft</option>
                    <option value="1">Publish</option>
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <a class="btn btn-sm btn-primary btn-submit">Simpan</a>
            </div>

        </div>

    </div>
</div>

<script>

    var url = new URLSearchParams(window.location.search);
    
    $(document).ready(function(){
        if(url.has('id')){
            $.post('?get=data', {'id' : url.get('id')}, function(result){
                var x   = JSON.parse(result);
                if(x.status == true){
                    var v = x.result[0];
                    $("[name=title]").val(v.title); 
                    $("[name=description]").val(v.description);
                    $("[name=category]").val(v.category);
                    $("[name=published]").val(v.published);
                    $("[name=img-caption]").val(v.caption);
                    tinymce.get('description').setContent(v.description); 
                    $('.image-holder').html(`<img src='<?php echo base_url(); ?>${v.filepath}' class='rounded-start' style='width:100%;height:100%;object-fit: cover;'>`).removeClass('placeholder');

                }else{

                }
            });
        }
        
    });

    $(document).on('click', '.btn-submit', function(e){
        tinyMCE.triggerSave();

        var action  = (url.has('id') ? 'update' : 'add');
        
        var param = {}; 
        param.title = $("[name=title]").val(); 
        param.description = $("[name=description]").val();
        param.category = $("[name=category]").val();
        param.published = $("[name=published]").val();
        param.imgcaption = $("[name=img-caption]").val();
        param.imgbase64 = $("[name=img-base64]").val();

        if(action == 'update'){
            param.id = url.get('id');
        }

        $.post('?do='+action, param, function(result){
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

</script>   