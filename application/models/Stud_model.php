<?php 
   class Stud_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
      } 
   
      public function insert($data) { 
         if ($this->db->insert("stud", $data)) { 
            return true; 
         } 
      } 
   
      public function delete($ci) { 
         if ($this->db->delete("stud", "ci = ".$ci)) { 
            return true; 
         } 
      } 
   
      public function update($data,$old_ci) { 
         $this->db->set($data); 
         $this->db->where("ci", $old_ci); 
         $this->db->update("stud", $data); 
      } 
   } 
?> 