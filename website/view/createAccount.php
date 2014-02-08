<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">

	<h1>Create Account</h1>
	<form id="People" method="post" action="http://www.nathantschultz.com/index.php">
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
<script src="http://www.nathantschultz.com/js/jquery.validate.min.js"></script>
<script src="http://www.nathantschultz.com/js/registrationRules.js"></script>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>



