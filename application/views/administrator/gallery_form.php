<div class="row">
	<div class="col-md-6">
		<div class="align-items-start">
			<div class="mb-3">
				<label for="" class="form-label">Judul Album</label>
				<input type="text" class="form-control form-control-sm" name="title">
			</div>
			<div class="mb-3">
				<label for="" class="form-label">Deskripsi Album</label>
				<textarea class="tiny form-control form-control-sm" id="description" name="description"></textarea>
			</div>
			<div class="mb-3">
	            <div class="col-md-6">
					<label for="" class="form-label">Status</label>
					<select class="form-control form-control-sm" id="" name="published">
						<option value="0">Draft</option>
						<option value="1">Publish</option>
					</select>
				</div>
			</div>
			<div class="mb-3">
				<button type="button" class="btn btn-submit btn-sm btn-primary btn-submit">Simpan</button>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<label for="" class="form-label">Gambar Album</label>
		<div class="row">
			<?php
				for($i=0;$i<8;$i++){
			?>
			<div class="col-3 mb-3">
				<div class="card">
					<div class="card-img-top border-bottom border-black">
						<div class="image-holder text-center" style="width:100%;height:200px;overflow:hidden">

						</div>
						<input type="file" class="img-file" name="img-file[]" style="position:absolute;top:0px;left:0;width:100%;height:200px;opacity:0;z-index:9">
						<input type="hidden" class="img-base64 d-none" name="img-base64">
					</div>
					<div class="card-footer p-0">
						<textarea class="border border-0 form-control form-control-sm img-caption" name="img-caption" placeholder="Caption" style="resize: none;height:100%"></textarea>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script>

    var url = new URLSearchParams(window.location.search);
    
	function loadData(){
		$('.image-holder').html(`<div class="p-5"> <p class="m-0 p-0"><i style="font-size:70px" class="bi bi-camera"></i></p> <span class="m-0 p-0">Add Image / Drop Here </span> </div>`);
		$('.img-caption').val('').attr('disabled', false);
		$('.img-base64').val('');
		$('.img-file').attr('disabled', false);
		$('.linkStore').val('').attr('disabled', false);
		$('.btn-delete-store').addClass('d-none');

		if(url.has('id')){
            $.post('?get=data', {'id' : url.get('id')}, function(result){
                var x   = JSON.parse(result);
                if(x.status == true){
                    var v = x.result[0];
                    $("[name=title]").val(v.title); 
                    $("[name=description]").val(v.description);
					$("[name=published]").val(v.published);
					tinymce.get('description').setContent(v.description); 

					$.each(JSON.parse(v.images), function(k1,v1){
						$('.image-holder').eq(k1).html(`<img src='<?php echo base_url(); ?>${v1.filepath}' class='rounded-start' style='width:100%;height:100%;object-fit: cover;'>`).removeClass('placeholder');
						$('.img-caption').eq(k1).val(v1.caption).attr('disabled', true);
						$('.img-file').eq(k1).attr('disabled', true);
						$('.image-holder').eq(k1).append(`<button class="btn btn-danger btn-delete-image position-absolute" data-bs-toggle="modal" data-bs-target="#appModal" data-id="${v1.id}" style="top:50%;left:50%;transform:translate(-50%, -50%);z-index:10"><i class="bi bi-trash"></i></button>`);
					});

                }else{

                }
            });
        }
	}
    $(document).ready(function(){
        loadData();
    });

    $(document).on('click', '.btn-delete-image', function(e){
		var id  = $(this).data('id');
		$("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i> Konfirmasi`);
		$("#appModal .modal-body").html(`Lanjutkan menghapus gambar album? <input type="hidden" name="id" value="${id}">`);
		$("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete-image">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
	});

    $(document).on('click', '.btn-confirm-delete-image', function(e){
        var image_id	= $('.modal [name=id]').val();
        var album_id	= url.get('id');

        $.post('?do=delete-image', {'image_id' : image_id, 'album_id' : album_id}, function(result){
            var x   = JSON.parse(result);
			if(x.status == true){
				loadData();
	            $("#appModal").modal('hide');
			}
        });
	});
	
    $(document).on('click', '.btn-submit', function(e){
        tinyMCE.triggerSave();

        var action  = (url.has('id') ? 'update' : 'add');
        
        var param = {}; 
        param.title = $("[name=title]").val(); 
        param.description = $("[name=description]").val();
        param.category = $("[name=category]").val();
        param.published = $("[name=published]").val();
    	param.images	= []
		$.each($(".img-base64"), function(k,v){
			if($(".img-base64").eq(k).val() != ""){
				param.images.push({'imgcaption' : $(".img-caption").eq(k).val(), 'imgbase64' :  $(".img-base64").eq(k).val()});
			}
		});
	
        if(action == 'update'){
            param.id = url.get('id');
        }

        $.post('?do='+action, param, function(result){
            var x = JSON.parse(result);
            if(x.status == false){
            }else if(x.status == true){
				loadData();                
            }
        });
    });

    $(document).on('change', '.img-file', function(e){
        var logo    = toBase64(e);
		var elm		= $(this);
        logo.then(function(result){
            console.log(result);
			elm.closest('.card-img-top').find('.image-holder').html(`<img src='${result}' class='w-100 rounded float-start'>`).removeClass('placeholder');
            elm.closest('.card').find('.img-base64').val(result);

        })
    });

</script>