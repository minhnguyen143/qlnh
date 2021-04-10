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
						<div class="card-title">Data Tables</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
								<thead>
									<tr class="border-bottom-0">
										<th class="wd-15p">#</th>
										<th class="wd-15p">Hình</th>
										<th class="wd-15p">Tên món</th>
										<th class="wd-20p">Số lượng</th>
										<th class="wd-15p">Giá</th>
										<th class="wd-10p">Nguyên liệu</th>
										<th class="wd-25p">Mô tả</th>
										<th class="wd-25p">Chỉnh sửa</th>
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
			<form id="add_new" enctype="multipart/form-data">
				<div class="modal-body pd-20">
				
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Tên món</label>
						<input type="text" class="form-control" id="name" name="tenMon" required="required">
					</div>
					<div class="form-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="hinh" id="hinh" accept=".jpg, .png">
							<label class="custom-file-label">Chọn file</label>
						</div>
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Số lượng</label>
						<input type="number" class="form-control" id="soluong" name="soluong" required="required">
					</div>
					<div class="form-group">
						<label for="gia" class="form-control-label">Giá</label>
						<input type="number" class="form-control" id="gia" name="gia" required="required">
					</div>
					<div class="form-group">
						<label for="nguyenlieu" class="form-control-label">Nguyên liệu</label>
						<select id="nguyenlieu"  class="select2 form-control" multiple="multiple"></select>
					</div>
					<div class="form-group">
						<label for="mota" class="form-control-label">Mô tả</label>
						<textarea class="form-control" id="mota" name="mota"></textarea>
					</div>
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
			<form id="edit_form" enctype="multipart/form-data">
				<div class="modal-body pd-20">
					<input type="hidden" id="update_id">
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Tên món</label>
						<input type="text" class="form-control" id="update_name" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Số lượng</label>
						<input type="number" class="form-control" id="update_soluong" required="required">
					</div>
					<div class="form-group">
						<label for="gia" class="form-control-label">Giá</label>
						<input type="number" class="form-control" id="update_gia" required="required">
					</div>
					<div class="form-group">
						<label for="nguyenlieu" class="form-control-label">Nguyên liệu</label>
						<select id="update_nguyenlieu" class="select2 form-control" multiple="multiple"></select>
					</div>
					<div class="form-group">
						<label for="mota" class="form-control-label">Mô tả</label>
						<textarea class="form-control" id="update_mota"></textarea>
					</div>
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
		$("#nguyenlieu").select2({
            placeholder: "Chọn nguyên liệu",
            allowClear: true,
            val: '',
            data: getDataNguyenLieu()
        });
        $("#update_nguyenlieu").select2({
            placeholder: "Chọn nguyên liệu",
            allowClear: true,
            val: '',
            data: getDataNguyenLieu()
        });
	});
	$('#edit_form').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataEdit = new Object();
		dataEdit.id = $('#update_id').val();
		dataEdit.tenMon = $('#update_name').val();
		dataEdit.soluong = $('#update_soluong').val();
		dataEdit.moTa = $('#update_mota').val();
		dataEdit.gia = $('#update_gia').val();
		dataEdit.nguyenlieu = $('#update_nguyenlieu').val();
		var dataEditJson = JSON.stringify(dataEdit);
		$.ajax({
			url: "<?= base_url('Monan/update') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataEditJson},
			success: function(d){
				if (d == 1) {
					alert('Cập nhật thành công ^_^!');
					$('#sua').modal('hide');
					$("#example").DataTable().ajax.reload();
				}else if(d == 3){
					alert('Không đủ nguyên liệu -_-!');

					$('#update_soluong').val('');
					$('#update_soluong').focus();
				}else{
					alert('Lỗi rồi -_-!');
					$('#sua').modal('hide');
				}
			}
		});
		
	});
	// $('#add_new').on('submit', function(event) {
	// 	event.preventDefault();
	// 	/* Act on the event */
	// 	//file
		
	// 	var dataAdd = new Object();
	// 	dataAdd.tenMon = $('#name').val();
	// 	dataAdd.soluong = $('#soluong').val();
	// 	dataAdd.moTa = $('#mota').val();
	// 	dataAdd.gia = $('#gia').val();
	// 	dataAdd.nguyenlieu = $('#nguyenlieu').val();
	// 	var dataAddJson = JSON.stringify(dataAdd);
	// 	$.ajax({
	// 		url: "<?= base_url('Monan/add') ?>",
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		data: {data: dataAddJson},
	// 		success: function(d){
	// 			if (d == 1) {
	// 				alert('Thêm thành công ^_^!');
	// 				$('#them').modal('hide');
	// 				$("#example").DataTable().ajax.reload();
	// 			}else if(d == 2){
	// 				alert('Món ăn này đã tồn tại rồi -_-!');

	// 				$('#name').val('');
	// 				$('#name').focus();
	// 			}else if(d == 3){
	// 				alert('Không đủ nguyên liệu -_-!');

	// 				$('#soluong').val('');
	// 				$('#soluong').focus();
	// 			}else{
	// 				alert('Lỗi rồi -_-!');
	// 				$('#them').modal('hide');
	// 			}
	// 		}
	// 	});
	// });
	$('#add_new').on('submit', function(event) {
		event.preventDefault();
		let formData = new FormData(this);
		formData.append('nguyenLieu', $('#nguyenlieu').val());
		$.ajax({
			url: "<?= base_url('Monan/add') ?>",
			method:'POST',  
            data:formData,
            contentType:false,
            processData:false,
			success: function(d){
				if (d == 1) {
					alert('Thêm thành công ^_^!');
					$('#them').modal('hide');
					$("#example").DataTable().ajax.reload();
				}else if(d == 2){
					alert('Món ăn này đã tồn tại rồi -_-!');

					$('#name').val('');
					$('#name').focus();
				}else if(d == 3){
					alert('Không đủ nguyên liệu -_-!');

					$('#soluong').val('');
					$('#soluong').focus();
				}else{
					alert('Lỗi rồi -_-!');
					$('#them').modal('hide');
				}
			}
		});
	});

	function getDataNguyenLieu() {
        var nguyenLieu = '';
        $.ajax({
            url: '<?= base_url('nguyenlieu/getSelect') ?>',
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function (d) {
                nguyenLieu = d;
                
            }
        });
        return nguyenLieu;
    }
	function initList(){
		list =  $('#example').DataTable({
			"processing": true,
            "destroy": true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('cursor-pointer');
            },
            "ajax": {
                url: "<?= base_url('Monan/getList') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,2,3,4,5,6] },
                    className: 'btn btn-success',
	                filename: 'Danh sách món ăn',
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
                    'targets': [1,7,8]
                },
                {
		            "targets": -1,
		            "data": null,
		            "defaultContent": "<button id='delete' class='btn btn-danger waves-effect btn-sm'>Xoá</button>   "
		        },
		        {
		            "targets": -2,
		            "data": null,
		            "defaultContent": "<button id='edit' class='btn btn-info waves-effect btn-sm'>Sửa</button> <button id='resetSL' class='btn btn-warning waves-effect btn-sm'>Reset SL</button>   "
		        },
		        {
		            "targets": 1,
		        	'data': 'hinh',
		        	'render': function ( data ) {
		        		console.log(data);
		        		if (data != "") {
		        			return '<span class="avatar brround avatar-md d-block" style="background-image: url(<?= base_url() ?>public/assets/images/products/'+data+')"></span>';
		        		}else{
		        			return '<span class="avatar brround avatar-md d-block" style="background-image: url(<?= base_url() ?>public/assets/images/products/monan.jpg)"></span>';
		        		}
		        	}
		        },

            ],
            'columns': [
                {
                    'width': '5%',
                    'data': 'id'
                }, {
                    'data': 'hinh'
                }, {
                    'data': 'tenMon'
                }, {
                    'data': 'soLuong'
                },{
                    'data': 'gia'
                },{
                    'data': 'nguyenLieu'
                },{
                    'data': 'moTa'
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
					url: "<?= base_url('Monan/delete') ?>",
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
	    $('#example tbody').on( 'click', 'button#resetSL', function () {
    		var data = list.row( $(this).parents('tr') ).data();
	        var id = data['id'];
	        //reset editForm before show another prj
	        //$('#editForm')[0].reset();
	        if (confirm('Đồng ý reset số lượng món ăn thành 0 ????')) {
	        	$.ajax({
					url: "<?= base_url('Monan/resetSoLuong') ?>",
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function(d){
						if (d == 1) {
							alert('Reset số lượng món ăn thành công ^_^!');
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
			url: '<?= base_url("Monan/getOne") ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(d){
				$('#update_id').val(d.id);
				$('#update_name').val(d.tenMon);
				$('#update_soluong').val(d.soLuong);
				$('#update_gia').val(d.gia);
				$('#update_mota').val(d.moTa);
				$('#update_nguyenlieu').val(d.nguyenlieu);
        		$('#update_nguyenlieu').select2().trigger('change');
			}
		});
		
	}
</script>