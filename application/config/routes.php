<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$route['default_controller'] = 'home/index';
$route['404_override'] = 'admin/index';

// -- Frontside -----
/*$route['home'] = 'home/index';
$route['upcoming_events'] = 'front/upcoming_events';
$route['upcoming_events_details/(:any)'] = 'front/upcoming_events_details';*/

// -- Admin -----
$route['admin'] = 'admin/index';
$route['admin/login'] = 'admin/index';
$route['admin/logout'] = 'admin/logout';
$route['admin/login/validate_credentials'] = 'admin/validate_credentials';
$route['admin/profile'] = 'admin/profile';
$route['admin/send_notifications'] = 'admin/send_notifications';
$route['admin/users'] = 'admin/manage_user';
$route['admin/users/add'] = 'admin/add_user';
$route['admin/users/delete/(:any)'] = 'admin/delete_user';
$route['admin/sessions'] = 'admin/sessions';
$route['admin/session/delete/(:any)'] = 'admin/delete_session';


$route['admin/category'] = 'category/manage_category';
$route['admin/category/add'] = 'category/add_category';
$route['admin/category/update/(:any)'] = 'category/update_category';
$route['admin/category/delete/(:any)'] = 'category/delete_category';
$route['admin/category/removeCategoryImage'] = 'category/removeCategoryImage';

$route['admin/items'] = 'items/manage_item';
$route['admin/items/add'] = 'items/add_item';
$route['admin/items/update/(:any)'] = 'items/update_item';
$route['admin/items/delete/(:any)'] = 'items/delete_item';
$route['admin/items/removeItemImage'] = 'items/removeItemImage';
$route['admin/items/updatevideoorder'] = 'items/updatevideoorder';

$route['admin/about_us'] = 'admin/about_us';
$route['admin/terms_and_conditions'] = 'admin/terms_and_conditions';

// -- API -----
$route['api/v1/get_category'] = 'mobile_api/get_category';
$route['api/v1/get_item'] = 'mobile_api/get_item';
$route['api/v1/get_item_by_cat_id'] = 'mobile_api/get_item_by_cat_id';
$route['api/v1/gcm_register'] = 'mobile_api/gcm_register';
$route['api/v1/gcm_delete'] = 'mobile_api/gcm_delete';
$route['api/v1/gcm_login'] = 'mobile_api/gcm_login';
$route['api/v1/get_about_us'] = 'mobile_api/get_about_us';
$route['api/v1/update_song_status'] = 'mobile_api/update_song_status';
$route['api/v1/search_song'] = 'mobile_api/search_song';
$route['api/v1/set_favorite'] = 'mobile_api/set_favorite';
$route['api/v1/get_favorite'] = 'mobile_api/get_favorite_item';
$route['api/v1/set_duration'] = 'mobile_api/set_duration';
$route['api/v1/get_duration'] = 'mobile_api/get_duration';
$route['api/v1/set_extra'] = 'mobile_api/set_extra';
$route['api/v1/update_user'] = 'mobile_api/update_user';
$route['api/v1/reset_password'] = 'mobile_api/reset_password';
$route['api/v1/set_session'] = 'mobile_api/set_session';



