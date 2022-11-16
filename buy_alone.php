<?php
    $prevPage = $_SERVER['HTTP_REFERER'];
    
    header('loaction:'.$prevPage);
    header("Content-Type: text/html;charset=UTF-8");
    session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];
    
    include "./dbconn.php";

    $bookNumber=$_GET['bookNumber']; //도서번호

    //주문번호 만들기

    $order_query = "SELECT * FROM `주문`ORDER BY 주문번호 DESC";

    $orderres = mysqli_query($mysqli, $order_query);

    $arrayOrderNumber = array();

    //주문번호 생성
    while($orderrow = mysqli_fetch_array($orderres)){
        $arrayOrderNumber[] = $orderrow['주문번호'];
    }


    //주문항목코드 만들기

    $bookListCode_query = "SELECT * FROM `주문항목` ORDER BY 주문항목코드 DESC";

    $bookListCoderes = mysqli_query($mysqli, $bookListCode_query);

    $arraybookListCode = array();

    //도서목폭코드 생성
    while($bookListCoderow = mysqli_fetch_array($bookListCoderes)){
        $arraybookListCode[] = $bookListCoderow['주문항목코드'];
    }

    if(!$userid){

		echo "<script>alert('로그인해주세요.')</script>";
        echo "<script>history.back();</script>";


    }else{
        
        //재고량
        $totalInventory = 0;

        $query1 = "SELECT * FROM `도서` WHERE 도서번호 = '$bookNumber';";
                
        $res1 = mysqli_query($mysqli, $query1);

        $arrayBookName = array();

        $arrayBookPrice = array();

        $arrayBookNumber = array();

        $arrayInventory = array();

        //판매가
        while($row1 = mysqli_fetch_array($res1)){
            $arrayBookPrice[] = $row1['판매가'];
            $arrayBookName[] = $row1['도서명'];
            $arrayBookNumber[] = $row1['도서번호'];
            $arrayInventory[] = $row1['재고량'];
        }

        $price = $arrayBookPrice[0]; //판매가
        $bn = $arrayBookName[0];    //도서명
        $str = "1권";
        $detailInfo = $bn.$str;
        $totalInventory = $arrayInventory[0]; //재고량
        

        if($totalInventory==0){
            echo "<script>alert('재고가 없습니다.')</script>";
            echo "<script>history.back();</script>";
        }else{
            //주문번호
            $valNumber = $arrayOrderNumber[0] + 1;

            $query2 = "INSERT INTO 주문(주문번호, 상세정보, 주문총액, 주문일자, 아이디, 주문상태, 반품사유, 환불일자, 환불총액) VALUES ('$valNumber', '$detailInfo', '$price', now(), '$userid', '준비중', '0', '0', '0')";
            
            mysqli_query($mysqli, $query2);

            

            $strval = 0;
                
            //주문항목코드
            if($arraybookListCode[0]<5000){
                $arraybookListCode[0] = 4999;
            }
            
            $orderItemListCode = $arraybookListCode[0] + 1;  

            $query5 = "INSERT INTO `주문항목`(`도서번호`, `주문번호`, `주문항목코드`, `수량`, `반품수량`) VALUES ('$bookNumber','$valNumber', '$orderItemListCode', '1', '0')";
        
            mysqli_query($mysqli, $query5);

            
            //재고량
            $totalInventory = $totalInventory - 1;
            
            $query6 = "UPDATE `도서` SET `재고량` = '$totalInventory' WHERE `도서번호`='$bookNumber';";
            
            mysqli_query($mysqli, $query6);
        
            echo "<script>alert('구매가 완료되었습니다.')</script>";
            echo $totalInventory;
            echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
        }

        
    }
?>