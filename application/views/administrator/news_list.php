<div class="row">
	<div class="col-md-12">
		<div class="align-items-start table-responsive datatable-custom">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer xtable" id="tableNews">
                <thead>
                    <tr>
                        <th style="width:50px"></th>
                        <th>Judul</th>
                        <th>Category</th>
                        <th>Penulis</th>
                        <th style="width:100px">Status</th>
                        <th style="width:200px">Tgl Ditulis</th>
                        <th style="width:200px"><i class="bi bi-three-dots"></i></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function loadData(){
        $.post('?get=data', {}, function(result){
            var x   = JSON.parse(result);
            var tbl = ``;
            $.each(x.result, function(k,v){
                tbl += `<tr>
                            <td class="text-center">${k+1}</td>
                            <td>${v.title}</td>
                            <td>${v.category}</td>
                            <td>${v.author}</td>
                            <td class="text-center">${(v.published == '0' ? '<span class="badge bg-secondary">Draft</span>' : '<span class="badge bg-success">Published</span>')}</td>
                            <td>${v.created_at}</td>
                            <td class="text-center">
                                <a title="edit" href="form?id=${v.id}" class="btn btn-xs btn-light mx-2"><i class="bi bi-pencil"></i></a>
                                <a title="delete" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appModal" data-id="${v.id}" class="btn btn-xs btn-danger mx-2 btn-delete"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>`;
            });
            $("#tableNews tbody").html(tbl);
            $('.xtable').dataTable();

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
        $("#appModal .modal-body").html(`Lanjutkan menghapus artikel? <input type="hidden" name="id" value="${id}">`);
        $("#appModal .modal-footer").html(`<a class="btn btn-sm btn-danger btn-confirm-delete">Ya</a> <a class="btn btn-sm btn-light" data-bs-dismiss="modal">Batalkan</a>`);
    });

    $(document).ready(function(){
        loadData();
    });
</script>