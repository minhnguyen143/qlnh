<div>
	<div class="container">
		<div class="page-header">
			<h4 class="page-title">Trang cá nhân</h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Pages</a></li>
				<li class="breadcrumb-item active" aria-current="page">Trang cá nhân</li>
			</ol>
		</div>
		<div class="row" id="user-profile">
		    <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
				<div class="card clearfix">
					<div class="card-header">
						 <h2 class="card-title">Thông tin cá nhân</h2>
					</div>
				    <div class="card-body p-0">
						<div class="card-body bg-primary text-white">
							<img src="<?= base_url() ?>public/assets/images/faces/male/user.jpg" alt="" class="profile-img img-responsive center-block">
							<a href="#" class="profile-image">
								<span class="fa fa-pencil" aria-hidden="true"></span>
							</a>
							<div class="profile-label mt-3">
								<span ><?= $this->session->userdata('fullName'); ?></span>
							</div>
							
							<div class="profile-stars">
								
								<span><?= $this->session->userdata('type'); ?></span>
							</div>

						</div>
                        <div class="border-bottom align-items-center">
							<div class="card-body">
								<div class="profile-details">
									<div class="list-group list-group-transparent mb-0 mail-inbox">
										<a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
											<span class="icon mr-3"><i class="fa fa-truck"></i></span>Số lượng món đã đặt: <span> <b> <?= $totalOrder ?> </b></span>
										</a>
										
									</div>
								</div>
							</div>
						</div>
                        <div class="p-3">
							<div class="profile-message-btn center-block text-center">
								<a id="changePass" class="btn btn-secondary btn-block">
									<i class="fa fa-refresh"></i> Đổi mật khẩu
								</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="col-lg-8 col-md-12 col-sm-12 col-xl-9">
			    <div class="card clearfix">
					<div class="card-header">
						<h2 class="card-title">Thông tin người dùng</h2>
					</div>
					<div class="card-body">
						<div class="row profile-user-info">
							<div class="col-lg-12">
								<div class="table-responsive border ">
									<table class="table row table-borderless w-100 m-0 ">
										<tbody class="col-lg-6 p-0">
											<tr>
												<td><strong>Họ và tên :</strong> <?= $this->session->userdata('fullName'); ?></td>
											</tr>
											<tr>
												<td><strong>Địa chỉ :</strong> 12 Nguyễn Văn Bảo, Gò vấp, Thành phố Hồ Chí Minh</td>
											</tr>
											
										</tbody>
										<tbody class="col-lg-6 p-0">
											
											<tr>
												<td><strong>Email :</strong> <?= $this->session->userdata('username'); ?>@qlnhahang.com</td>
											</tr>
											<tr>
												<td><strong>Phone :</strong> +19001560 </td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="card m-b-20">
									<div class="card-header ">
										<div class="card-title">Danh sách order ngày mai</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table table-bordered">
												<thead >
													<tr >
														<th>#</th>
														<th>Hình</th>
														<th>Món</th>
														<th>Giá</th>
														<th>Số lượng</th>
														<th>Tổng</th>
														<th>Ngày đặt</th>
													</tr>
												</thead>
												
											</table>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- change Modal -->
<div id="change" class="modal fade">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header pd-x-20">
				<h6 class="modal-title">Đổi mật khẩu</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="change_pass">
				<div class="modal-body pd-20">
				
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Mật khẩu cũ:</label>
						<input type="password" class="form-control" id="old" required="required">
					</div>
					<div class="form-group">
						<label for="message-text" class="form-control-label">Mật khẩu mới</label>
						<input type="password" class="form-control" id="new" required="required">
					</div>
					
				</div><!-- modal-body -->
			
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Đổi</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</form>
		</div>
	</div><!-- modal-dialog -->
</div><!-- modal -->

<script>
	$(function() {
		initList();
	});
	$('#changePass').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('#change_pass')[0].reset();
		$('#change').modal('show');
	});
	$('#change_pass').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: '<?= base_url('Nguoidung/changePass')?>',
			type: 'POST',
			dataType: 'json',
			data: {old: $('#old').val(), new: $('#new').val()},
			success:function(d){
				if(d == 1){
					alert('Đổi mật khẩu thành công ^_^!');
					$('#change_pass')[0].reset();
					$('#change').modal('hide');
				}else if(d == 2){
					alert('Mật khẩu cũ không đúng nha!');
					$('#old').val('');
					$('#old').focus();

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
                url: "<?= base_url('Order/getListOrder') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,2,3,4,5,6] },
                    className: 'btn btn-success',
	                filename: 'Danh sách các món đã đặt',
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    }
	            },
                {
                    text: "<i class='fa fa-plus'> Đặt thêm món",
                    className: 'btn btn-primary',
                    action: function (e) {
                        // dẫn đến trang order
                        location.href = "<?= base_url('order') ?>";
                        
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
                    'targets': [1]
                },
                
		        {
		            "targets": 1,
		        	'data': 'hinh',
		        	'render': function ( data ) {
		        		return '<span class="avatar brround avatar-md d-block" style="background-image: url(<?= base_url() ?>public/assets/images/products/'+data+')"></span>';
		        	}
		        }
            ],
            'columns': [
                {
                    'width': '5%',
                    'data': 'count'
                }, {
                    'data': 'hinh'
                }, {
                    'data': 'tenMon'
                },{
                    'data': 'gia'
                },{
                    'data': 'soLuong'
                },{
                    'data': 'tong'
                },{
                    'data': 'dayOrder'
                }
            ],
       
		});

	   
	}
</script>