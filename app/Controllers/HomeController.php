<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use Database;
use PDO;

class HomeController extends Controller{
    function __construct()
	{
		if(empty(user())){
			return redirect('/login');
		}
	}
	public function index($_get){
	    $user=user();
	    $obj=new Database();
		$sql="SELECT count(*) as total_users FROM users WHERE role!='Admin'";
		$stmt = $obj->con->query($sql); 
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data=toObject($data);
		$total_users=$data->total_users;
        $body = $this->view('dashboard/pages/index',compact('_get'));
        include_once $this->load('dashboard/layout');
	}

	public function users($_get){
	    $user=user();

		if($user?->role=='Admin'){
			$obj=new Database();
			$sql="SELECT id,username,email FROM users WHERE role!='Admin'";
			$stmt = $obj->con->query($sql); 
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$users=toObject($data,true);
			$body = $this->view('dashboard/pages/users',compact('_get'));
			include_once $this->load('dashboard/layout');
		}
		return back();
	}

	public function user_edit($_get){
	    $user=user();
		if($user?->role=='Admin'){
			$obj=new Database();
			$sql="SELECT id,username,email,role FROM users WHERE id='$_get[user_id]'";
			$stmt = $obj->con->query($sql); 
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$profile=toObject($data);
            $body = $this->view('dashboard/pages/user_edit',compact('_get','profile'));
            include_once $this->load('dashboard/layout');
		}
	    return back();
	}

	public function profile($_get){
	    $user=user();
		if($user?->id==$_get['user_id']||$user?->role=='Admin'){
			$obj=new Database();
			$sql="SELECT id,username,email,role FROM users WHERE id='$_get[user_id]'";
			$stmt = $obj->con->query($sql); 
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$profile=toObject($data);
            $body = $this->view('dashboard/pages/profile',compact('_get','profile'));
            include_once $this->load('dashboard/layout');
		}else{
           return back();
		}
        
	}

	public function user_update($_post){
		$user=user();
		if($user?->id==$_post['user_id']||$user?->role=='Admin'){
            $obj=new Database();
			$sql="UPDATE users SET username='$_post[username]',email='$_post[email]' WHERE id='$_post[user_id]'";
			$obj->con->query($sql);
		}
		return back();
	}

	public function user_change_password($_post){
		$user=user();
	    
		if($user?->id==$_post['user_id']||$user?->role=='Admin'){
            $obj=new Database();
			$sql="SELECT password FROM users WHERE id='$_post[user_id]'";
			$stmt = $obj->con->query($sql); 
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$profile=toObject($data);
			if(password_verify($_post['password'],$profile->password)){
				$has_pass=password_hash($_post['newpassword'],PASSWORD_DEFAULT);
				$sql="UPDATE users SET password='$has_pass' WHERE id='$_post[user_id]'";
				$obj->con->query($sql);
			}
		}
		return back();
	}

	public function user_destroy($_get){
	    $user=user();
		if($user?->id==$_get['user_id'] || $user?->role=='Admin'){
			$obj=new Database();
			$sql="DELETE FROM users WHERE id='$_get[user_id]'";
			$obj->con->query($sql);
			if($user?->id==$_get['user_id']){
				session_start();
				unset($_SESSION["auth_user"]);
				return redirect('/login');
			}
		}
		return back();
	}
}