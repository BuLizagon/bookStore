<?php
	session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];

	$prevPage = $_SERVER['HTTP_REFERER'];
   
    header('loaction:'.$prevPage);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>결제</title>
</head>
<body>
<?php if(!$userid){
		echo "<script>alert('로그인해주세요.')</script>";
        echo "<script>history.back();</script>";?>
	<?php }else{ ?>
	<form>
		<p>
			<strong>카드번호</strong>
			<input type="text" name="cardNumber" placeholder="카드번호 입력">
		</p>
		<p>
			<strong>유효기간</strong>
			<input type="text" name="cardDate" placeholder="유효기간 입력">
		</p>
    	<p>
			<strong>카드종류</strong>
			<input type="text" name="cardKind" placeholder="카드종류">
		</p>
		<p>
			<strong>우편번호</strong>
			<input type="text" name="zipCode" placeholder="카드종류">
		</p>
		<p>
			<strong>기본주소</strong>
			<input type="text" name="defaultAddress" placeholder="카드종류">
		</p>
		<p>
			<strong>상세주소</strong>
			<input type="text" name="detailAddress" placeholder="카드종류">
		</p>
		<p>
			<input type="submit" value="등록하기" formaction="http://bookdatabase.dothome.co.kr/register.php">
		</p>
	</form>
	<?php }?>
</body>
</html>