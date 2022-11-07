<?php
    $prevPage = $_SERVER['HTTP_REFERER'];
    
    header('loaction:'.$prevPage);
    header("Content-Type: text/html;charset=UTF-8");
    session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];
    
    header("Content-Type: text/html;charset=UTF-8");
    
    $db_user = "bookdatabase"; //데이터베이스 아이디
    
    $db_passwd = "MySQL80!";     //데이터베이스 비밀번호
        
    $db_name = "bookdatabase"; //데이터베이스 이름
        
    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);

    $bookNumber=$_GET['bookNumber']; //도서번호

    //주문번호 만들기

    $order_query = "SELECT * FROM `주문`ORDER BY 주문번호 DESC";

    $orderres = mysqli_query($mysqli, $order_query);

    $arrayOrderNumber = array();

    //주문번호 생성
    while($orderrow = mysqli_fetch_array($orderres)){
        $arrayOrderNumber[] = $orderrow['주문번호'];
    }

    if(!$userid){

		echo "<script>alert('로그인해주세요.')</script>";
        echo "<script>history.back();</script>";

    }else{

        $query1 = "SELECT * FROM `도서` WHERE 도서번호 = '$bookNumber';";
                
        $res1 = mysqli_query($mysqli, $query1);

        $arrayBookName = array();

        $arrayBookPrice = array();

        //판매가
        while($row1 = mysqli_fetch_array($res1)){
            $arrayBookPrice[] = $row1['판매가'];
            $arrayBookName[] = $row1['도서명'];
        }

        $price = $arrayBookPrice[0]; //판매가
        $bn = $arrayBookName[0];    //도서명
        $str = "1권";
        $detailInfo = $bn.$str;
        //주문번호
        $valNumber = $arrayOrderNumber[0] + 1;

        $query2 = "INSERT INTO 주문(주문번호, 상세정보, 주문총액, 주문일자, 아이디) VALUES ('$valNumber', '$detailInfo', '$price', now(), '$userid')";
    
        mysqli_query($mysqli, $query2);
        echo "<script>alert('구매가 완료되었습니다..')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
    }
?>