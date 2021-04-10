<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['info'] = array(
	'title-name' => 'Quản lý nhà hàng',
	'version' => '1.0',
	'author' => 'aaa',
	'title-site' => 'Quản lý nhà hàng',
	'description' => 'Quản lý nhà hàng',
	'icon-url' => '',
	'logo-url' => '',
	'footer-title' => 'Chúc một ngày tốt lành!'

);

$config['primary_nav'] = array(
	array(
		'icon' => 'fa fa-vcard',
        'nameDisplay' => 'Trang cá nhân',
        'url' => base_url('UserDetail'),
        'role' => array( 'admin', 'bep','nhanvien'),
	),
	array(
		'icon' => 'fa fa-send-o',
        'nameDisplay' => 'Order Món ăn',
        'url' => base_url('order'),
        'role' => array( 'admin', 'bep','nhanvien'),
	),
	array(
		'icon' => 'fa fa-th-list',
        'nameDisplay' => 'Báo cáo order',
        'url' => base_url('order/reportOrder'),
        'role' => array( 'admin', 'bep'),
	),
	array(
		'icon' => 'fa fa-coffee',
        'nameDisplay' => 'Món ăn',
        'url' => base_url('monan'),
        'role' => array( 'admin', 'bep'),
	),
	array(
		'icon' => 'fa fa-shopping-basket',
        'nameDisplay' => 'Nguyên Liệu',
        'url' => base_url('nguyenlieu'),
        'role' => array( 'admin', 'bep'),
	),
	array(
		'icon' => 'fa fa-list-alt',
        'nameDisplay' => 'Menu',
        'url' => base_url('menu'),
        'role' => array( 'admin', 'bep'),
	),
	array(
		'icon' => 'fa fa-users',
        'nameDisplay' => 'Người dùng',
        'url' => base_url('nguoidung'),
        'role' => array( 'admin'),
	),
);