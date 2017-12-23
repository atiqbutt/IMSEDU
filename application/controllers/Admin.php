<?php
class Admin extends CI_Controller{

public function index()
{
    $this->load->view('Admin/login');
   
}

public function validate_login()
{
  $name=$this->input->post('Name');
  $pass=$this->input->post('Password');
  
 $result= $this->Admin_model->validate_login($name,$pass);
   if($result==TRUE)
    {
      $this->session->set_userdata('user_id',$result);
             redirect('Admin/dashboard');
    }
    else 
     {
       $this->session->set_flashdata('error','Invalid username or passwors');
        redirect('Admin/index');
     }
}

public function dashboard()
{
  if(!$this->session->userdata('user_id'))
  {
     redirect('admin/index');
  }
  else
    {
      $this->load->view('Admin/header');
      $this->load->view('Admin/side_bar');
       $this->load->view('Admin/footer');
    }
}

public function log_out()
{
          $this->session->unset_userdata('user_id');
          $this->session->sess_destroy();
              redirect('admin/index');
}
    public function new_slider()
   {
          if(!$this->session->userdata('user_id'))
            {
                redirect('admin/index');
              }
          else{
                  $this->load->view('admin/new_slider');
              }
    } 

    public function upload_slider()
        {
                   $url=$this->do_upload();
                   $data = array(
                        'image_name'=>$this->input->post('name'),
                        'image' => $url);

                       $msg= $this->Admin_model->upload_slider($data);
                       if($msg)
                       {
                           $this->session->set_flashdata('msg','Image successfully uploades');
                            redirect('Admin/new_slider');
                       }
                       else
                       {
                         $this->session->set_flashdata('msg','Error occur');
                            redirect('Admin/new_slider');
                       }
                        

        }

        public function do_upload()
    {
         
          $type = explode('.', $_FILES["img"]["name"]);
          $type = $type[count($type)-1];
          $url = "assets/images/".uniqid(rand()).'.'.$type;
             if (in_array($type, array("png","jpg","jpeg","gif")))
             if(move_uploaded_file($_FILES["img"]["tmp_name"], $url)){
              $this->load->library('image_lib');
              $config= array('image_library' =>"gd2" ,
                                'source_image'=>$url,
                                'maintain_ratio'=>true,
                                 );
              $this->image_lib->initialize($config);
              if($this->image_lib->resize()){
                    return $url;
                }
            }
             return null;

    }

    public function view_slider()
    {
       $data['get_data']=$this->Admin_model->get_slider();
       
      $this->load->view('Admin/slider',$data);
    }

   public function del_img_slider($id)
           {
         
          $this->Admin_model->del_img_slider($id);
          redirect('Admin/view_slider');
  
           }

            public function view_slider_byid($id)
               {

                     if(!$this->session->userdata('user_id'))
                         {
                             return redirect('Admin/index');
                          }
                   else
                   {
                        $data['get_data']=$this->Admin_model->view_slider_byid($id);
                        $this->load->view('Admin/edit_slider',$data);
                   }
          
             }

           public function add_gallery()
           {
             if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                     $this->load->view('Admin/gallery');
                   }
           }

            public function new_notice()
           {
             if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                     $this->load->view('Admin/add_notice');
                   }
           }

           public function upload_gallery()
           {
              $url=$this->do_upload();
          $data = array(
       				'image_name' => $this->input->post('heading'),
       				'description' => $this->input->post('dis'),
       				'image'=>$url );	
       	$result=$this->Admin_model->insert_glr_img($data);
         if($result)
         {
            $this->session->set_flashdata('msg','Image successfully uploades');
            $this->load->view('Admin/gallery');
         }
       	
           }

             public function insert_notice()
           {
        
          $data = array(
       				'title' => $this->input->post('heading'),
       				'description' => $this->input->post('dis')
       				 );	
            	$result=$this->Admin_model->insert_notice($data);
                   if($result)
                    {
                       $this->session->set_flashdata('msg',' successfully uploades');
                       $this->load->view('Admin/add_notice');
                     }
       	
           }

           public function gallery(){
            
            if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  $g_data['data']=$this->Admin_model->gallery();
                  $this->load->view('Admin/view_gallery',$g_data);
                   }

           }

             public function Notice(){
            
            if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  $g_data['data']=$this->Admin_model->Notice();
                  $this->load->view('Admin/view_notice',$g_data);
                   }

           }

           public function delet_gallery($id)
            {
          
              $this->Admin_model->delete_gallery($id);
              redirect('Admin/gallery');

             }

               public function delet_notice($id)
            {
          
              $this->Admin_model->delete_notice($id);
              redirect('Admin/Notice');

             }

             public function view_image_byid($id)
               {

                     if(!$this->session->userdata('user_id'))
                         {
                             return redirect('Admin/index');
                          }
                   else
                   {
                        $data['get_data']=$this->Admin_model->view_image_byid($id);
                        $this->load->view('Admin/edit_gallery',$data);
                   }
          
             }

              public function view_notice_byid($id)
               {

                     if(!$this->session->userdata('user_id'))
                         {
                             return redirect('Admin/index');
                          }
                   else
                   {
                        $data['get_data']=$this->Admin_model->view_notice_byid($id);
                        $this->load->view('Admin/edit_notice',$data);
                   }
          
             }

             public function edit_slider()
              {
         
        
           if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                    $url=$this->do_upload();
                    $id=$this->input->post('u_id');
                    if($url==NULL)
                    {
                     $url=$this->input->post('my_img');
                     }
    
                   $data = array(
                    'image'=>$url,
                    'image_name' => $this->input->post('heading')

                      );

          
                     $this->Admin_model-> edit_slider($id,$data);
                     redirect('Admin/view_slider');
                    
                   }
       }

             
public function edit_gallery()
   {
         
        
           if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                    $url=$this->do_upload();
                    $id=$this->input->post('u_id');
                     if($url==NULL)
                     {
                       $url=$this->input->post('my_img');
                     }
                    
                   $data = array(
                    'image'=>$url,
                    'image_name' => $this->input->post('heading'),
                    'description' => $this->input->post('dis')
                     
                      );

          
                     $this->Admin_model->edit_gallery($id,$data);
                     redirect('Admin/gallery');
                    
                   }
       }

       public function edit_notice()
   {
         
        
           if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                   
                    $id=$this->input->post('u_id');
                    
                    
                   $data = array(
                    
                    'title' => $this->input->post('heading'),
                    'description' => $this->input->post('dis')
                     
                      );

          
                     $this->Admin_model->edit_notice($id,$data);
                     redirect('Admin/Notice');
                    
                   }
       }

       public function teacher()
                {
               if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  
              $this->load->view('Admin/new_teacher');
                   }
       
      
                }

   public function new_teacher()
   {  
      
      if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  
               $url=$this->do_upload();
         $data = array(
              
              'name' => $this->input->post('name'),
               'image'=>$url,
              'designation' => $this->input->post('dis')
              );

              
             $result= $this->Admin_model->save_teacher($data);
             if($result)
             {
                $this->session->set_flashdata('msg','Image successfully uploades');
               redirect('Admin/teacher');
             }
                   }

     
   }

   public function view_teacher()
   {
      
       if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  
             $data['get_data']=$this->Admin_model->view_teacher();
              $this->load->view('Admin/view_teacher',$data);
                   }
   }

     public function delete_teacher($del_id)
   {
       if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  
              $this->Admin_model->delete_teacher($del_id);
              redirect('Admin/view_teacher');
                   }
             

   }

     public function view_teacher_byid($id)
               {

                     if(!$this->session->userdata('user_id'))
                         {
                             return redirect('Admin/index');
                          }
                   else
                   {
                        $data['get_data']=$this->Admin_model->view_teacher_byid($id);
                        $this->load->view('Admin/edit_teacher',$data);
                   }
          
             }

          public function edit_teacher()
              {
         
        
           if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                    $url=$this->do_upload();
                    $id=$this->input->post('u_id');
                    if($url==NULL)
                    {
                     $url=$this->input->post('my_img');
                     }
    
                   $data = array(
                    'image'=>$url,
                    'name' => $this->input->post('name'),
                    'designation' => $this->input->post('designation')

                      );

          
                     $this->Admin_model-> edit_teacher($id,$data);
                     redirect('Admin/view_teacher');
                    
                   }
       }

   public function insert_feedback()
   {
       
   	      $data = array(
                 	    'name' => $this->input->post('name'),
                         'email' => $this->input->post('email'),
                        'message'=>$this->input->post('comments')
                 				 );

     			$this->Admin_model->insert_feedback($data);
                redirect('User/index');
   }

   public function getfeed_back()
       {

              if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  $data['get_data']=$this->Admin_model->feed_back();
                 
                 $this->load->view('Admin/feed_back',$data);
                   }
        
         
       }

       public function delete_feedback($del_id)
       {
 
                  if(!$this->session->userdata('user_id'))
                    {
                        return redirect('Admin/index');
                   }
                   else
                   {
                  
              $this->Admin_model->delete_feedback($del_id);
              redirect('Admin/getfeed_back');
                   }              
       }

            public function change_password()
          {
              $this->load->view('Admin/change_pass');
          }

          public function update_password()
          {
               $user_id =  $this->session->userdata('user_id');

            
            //var_dump( $user_id );die();

            $opass= $this->input->post('old_password');
            
            //var_dump(  $opass );die();

            $npass=$this->input->post('new_password');
            $cpass=$this->input->post('confirm_password');
            $dbpass = $this->db->select('password')->from('login')->where('id', $user_id)->get()->result();
            //var_dump(  $dbpass[0]->password );die();

            if($opass != $dbpass[0]->password){
             
                $this->session->set_flashdata('err-msg', 'The password you entered is not correct !');
                 redirect('Admin/change_password');

            }else{

                $data = array('password' =>$npass);
                $this->db->where('id', $user_id);
                $this->db->update('login', $data);
                $this->session->set_flashdata('msg', 'Your password has been Updated !');
                 redirect('Admin/change_password');
            }
          }
}

?>