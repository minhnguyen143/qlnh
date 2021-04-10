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
			<div class="col-lg-8">
				<div class="card m-b-20">
					<div class="card-header ">
						<div class="card-title">Danh sách order</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-bordered">
								<thead >
									<tr >
										<th>#</th>
										<th>#</th>
										<th>Hình</th>
										<th>Món</th>
										<th>Giá</th>
										<th>Số lượng</th>
										<th>Tổng</th>
										<th>Ngày đặt</th>
										<th>Xoá</th>
										<th>idMenu</th>
									</tr>
								</thead>
								
							</table>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card ">
					<div class="card-header ">
						<div class="card-title">Hoá đơn</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered mb-0">
								<tbody>
									<tr>
										<td>Tiền món ăn</td>
										<td class="text-right tongTien">$792.00</td>
									</tr>
									<tr>
										<td><span>Tổng cộng</span></td>
										<td class="text-right text-muted"><span class="tongTien">$792.00</span></td>
									</tr>
									<tr>
										<td><span>Tổng tiền trả</span></td>
										<td><h2 class="price text-right mb-0 tongTien" ><span> đ</span></h2></td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- small Modal -->
<div id="smallModal" class="modal fade">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>This is a modal with small size</p>
			</div><!-- modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div><!-- modal-dialog -->
</div><!-- modal -->
<script type="text/javascript">
	$(function() {
		initList();

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
	                exportOptions: {columns: [1,3,4,5,6,7] },
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
                [1, 'asc']
            ],
            'columnDefs': [
            	{
                    "visible": false,
                    "targets": [0, 9]
                },
                {
                    'searchable': false,
                    'orderable': false,
                    'targets': [2,8]
                },
                {
		            "targets": -2,
		            "data": null,
		            "defaultContent": "<button id='delete' class='btn btn-danger waves-effect btn-sm'>Xoá</button>   "
		        },
		        {
		            "targets": 2,
		        	'data': 'hinh',
		        	'render': function ( data ) {
		        		return '<span class="avatar brround avatar-md d-block" style="background-image: url(<?= base_url() ?>public/assets/images/products/'+data+')"></span>';
		        	}
		        }
            ],
            'columns': [
            	{
                    'width': '5%',
                    'data': 'id'
                },
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
                },
                {
                	'width': '10%'	
                },
                {
                	'data': 'idMenu'
                }
            ],
            "initComplete":function( settings, json){
	            let OrderData = json.data;
	            let tongTien = 0;
	            for (var i = OrderData.length - 1; i >= 0; i--) {
	            	tongTien+= OrderData[i].tong;
	            };
	            $('.tongTien').text((tongTien).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
	            // call your function here
	            
	        }
		});

	    $('#example tbody').on( 'click', 'button#delete', function () {
    		var data = list.row( $(this).parents('tr') ).data();
	        var idMon = data['id'];
	        var idMenu = data['idMenu'];
	        var soLuong = data['soLuong'];
	        if (confirm('Đồng ý xoá????')) {
	        	$.ajax({
					url: "<?= base_url('Order/delete') ?>",
					type: 'POST',
					dataType: 'json',
					data: {idMon: idMon, idMenu: idMenu, soLuong: soLuong},
					success: function(d){
						if (d == 1) {
							alert('Xoá order thành công ^_^!');
							$("#example").DataTable().ajax.reload();
						}else{
							alert('Lỗi rồi -_-!');
						}
					}
				});
	        }
	        
	    });
	}

</script>