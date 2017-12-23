<?php

class User extends CI_Controller{

public function index()
{
      $g_data['slidr_data']=$this->Admin_model->slider();
      $g_data['img_data']=$this->Admin_model->gallery_front();  
      $g_data['pos_data']=$this->Admin_model->faculty(); 
       $g_data['notice_data']=$this->Admin_model->get_board();  
    $this->load->view('Site',$g_data);
}


}
?>