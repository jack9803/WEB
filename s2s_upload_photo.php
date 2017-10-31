<?php
session_start();
include("config.php");
?>

<?php
unset($_SESSION['itemid']);
echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_info.html>';


?>