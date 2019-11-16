<?php 
    class Mahasiswa_model extends CI_Model{ 
         
        public function getMahasiswa($id=null){ 
            if($id===null){
                return $this->db->get('mahasiswa')->result_array();  
                // select * from mahasiswa 
            } 
            else{ 
                return $this->db->get_where('mahasiswa',['id'=>$id])->result_array(); 
                // melakukan select berdasarkan data id 
            }  
        } 
        public function deleteMahasiswa($id){
            $this->db->delete('mahasiswa',['id'=>$id]); 
            // mereturn jumlah baris yang mempengaruhi di dalam table sehingga data dapat di check di controller 
            return $this->db->affected_rows();
        } 
        public function createMahasiswa($data){ 
            $this->db->insert('mahasiswa',$data); 
            // mengembalikan jumlah data yang dijalankan 
            return $this->db->affected_rows();
        } 
        public function udpateMahasiswa($data, $id){ 
            $this->db->where('id', $id);
            $this->db->update('mahasiswa', $data); 
            // mengembalikan jumlah data yang dijalankan 
            return $this->db->affected_rows();
        }
    }
?>  