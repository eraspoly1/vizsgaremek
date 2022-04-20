<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['rendelok'] = "rendelok";
$route['rendelok/index'] = "rendelok/index";
$route['rendelok/modosit']['GET'] = "rendelok/modosit";
$route['rendelok/modosit/(:num)']['GET'] = "rendelok/modosit/$1";
$route['rendelok/rogzit']['GET'] = "rendelok/rogzit";
$route['rendelok/torol'] = "rendelok/torol";
$route['rendelok/torol/(:num)'] = "rendelok/torol/$1";
$route['rendelok/rogzit']['POST'] = "rendelok/rogzit_post";
$route['rendelok/modosit']['POST'] = "rendelok/modosit_vegrehajtas";
$route['rendelok/rendelo_reszletek/(:num)'] = "rendelok/rendelo_reszletek/$1";

#$route['keresok'] = "keresokapival";
#$route['keresok/kereses'] = "keresokapival/kereses";

$route['orvosok'] = "orvosok";
$route['orvosok/index'] = "orvosok/index";
$route['orvosok/modosit']['GET'] = "orvosok/modosit";
$route['orvosok/modosit/(:num)']['GET'] = "orvosok/modosit/$1";
$route['orvosok/rogzit']['GET'] = "orvosok/rogzit";
$route['orvosok/torol'] = "orvosok/torol";
$route['orvosok/torol/(:num)'] = "orvosok/torol/$1";
$route['orvosok/rogzit']['POST'] = "orvosok/rogzit_post";
$route['orvosok/modosit']['POST'] = "orvosok/modosit_vegrehajtas";

$route['allatok'] = "allatok";
$route['allatok/index'] = "allatok/index";
$route['allatok/modosit']['GET'] = "allatok/modosit";
$route['allatok/modosit/(:num)']['GET'] = "allatok/modosit/$1";
$route['allatok/rogzit']['GET'] = "allatok/rogzit";
$route['allatok/torol'] = "allatok/torol";
$route['allatok/torol/(:num)'] = "allatok/torol/$1";
$route['allatok/rogzit']['POST'] = "allatok/rogzit_post";
$route['allatok/modosit']['POST'] = "allatok/modosit_vegrehajtas";

$route['szolgaltatasok'] = "szolgaltatasok";
$route['szolgaltatasok/index'] = "szolgaltatasok/index";
$route['szolgaltatasok/modosit']['GET'] = "szolgaltatasok/modosit";
$route['szolgaltatasok/modosit/(:num)']['GET'] = "szolgaltatasok/modosit/$1";
$route['szolgaltatasok/rogzit']['GET'] = "szolgaltatasok/rogzit";
$route['szolgaltatasok/torol'] = "szolgaltatasok/torol";
$route['szolgaltatasok/torol/(:num)'] = "szolgaltatasok/torol/$1";
$route['szolgaltatasok/rogzit']['POST'] = "szolgaltatasok/rogzit_post";
$route['szolgaltatasok/modosit']['POST'] = "szolgaltatasok/modosit_vegrehajtas";

$route['nyitvatartasok'] = "nyitvatartasok";
$route['nyitvatartasok/index'] = "nyitvatartasok/index";
$route['nyitvatartasok/modosit']['GET'] = "nyitvatartasok/modosit";
$route['nyitvatartasok/modosit/(:num)']['GET'] = "nyitvatartasok/modosit/$1";
$route['nyitvatartasok/rogzit']['GET'] = "nyitvatartasok/rogzit";
$route['nyitvatartasok/torol'] = "nyitvatartasok/torol";
$route['nyitvatartasok/torol/(:num)'] = "nyitvatartasok/torol/$1";
$route['nyitvatartasok/rogzit']['POST'] = "nyitvatartasok/rogzit_post";
$route['nyitvatartasok/modosit']['POST'] = "nyitvatartasok/modosit_vegrehajtas";

$route['arak'] = "arak";
$route['arak/index'] = "arak/index";
$route['arak/modosit']['GET'] = "arak/modosit";
$route['arak/modosit/(:num)']['GET'] = "arak/modosit/$1";
$route['arak/rogzit']['GET'] = "arak/rogzit";
$route['arak/torol'] = "arak/torol";
$route['arak/torol/(:num)'] = "arak/torol/$1";
$route['arak/rogzit']['POST'] = "arak/rogzit_post";
$route['arak/modosit']['POST'] = "arak/modosit_vegrehajtas";

$route['felhasznalok'] = "felhasznalok";
$route['felhasznalok/index'] = "felhasznalok/index";
$route['felhasznalok/modosit']['GET'] = "felhasznalok/modosit";
$route['felhasznalok/modosit/(:num)']['GET'] = "felhasznalok/modosit/$1";
$route['felhasznalok/rogzit']['GET'] = "felhasznalok/rogzit";
$route['felhasznalok/torol'] = "felhasznalok/torol";
$route['felhasznalok/torol/(:num)'] = "felhasznalok/torol/$1";
$route['felhasznalok/rogzit']['POST'] = "felhasznalok/rogzit_post";
$route['felhasznalok/modosit']['POST'] = "felhasznalok/modosit_vegrehajtas";

$route['velemenyek'] = "velemenyek";
$route['velemenyek/index'] = "velemenyek/index";
$route['velemenyek/modosit']['GET'] = "velemenyek/modosit";
$route['velemenyek/modosit/(:num)']['GET'] = "velemenyek/modosit/$1";
$route['velemenyek/rogzit']['GET'] = "velemenyek/rogzit";
$route['velemenyek/torol'] = "velemenyek/torol";
$route['velemenyek/torol/(:num)'] = "velemenyek/torol/$1";
$route['velemenyek/rogzit']['POST'] = "velemenyek/rogzit_post";
$route['velemenyek/modosit']['POST'] = "velemenyek/modosit_vegrehajtas";

$route['regisztracio']['GET'] = 'kezdolap/regisztracio';
$route['regisztracio']['POST'] = 'kezdolap/regisztracio_post';
$route['bejelentkezes']['GET'] = 'kezdolap/bejelentkezes';
$route['bejelentkezes']['POST'] = 'kezdolap/bejelentkezes_post';
$route['kijelentkezes'] = "kezdolap/kijelentkezes";

#$route['vet_add']['GET'] = 'vets/rogzit';
#$route['vet_add']['POST'] = 'vets/rogzit_post';

$route['default_controller'] = 'kezdolap';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
$route['rendelok/rogzit']['POST'] = "rendelok/rogzit_post";
$route['rendelok/modosit']['POST'] = "rendelok/modosit_vegrehajtas";

$route['default_controller'] = 'rendelok';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
*/