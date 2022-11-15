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

    
    include "./dbconn.php";



    $OrderingNumber=$_GET['OrderingNumber']; //주문번호
    $OrderingDeatil=$_GET['OrderingDeatil']; //상세정보
    $OrderingPrice=$_GET['OrderingPrice'];  //주문총액
    $Ordering=$_GET['Ordering'];            //주문상태
    $deliverNo=$_GET['deliverNo'];  //반품사유

    $refundPirce = 0;

        //주문상태 검색
        $query1 = "SELECT * FROM 주문 WHERE 주문번호='$OrderingNumber;";

        $res1 = mysqli_query($mysqli, $query1);


        $query2 = "UPDATE `주문` SET `주문상태`='취소',`반품사유`='$deliverNo', `환불일자` = now(), `환불총액`='$OrderingPrice' WHERE `주문번호`='$OrderingNumber';";
        $res2 = mysqli_query($mysqli, $query2);

        echo "<script>alert('환불되었습니다.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
?>