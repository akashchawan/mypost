<?php


$connection=mysqli_connect("localhost","root","","mypost");

class database{

	public $connection;


	function __construct(){

			$host="localhost";
			$user="root";
			$password="";
			$database="mypost";


			$connection=mysqli_connect($host,$user,$password,$database);

			if ($connection->connect_errno) {
			    echo "Error: Unable to connect to MySQL.";
			}

	}
	function getconn(){
		GLOBAL $connection;
		return $connection;
	}
}

$dd=new database();
?>