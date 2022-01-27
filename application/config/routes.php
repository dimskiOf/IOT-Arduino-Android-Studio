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


//admin mpi rm
$route['mpi'] = 'Admin/mpi';//ADMIN MPI
$route['mpi/loadrm'] = 'Admin/mpi/getdatarm';//ADMIN MPI LOAD DATA RM
$route['mpi/select2get'] = 'Admin/mpi/select2getdata'; //select2 get data
$route['mpi/addbarcode'] = 'Admin/mpi/insertdataforprinting'; //Input data untuk printing barcode
$route['mpi/getadddatarm'] = 'Admin/mpi/getadddatarm';  //ngambil data add rm
$route['mpi/printbarcoderm'] = 'Admin/Print_barcodeqrcode3'; //printing barcode rm
$route['mpi/hapusadditem'] = 'Admin/mpi/hapusadditem';//hapus add item
$route['mpi/loadrmkeluar'] = 'Admin/mpi/getdatarmkeluar'; //get data rm keluar
$route['mpi/loadrmmasuk'] = 'Admin/mpi/getdatarmmasuk'; //get data rm masuk
$route['mpi/hapusrmkeluar'] = 'Admin/mpi/hapusdatarmkeluar'; //hapus data rm keluar
$route['mpi/hapusrmmasuk'] = 'Admin/mpi/hapusdatarmmasuk'; //hapus data rm masuk

//admin mpi fg
$route['mpi/fg'] = 'Admin/mpifg'; //FG ADMIN MPI
$route['mpi/loadfg'] = 'Admin/mpifg/getdatafg'; //ADMIN MPI LOAD DATA FG
$route['mpi/select2getfg'] = 'Admin/mpifg/select2getdata'; // select2 get data fg
$route['mpi/addbarcodefg'] = 'Admin/mpifg/insertdataforprinting'; // input data untuk printing barcode fg
$route['mpi/getadddatafg'] = 'Admin/mpifg/getadddata';  //ngambil data add fg -
$route['mpi/printbarcodefg'] = 'Admin/Print_barcodeqrcode4'; //printing barcode fg
$route['mpi/hapusadditemfg'] = 'Admin/mpifg/hapusadditem';//hapus add item
$route['mpi/loadfgkeluar'] = 'Admin/mpifg/getdatafgkeluar'; //get data fg keluar
$route['mpi/loadfgmasuk'] = 'Admin/mpifg/getdatafgmasuk'; //get data fg masuk
$route['mpi/hapusfgkeluar'] = 'Admin/mpi/hapusdatafgkeluar'; //hapus data fg keluar
$route['mpi/hapusfgmasuk'] = 'Admin/mpi/hapusdatafgmasuk'; //hapus data fg masuk


$route['operatormpi/upload'] = 'Operator/Konfirmasi_bahanmpi';//ADMIN MPI
$route['operatormpi/getitembycode'] = 'Operator/Konfirmasi_bahanmpi/getrmbykodeitem'; //get data untuk handphone dan kembalikan data untuk input

//arduino MPI
$route['operatormpi/inputdataarduinormmpikeluar'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpirmkeluar';//OPerator melakukan input rm keluar melalui alat arduino

$route['operatormpi/inputdataarduinormmpimasuk'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpirmmasuk';//OPerator melakukan input rm masuk melalui alat arduino

$route['operatormpi/inputdataarduinofgmpikeluar'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpifgkeluar';//OPerator melakukan input fg keluar melalui alat arduino

$route['operatormpi/inputdataarduinofgmpimasuk'] = 'Operator/Inputitembyarduino2/inputdatabarcodedantimbanganmpifgmasuk';//OPerator melakukan input fg masuk melalui alat arduino

//API android
$route['v1/login'] = 'rest/api/users';
$route['v1/login'] = 'rest/api';


//gudang 99 rm
$route['gd99'] = 'Admin/Gudang99';//ADMIN 99
$route['gd99/loadrm'] = 'Admin/gudang99/getdatarm';//ADMIN 99 LOAD DATA RM
$route['gd99/select2get'] = 'Admin/gudang99/select2getdata'; //select2 get data
$route['gd99/addbarcode'] = 'Admin/gudang99/insertdataforprinting'; //Input data untuk printing barcode
$route['gd99/getadddatarm'] = 'Admin/gudang99/getadddatarm';  //ngambil data add rm
$route['gd99/printbarcoderm'] = 'Admin/Print_barcodeqrcode'; //printing barcode rm
$route['gd99/hapusadditem'] = 'Admin/gudang99/hapusadditem';//hapus add item
$route['gd99/loadrmkeluar'] = 'Admin/gudang99/getdatarmkeluar'; //get data rm keluar
$route['gd99/loadrmmasuk'] = 'Admin/gudang99/getdatarmmasuk'; //get data rm masuk
$route['gd99/hapusrmkeluar'] = 'Admin/gudang99/hapusdatarmkeluar'; //hapus data rm keluar
$route['gd99/hapusrmmasuk'] = 'Admin/gudang99/hapusdatarmmasuk'; //hapus data rm masuk

//gudang 99 fg
$route['gd99/fg'] = 'Admin/gudang99fg'; //FG ADMIN 99
$route['gd99/loadfg'] = 'Admin/gudang99fg/getdatafg'; //ADMIN 99 LOAD DATA FG
$route['gd99/select2getfg'] = 'Admin/gudang99fg/select2getdata'; // select2 get data fg
$route['gd99/addbarcodefg'] = 'Admin/gudang99fg/insertdataforprinting'; // input data untuk printing barcode fg
$route['gd99/getadddatafg'] = 'Admin/gudang99fg/getadddata';  //ngambil data add fg -
$route['gd99/printbarcodefg'] = 'Admin/Print_barcodeqrcode2'; //printing barcode fg
$route['gd99/hapusadditemfg'] = 'Admin/gudang99fg/hapusadditem';//hapus add item
$route['gd99/loadfgkeluar'] = 'Admin/gudang99fg/getdatafgkeluar'; //get data fg keluar
$route['gd99/loadfgmasuk'] = 'Admin/gudang99fg/getdatafgmasuk'; //get data fg masuk
$route['gd99/hapusfgkeluar'] = 'Admin/gudang99fg/hapusdatafgkeluar'; //hapus data fg keluar
$route['gd99/hapusfgmasuk'] = 'Admin/gudang99fg/hapusdatafgmasuk'; //hapus data fg masuk

$route['operator99/upload'] = 'Operator/Konfirmasi_bahan99';//ADMIN 99
$route['operator99/getitembycode'] = 'Operator/Konfirmasi_bahan99/getrmbykodeitem'; //get data untuk handphone dan kembalikan data untuk input


//clearalldata triger
$route['all/clear'] = 'Admin/Clear';


//arduino 99
$route['operator99/inputdataarduinorm99keluar'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99rmkeluar';//OPerator melakukan input rm keluar melalui alat arduino

$route['operator99/inputdataarduinorm99masuk'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99rmmasuk';//OPerator melakukan input rm masuk melalui alat arduino

$route['operator99/inputdataarduinofg99keluar'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99fgkeluar';//OPerator melakukan input fg keluar melalui alat arduino

$route['operator99/inputdataarduinofg99masuk'] = 'Operator/Inputitembyarduino/inputdatabarcodedantimbangangd99fgmasuk';//OPerator melakukan input fg masuk melalui alat arduino


