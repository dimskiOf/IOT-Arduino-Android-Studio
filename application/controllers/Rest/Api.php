<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

     public function users_get()
        {
            // Users from a data store e.g. database
            $users = [['id' => 0, 'name' => 'John', 'email' => 'rezky.dimas@gmail.com', 'password' => 'dimas123'],];
            $error = [
                ['pesan' => 'data kosong'],
            ];
            $email = $this->get('email');
            $password = $this->get('password');
            if ($email === null) {

                   $this->response([
                       'status' => false,
                       'message' => 'email kosong'
                   ], 404);
                
            } elseif ($password === null) {
                    $this->response([
                       'status' => false,
                       'message' => 'password kosong'
                   ], 404);
            }else {
               if (array_key_exists($password, $users)) {
                    $this->response($users[$password], 200);
                } else {
                    $this->response([
                       'status' => false,
                       'message' => 'No such user found'
                   ], 404);
               }
            }
        }
    public function index_post(){
        $data = array(
                    'emails'           => $this->post('email'),
                    'passwords'          => $this->post('password'));
        $respon =array('email' => 'test@gmail.com','token' => 'asdasdsad' );
        //$insert = $this->db->insert('telepon', $data);
        if (!empty($data)) {
            $this->response($respon, 200);
        } else {
            $this->response([
                       'status' => false,
                       'message' => 'No such user found'
                   ], 404);
        }
    }

    public function index_put(){

    }

    public function index_delete(){

    }

}
