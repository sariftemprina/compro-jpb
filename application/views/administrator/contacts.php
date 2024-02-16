<div class="row">
	<div class="col-md-12">
		<div class="align-items-start">
            <ul class="list-group" id="listContact">
                <li class="list-group-item">Tidak ada kontak. <a href="javascript:void()">Tambah Baru</a></li> 
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
                            <div class="row">
                                <div class="col-10 px-3 border-end">
                                    <div class="card-body">
                                        <h4 class="card-title">${v.name} </h4>
                                        <div class="row">
                                            <div class="col-md-8 px-3 border-end">
                                                <small class="text-secondary">${v.position} - ${v.institutions}</small>
                                            </div>
                                            <div class="col-md-2 px-3 align-top text-left">
                                                <small class="text-secondary"><i class="bi bi-telephone"></i> ${v.phone}</small>
                                            </div>
                                            <div class="col-md-2 px-3 align-top text-left">
                                                <small class="text-secondary"><i class="bi bi-whatsapp"></i> ${v.whatsapp}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    ${btn} 
                                </div>
                            </div>
                    </li>`;
                });
                $("#listContact").html(list);
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
        $("#appModal .modal-body").html(`Lanjutkan menghapus kontak? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });


    $(document).ready(function(){
        loadData();
    });
</script>