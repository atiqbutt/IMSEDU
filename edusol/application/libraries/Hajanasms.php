<?php



    class Hajanasms{

        private $CI;

        function __construct() {
            $this->CI=&get_instance();
            $this->CI->config->load('sms_hajana_config');
            $this->url = $this->CI->config->item('url');
            $this->mask = $this->CI->config->item('mask');
            $this->CI->load->library('unirest');
            //$this->check_counter_table();
            //exit('inConstructor');
        }
		
	public function sendOneNumber($number='',$message='')
        {
            if($number!='' && $message!='') {
                //$allowed=$this->allowed_to_send(1,$message);
                //if($allowed) {
                    $number=$this->correctNumberFormat($number);
                    $this->sendMessage($number,$message);
                //}
            }else{
                return false;
            }
        }
		
        public function sendManyNumber($number='',$message='')
        {
            if($number!='' && $message!='') {
                //$allowed=$this->allowed_to_send(count($number),$message);
                //if($allowed) {
                    $number=$this->prepareNumbers($number);
                    $this->sendMessage($number,$message);
                //}
            }else{
                return false;
            }
        }

        public function correctNumberFormat($number='')
        {
            if($number!='') {
                $start=substr($number,0,2);
                if($start=="+9"){
                    return str_replace('+','',$number);
                }
                elseif($start=='03') {
                    return substr_replace($number,'92',0,1);
                }
                elseif($start=='92'){
                    return $number;
                }
                else {
                    return '';
                }
            }else{
                return false;
            }
        }

        public function prepareNumbers($numbers='')
        {
            $ready_numbers='';
            if($numbers!='') {
                foreach ($numbers as $key => $value) {
                    $ready_numbers.=(','.$this->correctNumberFormat($value));
                }
                return substr_replace($ready_numbers,'',0,1);
            }
        }

        public function sendMessage($number='',$message='')
        {
            
            if($number!='' && $message!='') {
                $message=rawurlencode($message);
                $base_url=$this->url;
                $mask=$this->mask;
                $send_url=$base_url.$number.'&sender='.$mask.'&message='.$message;
                //var_dump($send_url);die();
                //var_dump('<pre>',$send_url,'</pre>');
                //=========counting Total messages===========

                $pages=$this->getPages($message);
                $count_numbers=count(explode(',',$number));
                $total_messages=$count_numbers*$pages;
                //===========================================
                //accessing CI db

                #====>$result=$this->CI->db->get('admin')->result_array()[0];
                #====>var_dump('<pre>',$result);die();

                //ending db logic here
                //preparing to send sms=========starting curl_exec


                //if (!function_exists('curl_init')){
                //    die('cURL is not installed. Install and try again.');
                //}
                
                //$response = $this->CI->unirest->get($send_url);
                //$ch = curl_init();
                //curl_setopt($ch, CURLOPT_URL, $send_url);
                //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //$output = curl_exec($ch);
                //if($response) {
                //    $this->inc_counter($total_messages);
                //}
                //curl_close($ch);


                //releasing curl resources
                //echo $output;die();
            }
            else {
                return false;
            }
        }

        public function check_counter_table()
        {
            $status=$this->CI->db->table_exists('sms_details');
            if(!$status) {
                $this->CI->db->query("CREATE TABLE IF NOT EXISTS `sms_details`( `id` int(11) NOT NULL AUTO_INCREMENT, `sent` bigint(20) NOT NULL DEFAULT '0', `balance` bigint(20) NOT NULL DEFAULT '0',PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=latin1");
                $this->CI->db->query("INSERT INTO `sms_details` (`id`, `sent`, `balance`) VALUES (NULL, 0, 0);");        
            }
        }

        public function inc_counter($value='')
        {
            if($value=='')
            $value=1;
            $status=$this->CI->db->query("SELECT EXISTS(SELECT * FROM sms_details) as status")->row_array()['status'];
            if($status==1) {
                $this->CI->db->query("UPDATE `sms_details` set sent=(sent+$value)");
            }
            else{
                $this->CI->db->query("INSERT INTO `sms_details` (`id`, `sent`, `balance`) VALUES (NULL, $value, NULL);");
            }
        }

        public function getPages($msg='')
        {
            if($msg!='') {
                $length=strlen(rawurldecode($msg));
                if($length<=160) {
                    return 1;
                }
                elseif(($length%160)>0) {
                    return ($length%160)+1;
                }
                else{
                    return ($length%160);
                }
            }else{
                return false;
            }
        }

        public function allowed_to_send($count_numbers='',$message)
        {
            if($count_numbers!='' && $message!='')
            $pages=$this->getPages($message);
            $total_messages=$count_numbers*$pages;
            $current_stat=$this->CI->db->get('sms_details')->row_array();
            $sent=$current_stat['sent'];
            $sent=$current_stat['sent'];
            $balance=$current_stat['balance'];
            if($sent+$total_messages>$balance) {
                $window="<script>alert('You Are not allowed to send SMS, perhaps your Branded message bucket is over! Contact Softvilla')</script>";
                echo $window;
                return false;
            }else{
                return true;
            }
        }
		

 
    }

?>