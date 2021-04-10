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
						<div class="card-title">Báo cáo danh sách đặt món</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
								<thead>
									<tr class="border-bottom-0">
										<th class="wd-15p">#</th>
										<th>Người đặt</th>
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
					<!-- table-wrapper -->
				</div>
				<!-- section-wrapper -->
			</div>
		</div>
	</div>
</div>
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
                url: "<?= base_url('Order/getListReportOrder') ?>"
            },
            dom: 'Bfrtip',
            buttons: [
            	{
	                extend: 'excelHtml5',
	                exportOptions: {columns: [0,1,3,4,5,6] },
                    className: 'btn btn-success',
	                filename: 'Danh sách các món đã đặt',
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    }
	            }
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
                    "visible": false,
                    "targets": [1]
                },
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
                },{
                	'data' :'user'
                }, 
                {
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
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="5">Tên người dùng: <b>'+group+'</b></td></tr>'
                        );
     
                        last = group;
                    }
                } );
            }
		});

	    
	}
</script>