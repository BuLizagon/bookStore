<?php
   //이전 페이지
   $prevPage = $_SERVER['HTTP_REFERER'];
   
   header('loaction:'.$prevPage);
   header("Content-Type: text/html;charset=UTF-8");
    
   $db_user = "bookdatabase"; //데이터베이스 아이디
        
   $db_passwd = "MySQL80!";     //데이터베이스 비밀번호
        
   $db_name = "bookdatabase"; //데이터베이스 이름
        
   $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);
        
   $signup_id = $_GET['signup_id'];

   if(!$signup_id){
      echo "아이디를 입력하세요.";
      exit;
   }
    

	//데이터베이스 검색문
	$query = "SELECT * FROM 회원 WHERE 아이디='$signup_id'";
   $result=mysqli_query($mysqli, $query);
   $rowNum=mysqli_num_rows($result);

	if($rowNum){
      
		echo "<script>alert('해당 아이디가 존재합니다.')</script>";
      echo "<script>history.back();</script>";
	}
		
	else{
      echo "<script>alert('사용가능한 아이디입니다.')</script>";
      echo "<script>history.back();</script>";
	}

   mysqli_close($mysqli);

?>