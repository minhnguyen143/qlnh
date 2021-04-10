<!doctype html>
<html lang="en" dir="ltr">
	
<!-- Mirrored from www.spruko.com/demo/adminor/html/Horizontal-Light/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Dec 2018 07:37:30 GMT -->
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-TileColor" content="#0061da">
		<meta name="theme-color" content="#1643a3">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>public/assets/images/logo1-1.png" />

		<!-- Title -->
		<title><?= $curPage ?> – <?= $info['title-site'] ?></title>
		<link rel="stylesheet" href="<?= base_url(); ?>public/assets/fonts/fonts/font-awesome.min.css">

		<!-- Font family-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

		<!-- Dashboard Core -->
		<link href="<?= base_url(); ?>public/assets/css/dashboard.css" rel="stylesheet" />

		<!-- c3.js Charts Plugin -->
		<link href="<?= base_url(); ?>public/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="<?= base_url(); ?>public/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!---Font icons-->
		<link href="<?= base_url(); ?>public/assets/css/icons.css" rel="stylesheet" />
		<!-- Data table css -->
		<link href="<?= base_url() ?>public/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

		<!-- Slect2 css -->
		<link href="<?= base_url() ?>public/assets/plugins/select2/select2.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?= base_url() ?>public/assets/css/buttons.dataTables.min.css">

		<!-- Dashboard js-->
		<script src="<?= base_url() ?>public/assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vendors/selectize.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vendors/circle-progress.min.js"></script>
		<script src="<?= base_url() ?>public/assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- Data tables -->
		<script src="<?= base_url() ?>public/assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>public/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

		<!-- Select2 js -->
		<script src="<?= base_url() ?>public/assets/plugins/select2/select2.full.min.js"></script>
		<!-- Custom scroll bar Js-->
		<script src="<?= base_url() ?>public/assets/js/dataTables.buttons.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/buttons.flash.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/jszip.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/pdfmake.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/vfs_fonts.js"></script>
		<script src="<?= base_url() ?>public/assets/js/buttons.html5.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/buttons.print.min.js"></script>
		<script src="<?= base_url() ?>public/assets/js/buttons.colVis.min.js"></script>
		
	</head>
	<body >
		<div id="global-loader" ></div>
		<div class="page" >
			<div class="page-main">
				<div class="header">
					<div class="container">
						<div class="d-flex">
							<a class="header-brand" href="<?= base_url() ?>">
								<img src="<?= base_url(); ?>public/assets/images/brand/logo.png" class="header-brand-img" alt="adminor logo">
							</a>
							<div class="d-flex order-lg-2 ml-auto header-right-icons">
								<div class="p-2">
									<form class="input-icon ">
										<div class="input-icon-addon" style="top: 18px !important; min-width: 11.5rem !important">
											<?= $this->session->userdata('fullName'); ?>
											<!-- <i class="fe fe-search"></i> -->
										</div>
										<!-- <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1"> -->
									</form>
								</div>
								<div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" href="<?= base_url('order/listOrder') ?>">
										<i class="fa fa-shopping-bag"></i>
										<span class="nav-unread bg-warning"></span>
									</a>
									
								</div>
								<div class="dropdown d-none d-md-flex" >
									<a  class="nav-link icon full-screen-link nav-link-bg">
										<i class="fa fa-expand"  id="fullscreen-button"></i>
									</a>
								</div>
								
								<div class="dropdown text-center selector">
									<a href="#" class="nav-link leading-none" data-toggle="dropdown">
										<span class="avatar avatar-sm brround cover-image" data-image-src="<?= base_url(); ?>public/assets/images/faces/male/user.png"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
										
										<a class="dropdown-item" href="<?= base_url('logout') ?>">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
										</a>
									</div>
								</div>
							</div>
							<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
								<span class="header-toggler-icon"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="admin-navbar" id="headerMenuCollapse">
					<div class="container">
						<ul class="nav">
							<?php 
								foreach ($nav as $item){
									if (in_array($this->session->userdata('type')  , $item['role'])) {
										echo '<li class="nav-item with-sub">
													<a class="nav-link" href="'.$item['url'].'">
														<i class="'.$item['icon'].'"></i>
														<span>'.$item['nameDisplay'].'</span>
													</a>
													
												</li>';
									}
								}
							 ?>
							
						</ul>
					</div>
				</div>