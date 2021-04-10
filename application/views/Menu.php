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
						<div class="card-title">Danh sách thực đơn</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
								<thead>
									<tr class="border-bottom-0">
										<th class="wd-15p">#</th>
										<th class="wd-15p">Thực đơn</th>
										<th class="wd-20p">Ngày</th>
										<th class="wd-15p">Tên Món</th>
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
						<label for="recipient-name" class="form-control-label">Tên thực đơn</label>
						<input type="text" class="form-control" id="name" required="required">
					</div>
					
					<div class="form-group">
						<label for="ngay" class="form-control-label">Ngày</label>
						<input class="form-control fc-datepicker" id="ngay" placeholder="DD/MM/YYYY" type="text">
					</div>
					<div class="form-group">
						<label for="monan" class="form-control-label">Món ăn</label>
						<select id="monan" class="select2 form-control" multiple="multiple"></select>
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
			<form id="edit_form">
				<div class="modal-body pd-20">
					<input type="hidden" id="update_id">
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Tên thực đơn</label>
						<input type="text" class="form-control" id="update_name" required="required">
					</div>
					
					<div class="form-group">
						<label for="ngay" class="form-control-label">Ngày</label>
						<input class="form-control fc-datepicker" id="update_ngay" placeholder="DD/MM/YYYY" type="text">
					</div>
					<div class="form-group">
						<label for="monan" class="form-control-label">Món ăn</label>
						<select id="update_monan" class="select2 form-control" multiple="multiple"></select>
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
<!-- Timepicker js -->
<script src="<?= base_url() ?>public/assets/plugins/time-picker/jquery.timepicker.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/time-picker/toggles.min.js"></script>

<!-- Datepicker js -->
<script src="<?= base_url() ?>public/assets/plugins/date-picker/spectrum.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/date-picker/jquery-ui.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/input-mask/jquery.maskedinput.js"></script>
<style>
	.ui-datepicker {
	    z-index: 9999 !important;
	}
</style>
<script>
	$(function(e) {
		
		initList();
		$('.fc-datepicker').datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: "dd-mm-yy",
			minDate: new Date()
		});
		$("#monan").select2({
            placeholder: "Chọn món ăn",
            allowClear: true,
            val: '',
            data: getDataMonan()
        });
        $("#update_monan").select2({
            placeholder: "Chọn món ăn",
            allowClear: true,
            val: '',
            data: getDataMonan()
        });
	});
	$('#edit_form').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataEdit = new Object();
		dataEdit.id = $('#update_id').val();
		dataEdit.tenMenu = $('#update_name').val();
		dataEdit.day = $('#update_ngay').val();
		dataEdit.monAn = $('#update_monan').val();
		var dataEditJson = JSON.stringify(dataEdit);
		$.ajax({
			url: "<?= base_url('Menu/update') ?>",
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
	$('#add_new').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var dataAdd = new Object();
		dataAdd.tenMenu = $('#name').val();
		dataAdd.day = $('#ngay').val();
		dataAdd.monan = $('#monan').val();
		var dataAddJson = JSON.stringify(dataAdd);
		$.ajax({
			url: "<?= base_url('Menu/add') ?>",
			type: 'POST',
			dataType: 'json',
			data: {data: dataAddJson},
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
	function getDataMonan(){
		var monAn = '';
        $.ajax({
            url: '<?= base_url('Monan/getSelect') ?>',
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function (d) {
                monAn = d;
                
            }
        });
        return monAn;
	}
	function initList(){
		list =  $('#example').DataTable({
			"processing": true,
            "destroy": true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass('cursor-pointer');
            },
            "ajax": {
                url: "<?= base_url('Menu/getList') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,1,2,3] },
                    className: 'btn btn-success',
	                filename: 'Danh sách thực đơn',
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
		            "defaultContent": "<button id='edit' class='btn btn-info waves-effect btn-sm'>Sửa</button>"
		        }
            ],
            'columns': [
                {
                    'width': '5%',
                    'data': 'id'
                }, {
                    'data': 'tenMenu'
                }, {
                    'data': 'day'
                },{
                    'data': 'tenMon'
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
	    
	}
	function initFormEdit(id){
		$.ajax({
			url: '<?= base_url("Menu/getOne") ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function(d){
				$('#update_id').val(d.id);
				$('#update_name').val(d.tenMenu);
				$('#update_ngay').val(d.day);
				$('#update_monan').val(d.monAn);
        		$('#update_monan').select2().trigger('change');
			}
		});
		
	}
</script>