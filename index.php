<?php
	header("Location:./home.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Post</title>
	<?php 
	session_start();

	include 'include/hlinks.php'; 
	include 'include/getfunction.php';


	checklogin();

	?>
</head>
<body>

</body>
	<?php include 'include/flinks.php'; ?>
	<script>
		

	</script>
</html>