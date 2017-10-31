<?php
session_start();
include("config.php");
?>

<?php
	function test_input($data){
	$data = trim($data);				//去掉多餘空白
	$data = stripslashes($data);		//去掉反斜線
	$data = htmlspecialchars($data,ENT_NOQUOTES);	//去掉& " ' < >
	return $data;
	}


	if(isset($_FILES['files']) && $_FILES['files']['error'] == 0){
		$upload_folder = dirname(dirname(__FILE__))."/uploads";
		$tmp=$_FILES['files']['name'];
		$FILE_NAME = test_input($tmp);
		$upload_path = $upload_folder."/".$FILE_NAME;
		
		
		
		move_uploaded_file($_FILES['files']['tmp_name'], $upload_path);
		//echo '{"status":"success"}';
		$ITEMID=$_SESSION['itemid'];
		$sql="INSERT INTO photo(itemid,photoname)VALUES($ITEMID,'$FILE_NAME')";
		mysql_query($sql);

		//exit;
		//echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_info.html>';
	}
	//echo '{"status":"error"}';
	//exit;
?>