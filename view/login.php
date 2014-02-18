<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>

<section class="content">
	
	<?php 
	if(!isset($_SESSION['$alerts'])){
		$_SESSION['$alerts'] = false;
	}
	
	if($_SESSION['$alerts']){
		echo $_SESSION['$alerts'] . "<br />";
		$_SESSION['$alerts'] = "";  
	}
	?>
	
	<?php 
		/*
if(isset($_SESSION['$alerts'])){
			echo $_SESSION['$alerts'] . "<br />";
			$_SESSION['$alerts'] = ""; 
		} 
*/
	?>
	

	<h1>Login:</h1>
	<form id="People" method="post" action="http://cs313.nathantschultz.com/index.php">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <br>
      <label for="submit">&nbsp;</label>
      <input type="submit" name="submit" id="submit" value="Submit">
	  <input type="hidden" name="action" id="action" value="check_credentials">
    </form>
    
    <p><a href="http://cs313.nathantschultz.com/index.php?action=create_account">Create Account</a></p>

    
</section>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/registrationRules.js"></script>