<div id="dashboard">

	<?php  if (!isset($_GET['p'])) include('fo/profil.php'); else include('fo/'.secure($_GET['p']).'.php'); ?>

</div>