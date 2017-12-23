<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Backup_model extends CI_Model {

	private $con;
	private $host;
	private $user;
	private $pass;
	private $name;

	public function __construct()
	{
		$this->con = new mysqli($this->db->hostname,$this->db->username,$this->db->password,$this->db->database);
		$this->host = $this->db->hostname;
		$this->user = $this->db->username;
		$this->pass = $this->db->password;
		$this->name = $this->db->database;
	}

	public function export($file=""){
	    $mysqli = $this->con;
	    $mysqli->select_db($this->name); 
	    $mysqli->query("SET NAMES 'utf8'");
	    $queryTables = $mysqli->query('SHOW TABLES');
	    while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }   
	    foreach($target_tables as $table){
	        $result = $mysqli->query('SELECT * FROM '.$table);  $fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows;     $res = $mysqli->query('SHOW CREATE TABLE '.$table); $TableMLine=$res->fetch_row();
	        $content = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n--";
	        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
	            while($row = $result->fetch_row())  { //when started (and every after 100 command cycle):
	                if ($st_counter%100 == 0 || $st_counter == 0 )  {$content .= "\nINSERT INTO ".$table." VALUES";}
	                    $content .= "\n(";
	                    for($j=0; $j<$fields_amount; $j++)  { $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ; }else {$content .= '""';}     if ($j<($fields_amount-1)){$content.= ',';}      }
	                    $content .=")";
	                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
	                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";--";} else {$content .= ",";} $st_counter=$st_counter+1;
	            }
	        } $content .="\n\n\n--";
	    }
	    if($file == "")
	    	$backup_name = $this->name."_(".date('H-i')."_".date('d-m-Y').").sql";
	    else
	    	$backup_name = $file;
	    file_put_contents("./backup/".$backup_name,$content);
	}

	public function import($file="",$name=""){
	    if(!empty($file) AND !empty($name))
	    {
	    	$content = file_get_contents("./backup/".$file);
	    	$a = explode("--",$content);
	    	$mysqli = new mysqli($this->host,$this->user,$this->pass,$name);
	    	$queryTables = $mysqli->query('SHOW TABLES');
	    	while($row = $queryTables->fetch_row())  {
	    		$mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
	    	}
	    	foreach ($a as $key => $value) {
	    		if(empty($value))
	    			unset($a[$key]);
	    		else
	    			$mysqli->query($value);
	    	}
	    }else{
	    	echo "No file/database name";
	    }
	}

}
