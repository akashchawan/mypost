<!DOCTYPE html>
<html>
<head>
	<title>My Post</title>
	<?php 
	session_start();
  date_default_timezone_set("Asia/Kolkata");

	include 'include/hlinks.php'; 
	include 'include/getfunction.php';

	checklogin();
  GLOBAL $connection;

  if(isset($_POST['uploadmypost'])){


    $cdate=date('Y-m-d H:i:s');
    $mypost=$_FILES['mypostfile']['name'];
    $tmypost=$_FILES['mypostfile']['tmp_name'];
    $comment=$_POST['mycomment'];
    $category=$_POST['mycaption'];
    $dir="mypost/$mypost";

      $ppost=mysqli_query($connection,"INSERT INTO post
                                                      SET
                                                         filename='".$mypost."',
                                                         filecomment='".$comment."',
                                                         filecat='".$category."',                                                         
                                                         user='".$_SESSION['userid']."',
                                                         posteddate='".$cdate."'
                          ");
      move_uploaded_file($tmypost, $dir);

  }


  if(isset($_POST['updatemypost'])){


    $cdate=date('Y-m-d H:i:s');
    if(!empty($_FILES['mypostfile']['name'])){
    $mypost=$_FILES['mypostfile']['name'];
    }else{
    $mypost=$_POST['prefilename'];
    }
    $tmypost=$_FILES['mypostfile']['tmp_name'];
    $comment=$_POST['mycomment'];
    $category=$_POST['mycaption'];
    $dir="mypost/$mypost";

      $ppost=mysqli_query($connection,"UPDATE post
                                                      SET
                                                         filename='".$mypost."',
                                                         filecomment='".$comment."',
                                                         filecat='".$category."',                                                         
                                                         user='".$_SESSION['userid']."',
                                                         posteddate='".$cdate."'

                                                         where id='".$_REQUEST['edit']."'
                          ");
      move_uploaded_file($tmypost, $dir);



  }

  if(!empty($_REQUEST['delete'])){
      $delete=mysqli_query($connection,"DELETE from post where id='".$_REQUEST['delete']."'");    
  }

  if(!empty($_REQUEST['edit'])){

      $edit=mysqli_query($connection,"SELECT * from post where id='".$_REQUEST['edit']."'");    
      $redit=mysqli_fetch_assoc($edit); 

  }

	?>
</head>
<style type="text/css">
  body{
    overflow-x:hidden; 
  }
</style>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
<?php
	include 'include/header.php';
?>

<br>

  <div class="form-group row  offset-4">      
      <label for="formFileLg" class="form-label"><br><h5>Upload Your File</h5></label>
      <div class="form-group col-md-4">
        <input class="form-control form-control-lg" id="mypostfile" name="mypostfile" accept="image/*" type="file" 
        <?php echo !empty($_REQUEST['edit'])?'':'required'; ?>>       
        <input type="hidden" name="prefilename" value="<?php echo !empty($_REQUEST['edit'])?$redit['filename']:''; ?>">
        <p id="imageal" style="font:normal 12px italic;color:red;">*Please choose image format</p>
      </div>
  </div>


  <div class="form-group row  offset-4">

      <label for="formFileLg" class="form-label"><br><h5>Add Comment</h5></label>
      <div class="form-group col-md-4">
        <textarea class="form-control" name="mycomment"  aria-label="With textarea" placeholder="Add Your Comment Here" style="margin:0% 18px;" required><?php echo !empty($_REQUEST['edit'])?$redit['filecomment']:''; ?></textarea>
      </div>
  </div>




  <div class="form-group row  offset-4">

      <label for="formFileLg" class="form-label"><br><h5>Category</h5></label>
      <div class="form-group col-md-4">
        <input type="text" class="form-control form-control-lg" value="<?php echo !empty($_REQUEST['edit'])?$redit['filecat']:''; ?>" name="mycaption" id="mycaption" style="margin:0% 68px;" placeholder="Image Category" required> 
      </div>
  </div>

  <div class="form-group row  offset-5">

      <div class="form-group col col-md-4 offset-3">
        
        <input type="submit" name="<?php echo !empty($_REQUEST['edit'])?'updatemypost':'uploadmypost'; ?>" id="<?php echo !empty($_REQUEST['edit'])?'updatemypost':'uploadmypost'; ?>" value="<?php echo !empty($_REQUEST['edit'])?'Update':'Upload'; ?>" class="btn btn-primary">       

      </div>
  </div>


<?php if(!checkpost()): ?>

    <span class="btn btn-danger">You have not uploaded any post</span>

<?php endif; ?>

<?php 

if(checkpost()): 

$mypost=showallpost();
?>

          <div class="container">

                    <div class="row">

                    <?php while($rmypost=mysqli_fetch_assoc($mypost)): ?>

                      <div class="col-md-4" style="border-radius: 20px;">
                        <div class="card mb-4 box-shadow">
                          <img class="card-img-top" src="<?php echo "mypost/".$rmypost['filename']; ?>" alt="<?php echo "mypost/".$rmypost['filename']; ?>" style='height:400px;'>
                          <div class="card-body">
                            <p class="card-text"><?php echo $rmypost['filecomment']; ?>.</p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <a href="?delete=<?php echo $rmypost['id']; ?>" class="btn btn-sm btn-outline-secondary">Delete</a>
                                <a href="?edit=<?php echo $rmypost['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                              </div>
                              <small class="text-muted"><?php echo date('D F Y',strtotime($rmypost['posteddate'])); ?></small>
                            </div>
                          </div>
                        </div>
                      </div>


                    <?php endwhile; ?>

                    </div>

          </div>


<?php endif; ?>




      </form>
</body>
	<?php include 'include/flinks.php'; ?>
	<script>
		  $("#imageal").hide();
      $(document).on('change','#mypostfile',function(){
            var fileExtension,fileName;
            fileName=$("#mypostfile").val();
            fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
            var ff=fileExtension.toLowerCase();

            if(ff=='jpg'||ff=='jpeg'||ff=='png'){
                console.log(ff);
                document.getElementById("uploadmypost").disabled=false;                              
                $("#imageal").hide();                
            }else{
                document.getElementById("uploadmypost").disabled=true;              
                $("#imageal").show();
            }

      });

	</script>

</html>