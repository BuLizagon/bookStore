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
    $deliverNo=$_GET['deliverNo'];          //반품사유
    $deliverReturn=$_GET['deliverReturn'];  //반품선택

    

    $refundPirce = 0;

        //주문상태 검색
        $query1 = "SELECT * FROM 주문 WHERE 주문번호='$OrderingNumber;";

        $res1 = mysqli_query($mysqli, $query1);

        //주문항목의 주문번호 검색
        $query4 = "SELECT * FROM `주문항목` WHERE `주문번호`='$OrderingNumber';";

        $res4 = mysqli_query($mysqli, $query4);

        $arrayOrderListCode = array();
        $arrayOrderCount = array();
        $arrayBookNumber = array();
        $arrayBookCount = array();
        
        
        while($row4 = mysqli_fetch_array($res4)){
            $arrayOrderListCode[] = $row4['주문항목코드'];
            $arrayOrderCount[] = $row4['수량'];
            $arrayBookNumber[] = $row4['도서번호'];
        }

        //도서번호로 도서찾기
        for($j=0;$j<count($arrayOrderListCode);$j++){
                $query6 = "SELECT * FROM `도서` WHERE `도서번호`='$arrayBookNumber[$j]';";

                $res6 = mysqli_query($mysqli, $query6);

                while($row6 = mysqli_fetch_array($res6)){
                    $arrayBookCount[] = $row6['재고량'];

                }
        

            
        }
        
        $time_now = date("Y-m-d His");
        $str_date = date("Y-m-d His", strtotime($time_now.'+3 days'));


        if($Ordering=="배송완료"){
            $query2 = "UPDATE `주문` SET `주문상태`='$deliverReturn',`반품사유`='$deliverNo', `환불일자` = '$str_date', `환불총액`='$OrderingPrice' WHERE `주문번호`='$OrderingNumber';";
            $res2 = mysqli_query($mysqli, $query2);

            for($i=0; $i<count($arrayOrderListCode);$i++){
                $query5="UPDATE `도서` SET `재고량` = '$arrayOrderCount[$i]'+'$arrayBookCount[$i]' WHERE  `도서번호`='$arrayBookNumber[$i]';";
                $res5 = mysqli_query($mysqli, $query5);
            }


        }
        else{
            $query3 = "UPDATE `주문` SET `주문상태`='취소',`반품사유`='$deliverNo', `환불일자` = '$str_date', `환불총액`='$OrderingPrice' WHERE `주문번호`='$OrderingNumber';";
            $res3 = mysqli_query($mysqli, $query3);

            for($i=0; $i<count($arrayOrderListCode);$i++){
                $query5="UPDATE `도서` SET `재고량` = '$arrayOrderCount[$i]'+'$arrayBookCount[$i]' WHERE  `도서번호`='$arrayBookNumber[$i]';";
                $res5 = mysqli_query($mysqli, $query5);
            }
        }
        

        //재고량 추가



        echo "<script>alert('환불되었습니다.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
?>