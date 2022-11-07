<?php
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
        
    $cardNumber = $_GET['cardNumber'];
    $cardDate = $_GET['cardDate'];
    $cardKind = $_GET['cardKind'];
    
    $zipCode = $_GET['zipCode'];
    $defaultAddress = $_GET['defaultAddress'];
    $detailAddress = $_GET['detailAddress'];
        


    //데이터베이스 삽입문
    if($mysqli){
        
        $query1 = "INSERT INTO 신용카드정보(카드번호, 유효기간, 카드종류, 아이디) VALUES ('$cardNumber', '$cardDate', '$cardKind', '$userid')";
        $query2 = "INSERT INTO 배송지(우편번호, 기본주소, 상세주소, 아이디) VALUES ('$zipCode', '$defaultAddress', '$detailAddress', '$userid')";

        mysqli_query($mysqli, $query1);
        mysqli_query($mysqli, $query2);

        echo "<script>alert('등록이 완료되었습니다.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
    }
    else{
        echo "DB연결실패";
    }

    mysqli_close($mysqli);
?>
    