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

	<h1>Create Account</h1>
	<form id="People" method="post" action="http://cs313.nathantschultz.com/index.php">
      <label for="firstname">First Name:</label>
      <input type="text" name="name" id="firstname" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" name="password" id='password' required>
      <br>
      <label for="submit">&nbsp;</label>
      <input type="submit" name="submit" id="submit" value="Submit">
	  <input type="hidden" name="action" value="add_account">
    </form>
    
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/registrationRules.js"></script>
