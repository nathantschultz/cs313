<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
?>
<section class="plan">

	<h1>Login:</h1>
	<form id="People" method="post" action="http://www.nathantschultz.com/index.php">
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
    
    <p><a href="http://www.nathantschultz.com/index.php?action=create_account">Create Account</a></p>

    
</section>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/js/jquery.validate.min.js"></script>
<script src="/js/registrationRules.js"></script>

<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>

