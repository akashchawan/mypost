<!DOCTYPE html>
<html>
<head>
	<title>My Post</title>
	<?php 
	session_start();
	include 'include/hlinks.php'; 
	include 'include/getfunction.php';
	?>
</head>
<body>
<?php
	include 'include/header.php';

?>

	<?php
	if(show()):
	?>
     <a class="btn btn-primary" href="mypost.php" style="color:white;margin: 3% 3%;">+ New Post</a>	
    <?php endif; ?>
<br>

<div class="container">
  <?php  
    $allcategory=category();
  ?>

<select id="mycategory" class="form-control col-md-6 offset-3">
    <option value="">Select Category</option>

  <?php while($rallcategory=mysqli_fetch_assoc($allcategory)): ?>

    <option value="<?=$rallcategory['filecat']?>"><?=$rallcategory['filecat']?></option>

  <?php endwhile; ?>

</select>      


</div>

<?php if(listallpost()) : ?>
			<div class="col-md-5" id="loadmypost" style="margin:3% 30%;">

      </div>
<?php endif; ?>
</body>
	<?php include 'include/flinks.php'; ?>
	<script>

     loadmypost();

      function loadmypost(data,category){
          newdata={
            'page':data,
            'category':category
          }
          $.ajax({
              type:'post',
              data:newdata,
              url:'pagination.php',
              success:function(data){
                $('#loadmypost').html(data);
              },error:function(){
                swal('Sorry Something went wrong');
              }
          });


	      
	      
	      
      }
		  
      $(document).on('change','#mycategory',function(){
          var cat=$(this).val();
          if(cat!=''){
            loadmypost('0',cat);
          }
      });

      $(document).on('click','#nextpage',function(){
          var id=$(this).attr('next');  
          var mycat=$("#mycategory").val();
          loadmypost(id,mycat);
      });

      $(document).on('click','#previouspage',function(){
          var id=$(this).attr('next');  
          var mycat=$("#mycategory").val();
          loadmypost(id,mycat);
      });

	</script>


</html>
