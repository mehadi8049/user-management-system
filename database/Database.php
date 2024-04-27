<?php
include_once (__DIR__.'/../config/Config.php');
/**
 * 
 */
class Database
{   
	private $config;
	public $con;
	function __construct()
	{
		$this->config=new Config();
		$this->con=$this->db_connect();
	}
    public function db_connect(){
    	$db_host =$this->config->db_host;
    	$db_user = $this->config->db_user;
    	$db_password = $this->config->db_password;
    	$db_name = $this->config->db_name;

    	try {
			$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch(PDOException $e) {
		return  $e->getMessage();
		}
    }

} 


