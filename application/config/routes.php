<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//trang chu
$route['default_controller'] = 'CHome';

$route['Home'] = 'CHome';
$route['upload_img'] = 'CHome/upload';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
