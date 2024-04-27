<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use Database;
use PDO;

class LoginController extends Controller{
	public function login_form($_get){
		if(user()){
			return redirect('/home');
		}
		session_start();
		$error_message='';
		if(isset($_SESSION["error_message"])&&$_SESSION["error_message"]){
			$error_message=$_SESSION["error_message"];
			unset($_SESSION["error_message"]);
		}
        $body = $this->view('login/pages/login',compact('_get','error_message'));
        include_once $this->load('login/layout');
	}

	public function login($_post){
		
		$obj=new Database();
		$sql="SELECT * FROM users WHERE email='$_post[email]'";
		$stmt = $obj->con->query($sql); 
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data=toObject($data);
		$password=$_post['password'];
		session_start();
		if(password_verify($password , $data->password)){
			unset($data->password);
			$user=$data;
            $_SESSION["auth_user"]=$user;
			return redirect('/home');
		}

		$_SESSION["error_message"]='Email or Password is invalid.';
	    return back();
	}

	public function logout($_get){
		session_start();
		unset($_SESSION["auth_user"]);
		return redirect('/login');
	}
}