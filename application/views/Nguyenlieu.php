<div>
	<div class="container">
		<div class="page-header">
			<h4 class="page-title"><?= $curPage ?></h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $curPage ?></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Danh sách nguyên liệu</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
								<thead>
									<tr class="border-bottom-0">
										<th class="wd-15p">#</th>
										<th class="wd-15p">Tên</th>
										<th class="wd-10p">Số lượng</th>
										<th class="wd-10p">Đơn vị tính</th>
										<th class="wd-15p">Chi phí</th>
										<th class="wd-10p">Chỉnh sửa</th>
										<th class="wd-25p">Xoá</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>
					<!-- table-wrapper -->
				</div>
				<!-- section-wrapper -->
			</div>
		</div>
	</div>
</div>
<!-- Thêm Modal -->
<div id="them" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header pd-x-20">
				<h6 class="modal-title">Thêm</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="add_new">
				<div class="modal-body pd-20">
				
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Tên nguyên liệu:</label>
						<input type="text" class="form-control" id="name" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Số lượng</label>
						<input type="number" class="form-control" id="soluong" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Chi phí</label>
						<input type="number" class="form-control" id="chiphi" required="required">
					</div>
					<label for="message-text" class="form-control-label">Đơn vị tính</label>
					<select id="donvi" class="form-control" required="required">
						<option value="Chai">Chai</option>
						<option value="Kgs">Kgs</option>
					</select>
					
				</div><!-- modal-body -->
			
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Lưu</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</form>
		</div>
	</div><!-- modal-dialog -->
</div><!-- modal -->


<!-- Sửa Modal -->
<div id="sua" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header pd-x-20">
				<h6 class="modal-title">Sửa</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="edit_form">
				<div class="modal-body pd-20">
					<input type="hidden" id="update_id">
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Tên nguyên liệu:</label>
						<input type="text" class="form-control" id="update_name" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Số lượng</label>
						<input type="number" class="form-control" id="update_soluong" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Chi phí</label>
						<input type="number" class="form-control" id="update_chiphi" required="required">
					</div>
					<label for="message-text" class="form-control-label">Đơn vị tính</label>
					<select id="update_donvi" class="form-control" required="required">
						<option value="Chai">Chai</option>
						<option value="Kgs">Kgs</option>
					</select>
					
				</div><!-- modal-body -->
			
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Lưu</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</form>
		</div>
	</div><!-- modal-dialog -->
</div><!-- modal -->
<script>
	$(function(e) {
		initList();
	});
	$('#edit_form').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataUpdate = new Object();
		dataUpdate.id = $('#update_id').val();
		dataUpdate.tenNguyenLieu = $('#update_name').val();
		dataUpdate.soLuong = $('#update_soluong').val();
		dataUpdate.chiPhi = $('#update_chiphi').val();
		dataUpdate.donViTinh = $('#update_donvi').val();
		var dataUpdateJson = JSON.stringify(dataUpdate);
		$.ajax({
			url: "<?= base_url('Nguyenlieu/update') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataUpdateJson},
			success: function(d){
				if (d == 1) {
					alert('Cập nhật thành công ^_^!');
					$('#sua').modal('hide');
					$("#example").DataTable().ajax.reload();
				}else{
					alert('Lỗi rồi -_-!');
					$('#sua').modal('hide');
				}
			}
		});
	});
	$('#add_new').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataAdd = new Object();
		dataAdd.tenNguyenLieu = $('#name').val();
		dataAdd.soLuong = $('#soluong').val();
		dataAdd.chiPhi = $('#chiphi').val();
		dataAdd.donViTinh = $('#donvi').val();
		var dataAddJson = JSON.stringify(dataAdd);
		$.ajax({
			url: "<?= base_url('Nguyenlieu/add') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataAddJson},
			success: function(d){
				if (d == 1) {
					alert('Thêm thành công ^_^!');
					$('#them').modal('hide');
					$("#example").DataTable().ajax.reload();
				}else if(d == 2){
					alert('Nguyên liệu này đã có rồi -_-!');

					$('#username').val('');
					$('#username').focus();
				}else{
					alert('Lỗi rồi -_-!');
					$('#them').modal('hide');
				}
			}
		});
	});
	function initList(){
		list =  $('#example').DataTable({
			"processing": true,
            "destroy": true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('cursor-pointer');
            },
            "ajax": {
                url: "<?= base_url('Nguyenlieu/getList') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,1,2,3,4] },
                    className: 'btn btn-success',
	                filename: 'Danh sách người dùng',
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    }
	            },
                {
                    text: "Thêm mới",
                    className: 'btn btn-primary',
                    action: function (e) {
                        $('#them').modal('show');
                        $('#add_new')[0].reset();
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    }
                }, 
            ],
            'pageLength': 10,
            'lengthChange': false,
            'autoWidth': false,
            'scrollX': true,
            'language': {
                'lengthMenu': 'Hiển thị _MENU_ dòng mỗi trang',
                'zeroRecords': 'Không tìm thấy giá trị nào',
                'info': 'Đang hiển thị trang _PAGE_ của _PAGES_',
                'infoEmpty': 'Không có dòng nào để hiển thị',
                'infoFiltered': '(Đã lọc trong _MAX_ tổng số dòng)'
            },
            'order': [
                [0, 'asc']
            ],
            'columnDefs': [
                {
                    'searchable': false,
                    'orderable': false,
                    'targets': [5,6]
                },
                {
		            "targets": -1,
		            "data": null,
		            "defaultContent": "<button id='delete' class='btn btn-danger waves-effect btn-sm'>Xoá</button>   "
		        },
		        {
		            "targets": -2,
		            "data": null,
		            "defaultContent": "<button id='edit' class='btn btn-info waves-effect btn-sm'>Sửa</button> "
		        }
            ],
            'columns': [
                {
                    'width': '5%',
                    'data': 'id'
                }, {
                    'data': 'tenNguyenLieu'
                }, {
                    'data': 'soLuong'
                }, {
                    'data': 'donViTinh'
                },{
                    'data': 'chiPhi'
                },
                {
                	'width': '10%'	
                },
                {
                	'width': '10%'	
                }
            ]
		});

		$('#example tbody').on( 'click', 'button#edit', function () {
    		var data = list.row( $(this).parents('tr') ).data();
	        var id = data['id'];
	       
	        $('#edit_form')[0].reset();
	        $('#sua').modal('show');
	        initFormEdit(id);
	        
	    });
	    $('#example tbody').on( 'click', 'button#delete', function () {
    		var data = list.row( $(this).parents('tr') ).data();
	        var id = data['id'];
	        //reset editForm before show another prj
	        //$('#editForm')[0].reset();
	        if (confirm('Đồng ý xoá????')) {
	        	$.ajax({
					url: "<?= base_url('Nguyenlieu/delete') ?>",
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function(d){
						if (d == 1) {
							alert('Xoá nguyên liệu thành công ^_^!');
							$("#example").DataTable().ajax.reload();
						}else{
							alert('Lỗi rồi -_-!');
						}
					}
				});
	        }
	        
	    });
	    
	}
	function initFormEdit(id){
		$.ajax({
			url: '<?= base_url("Nguyenlieu/getOne") ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(d){
				$('#update_id').val(d.id);
				$('#update_donvi').val(d.donViTinh);
				$('#update_chiphi').val(d.chiPhi);
				$('#update_soluong').val(d.soLuong);
				$('#update_name').val(d.tenNguyenLieu);
			}
		});
		
	}
</script>