<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("config.php");
$id = $_POST['acc'];
$pw = $_POST['pwd'];
$temppw = md5($pw);
//搜尋資料庫資料
$sql = "SELECT * FROM user where account = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
$flag=0;
$tempid = strip_tags($id);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員

if($id != null && $pw != null && $row[1] == $id && $row[2] == $temppw && $tempid == $id)
{
        $flag=0;
		//將帳號寫入session，方便驗證使用者身份
        for ($i=0;$i<strlen($id);$i++) {
				if ($id[$i]=='.' ||  $id[$i]=='/' || $id[$i]=='\\' || $id[$i]=='+'
					|| $id[$i]=='*' || $id[$i]=='?' || $id[$i]=='[' || $id[$i]==']'
						|| $id[$i]=='(' || $id[$i]==')' || $id[$i]=='$' ) {
							$flag = 1;
							
							echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s.html>';
				}
			
		}
		if ($flag==0) {
			$_SESSION['account'] = $id;
			
			echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s_main.php>';
		}
		
}

else
{
        
        echo '<meta http-equiv=REFRESH CONTENT=1;url=s2s.html>';
}
?>