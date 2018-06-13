<?php  

	class Apicontrollers extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model('apicontroller');
		}

		public function trial(){
			$form_data = array(
					'fname'=>"Chaprel"
			);
			//echo ($this->apicontroller->update(4,$form_data));
			echo base_url();
			//$this->load->view("Dashboard");

		}

		public function login(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$username = $request->username;
				$password = $request->password;
				print_r(json_encode($this->apicontroller->login($username,md5(sha1($password)))));
			}else{
				echo json_encode("error");
			}
		}

		public function addUser(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$fname = $request->fname;
				$lname = $request->lname;
				$username = $request->username;
				$password = $request->password;
				$form_data = array(
								'fname'=>ucwords(strtolower(trim($fname))),
								'lname'=>ucwords(strtolower(trim($lname))),
								'username'=>strtolower(trim($username)),
								'password'=>md5(sha1(trim($password))),
								'isActive'=>1,
								'userType'=>'User',
							 );
				if($this->apicontroller->duplicateTrapper($username) == 1){
					echo json_encode("duplicate");
				}else{
					$holder = $this->apicontroller->addUser($form_data);
					print_r(json_encode($this->apicontroller->getUser($holder)));
				}
			}else{
				echo json_encode("error");
			}
		}

		public function getWeight(){
			$weight = file_get_contents("http://192.168.22.12");
			echo json_encode($weight);
			// echo json_encode("google");
		}

		public function update(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$userID = $request->userID;
				$fname = $request->fname;
				$lname = $request->lname;
				$username = $request->username;
				$form_data = array(
						"fname"=>$fname,
						"lname"=>$lname,
						"username"=>$username
										);
				if($this->apicontroller->duplicateTrapper($username) == 1){
					$userDataHolder = $this->apicontroller->getUser($userID);
					if($userDataHolder["username"] == $username){
						$this->apicontroller->update($userID,$form_data);
						print_r(json_encode($this->apicontroller->getUser($userID)));
					}
					else{
						echo json_encode("duplicate");						
					}
				}else{
					$this->apicontroller->update($userID,$form_data);
					print_r(json_encode($this->apicontroller->getUser($userID)));
				}
			}else{
				echo json_encode("error");
			}
		}

		public function changepass(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$userID = $request->userID;
				$password = $request->password;
				$form_data = array(
							"password"=>md5(sha1($password))
										);
				$this->apicontroller->update($userID,$form_data);
				print_r(json_encode($this->apicontroller->getUser($userID)));
			}else{
				echo json_encode("error");
			}
		}

		public function setFeedTime(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$userID = $request->userID;
				$time = $request->time;
				$description = $request->description;
				$isActive = 1;
				$form_data = array(
												"userID"=>$userID,
												"time"=>$time,
												"description"=>$description,
												"isActive"=>$isActive
										);
				$information = $this->apicontroller->setFeedTime($form_data,$userID,$time);
				if($information == true){
					echo json_encode('duplicate');
				}else{
					print_r(json_encode($this->apicontroller->getFeedTime($userID)));
				}
			}else{
				echo json_encode("error");
			}
		}

		public function getFeedTime(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$userID = $request->userID;
				$information = $this->apicontroller->getFeedTime($userID);
				if($information == false){
					echo json_encode("none");
				}else{
					print_r(json_encode($information));
				}
			}else{
				echo json_encode('error');
			}
		}

		public function deleteFeedTime(){
			$postdata = file_get_contents("php://input");
			if(isset($postdata)){
				$request = json_decode($postdata);
				$feedTimeID = $request->feedTimeID;
				$information = $this->apicontroller->deleteFeedTime($feedTimeID);
				if($information == true){
					echo json_encode("success");
				}else{
					echo json_encode("not-deleted");
				}
			}else{
				echo json_encode("error");
			}
		}

		public function disableFeedTime(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$feedTimeID = $request->feedTimeID;
				$form_data = array(
								'isActive'=>0
				);
				$information = $this->apicontroller->disableFeedTime($feedTimeID,$form_data);
				if($information == true){
					echo json_encode('success');
				}else{
					echo json_encode('not-disabled');
				}
			}else{
				echo json_encode('error');
			}
		}

		public function enableFeedTime(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$feedTimeID = $request->feedTimeID;
				$form_data = array(
								'isActive'=>1
				);
				$information = $this->apicontroller->enableFeedTime($feedTimeID,$form_data);
				if($information == true){
					echo json_encode('success');
				}else{
					echo json_encode('action-denied');
				}
			}else{
				echo json_encode('error');
			}
		}

		public function getLogs(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$userID = $request->userID;
				$data = $this->apicontroller->getLogs($userID);
				echo json_encode($data);
			}
		}

		public function getMoreInfo(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$logID = $request->logID;
				$data = $this->apicontroller->getMoreInfo($logID);
				echo json_encode($data);
			}
		}

		public function feedInfo(){
			$postdata = file_get_contents('php://input');
			if(isset($postdata)){
				$request = json_decode($postdata);
				$feedID = $request->feedID;
				$data = $this->apicontroller->feedInfo($feedID);
				echo json_encode($data);
			}
		}

		public function getAllFeeds(){
			$data = $this->apicontroller->getAllFeeds();
			echo json_encode($data);
		}

	}

?>