<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string  Your facebook app ID.
|  facebook_app_secret           string  Your facebook app secret.
|  facebook_login_type           string  Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string  URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string  URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array   The permissions you need.
*/

$config['facebook_app_id'] = '406165639588953';
$config['facebook_app_secret'] = '2f14878549c89707ee2524741716a406';
$config['access_token']='889052584522642|Tt0txXDmvq13oL8GSH6JLrBONis';
$config['facebook_login_redirect_url'] = base_url();
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'admin/achievements';
$config['facebook_logout_redirect_url'] = 'example/logout';
$config['facebook_permissions']         = array('email','publish_actions');
