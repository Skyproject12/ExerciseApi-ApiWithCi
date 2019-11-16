<?php 

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed'); 
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class mahasiswa extends REST_Controller{
    
    public function __construct(){
        parent::__construct(); 
        $this->load->model('Mahasiswa_model','mahasiswa');
        $this->load->database();
    }
     
    // method get
    public function index_get(){ 
        $id=$this->get('id'); 
        // jika id null
        if($id=== null){ 
            // request all  
            $mahasiswa=$this->mahasiswa->getMahasiswa(); 
        } 
        else{  
            // request id
            $mahasiswa=$this->mahasiswa->getMahasiswa($id);
        }
        if($mahasiswa){ 
            // check response status 
            $this->response([
                'status'=>true, 
                // mengambil data berupa format json
                'data'=>$mahasiswa, 
                'message' => 'Request Success'
            ], REST_Controller::HTTP_OK);
        } 
        else{ 
            $this->response([
                'status'=>false, 
                'message'=> 'not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // method delete 
    public function index_delete(){ 
        $id= $this->delete('id'); 
        if($id===null){ 
            $this->response([
                'status'=>false,
                'message'=>'provice an id'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } 
        else{ 
            // mengecek jumlah data yang akan di return 
            if($this->mahasiswa->deleteMahasiswa($id)>0){
                $this->response([
                    'status'=>true, 
                    'message'=>'Request Success'
                ], REST_Controller::HTTP_OK);
            }
            else{    
                $this->response([
                    'status'=>false,
                    'message'=>'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // method post 
    public function index_post(){
        $data=[
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'), 
            'email'=> $this->post('email'), 
            'jurusan'=> $this->post('jurusan')
        ];
        if($this->mahasiswa->createMahasiswa($data)>0){ 
            $this->response([
                'status'=>true, 
                'message'=> 'Success Created'
            ], REST_Controller::HTTP_OK); 

        } 
        else{ 
            $this->response([
                'status'=>false,
                'message'=>'failed create'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }  

    function index_put() {
        $id = $this->put('id');
        $data=[
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'), 
            'email'=> $this->put('email'), 
            'jurusan'=> $this->put('jurusan')
        ];
        $this->db->where('id', $id);
        $update= $this->db->update('mahasiswa',$data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}   