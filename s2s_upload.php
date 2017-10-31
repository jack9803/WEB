<?php
session_start();
include("config.php");
?>

<?php

function test_input($value){
	if (get_magic_quotes_gpc()){
  $value = stripslashes($value);
  }

if (!is_numeric($value)){
  $value = "'" . mysql_real_escape_string($value) . "'";
  }
  $value = trim($value);
  $value = htmlspecialchars($value,ENT_QUOTES);
  $value = strip_tags($value);
  $value = str_ireplace("echo","yayaya",$value);
return $value;
}


if(isset($_SESSION['account'])&&$_SESSION['account']!=NULL){
	$SALER=$_SESSION['account'];
	$ITEM_NAME=test_input($_POST['item_name']);
	$ITEM_PRICE=test_input($_POST['item_price']);
	$ITEM_CLASS=test_input($_POST['item_class']);
	$ITEM_TRADE=test_input($_POST['item_trade']);
	$ITEM_SITUATION=test_input($_POST['item_situation']);
	$ITEM_PS=test_input($_POST['item_ps']);
	$ITEM_PHOTO=test_input($_FILES['files']['name']);
	$ITEM_LOCATION=test_input($_POST['item_location']);
	
	$ITEM_TAG1=test_input($_POST['tag1']);
	$ITEM_TAG2=test_input($_POST['tag2']);
	$ITEM_TAG3=test_input($_POST['tag3']);
	
	
	if(($ITEM_NAME!=NULL)&&($ITEM_PRICE!=NULL)&&($ITEM_CLASS!=NULL)&&($ITEM_TRADE!=NULL)&&($ITEM_SITUATION!=NULL)){
		
		if(($ITEM_TRADE==1)&&($ITEM_LOCATION==NULL)){
			echo "<SCRIPT Language=javascript>";
			echo "window.alert('請填完所有必要項目!')";
			echo "</SCRIPT>";
			echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_upload.html>';
	
		}else{
		$sql="INSERT INTO item(saler,itemName,price,itemsituation,saleway,ps,category,TAG1,TAG2,TAG3,location)
				VALUES('$SALER','$ITEM_NAME','$ITEM_PRICE','$ITEM_SITUATION','$ITEM_TRADE'
				,'$ITEM_PS','$ITEM_CLASS','$ITEM_TAG1','$ITEM_TAG2','$ITEM_TAG3','$ITEM_LOCATION')";
		mysql_query($sql);
		
		
		//把itemid存到session
		$sql="SELECT * FROM item WHERE saler = '$SALER' AND itemName='$ITEM_NAME'";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result);
		//echo "$row['id']";
		$_SESSION['itemid']=$row['id']; 
		
		
		if($ITEM_TAG1!=NULL){
			$sql="SELECT * FROM TAG WHERE tag='$ITEM_TAG1'";
			$result=mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(mysql_num_rows($result)<1){
				//echo "not found";
				$sql="INSERT INTO TAG(times, tag)VALUES(0,'$ITEM_TAG1')";
				mysql_query($sql);
			}else{
				//echo "found!!!!";
				$tmp_times=$row['times'];
				$tmp_times = $tmp_times + 1;
				$sql="UPDATE TAG SET times = $tmp_times WHERE tag = '$ITEM_TAG1'";
				mysql_query($sql);
			}
			
			//echo "yayyayayyaya";
		}
		if(($ITEM_TAG2!=NULL)&&($ITEM_TAG2!=$ITEM_TAG1)){
			$sql="SELECT * FROM TAG WHERE tag='$ITEM_TAG2'";
			$result=mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(mysql_num_rows($result)<1){
				//echo "not found";
				$sql="INSERT INTO TAG(times, tag)VALUES(0,'$ITEM_TAG2')";
				mysql_query($sql);
			}else{
				//echo "found!!!!";
				$tmp_times=$row['times'];
				$tmp_times = $tmp_times + 1;
				$sql="UPDATE TAG SET times = $tmp_times WHERE tag = '$ITEM_TAG2'";
				mysql_query($sql);
			}
			
			//echo "yayyayayyaya";
		}

		if(($ITEM_TAG3!=NULL)&&($ITEM_TAG3!=$ITEM_TAG1)&&($ITEM_TAG3!=$ITEM_TAG2)){
			$sql="SELECT * FROM TAG WHERE tag='$ITEM_TAG3'";
			$result=mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(mysql_num_rows($result)<1){
				//echo "not found";
				$sql="INSERT INTO TAG(times, tag)VALUES(1,'$ITEM_TAG3')";
				mysql_query($sql);
			}else{
				//echo "found!!!!";
				$tmp_times=$row['times'];
				$tmp_times = $tmp_times + 1;
				$sql="UPDATE TAG SET times = $tmp_times WHERE tag = '$ITEM_TAG3'";
				mysql_query($sql);
			}
			
			//echo "yayyayayyaya";
		}
		

		echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_upload_photo1.php>';
		}
	}else{
		echo "<SCRIPT Language=javascript>";
		echo "window.alert('請填完所有必要項目!')";
		echo "</SCRIPT>";
		echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_upload1.php>';
	}





}else{

	echo "<SCRIPT Language=javascript>";
	echo "window.alert('請先登入!')";
	echo "</SCRIPT>";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s.html>';
}






?>