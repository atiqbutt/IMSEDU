<?php

class Admin_model extends CI_Model{


   public function validate_login($name,$pass)
   {
       
        $qry=$this->db->where(['user_name'=>$name,'password'=>$pass])
                     ->get('login');
                     if($qry->num_rows())
                     {
                          return  $qry->row()->id;
                          
                     }
                     else{
                         return FALSE;
                     }
   }

   public function upload_slider($data)

   {
        return $this->db->insert('slider',$data);
   }

   public function get_slider()
   {
     
      $rzlt=$this->db->get('slider');
    	$qry=$rzlt->result();
    	return $qry;
   }

   public function del_img_slider($id)
    {
    		$this->db->where('id',$id);
    		$this->db->delete('slider');
    }

     public function view_slider_byid($id)
	{
		$this->db->where('id',$id);
		$data=$this->db->get('slider');
			return $data->row_array();
	}

     public function edit_slider($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('slider',$data);
	}

   public function insert_glr_img($data)
	{
	     return	$this->db->insert('gallery',$data);

	}

     public function insert_notice($data)
	{
	     return	$this->db->insert('notice_board',$data);

	}

    public function gallery()
	{

		$rzlt=$this->db->get('gallery');
		$qry=$rzlt->result();
		return $qry;

	}

     public function Notice()
	{

		$rzlt=$this->db->get('notice_board');
		$qry=$rzlt->result();
		return $qry;

	}

    public function delete_gallery($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('gallery');
	}

     public function delete_notice($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('notice_board');
	}

    public function view_image_byid($id)
	{
		$this->db->where('id',$id);
		$data=$this->db->get('gallery');
			return $data->row_array();
	}

     public function view_notice_byid($id)
	{
		$this->db->where('id',$id);
		$data=$this->db->get('notice_board');
			return $data->row_array();
	}

    public function edit_gallery($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('gallery',$data);
	}

      public function edit_notice($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('notice_board',$data);
	}

    public function save_teacher($data)
    {
           return $this->db->insert('teacher',$data);

    }

    public function view_teacher()
    {
            $rzlt=$this->db->get('teacher');
            $qry=$rzlt->result();
            return $qry;
    }
    public function delete_teacher($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('teacher');

    }

       public function view_teacher_byid($id)
	{
		$this->db->where('id',$id);
		$data=$this->db->get('teacher');
			return $data->row_array();
	}

      public function edit_teacher($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('teacher',$data);
	}

     public function feed_back()
    {
    	$rzlt=$this->db->get('feed_back');
    	$qry=$rzlt->result();
    	return $qry;

    }

     public function delete_feedback($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('feed_back');

    }

       public function insert_feedback($data)
    {
           $this->db->insert('feed_back',$data);

    }

    //for froent end

   public function slider()
    {
    	$rzlt=$this->db->get('slider');
    	$qry=$rzlt->result();
    	return $qry;

    }

    public function gallery_front()
	{
     	$rzlt=$this->db->get('gallery');
		$qry=$rzlt->result();
		return $qry;

	}

    public function faculty()
    {
            $rzlt=$this->db->get('teacher');
            $qry=$rzlt->result();
            return $qry;
    }

     public function get_board()
	{

		$rzlt=$this->db->select('*')
                        ->from('notice_board')
                            ->limit(6)
                            ->order_by('id','DESC')
                            ->get();
		$qry=$rzlt->result();
        		return $qry;

	}
}

?>