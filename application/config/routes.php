<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "admin";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
/*
$route['e_book/(:num)'] = "e_books/selected_ebook_category/$1";
$route['e_book/(:num)/(:num)'] = "e_books/selected_ebook_category/$1/$1";
$route['e_book_detail/(:num)'] = "e_books/e_book_details/$1";
$route['e_book/more'] = "e_books/all_ebook_category";
$route['contactus'] = "welcome/contact_us";
$route['help'] = "welcome/help_me";
$route['login'] = "welcome/user_login";
$route['logout'] = "welcome/user_logout";
$route['(:num)'] = "welcome/index/$1";
$route['verify/(:num)/(:num)'] = "welcome/verify_user/$1/$1";
$route['search_e_book'] = "e_books/search_book";
$route['search_e_book/(:num)'] = "e_books/search_book/$1";
$route['wishlist'] = "e_books/my_wishlist";
$route['wishlist/(:num)'] = "e_books/my_wishlist/$1";
$route['my_account'] = "welcome/my_account_page";
$route['order_detail/(:num)'] = "welcome/my_order_detail/$1";
*/  