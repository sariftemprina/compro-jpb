<div class="row">
	<div class="col-xl-4">
		<div class="card" style="width:100%" id="news">
			<div class="card-body d-flex">
				<div class="w-25 text-center border-end px-4">
	                <h1 class="published">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Published</p>
				</div>
				<div class="w-25 text-center border-end px-4">
	                <h1 class="draft">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Draft</p>
				</div>
				<div class="w-50 px-4 text-center">
					<h4 class="mb-2 p-0">News and Artikel</h4>
					<a class="btn btn-xs" style="font-size:11px" href="<?php echo base_url('administrator/news/form'); ?>">Add New</a> |
					<a class="btn btn-xs" style="font-size:11px" href="<?php echo base_url('administrator/news/list'); ?>">Manage</a>
				</div>
			</div>
			<div class="card-footer text-center p-2">
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="card" style="width:100%" id="product">
			<div class="card-body d-flex">
				<div class="w-25 text-center border-end px-4">
	                <h1 class="published">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Published</p>
				</div>
				<div class="w-25 text-center border-end px-4">
	                <h1 class="draft">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Draft</p>
				</div>
				<div class="w-50 px-4 text-center">
					<h4 class="mb-2 p-0">Products Catalogues</h4>
					<a class="btn btn-xs" style="font-size:11px" href="<?php echo base_url('administrator/product/form'); ?>">Add New</a> |
					<a class="btn btn-xs" style="font-size:11px" href="<?php echo base_url('administrator/product/list'); ?>">Manage</a>
				</div>
			</div>
			<div class="card-footer text-center p-2">
			</div>
		</div>
	</div>
	<!-- <div class="col-xl-3">
		<div class="card" style="width:100%" id="gallery">
			<div class="card-body d-flex">
				<div class="w-25 text-center border-end">
	                <h1 class="published">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Published</p>
				</div>
				<div class="w-25 text-center border-end">
	                <h1 class="draft">0</h1>
					<p class="m-0 p-0" style="font-size:11px">Draft</p>
				</div>
				<div class="w-50 px-2">
					<p class="m-0 p-0">Gallery and Event</p>
					<a style="font-size:11px" href="<?php echo base_url('administrator/gallery/add'); ?>">Add New</a> |
					<a style="font-size:11px" href="<?php echo base_url('administrator/gallery/list'); ?>">Manage</a>
				</div>
			</div>
			<div class="card-footer text-center p-2">
			</div>
		</div>
	</div> -->
</div>
<script>
	$(document).ready(function(){
		$.post('<?php echo base_url('administrator/news'); ?>?get=count', {}, function(result){
			var x   	= JSON.parse(result);
			var list 	= ``;
			var data	= {}

			data.published = 0;
			data.draft = 0;
			if(x.result.length > 0){
				$.each(x.result, function(k,v){
					if(v.published == 0){
						data.draft = v.total;
					}
					if(v.published == 1){
						data.published = v.total;
					}
				});
				$('#news .published').text(data.published);
				$('#news .draft').text(data.draft);
			}
		});

		$.post('<?php echo base_url('administrator/product'); ?>?get=count', {}, function(result){
			var x   	= JSON.parse(result);
			var list 	= ``;
			var data	= {}

			data.published = 0;
			data.draft = 0;
			if(x.result.length > 0){
				$.each(x.result, function(k,v){
					if(v.published == 0){
						data.draft = v.total;
					}
					if(v.published == 1){
						data.published = v.total;
					}
				});
				$('#product .published').text(data.published);
				$('#product .draft').text(data.draft);
			}
		});

		$.post('<?php echo base_url('administrator/gallery'); ?>?get=count', {}, function(result){
			var x   	= JSON.parse(result);
			var list 	= ``;
			var data	= {}

			data.published = 0;
			data.draft = 0;
			if(x.result.length > 0){
				$.each(x.result, function(k,v){
					if(v.published == 0){
						data.draft = v.total;
					}
					if(v.published == 1){
						data.published = v.total;
					}
				});
				$('#gallery .published').text(data.published);
				$('#gallery .draft').text(data.draft);
			}
		});

	});
</script>