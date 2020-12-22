<?php


require_once('database.php');


function newconnection(){
	GLOBAL $connection;
	return $connection;
}


function checklogin(){
	if(!isset($_SESSION['getloggedin'])){
		session_destroy();
		header('Location:./home.php');
	}
}


function show(){
	if(isset($_SESSION['getloggedin'])){
		return true;
	}

}

function checkin(){
	if(isset($_SESSION['getloggedin'])){
			header('Location:./home.php');
	}

}


function listallpost(){

	$allpost=mysqli_query(newconnection(),"SELECT * from post");

	if($allpost->num_rows>0){
		return true;
	}

}


function checkpost(){

	$checkpost=mysqli_query(newconnection(),"SELECT * from post where user='".$_SESSION['userid']."'");

	if($checkpost->num_rows>0){
		return true;
	}
}

function showallpost(){

	$allpost=mysqli_query(newconnection(),"SELECT * from post where user='".$_SESSION['userid']."' order by posteddate DESC");

	if($allpost->num_rows>0){
		return $allpost;
	}

}

function category(){

	$allcategory=mysqli_query(newconnection(),"SELECT DISTINCT filecat from post ");

	if($allcategory->num_rows>0){
		return $allcategory;
	}

}
?>