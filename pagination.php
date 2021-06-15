<?php 
//This is done for Testing
session_start();

	include 'include/hlinks.php'; 
	include 'include/getfunction.php';

	$page=@$_POST['page'];
	$category=@$_POST['category'];


    if(!empty($category)){

	$noofpost=mysqli_query($connection,"SELECT * from post where filecat='".$category."' ");

	}else{

	$noofpost=mysqli_query($connection,"SELECT * from post");

	}

	if(isset($page)){
		$page=$page;
	}else{
		$page=0;
	}

    if(!empty($category)){

	$load=mysqli_query($connection,"SELECT * from post where filecat='".$category."' limit $page,1");    	

    }else{
	$load=mysqli_query($connection,"SELECT * from post limit $page,1");    	
    }

	$rload=mysqli_fetch_assoc($load);

	$data="
              <div class='card mb-4 box-shadow'>
                <img class='card-img-top' src='mypost/".$rload['filename']."' alt='".$rload['filename']."''>

                <div class='card-body'>
                  <p class='card-text'>".$rload['filecomment']."

              </p>
                  <div class='d-flex justify-content-between align-items-center'>
                    <div class='btn-group'>";



     if($rload['user']==@$_SESSION['userid']){

    $data .="
    					<span class='btn btn-sm btn-outline-secondary'>Delete</span>
    					<span class='btn btn-sm btn-outline-secondary'>Edit</span>

            ";

     }


    $data .="         </div>
                    <small class='text-muted'>".date('d F Y',strtotime($rload['posteddate']))."</small>
                  </div>
                  <br>
                 ";
    $nextpage=$page+1;
    $previous=$page-1;
    $lastpoast=$noofpost->num_rows;
    $stop=$noofpost->num_rows-1;    
    $newpage=$page+1;
    if($page>0){
    $data .="


                 <span class='btn btn-primary' id='previouspage'  next=".$previous.">Previous</span>";

    }

    if($page<$stop){


    $data .="
                 <span class='btn btn-primary' style='float:right;' id='nextpage'  next=".$nextpage.">Next</span>
                 <br>
                 Showing ".$newpage." of :".$lastpoast."
                </div>

              </div>

		";


    }



	echo $data;
?>
