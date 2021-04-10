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
						<div class="card-title">Danh sách người dùng</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
								<thead>
									<tr class="border-bottom-0">
										<th class="wd-15p">#</th>
										<th class="wd-15p">Tên đăng nhập</th>
										<th class="wd-15p">Họ và tên</th>
										<th class="wd-20p">Loại người dùng</th>
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
						<label for="recipient-name" class="form-control-label">Tên đăng nhập:</label>
						<input type="text" class="form-control" id="username" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Họ và tên</label>
						<input type="text" class="form-control" id="fullname" required="required">
					</div>
					<label for="message-text" class="form-control-label">Loại người dùng</label>
					<select id="typeUser" class="form-control" required="required">
						<option value="admin">Quản lý</option>
						<option value="bep">NV bếp</option>
						<option value="nhanvien">Nhân viên</option>
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
						<label for="recipient-name" class="form-control-label">Tên đăng nhập:</label>
						<input type="text" disabled="" class="form-control" id="update_username" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Họ và tên</label>
						<input type="text" class="form-control" id="update_fullname" required="required">
					</div>
					<label for="message-text" class="form-control-label">Loại người dùng</label>
					<select id="update_typeUser" class="form-control" required="required">
						<option value="admin">Quản lý</option>
						<option value="bep">NV bếp</option>
						<option value="nhanvien">Nhân viên</option>
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
	} );
	$('#add_new').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataAdd = new Object();
		dataAdd.username = $('#username').val();
		dataAdd.fullName = $('#fullname').val();
		dataAdd.type = $('#typeUser').val();
		var dataAddJson = JSON.stringify(dataAdd);
		$.ajax({
			url: "<?= base_url('Nguoidung/add') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataAddJson},
			success: function(d){
				if (d == 1) {
					alert('Thêm thành công ^_^!');
					$('#them').modal('hide');
					$("#example").DataTable().ajax.reload();
				}else if(d == 2){
					alert('Username này đã tồn tại rồi -_-!');

					$('#username').val('');
					$('#username').focus();
				}else{
					alert('Lỗi rồi -_-!');
					$('#them').modal('hide');
				}
			}
		});
	});
	$('#edit_form').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataEdit = new Object();
		dataEdit.id = $('#update_id').val();
		dataEdit.fullName = $('#update_fullname').val();
		dataEdit.type = $('#update_typeUser').val();
		var dataEditJson = JSON.stringify(dataEdit);
		$.ajax({
			url: "<?= base_url('Nguoidung/update') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataEditJson},
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
	function initList(){
		list =  $('#example').DataTable({
			"processing": true,
            "destroy": true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('cursor-pointer');
            },
            "ajax": {
                url: "<?= base_url('Nguoidung/getList') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,1,2,3] },
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
                    'targets': [4,5]
                },
                {
		            "targets": -1,
		            "data": null,
		            "defaultContent": "<button id='delete' class='btn btn-danger waves-effect btn-sm'>Xoá</button>   "
		        },
		        {
		            "targets": -2,
		            "data": null,
		            "defaultContent": "<button id='edit' class='btn btn-info waves-effect btn-sm'>Sửa</button> <button id='resetPass' class='btn btn-warning waves-effect btn-sm'>Reset Pwd</button>   "
		        },
		        {
		        	 "targets": 3,
		        	 'data': 'status',
		        	'render': function ( data ) {
		        		if (data == 'admin') {
		        			return '<span class="badge badge-warning">Quản lý</span>';
		        		}else if(data == 'bep'){
		        			return '<span class="badge badge-primary">Nhà bếp</span>';
		        		}else if(data == 'nhanvien'){
		        			return '<span class="badge badge-info">Nhân viên</span>';
		        		}
		        	}
		        }
		        //<button id='delete' class='btn btn-danger btn-sm'>Xoá</button>
            ],
            'columns': [
                {
                    'width': '5%',
                    'data': 'id'
                }, {
                    'data': 'username'
                }, {
                    'data': 'fullName'
                },{
                    'data': 'type'
                },
                {
                	'width': '15%'	
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
					url: "<?= base_url('Nguoidung/delete') ?>",
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function(d){
						if (d == 1) {
							alert('Xoá user thành công ^_^!');
							$("#example").DataTable().ajax.reload();
						}else{
							alert('Lỗi rồi -_-!');
						}
					}
				});
	        }
	        
	    });
	    $('#example tbody').on( 'click', 'button#resetPass', function () {
    		var data = list.row( $(this).parents('tr') ).data();
	        var id = data['id'];
	        //reset editForm before show another prj
	        //$('#editForm')[0].reset();
	        if (confirm('Đồng ý reset mật khẩu????')) {
	        	$.ajax({
					url: "<?= base_url('Nguoidung/resetPwd') ?>",
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function(d){
						if (d == 1) {
							alert('Reset mật khẩu thành công ^_^! mật khẩu mới : 123456');
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
			url: '<?= base_url("Nguoidung/getOne") ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(d){
				$('#update_id').val(d.id);
				$('#update_username').val(d.username);
				$('#update_fullname').val(d.fullName);
				$('#update_typeUser').val(d.type);
			}
		});
		
	}
</script>