<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {


    public function Create($t="",$d=array())
    {
        if(!empty($t))
        {
            if($this->db->insert($t,$d))
                return true;
            else
                return false;
        }
    }
    public function Update($t="",$d=array(),$col,$id)
    {
        if(!empty($t))
        {
            $this->db->where($col,$id);
              $this->db->update($t,$d);
              return true;
        }else
                return false;
        
    }
    public function all($t="")
    {
        $this->db->select('*');
        $this->db->where('is_delete',0);
        $data=$this->db->get($t)->result_array();
        return $data;
    }
    public function id_($t='',$id=0,$col='')
    {
        $this->db->select('*'); 
            $this->db->from($t);
           $this->db->where($col,$id);
           $data =$this->db->get();
           $query=$data->result_array()[0];
           return $query;
    }
    public function up()
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] =$this->user_model->userInfo("first_name,last_name");
        return $data;
        
    }public function down($link="",$data=array())
    {
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view($link,$data);
        $this->load->view("footer");
    }
    public function dopaginate($total=0,$limit=0,$uri=0,$base="")
    {
        
        $config['total_rows']=$total;
        $config['per_page']=$limit;
        $config['uri_segment']=$uri;
        $config['base_url']=base_url().$base;
        $config["full_tag_open"] = '<ul class="pagination pull-right">';
        $config["full_tag_close"] = '</ul>';	
        $config["first_link"] = true;
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = true;
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="'.$config['base_url'].'/'.$limit.'">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

}
