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

$people = getPeople();
$name = null;
$email = null;

foreach($people as $person){
	if ($_SESSION['userId1'] == $person['user_id']){
		$name = $person['name'];
		$email = $person['email'];
		$admin2 = $person['admin'];	
	}
}

?>
	<h1>Edit Account</h1>
	<form id="People" method="post" action="http://cs313.nathantschultz.com/index.php">
      <label for="firstname">First Name:</label>
      <input type="text" name="name" id="name" value="<?php echo $name ?>" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="<?php echo $email ?>" required>
      <br>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <br>
      
      <label for="admin">Admin:</label>
	  <p><input type="radio" name="adminSelected" id="admin1" value="true" <?php if ($admin2){echo "checked='checked'";} ?>>Yes</p>
      <p><input type="radio" name="adminSelected" id="admin2" value="0" <?php if (!$admin2){echo "checked='checked'";} ?>>No</p>
      
      <label for="submit">&nbsp;</label>
      <input type="submit" name="submit" id="submit" value="Submit">
	  <input type="hidden" name="action" id="action" value="update_user">
	  <input type="hidden" name="page_id" value="<?php echo $_SESSION['userId1']?>">
    </form>   
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://cs313.nathantschultz.com/js/registrationRules.js"></script>
