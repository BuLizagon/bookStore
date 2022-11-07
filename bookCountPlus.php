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

    
    $basketNumber = $_GET['basketNumber'];


    
    if($mysqli){
        
        //장바구니번호로 주문목록검색
        $query1 = "SELECT * FROM `주문목록` WHERE 장바구니번호 = '$basketNumber';";
        $res1 = mysqli_query($mysqli, $query1);

        $arrayBasketNumber = array();
        $arrayBookCount = array();
                        
        while($row1 = mysqli_fetch_array($res1)){
            $arrayBasketNumber[] = $row1['장바구니번호'];
            $arrayBookCount[] = $row1['수량'];
        }
        
        $plusCount = $arrayBookCount[0] + 1;
        $abn = $arrayBasketNumber[0];

        $query2 = "UPDATE `주문목록` SET `수량` = '$plusCount' WHERE  `장바구니번호`='$abn';";
        $res2 = mysqli_query($mysqli, $query2);
        echo "<script>history.back();</script>";
    }
    else{
        echo "DB연결실패";
    }

    mysqli_close($mysqli);
    
?>