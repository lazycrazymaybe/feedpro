<?php 

	class Apicontroller extends CI_Model{

		public function getUser($userID){
			$this->db->select()->from("tbl_users")->where("userID",$userID);
			$query = $this->db->get();
			return $query->first_row("array");
		}

		public function login($username,$password){
			$this->db->select()->from('tbl_users')->where(array('username'=>$username,'password'=>$password,'userType'=>'User'));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return "no-data";
			}else{
				return $query->row_array();
			}
		}

		public function addUser($data){
			$this->db->insert('tbl_users',$data);
			return $this->db->insert_id();
		}

		public function update($userID,$data){
			$this->db->where('userID',$userID);
			$this->db->update('tbl_users',$data);
			if($this->db->affected_rows() > 0){
				return "ok";
			}else{
				return "failed";
			}
		}

		public function setFeedTime($data,$userID,$time){
			$this->db->from("tbl_feedtime")->where(array('userID'=>$userID, 'time'=>$time));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				$this->db->insert('tbl_feedtime',$data);
				$this->db->insert_id();
			}else{
				return true;
			}
		}

		public function getFeedTime($userID){
			$this->db->select()->from('tbl_feedtime')->where(array('userID'=>$userID))->order_by('time','ASC');
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return $query->result();
			}
		}

		public function deleteFeedTime($feedTimeID){
			$this->db->where('feedTimeID',$feedTimeID);
			$this->db->delete('tbl_feedtime');
			if($this->db->affected_rows() == 0){
				return false;
			}else{
				return true;
			}
		}

		public function disableFeedTime($feedTimeID,$data){
			$this->db->where('feedTimeID',$feedTimeID);
			$this->db->update('tbl_feedtime',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function enableFeedTime($feedTimeID,$data){
			$this->db->where('feedTimeID',$feedTimeID);
			$this->db->update('tbl_feedtime',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function getLogs($userID){
			$this->db->select()->from('tbl_logs')->where('userID',$userID)->order_by('date',"DESC");
			$query = $this->db->get();
			return $query->result_array();
		}

		public function getMoreInfo($logID){
			$this->db->select()->from('tbl_feeds feeds, tbl_feedsused fd')
			            ->where("logID",$logID)
			            ->where("fd.feedID = feeds.feedID");
			$query = $this->db->get();
			return $query->result_array();
		}

		public function feedInfo($feedID){
			$this->db->select()->from('tbl_feeds')->where('feedID',$feedID);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function getAllFeeds(){
			$this->db->select()->from('tbl_feeds');
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