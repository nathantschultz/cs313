<?php
// Display Header 
include $_SERVER['DOCUMENT_ROOT'] . '/view/header.php';
$uId = $_SESSION['confirm_id'];

?>



<section class="plan">
<h1>Are you sure?</h1>
<p><a href="http://www.nathantschultz.com/index.php?action=delete_user&amp;id=<?php echo $uId?>">Delete</a></p>
<p><a href="http://www.nathantschultz.com/index.php?action=profile">Cancel</a></p>
</section>


<?php 
// Display Footer
include $_SERVER['DOCUMENT_ROOT'] . '/view/footer.php'; 
?>
