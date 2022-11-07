<?php
    $prevPage = $_SERVER['HTTP_REFERER'];
   
    header('loaction:'.$prevPage);
    header("Content-Type: text/html;charset=UTF-8");
	session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];

	$prevPage = $_SERVER['HTTP_REFERER'];
   
    header('loaction:'.$prevPage);

    header("Content-Type: text/html;charset=UTF-8");
 
    $db_user = "bookdatabase"; //데이터베이스 아이디

    $db_passwd = "MySQL80!";     //데이터베이스 비밀번호

    $db_name = "bookdatabase"; //데이터베이스 이름 

    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);


    $basketNumber=$_GET['basketNumber']; //장바구니번호



    //DB삭제문
    if($mysqli){
        
        $query = "DELETE FROM `장바구니` WHERE 아이디='$userid' AND 장바구니번호 = '$basketNumber'";

        mysqli_query($mysqli, $query);

        echo "<script>alert('삭제되었습니다.');</script>";
        echo "<script>history.back();</script>";
    }
    else{
        echo "DB연결실패";
    }

    mysqli_close($mysqli);

?>