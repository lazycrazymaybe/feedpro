<?php  

	class Admin extends CI_Model{

		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
		}

		public function login($username,$password){
			$this->db->select()->from('tbl_users')->where(array('username'=>$username,'password'=>md5(sha1($password)),'userType'=>'Admin'));
			$query = $this->db->get();
			return $query->result_array();
		}
		public function userCounter(){
			$this->db->select()->from('tbl_users')->where(array('isActive'=>1,'userType'=>"User"));
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function getMonthlyRegCount($date){
			$this->db->select()->from('tbl_users')->like('date',$date);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function getMonthlyLogCount($date){
			$this->db->select()->from('tbl_logs')->like('date',$date);
			$query = $this->db->get();
			return $query->num_rows();
		}
		//START OF AJAX For USERS
		public function getRecentRegistrations(){
			$order_column = array("userID","lname","username","date","userType",null,null);  
			$this->db->select()->from('tbl_users');
			if(isset($_POST["search"]["value"])){  
	            $this->db->or_like("lname", $_POST["search"]["value"])->or_like("fname", $_POST["search"]["value"])->or_like("username", $_POST["search"]["value"])->or_like("date", $_POST["search"]["value"])->or_like("userType", $_POST["search"]["value"])->or_like("username", $_POST["search"]["value"]);  
            }
            if(isset($_POST['order'])){
            	$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
            }
            else{
            	$this->db->like('date',date('Y-m', strtotime('first day of last month')))->or_like('date',date('Y-m',strtotime('this day')))->order_by('date', 'DESC');
            }  			
		}
		public function make_datatables(){  
       		$this->getRecentRegistrations();  
	        if($_POST["length"] != -1){  
	            $this->db->limit($_POST['length'], $_POST['start']);  
	        }  
	        $query = $this->db->get();  
	        return $query->result_array();  
        }  
        public function getFilteredData(){  
        	$this->getRecentRegistrations();  
            $query = $this->db->get();  
            return $query->num_rows();  
        }  
        public function getAllData(){  
        	$this->db->select("*");  
           	$this->db->from("tbl_users");  
           	return $this->db->count_all_results();  
      	}  
		//END OF AJAX USERS
		//START OF AJAX LOGS
		public function todaysLogs(){
			$order_column = array("logs.logID","users.username","logs.weight","logs.date","logs.cost","logs.comment");  
			$this->db->select('logs.logID,users.username,logs.weight,logs.date,logs.comment,logs.userID,logs.cost')->from('tbl_users users, tbl_logs logs');
			if(isset($_POST["search"]["value"])){  
				$this->db->like('users.username',$_POST["search"]["value"]);
            }
			if(isset($_POST['order'])){
            	$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
            }
			$this->db->where('logs.userID = users.userID');
		}
		public function makeDatatablesDailyLogs(){  
       		$this->todaysLogs();  
	        if($_POST["length"] != -1){  
	            $this->db->limit($_POST['length'], $_POST['start']);  
	        }  
	        $query = $this->db->get();  
	        return $query->result_array();  
        } 
        public function getFilteredDataDailyLogs(){  
        	$this->todaysLogs();  
            $query = $this->db->get();  
            return $query->num_rows();  
        }  
        public function getAllDataDailyLogs(){  
        	$this->db->select("*");  
           	$this->db->from("tbl_logs")->like('date',date('Y-m-d'));  
           	return $this->db->count_all_results();  
      	}   
      	// END OF AJAX DAILY LOGS
      	// FEEDS AJAX
      	public function getAllFeeds(){
      		$order_column = array("feedName","crudeProtein","crudeFiber","crudeFat","Calcium","Moisture","Phosphorous","maximumInclusion","costPerKilo",null);  
      		$this->db->from('tbl_feeds');
      		if(isset($_POST['search']['value'])){
      			$temp = $_POST['search']['value'];
      			$this->db->like('feedName',$temp)->or_like('crudeProtein',$temp)->or_like('crudeFiber',$temp)->or_like('crudeFat',$temp)->or_like('Calcium',$temp)->or_like('Moisture',$temp)->or_like('Phosphorous',$temp)->or_like('maximumInclusion',$temp)->or_like('costPerKilo',$temp);
      		}
      		if(isset($_POST['order'])){
      			$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
      		}else{
      			$this->db->order_by('feedName',"DESC");
      		}
      	}
      	public function makeDatatablesFeeds(){
      		$this->getAllFeeds();
      		$query = $this->db->get();
      		return $query->result_array();
      	}
      	public function getFilteredFeeds(){
      		$this->getAllFeeds();
      		$query = $this->db->get();
      		return $query->num_rows();
      	}
      	public function getAllDataFeeds(){
      		$this->db->select('*')->from('tbl_feeds');
      		return $this->db->count_all_results();
      	}
      	// END FEEDS AJAX
      	// FETCH 10 NEW USERS FOR DASHBOARD PANNELS
      	public function getNewRegistrarions(){
      		$this->db->select()->from('tbl_users')->like('date',date('Y-m',strtotime('first day of this month')))->limit(10)->order_by('date','DESC');
      		$query = $this->db->get();
      		return $query->result_array();
      	}
      	//FETCH 10 NEW LOGS FOR DASHBOARD
      	public function getNewLogs(){
      		$this->db->select('logs.logID,users.username,logs.weight,logs.date,logs.comment,logs.userID')->from('tbl_users users, tbl_logs logs');
      		$this->db->like('logs.date',date('Y-m-d'))->limit(10)->where('logs.userID = users.userID')->order_by('logs.date',"DESC");
      		$query = $this->db->get();
      		return $query->result_array();
      	}
		public function fetchUser($userID){
			$this->db->select()->from('tbl_users')->where('userID',$userID);
			$query = $this->db->get();
			return $query->first_row();
		}
		public function fetchFeed($feedID){
			$this->db->select()->from('tbl_feeds')->where('feedID',$feedID);
			$query = $this->db->get();
			return $query->first_row();
		}

		public function updateUser($userID,$userdata){
			$this->db->where('userID',$userID);
			$this->db->update('tbl_users',$userdata);
		}

		public function updateFeed($feedID,$data){
			$this->db->where('feedID',$feedID);
			$this->db->update('tbl_feeds',$data);
			return $this->db->affected_rows();
		}

		public function createUser($data){
			$this->db->insert('tbl_users',$data);
			return $this->db->insert_id();
		}

		public function getNotifications(){
			$this->db->select('u.fname,u.lname,n.type,n.notificationID')->from('tbl_users u, tbl_notifications n')
			->where('u.userID = n.userID')->limit(5)->order_by('notificationID',"DESC");
			$query = $this->db->get();
			return $query->result_array();
		}

		public function countUnreadNotification(){
			$this->db->select()->from('tbl_notifications')->where('seen',1);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function createNotification($data){
			$this->db->insert('tbl_notifications',$data);
			return $this->db->insert_id();
		}

		public function readNotification($data){
			$this->db->update('tbl_notifications',$data);
			return $this->db->affected_rows();
		}

		public function forGraphs(){
			$this->db->select('date')->from('tbl_users');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function duplicateTrapper($username){
			$this->db->from('tbl_users')->where('username',$username);
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return true;
			}
		}

	}

?>