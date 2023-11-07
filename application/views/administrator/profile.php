<div class="row">
	<div class="col-md-12">
		<div class="d-flex align-items-start">
			<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<button class="nav-link active" id="v-pills-site-tab" data-bs-toggle="pill" data-bs-target="#v-pills-site" type="button" role="tab" aria-controls="v-pills-site" aria-selected="true">Pengaturan Umum</button>
				<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profil Perusahaan</button>
				<button class="nav-link" id="v-pills-company-tab" data-bs-toggle="pill" data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company" aria-selected="false">Kontak dan Lokasi</button>
				<button class="nav-link" id="v-pills-tim-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tim" type="button" role="tab" aria-controls="v-pills-tim" aria-selected="false">Susunan Organisasi</button>
				<button class="nav-link" id="v-pills-partner-tab" data-bs-toggle="pill" data-bs-target="#v-pills-partner" type="button" role="tab" aria-controls="v-pills-partner" aria-selected="false">Partnership</button>
			</div>
			<div class="tab-content w-100" id="v-pills-tabContent">
				<div class="tab-pane fade show w-100 active" id="v-pills-site" role="tabpanel" aria-labelledby="v-pills-site-tab" tabindex="0">
					<form id="site">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="" class="form-label">Nama Perusahaan</label>
									<input type="text" class="form-control form-control-sm" id="" name="company" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Judul Website</label>
									<input type="text" class="form-control form-control-sm" id="" name="title" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Keyword </label>
									<input type="text" class="form-control" id="" name="keywords" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Description </label>
									<input type="text" class="form-control" id="" name="description" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="col-sm-12 form-label">Logo </label>
									<div class="card">
										<div class="row">
											<div class="col-md-12 border-black">
												<div class="image-holder text-center" id="logo" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
													<div class="pt-3">
														<p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
														<span class="m-0 p-0">Add Image / Drop Here </span>
													</div>
												</div>
												<input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
												<input type="hidden" class="img-base64 d-non" name="img-base64-logo">
											</div>
										</div>
									</div>
									<div class="form-text">
										Pastikan ukuran gambar tidak melebihi 2048px atau lebih dari 4mb
									</div>                    
								</div>
								<div class="mb-3">
									<button class="btn btn-sm btn-primary btn-submit" type="button">Simpan Pengaturan Website</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
								<label for="basic-url" class="form-label">Link Sosial Media</label>
									<?php
										$socmed	= ['facebook', 'youtube', 'instagram', 'twitter-x', 'tiktok'];
										foreach($socmed as $v){
									?>
									<div class="input-group mb-2">
										<span class="input-group-text bg-dark" style="width:150px" id="basic-addon3"><?php echo ucwords($v); ?></span>
										<input type="text" class="form-control socmed" id="basic-url" name="<?php echo $v; ?>" aria-describedby="basic-addon3 basic-addon4">
										<button type="button" title="delete" class="btn btn-sm btn-danger btn-delete"><i class="bi bi-x-lg"></i></button>
									</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
					<form id="profile">
						<div class="row">
							<div class="col-md-12">
								<div class="mb-3">
									<label for="" class="form-label">Profile Perusahaan</label>
									<div class="row">
										<div class="col-md-10">
											<textarea class="tiny form-control form-control-sm" name="profile" id="profile"></textarea>
										</div>
										<div class="col-md-2">
											<div class="card">
												<div class="row">
													<div class="col-md-12 border-black">
														<div class="image-holder text-center" id="profile" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
															<div class="pt-3">
																<p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
																<span class="m-0 p-0">Add Image / Drop Here </span>
															</div>
														</div>
														<input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
														<input type="hidden" class="img-base64 d-non" name="img-base64-profile">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label for="" class="form-label">Visi dan Misi</label>
									<div class="row">
										<div class="col-md-5">
											<textarea class="tiny form-control form-control-sm" name="visi" id="visi"></textarea>
										</div>
										<div class="col-md-5">
											<textarea class="tiny form-control form-control-sm" name="misi" id="misi"></textarea>
										</div>
										<div class="col-md-2">
											<div class="card">
												<div class="row">
													<div class="col-md-12 border-black">
														<div class="image-holder text-center" id="visi" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
															<div class="pt-3">
																<p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
																<span class="m-0 p-0">Add Image / Drop Here </span>
															</div>
														</div>
														<input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
														<input type="hidden" class="img-base64 d-non" name="img-base64-visi">
													</div>
												</div>
											</div>											
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<button class="btn btn-sm btn-primary btn-submit" type="button">Simpan Pengaturan Profile</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade show w-100" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab" tabindex="0">
					<form id="company" action="?do=save-company">	
						<div class="row">
							<div class="col-md-12 border-bottom border-black mb-5">
								<table class="table table-sm" id="table-companies">
									<thead>
										<tr>
											<th style="width:200px">Nama</th>
											<th>Alamat</th>
											<th>Email</th>
											<th>Maps</th>
											<th>Created at</th>
											<th style="width:220px"><i class="bi bi-three-dots"></i></th>
										</tr>
									</thead>
									<tbody> 
										<tr>
											<td colspan="5" class="text-center">Tidak ada data</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="" class="form-label">Nama Perusahaan</label>
									<input type="text" class="form-control form-control-sm" id="" name="company-name" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Gedung</label>
									<input type="text" class="form-control form-control-sm" id="" name="company-building" aria-describedby="">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Alamat </label>
									<textarea class="form-control form-control-sm" id="" name="company-address" aria-describedby=""></textarea>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Email </label>
									<input type="text" class="form-control" id="" name="company-email" aria-describedby="">
								</div>
								<div class="">
									<label for="" class="form-label">Kontak </label>
									<?php for($i=0;$i<5;$i++){?>
									<div class="row mb-3">
										<div class="col-md-2">
											<select class="form-control company-contact">
												<option value="">-Pilih-</option>
												<option value="whatsapp">WA</option>
												<option value="telephone">Telp</option>
											</select>
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control company-phone" placeholder="Nomor" aria-describedby="">
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control company-label" placeholder="Label" aria-describedby="">
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Link Map</label>
									<input type="text" class="form-control" id="" name="company-maps" aria-describedby="">
								</div>
								<div class="mb-3">
									<button class="btn btn-sm btn-primary btn-submit" type="button">Simpan Pengaturan Kontak</button>
									<button class="btn btn-sm btn-light btn-reset" type="button">Reset</button>
								</div>
							</div>
							<div class="col-md-6 row">
								<?php
									for($i=0;$i<2;$i++){
								?>
								<div class="col-6 mb-3">
									<div class="card">
										<div class="card-img-top border-bottom border-black">
											<div class="image-holder text-center" style="width:100%;height:200px;overflow:hidden">

											</div>
											<input type="file" class="img-file" name="img-file[]" style="position:absolute;top:0px;left:0;width:100%;height:200px;opacity:0;z-index:9">
											<input type="hidden" class="img-base64 d-none company-images" name="foto">
										</div>
										<div class="action">
											<button type="button" class="btn btn-sm btn-danger btn-delete-img"><i class="bi bi-trash3"></i></button>
										</div>
									</div>
								</div>
								<?php } ?>

							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade show w-100" id="v-pills-tim" role="tabpanel" aria-labelledby="v-pills-tim-tab" tabindex="0">
					<form id="person">
						<div class="row">
							<div class="col-md-6">
								<div class="list-group" id="person-list">
									<div class="w-100 bg-gradient">
										<p class="text-muted text-center">Tidak ada data</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="" class="form-label">Nama</label>
									<input type="text" class="form-control form-control-sm" name="person-name" id="">
								</div>
								<div class="mb-3 row">
									<div class="col-md-9">
										<label for="" class="form-label">Jabatan</label>
										<input type="text" class="form-control form-control-sm" name="person-position" id="">
									</div>
									<div class="col-md-3">
										<label for="" class="form-label">Urutan</label>
										<input type="number" class="form-control form-control-sm" name="person-num" id="">
									</div>
								</div>
								<div class="mb-3 row">
									<div class="col-md-6">
										<div class="card">
											<div class="image-holder text-center" id="person" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
												<div class="pt-3">
													<p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
													<span class="m-0 p-0">Add Image / Drop Here </span>
												</div>
											</div>
											<input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
											<input type="hidden" class="img-base64 d-non" name="img-base64-person">
										</div>
										<div class="mb-3 form-text">
											Pastikan ukuran gambar tidak melebihi 2048px atau lebih dari 4mb
										</div>                    
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="" class="form-label">Facebook</label>
											<input type="text" class="form-control form-control-sm person-links" name="facebook" id="">
										</div>
										<div class="mb-3">
											<label for="" class="form-label">Instagram</label>
											<input type="text" class="form-control form-control-sm person-links" name="instagram" id="">
										</div>
										<div class="mb-3">
											<label for="" class="form-label">LinkedIn</label>
											<input type="text" class="form-control form-control-sm person-links" name="linkedin" id="">
										</div>
									</div>
								</div>
								<button class="mt-3 btn btn-sm btn-primary btn-submit" type="button"><i class="bi bi-upload"></i> Upload Image</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade show w-100" id="v-pills-partner" role="tabpanel" aria-labelledby="v-pills-partner-tab" tabindex="0">
					<form id="partnership">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="" class="form-label">Judul</label>
									<input type="text" class="form-control form-control-sm" name="partnershiptitle" id="partnershiptitle">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Sub Judul</label>
									<input type="text" class="form-control form-control-sm" name="partnershipsubtitle" id="partnershipsubtitle">
								</div>
								<div class="mb-3">
									<label for="" class="form-label">Deskripsi</label>
									<textarea class="tiny form-control form-control-sm" name="partnershipcontent" id="partnershipcontent"></textarea>
								</div>
								<button class="btn btn-sm btn-primary btn-submit" type="button">Simpan Informasi Kemitraan</button>
							</div>
							<div class="col-md-6">
								<label for="basic-url" class="form-label">Kontak Bagian Kemitraan</label>
								<?php
									for($i=0;$i<3;$i++){
								?>
								<div class="mb-3">
									<div class="input-group mb-2 partnershipcontact">
										<input type="text" class="form-control label" id="basic-url" placeholder="label" aria-describedby="basic-addon3 basic-addon4">
										<input type="text" class="form-control no" id="basic-url" placeholder="62XXXXXXX whatsapp" aria-describedby="basic-addon3 basic-addon4">
										<button type="button" title="delete" class="btn btn-sm btn-danger btn-delete"><i class="bi bi-x-lg"></i></button>
									</div>
								</div>
								<?php
									}
								?>
								<div class="col-md-row">
									<div class="col-md-4">
										<div class="card">
											<div class="row">
												<div class="col-md-12 border-black">
													<div class="image-holder text-center" id="partnershipimg" style="overflow:hidden;height:150px;width:100%;object-fit: cover;">
														<div class="pt-3">
															<p class="m-0 p-0"><i style="font-size:50px" class="bi bi-camera"></i></p>
															<span class="m-0 p-0">Add Image / Drop Here </span>
														</div>
													</div>
													<input type="file" class="img-file" name="img-file" style="position:absolute;top:0px;left:0;width:100%;height:100%;opacity:0;z-index:9">
													<input type="hidden" class="img-base64 d-non" name="img-base64-partnership">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function loadData(id){
		var params = {}
		if(id != null || id != ""){
			params.id = id;	
		}

		$.post('?get=data', {params}, function(result){
			var x	= JSON.parse(result);

			if(x.status == true){
				var person_list	= ``;
				var company_list	= ``;
				$.each(x.result.person, function (k,v){

					person_list += `<div class="list-group-item list-group-item-action" aria-current="true">
									<div class="d-flex w-100 justify-content-between">
										<div class="mx-auto" style="height:100px;overflow:hidden">
											<img src="<?php echo base_url(); ?>${(v.photo ?? '')}" class="img-thumbnail" style="width:100px">
										</div>
										<div class="text-left w-50"> 
											<h5 class="mb-1">${v.name}</h5>
											<small class="text-muted">${v.position}</small>
										</div>
										<div class="w-25 text-center">
											<button type="button" data-id="${v.id}" class="btn btn-sm btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#appModal"><i class="bi bi-trash"></i></button>
										</div>
									</div>
								</div>`;

				});

				if(x.result.person.length > 0){
					$('#person-list').html(person_list);
				}

				$.each(x.result.site, function (k,v){
					$("[name='"+(v.code).replace(/\%/g, '')+"']").val(v.value);
					if(v.code == '%logo%'){
						let img = `<img src="<?php echo base_url(); ?>${v.value}" class="w-100">`;
						$("#logo.image-holder").html(img);
					}else if(v.code == '%socmed%'){
						let socmed = JSON.parse(v.value);
						$.each(socmed, function(k1,v1){
							$(".socmed[name='"+v1.name+"']").val(v1.value);
						});
					}

					if($('#' + (v.code).replace(/\%/g, '')).hasClass('tiny')){
						tinymce.get((v.code).replace(/\%/g, '')).setContent(v.value); 
					}
				});

				$.each(x.result.profile, function (k,v){
					$("[name='"+(v.code).replace(/\%/g, '')+"']").val(v.value);
					if(v.code == '%visiimg%'){
						let img = `<img src="<?php echo base_url(); ?>${v.value}" class="w-100">`;
						$("#visi.image-holder").html(img);
					}
					if(v.code == '%misiimg%'){
						let img = `<img src="<?php echo base_url(); ?>${v.value}" class="w-100">`;
						$("#misi.image-holder").html(img);
					}
					if(v.code == '%profileimg%'){
						let img = `<img src="<?php echo base_url(); ?>${v.value}" class="w-100">`;
						$("#profile.image-holder").html(img);
					}

					if($('textarea#' + (v.code).replace(/\%/g, '')).hasClass('tiny')){
						tinymce.get((v.code).replace(/\%/g, '')).setContent(v.value); 
					}
				});

				$.each(x.result.partnership, function (k,v){
					$("[name='"+(v.code).replace(/\%/g, '')+"']").val(v.value);

					if(v.code == '%partnershipcontact%'){
						var contact = JSON.parse(v.value);
						$.each(contact , function(k1, v1){
							$('.partnershipcontact .label').eq(k1).val(v1.label);
							$('.partnershipcontact .no').eq(k1).val(v1.no);
						})
					}
					if(v.code == '%partnershipimg%'){
						let img = `<img src="<?php echo base_url(); ?>${v.value}" class="w-100">`;
						$("#partnershipimg.image-holder").html(img);
					}

					if($('textarea#' + (v.code).replace(/\%/g, '')).hasClass('tiny')){
						tinymce.get((v.code).replace(/\%/g, '')).setContent(v.value); 
					}
				});


				$.each(x.result.companies, function(k,v){
					company_list += `<tr>
								<td>${v.name}</td>
								<td>${v.address}</td>
								<td>${v.email}</td>
								<td class="text-center">${(v.maps == '' ? '<i class="bi bi-x text-danger fw-bold"></i>' : '<i class="bi bi-check2 text-success fw-bold"></i>')}</td>
								<td>${v.created_at}</td>
								<td>
									<button type="button" data-id="${v.id}" class="btn btn-sm btn-light btn-edit"><i class="bi bi-pencil"></i> Edit</button>
									<button type="button" data-id="${v.id}" class="btn btn-sm btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#appModal"><i class="bi bi-trash3"></i> Delete</button>
								</td>
							</tr>`;
				});

				if(x.result.companies.length == 0){
					company_list += `<tr>
								<td colspan="7" class="text-center">Tidak ada data</td>
							</tr>`;
				}
				$("#table-companies tbody").html(company_list);
				$('.xtable').dataTable();

			}
		});
	}

    $(document).on('click', 'form#site .btn-delete', function(){
		console.log($(this).closest('.input-group').find('.socmed'));
		if($(this).closest('.input-group').find('.socmed').val() !== ''){
			$("#appModal").modal('show');
			$("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-info fs-1"></i> Informasi`);
	        $("#appModal .modal-body").html(`Menghapus link sosial media tidak akan tersimpan selama belum menekan tombol simpan`);
	        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-light" data-bs-dismiss="modal">Saya Mengerti</a>`);
			$(this).closest('.input-group').find('.socmed').val('');
		}
	});

    $(document).on('click', 'form#partnership .btn-delete', function(){
		if($(this).closest('.input-group').find('.no').val() !== '' || $(this).closest('.input-group').find('.label').val() !== ''){
			$("#appModal").modal('show');
			$("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-info fs-1"></i> Informasi`);
	        $("#appModal .modal-body").html(`Menghapus link sosial media tidak akan tersimpan selama belum menekan tombol simpan`);
	        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-light" data-bs-dismiss="modal">Saya Mengerti</a>`);
			$(this).closest('.input-group').find('.no').val('');
			$(this).closest('.input-group').find('.label').val('');
		}
	});

    $(document).on('click', 'form#company .btn-delete-img', function(){
		if($(this).closest('.card').find('.company-images').val() !== ''){
			$("#appModal").modal('show');
			$("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-info fs-1"></i> Informasi`);
	        $("#appModal .modal-body").html(`Menghapus foto kantor tidak akan tersimpan selama belum menekan tombol simpan`);
	        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-light" data-bs-dismiss="modal">Saya Mengerti</a>`);
			$(this).closest('.card').find('.company-images').val('');
			$(this).closest('.card').find('.image-holder').html('');
		}else{

		}
	});
		
	$(document).on('click', 'form#company .btn-delete', function(){
        var id  = $(this).data('id');

        $("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i> Konfirmasi`);
        $("#appModal .modal-body").html(`Lanjutkan menghapus informasi perusahaan? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete-company">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).on('click', 'form#person .btn-delete', function(){
        var id  = $(this).data('id');
        $("#appModal .modal-title").html(`<i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i> Konfirmasi`);
        $("#appModal .modal-body").html(`Lanjutkan menghapus dari struktur organisasi? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete-person">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).on('click', '.btn-confirm-delete-person', function(e){
        var id  = $('.modal [name=id]').val();

		$.post('?do=delete-person', {id : id}, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			loadData();
			$("#appModal").modal('hide');
		});
	});

    $(document).on('click', '.btn-confirm-delete-company', function(e){
        var id  = $('.modal [name=id]').val();

		$.post('?do=delete-company', {id : id}, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			loadData();
			$("#appModal").modal('hide');
		});
	});
	
    $(document).on('click', 'form#company .btn-edit', function(e){
		var id	= $(this).data('id');

		$(".company-contact").val('');
		$(".company-phone").val('');
		$(".company-label").val('');
		$('[name=company-name]').val('');
		$('[name=company-address]').val('');
		$('[name=company-email]').val('');
		$('[name=company-maps]').val('');
		$("form#company .image-holder").html(``);
		$("form#company .company-images").val(``);

        $.post('?get=data', null, function(result){
            var x   	= JSON.parse(result);
            var data	= x.result.companies;

			$("form#company").attr('action','?do=save-company&id='+id);
			$.each(data, function(k,v){
				if(v.id == id){
					$('[name=company-name]').val(v.name);
					$('[name=company-building]').val(v.building);
					$('[name=company-address]').val(v.address);
					$('[name=company-email]').val(v.email);
					$('[name=company-maps]').val(v.maps);
					$.each(JSON.parse(v.contacts), function(k1,v1){
						$(".company-contact").eq(k1).val(v1.name);
						$(".company-phone").eq(k1).val(v1.value);
						$(".company-label").eq(k1).val(v1.label);
					});
					$.each(JSON.parse(v.images), function(k1,v1){
						if(v1.value != "" && v1.value != null){
							$("form#company .image-holder").eq(k1).html(`<img src='<?php echo base_url(); ?>${v1.value}' style='width:100%'>`);
							$("form#company .company-images").eq(k1).val(v1.value);
						}
					});
				}
			});
		});
	});

    $(document).on('click', 'form#company .btn-reset', function(e){
		$("form#company .form-control").val('');
		$("form#company .image-holder").html('');
		$('.img-base64').val('');
		$("form#company").attr('action','?do=save-company');
	});

    $(document).on('click', 'form#company .btn-submit', function(e){
        var param = {}; 
		var contacts = [];
		var images	= [];

		$.each($(".company-contact"), function(k,v){
			var contacttype		= $(".company-contact").eq(k).val();
			var contactphone	= $(".company-phone").eq(k).val();
			var contactlabel	= $(".company-label").eq(k).val();
			if(contactphone != ""){
				contacts.push({'name' : contacttype, 'value' : contactphone, 'label' : contactlabel});
			}
		});

		$.each($(".company-images").serializeArray(), function(k,v){
			images.push({'name' : v.name, 'value' : v.value});
		});

		param.name		= $("[name=company-name]").val();
		param.building	= $("[name=company-building]").val();
		param.address	= $("[name=company-address]").val();
		param.contacts	= contacts;
		param.email		= $("[name=company-email]").val();
		param.maps		= $("[name=company-maps]").val();
		param.images	= images;

        $.post($("form#company").attr('action'), param, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			loadData();

			if(x.status == true){
				$("form#company .form-control").val('');
				$("form#company .image-holder").html('');
				$("form#company").attr('action','?do=save-company');
			}
		});
	});

    $(document).on('click', 'form#profile .btn-submit', function(e){
        tinyMCE.triggerSave();

		var param = {}; 
		param.visi		= $("[name=visi]").val();
		param.visiimg	= $("[name=img-base64-visi]").val();

		param.misi		= $("[name=misi]").val();
		param.misiimg	= $("[name=img-base64-misi]").val();

		param.profile		= $("[name=profile]").val();
		param.profileimg	= $("[name=img-base64-profile]").val();

        $.post('?do=save-profile', param, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
		});
	});

	$(document).on('click', 'form#site .btn-submit', function(e){
        var param = {}; 
		param.company	= $("[name=company]").val();
		param.title	= $("[name=title]").val();
		param.keywords	= $("[name=keywords]").val();
		param.description	= $("[name=description]").val();
		param.logo	= $("[name=img-base64-logo]").val();
		param.socmed	= $(".socmed").serializeArray();

        $.post('?do=save-site', param, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
		});
	});

	$(document).on('click', 'form#person .btn-submit', function(e){
        var param = {}; 
		param.name			= $("[name=person-name]").val();
		param.position		= $("[name=person-position]").val();
		param.num			= $("[name=person-num]").val();
		param.links			= $(".person-links").serializeArray();
		param.photo			= $("[name=img-base64-person]").val();

        $.post('?do=save-person', param, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			loadData();
		});
	});

	$(document).on('click', 'form#partnership .btn-submit', function(e){
        var param = {}; 
		param.partnershiptitle			= $("[name=partnershiptitle]").val();
		param.partnershipsubtitle		= $("[name=partnershipsubtitle]").val();
		param.partnershipcontent		= tinymce.get("partnershipcontent").getContent();
		param.partnershipimg			= $("[name=img-base64-partnership]").val();

		contact	= [];
		$.each($("form#partnership .partnershipcontact"), function(k,v){
			if($(this).find('.no').val() != ''){
				contact.push({'label' : $(this).find('.label').val(), 'no' : $(this).find('.no').val()});
			}
		});
		param.partnershipcontact	= JSON.stringify(contact);

        $.post('?do=save-partnership', param, function(result){
			var x = JSON.parse(result);
            msg(x.msg,(x.status == false ? 'danger' : 'primary'));
			loadData();
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