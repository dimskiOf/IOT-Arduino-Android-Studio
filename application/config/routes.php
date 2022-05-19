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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Login FUNCTION
$route['user/login'] = 'Login';
$route['user/auth/(:any)/(:any)'] = 'Auth/index/$1';

//******************************************** PENGELOLAAN WAREHOUSE **************************************************\\

//admin fg masuk
$route['fgmasuk'] = 'warehouse/Fgmasuk/Fgmasuk_c'; //FG ADMIN
$route['fgmasuk/select2getfg'] = 'warehouse/Fgmasuk/Fgmasuk_c/select2getdata'; // select2 get data fg
$route['fgmasuk/addbarcodefg'] = 'warehouse/Fgmasuk/Fgmasuk_c/insertdataforprinting'; // input data untuk printing barcode fg
$route['fgmasuk/getadddatafg'] = 'warehouse/Fgmasuk/Fgmasuk_c/getadddata';  //ngambil data add fg -
$route['fgmasuk/printbarcodefg'] = 'Print_b/Barcode_fgmasuk'; //printing barcode fg
$route['fgmasuk/hapusadditemfg'] = 'warehouse/Fgmasuk/Fgmasuk_c/hapusadditem';//hapus add item
$route['fgmasuk/loadfgmasuk'] = 'warehouse/Fgmasuk/Fgmasuk_c/getdatafgmasuk'; //get data fg masuk ***
$route['fgmasuk/hapusfgmasuk'] = 'warehouse/Fgmasuk/Fgmasuk_c/hapusdatafgmasuk'; //hapus data fg masuk

//admin fg keluar
$route['fgkeluar'] = 'warehouse/fgkeluar/Fgkeluar_c'; //FG ADMIN
$route['fgkeluar/select2getfg'] = 'warehouse/fgkeluar/Fgkeluar_c/select2getdata'; // select2 get data fg
$route['fgkeluar/addbarcodefg'] = 'warehouse/fgkeluar/Fgkeluar_c/insertdataforprinting'; // input data untuk printing barcode fg
$route['fgkeluar/getadddatafg'] = 'warehouse/fgkeluar/Fgkeluar_c/getadddata';  //ngambil data add fg -
$route['fgkeluar/printbarcodefg'] = 'warehouse/Print_b/Barcode_fgkeluar'; //printing barcode fg
$route['fgkeluar/hapusadditemfg'] = 'warehouse/fgkeluar/Fgkeluar_c/hapusadditem';//hapus add item
$route['fgkeluar/loadfgkeluar'] = 'warehouse/fgkeluar/Fgkeluar_c/getdatafgkeluar'; //get data fg keluar ***
$route['fgkeluar/hapusfgkeluar'] = 'warehouse/fgkeluar/Fgkeluar_c/hapusdatafgkeluar'; //hapus data fg keluar

//admin rm masuk
$route['rmmasuk'] = 'warehouse/rmmasuk/Rmmasuk_c'; //RM ADMIN
$route['rmmasuk/select2getrm'] = 'warehouse/rmmasuk/Rmmasuk_c/select2getdata'; // select2 get data rm
$route['rmmasuk/addbarcoderm'] = 'warehouse/rmmasuk/Rmmasuk_c/insertdataforprinting'; // input data untuk printing barcode rm
$route['rmmasuk/getadddatarm'] = 'warehouse/rmmasuk/Rmmasuk_c/getadddata';  //ngambil data add rm -
$route['rmmasuk/printbarcoderm'] = 'Print_b/Barcode_rmmasuk'; //printing barcode rm
$route['rmmasuk/hapusadditemrm'] = 'warehouse/rmmasuk/Rmmasuk_c/hapusadditem';//hapus add item
$route['rmmasuk/loadrmmasuk'] = 'warehouse/rmmasuk/Rmmasuk_c/getdatarmmasuk'; //get data rm masuk ***
$route['rmmasuk/hapusrmmasuk'] = 'warehouse/rmmasuk/Rmmasuk_c/hapusdatarmmasuk'; //hapus data rm masuk

//admin rm keluar
$route['rmkeluar'] = 'warehouse/rmkeluar/Rmkeluar_c'; //RM ADMIN
$route['rmkeluar/select2getrm'] = 'warehouse/rmkeluar/Rmkeluar_c/select2getdata'; // select2 get data rm
$route['rmkeluar/addbarcoderm'] = 'warehouse/rmkeluar/Rmkeluar_c/insertdataforprinting'; // input data untuk printing barcode fg
$route['rmkeluar/getadddatarm'] = 'warehouse/rmkeluar/Rmkeluar_c/getadddata';  //ngambil data add rm -
$route['rmkeluar/printbarcoderm'] = 'Print_b/Barcode_rmkeluar'; //printing barcode rm
$route['rmkeluar/hapusadditemrm'] = 'warehouse/rmkeluar/Rmkeluar_c/hapusadditem';//hapus add item
$route['rmkeluar/loadrmkeluar'] = 'warehouse/rmkeluar/Rmkeluar_c/getdatarmkeluar'; //get data rm keluar ***
$route['rmkeluar/hapusrmkeluar'] = 'warehouse/rmkeluar/Rmkeluar_c/hapusdatarmkeluar'; //hapus data rm keluar

//******************************************** END PENGELOLAAN WAREHOUSE **************************************************\\

//******************************************** PENGELOLAAN PPIC **************************************************\\

//******************************************** END PENGELOLAAN PPIC **************************************************\\

//******************************************** ANDROID **************************************************\\

$route['operatormpi/upload'] = 'Operator/Konfirmasi_bahanmpi';//ADMIN MPI
$route['operatormpi/getitembycode'] = 'Operator/Konfirmasi_bahanmpi/getrmbykodeitem'; //get data untuk handphone dan kembalikan data untuk input

//API android
$route['v1/login'] = 'rest/api/users';
$route['v1/login'] = 'rest/api';

$route['operator99/upload'] = 'Operator/Konfirmasi_bahan99';//ADMIN 99
$route['operator99/getitembycode'] = 'Operator/Konfirmasi_bahan99/getrmbykodeitem'; //get data untuk handphone dan kembalikan data untuk input

//********************************************* END ANDROID ************************************************\\

//******************************************** ALAT ARDUINO **************************************************\\

//arduino MPI
$route['operatormpi/inputdataarduinormmpikeluar'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpirmkeluar';//OPerator melakukan input rm keluar melalui alat arduino

$route['operatormpi/inputdataarduinormmpimasuk'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpirmmasuk';//OPerator melakukan input rm masuk melalui alat arduino

$route['operatormpi/inputdataarduinofgmpikeluar'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpifgkeluar';//OPerator melakukan input fg keluar melalui alat arduino

$route['operatormpi/inputdataarduinofgmpimasuk'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpifgmasuk';//OPerator melakukan input fg masuk melalui alat arduino

//arduino 99
$route['operator99/inputdataarduinorm99keluar'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99rmkeluar';//OPerator melakukan input rm keluar melalui alat arduino

$route['operator99/inputdataarduinorm99masuk'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99rmmasuk';//OPerator melakukan input rm masuk melalui alat arduino

$route['operator99/inputdataarduinofg99keluar'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99fgkeluar';//OPerator melakukan input fg keluar melalui alat arduino

$route['operator99/inputdataarduinofg99masuk'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99fgmasuk';//OPerator melakukan input fg masuk melalui alat arduino

//******************************************** END ALAT ARDUINO **************************************************\\

//Beranda
$route['beranda'] = 'Dashboard/Admindasboard'; //menu beranda admin

//******************************************** PENGELOLAAN AKUN **************************************************\\

//route kelola hak akses
$route['hakakses'] = 'Hakakses/Adminkelolahakakses';
$route['admin/kelhas'] = 'Hakakses/Adminkelolahakakses/kelola_hak_akses';
$route['admin/tambahhak'] = 'Hakakses/Adminkelolahakakses/tambah_hak_akses';
$route['admin/hapushak'] = 'Hakakses/Adminkelolahakakses/hapus_hak_akses';
$route['admin/tambahhaksub'] = 'Hakakses/Adminkelolahakakses/tambah_hak_akses_sub_menu';
$route['admin/hapushaksub'] = 'Hakakses/Adminkelolahakakses/hapus_hak_akses_sub_menu';
$route['admin/tambahhaksubsub'] = 'Hakakses/Adminkelolahakakses/tambah_hak_akses_sub_submenu';
$route['admin/hapushaksubsub'] = 'Hakakses/Adminkelolahakakses/hapus_hak_akses_sub_submenu';
$route['admin/hakaksesmenu/(:any)/(:any)'] = 'Hakakses/Adminkelolahakakses/hak_akses_menu/$2/$1';
$route['admin/hakaksessubmenu/(:any)/(:any)'] = 'Hakakses/Adminkelolahakakses/hak_akses_submenu/$2/$1';
$route['admin/hakaksessubsubmenu/(:any)/(:any)'] = 'Hakakses/Adminkelolahakakses/hak_akses_sub_submenu/$2/$1';
$route['admin/carirole/(:any)/(:any)'] = 'Hakakses/Adminkelolahakakses/cari_role/$2/$1';

//******************************************** END PENGELOLAAN AKUN **************************************************\\

//akun logout
$route['akun/logout'] = 'Logout';