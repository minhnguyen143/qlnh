<!-- Notifications  Css -->
<link href="<?= base_url() ?>public/assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
<!-- Notifications js -->
<script src="<?= base_url() ?>public/assets/plugins/notify/js/rainbow.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/notify/js/jquery.growl.js"></script>
<!-- popover js -->
<script src="<?= base_url() ?>public/assets/js/popover.js"></script>
<div>
	<div class="container">
		<div class="page-header">
			<h4 class="page-title"><?= $curPage ?></h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $curPage ?></li>
			</ol>

		</div>
		<div class="row row-cards">
			
			<div class="col-lg-12">
				<!-- <div class="input-group mb-5">
					<input type="text" class="form-control br-tl-7 br-bl-7" placeholder="">
					<div class="input-group-append ">
						<button type="button" class="btn btn-primary br-tr-7 br-br-7">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
					</div>
				</div> -->
				<div class="row">
					<?php
						if (is_array($arrMon)) {
						 	foreach ($arrMon as $value) {
							 	echo '<div class="col-lg-4">
											<div class="card item-card">
												<div class="product-grid6  card-body">
													<div class="product-image6">
														<a href="#">
															<img class="img-fluid" src="'.base_url().'public/assets/images/products/'.$value['hinh'].'">
														</a>
													</div>
													<div class="product-content text-center">
														<h4 class="title"><a href="#">'.$value['tenMon'].'</a></h4>
														<div class="price">'.$value['gia'].' - <span class="soluong" id="soLuong'.$value['id'].'" style="text-decoration: none"> '. $value['soLuong'] .'</span> phần</div>
													</div>
													<ul class="icons">
														<li><a data-container="body" data-toggle="popover" data-popover-color="default" data-placement="top" title="Mô tả" data-content="'.$value['moTa'].'" id="'.$value['id'].'" class="showDetail" data-tip="Mô tả món ăn"><i class="fa fa-info"></i></a></li>
														<li><a menu="'.$value['idMenu'].'" name="'.$value['tenMon'].'" id="'.$value['id'].'" class="book notice" data-tip="Đặt món này"><i class="fa fa-shopping-cart"></i></a></li>
													</ul>
											    </div>
											</div>
										</div>';
							}
						 }else{
						 	echo '<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Danh sách món ăn</h3>
									</div>
									<div class="card-body">
										<div class="jumbotron">
											<h1 class="display-3">Không tìm thấy món ăn!</h1>
											<p class="lead">Chưa có thực đơn cho hôm nay! Vui lòng quay lại sau.</p>
											<hr class="my-4">
											<p>Cảm ơn quý khách đã đến !</p>
											
										</div>
									</div>
								</div>
							</div>';
						 }
					?>
					
					
				</div>
				
			</div>
			
		</div>
	</div>
</div>
<script>
	$('.book').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		let id = $(this).attr('id');
		let ten = $(this).attr('name');
		let menu = $(this).attr('menu');
		let soluong = parseInt($('#soLuong'+id).text());
		// trừ số luọng
		
	    if (soluong > 0) {
	    	$.ajax({
		    	url: '<?= base_url('Order/addOrder') ?>',
		    	type: 'POST',
		    	dataType: 'json',
		    	data: {id: id, idMenu : menu},
		    	async: false,
		    	success: function(d){
		    		$('#soLuong'+id).text(soluong -1);
					return $.growl.notice({
				        message: "Đặt món "+ten+" thành công!"
				    });
		    	}
		    });
	    }else{
		    return $.growl.error({
		    	message: "Hết món rồi vui lòng đặt món khác!"
		    });
	    }
	    
	});
	
</script>