<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use Database;
use PDO;

class RegisterController extends Controller{
	function __construct()
	{
		if(empty(user())){
			return redirect('/login');
		}
	}

    public function register_form($_get){
		$user=user();
		if($user?->role=='Admin'){
            $body = $this->view('dashboard/pages/register',compact('_get'));
            include_once $this->load('dashboard/layout');
		}
	    return back();
	}

	public function store($_post){
		$user=user();
		if($user?->role=='Admin'){
            $obj=new Database();
            $has_pass=password_hash($_post['password'],PASSWORD_DEFAULT);
			$sql="INSERT INTO users (username, email, password,role)
            VALUES ('$_post[username]', '$_post[email]', '$has_pass','User')";
			$obj->con->query($sql);
		}
	    return back();
	}
}