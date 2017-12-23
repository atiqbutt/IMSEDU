<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Load_model extends CI_Model 
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function menu()
    {
        $admin = $this->user_model->userInfo('id')['id'];
        $per_menu = $this->db->query("SELECT DISTINCT `permission`.`menu_id`,`menu`.`name`,`menu`.`icon` FROM `permission` INNER JOIN `menu` ON `menu`.`id` = `permission`.`menu_id` WHERE `permission`.`admin_id`='$admin' AND `menu`.`is_delete`='0' ORDER BY `menu`.`order` ASC")->result_array();
        $per_submenu = $this->db->query("SELECT `permission`.`menu_id`,`submenu`.`name`,`submenu`.`link` FROM `permission` INNER JOIN `submenu` ON `submenu`.`id` = `permission`.`submenu_id` WHERE `permission`.`admin_id`='$admin' AND `submenu`.`is_delete`='0'")->result_array();

        $return = "";

        foreach ($per_menu as $k => $v) {
            $m_id = $v['menu_id'];
            $m_name = $v['name'];
            $m_icon = $v['icon'];
            $return .= '<li><a><i class="fa '.$m_icon.'"></i>'.$m_name.' <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">';
            foreach($per_submenu as $key=>$value)
            {
                $s_id = $value['menu_id'];
                $s_name = $value['name'];
                $s_link = $value['link'];
                if($m_id==$s_id)
                    $return .= '<li><a href="'.base_url().$s_link.'">'.$s_name.'</a></li>';
            }
              $return .= '</ul>
                  </li>';
        }

        return $return;
    }

    public function menu_array($id="")
    {
        if(empty($id))
            $admin = $this->user_model->userInfo('id')['id'];
        else
            $admin = $id;
        $per_menu = $this->db->query("SELECT DISTINCT `permission`.`menu_id`,`menu`.`name`,`menu`.`icon` FROM `permission` INNER JOIN `menu` ON `menu`.`id` = `permission`.`menu_id` WHERE `permission`.`admin_id`='$admin' AND `menu`.`is_delete`='0'")->result_array();
        $per_submenu = $this->sub_menu($admin);

        $return = array();

        foreach ($per_menu as $k => $v) {
            $m_id = $v['menu_id'];
            $m_name = $v['name'];
            $sub = array(); 
            foreach($per_submenu as $key=>$value)
            {
                $s_id = $value['menu_id'];
                $sub_id = $value['id'];
                $s_name = $value['name'];
                if($m_id==$s_id)
                    $sub[] = array($s_id,$s_name,$sub_id);
            }
            $return[] = array($m_id,$m_name,$sub);
        }

        return $return;
    }

    public function sub_menu($id="")
    {
        if(empty($id))
            $admin = $this->user_model->userInfo('id')['id'];
        else
            $admin = $id;
        return $this->db->query("SELECT `permission`.`menu_id`,`submenu`.`id`,`submenu`.`name`,`submenu`.`link` FROM `permission` INNER JOIN `submenu` ON `submenu`.`id` = `permission`.`submenu_id` WHERE `permission`.`admin_id`='$admin' AND `submenu`.`is_delete`='0'")->result_array();
    }

    public function per_menu($id="")
    {
        if(empty($id))
            $admin = $this->user_model->userInfo('id')['id'];
        else
            $admin = $id;
        $curr_user = $this->user_model->userInfo('id')['id'];
        $return = "";
        $sub_i = $this->sub_menu($admin);
        if($this->user_model->is_super())
        {
            $menus = $this->db->query("SELECT id,name FROM `menu` WHERE `is_delete`='0'")->result_array();
            $sub = $this->db->query("SELECT `submenu`.`id`,`submenu`.`name`,`submenu`.`menu_id` FROM `submenu` WHERE `is_delete`='0'")->result_array();
            foreach($menus as $k=>$v){
                $return .= '<h2>'.$v['name'].'</h2>';
                foreach ($sub as $key => $value) { 
                    if($value['menu_id']==$v['id']){
                        $i = $this->user_model->search_multi_arr($sub_i,"name",$value["name"]);
                        if($admin!=$curr_user)
                        {
                            if($i)
                                $a = "checked";
                            else
                                $a = "";
                        }else
                            $a = "";
                        $return .= '<div class="checkbox">
                            <label>
                                <input type="checkbox" class="sub_menu" '.$a.' name="permissions[]" value="'.$v['id'].'_'.$value['id'].'"> '.$value['name'].'
                            </label>
                        </div>';      
                    }
                }
            } 
        }else{
            $permissions = $this->menu_array();
            foreach ($permissions as $key => $value) {
                $return .= '<h2>'.$value[1].'</h2>';
                foreach ($value[2] as $key => $v) { 
                    if($value[0]==$v[0]){
                        $i = $this->user_model->search_multi_arr($sub_i,"name",$v[1]);
                        //var_dump($admin,$curr_user);
                        if($admin!=$curr_user)
                        {
                            if($i)
                                $a = "checked";
                            else
                                $a = "";
                        }else
                            $a = "";
                        $return .= '<div class="checkbox">
                            <label>
                                <input type="checkbox" class="sub_menu" '.$a.' name="permissions[]" value="'.$value[0].'_'.$v[2].'"> '.$v[1].'
                            </label>
                        </div>';       
                    }
                }
            }
        } 
        return $return;
    }
     public function data_emp($ref="",$val=0)
    {
        $branch=$this->user_model->getbranch();
        if($ref=="teacher"){
            
            $this->db->select("id,CONCAT(firstname,' ', lastname) as name");
            $this->db->from('teacher');
            $this->db->where('branch',$branch)->where('is_delete',0)->where('id',$val);
            
            $data=$this->db->get()->result_array()[0];
            return $data;
        }else if($ref=="staff"){
            $this->db->select("id,CONCAT(firstname,' ', lastname) as name");
            $this->db->from('staff');
            $this->db->where('branch',$branch)->where('status',0)->where('id',$val);;
            
            $data=$this->db->get()->result_array()[0];
             return $data;
        }else{echo "";}
    }

}


?>