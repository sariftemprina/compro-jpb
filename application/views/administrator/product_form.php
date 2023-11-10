<div class="row">
	<div class="col-md-6">
		<div class="align-items-start">
			<div class="mb-3">
				<label for="" class="form-label">Judul Produk</label>
				<input type="text" class="form-control form-control-sm" name="title">
			</div>
			<div class="mb-3">
				<label for="" class="form-label">Deskripsi Produk</label>
				<textarea class="tiny form-control form-control-sm" id="description" name="description"></textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<label for="" class="form-label">Gambar Produk</label>
		<div class="row">
			<?php
				for($i=0;$i<4;$i++){
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
		<div class="row mb-3">
			<div class="col-md-6">
				<label for="" class="form-label">Harga</label>
				<input type="number" class="form-control form-control-sm" name="price">
				<div class="form-text">
					Kosongi untuk tidak menampilkan harga    
				</div>
			</div>
			<div class="col-md-6">
				<label for="" class="form-label">Status</label>
				<select class="form-control form-control-sm" name="published">
					<option value="0">Draft</option>
					<option value="1">Publish</option>
				</select>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-6">
				<label for="" class="form-label">Kategori</label>
				<select class="form-control form-control-sm" name="category">
				<?php
					$category	= ['Guru', 'SD', 'SMP', 'SMA', 'Umum'];
					foreach($category as $v){
						echo "<option value='{$v}'>{$v}</option>";
					}
				?>
				</select>
			</div>
			<div class="col-md-6">
				<label for="" class="form-label">Populer</label>
				<select class="form-control form-control-sm" name="popular">
					<option value="0">Tidak</option>
					<option value="1">Ya</option>
				</select>
			</div>
		</div>
		<div class="mb-3">
			<label for="basic-url" class="form-label">Link pembelian</label>

			<?php
				$mktplace	= ['tokopedia', 'blibli', 'shopee', 'bukalapak'];
				foreach($mktplace as $v){
			?>
			<div class="input-group mt-2">
				<span class="input-group-text bg-dark" style="width:150px" id="basic-addon3"><?php echo $v; ?></span>
				<input type="text" class="form-control linkStore" id="basic-url" data-store="<?php echo $v; ?>" aria-describedby="basic-addon3 basic-addon4">
				<button title="delete" class="btn btn-sm btn-danger btn-delete-store" data-bs-toggle="modal" data-bs-target="#appModal" data-store="<?php echo $v; ?>"><i class="bi bi-x-lg"></i></button>			</div>
			<?php
				}
			?>
			<div class="form-text" id="basic-addon4">Kosongi untuk tidak menampilkan link pembelian</div>
            <div class="col-md-6 mt-3">
                <a class="btn btn-sm btn-primary btn-submit">Simpan</a>
            </div>
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
                    $("[name=price]").val(v.price);
                    $("[name=category]").val(v.category);
                    tinymce.get('description').setContent(v.description); 
					//console.log('tinyMCE exists? ' + (tinymce === undefined ? 'NO' : 'YES'));

					$.each(JSON.parse(v.stores), function(k1,v1){
						$('.linkStore[data-store='+v1.store+']').val(v1.link).attr('disabled', true);
						$('.linkStore[data-store='+v1.store+']').val(v1.link).closest('div').find('.btn-delete-store').removeClass('d-none');
					});
					
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
		$("#appModal .modal-body").html(`Lanjutkan menghapus gambar produk? <input type="hidden" name="id" value="${id}">`);
		$("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete-image">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
	});

    $(document).on('click', '.btn-confirm-delete-image', function(e){
        var image_id	= $('.modal [name=id]').val();
        var product_id	= url.get('id');

        $.post('?do=delete-image', {'image_id' : image_id, 'product_id' : product_id}, function(result){
            var x   = JSON.parse(result);
			if(x.status == true){
				loadData();
	            $("#appModal").modal('hide');
	            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			}
        });
	});
	
	$(document).on('click', '.btn-delete-store', function(e){
		var store  = $(this).data('store');
		$("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i> Konfirmasi`);
		$("#appModal .modal-body").html(`Lanjutkan menghapus link pembelian produk? <input type="hidden" name="store" value="${store}">`);
		$("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete-store">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
	});

	$(document).on('click', '.btn-confirm-delete-store', function(e){
        var store	= $('.modal [name=store]').val();
        var product_id	= url.get('id');

        $.post('?do=delete-store', {'store' : store, 'product_id' : product_id}, function(result){
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
        param.price = $("[name=price]").val();
		param.images	= []
		param.stores	= []
		$.each($(".img-base64"), function(k,v){
			if($(".img-base64").eq(k).val() != ""){
				param.images.push({'imgcaption' : $(".img-caption").eq(k).val(), 'imgbase64' :  $(".img-base64").eq(k).val()});
			}
		});
		$.each($(".linkStore"), function(k,v){
			if($(".linkStore").eq(k).val() != "" && ($(".linkStore").eq(k).prop('disabled') == false)){
				param.stores.push({'name' : $(".linkStore").eq(k).data('store'), 'link' :  $(".linkStore").eq(k).val()});
			}
		});

        if(action == 'update'){
            param.id = url.get('id');
        }

        $.post('?do='+action, param, function(result){
            var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			//loadData();                
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