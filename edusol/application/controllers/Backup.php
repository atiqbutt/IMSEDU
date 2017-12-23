<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
    private $userInfo  = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("backup_model");
        $this->user_model->check_login("backup");
        date_default_timezone_set("Asia/Karachi");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

	public function index()
	{
        $this->user_model->check_permissions('backup/index');
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('home/backup',$data);
	}

    public function export()
    {
        $ext = ".sql";
        if($this->input->post())
        {
            $name = $this->input->post("name",true);
            if(!empty($name))
                $file = $name.$ext;
            else
                $file="";
            $this->backup_model->export($file);
        }
        redirect("backup/index","refresh");
    }

    public function import()
    {
        if($this->input->post())
        {
            $name = $this->input->post("file",true);
            $this->backup_model->import($name,$this->db->database);
        }
        redirect("backup/index","refresh");
    }

    public function download()
    {
        $file = $this->input->post("file",true);
        $path = "./backup/".$file;
        if(!empty($file))
        {
            if(file_exists($path))
            {
                header("Content-Type: text/sql");
                header('Content-Length: ' . filesize($path));
                header('Content-Disposition: attachment; filename="'.$file.'"');
                echo file_get_contents($path);
            }
        }
        redirect("backup/index","refresh");
    }

}
