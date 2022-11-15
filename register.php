<?php
    session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];
    
    include "./dbconn.php";
        
    $cardNumber = $_GET['cardNumber'];
    $cardDate = $_GET['cardDate'];
    $cardKind = $_GET['cardKind'];
    
    $zipCode = $_GET['zipCode'];
    $defaultAddress = $_GET['defaultAddress'];
    $detailAddress = $_GET['detailAddress'];
        
    $query3 = "SELECT * FROM `신용카드정보` WHERE 아이디 = '$userid';";

    $res3=mysqli_query($mysqli, $query3);

    $arrayCardNumber = array();

    while($row3 = mysqli_fetch_array($res3)){
        $arrayCardNumber[] = $row3['카드번호'];
    }

    
    if(!$cardNumber){
        echo "<script>alert('카드번호를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    if(!$cardDate){
        echo "<script>alert('유효기간을 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    if(!$cardKind){
        echo "<script>alert('카드종류를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    if(!$zipCode){
        echo "<script>alert('우편번호를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    if(!$defaultAddress){
        echo "<script>alert('기본주소를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    if(!$detailAddress){
        echo "<script>alert('상세주소를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/register_form.php'</script>";
    }
    
    //데이터베이스 삽입문

    if($cardNumber!=$arrayCardNumber[0] and $cardDate!='' and $cardKind!='' and $zipCode!='' and $defaultAddress!='' and $detailAddress!=''){
            
        $query1 = "INSERT INTO 신용카드정보(카드번호, 유효기간, 카드종류, 아이디) VALUES ('$cardNumber', '$cardDate', '$cardKind', '$userid')";
        $query2 = "INSERT INTO 배송지(우편번호, 기본주소, 상세주소, 아이디) VALUES ('$zipCode', '$defaultAddress', '$detailAddress', '$userid')";

        mysqli_query($mysqli, $query1);
        mysqli_query($mysqli, $query2);

        echo "<script>alert('등록이 완료되었습니다.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
    }
    else{
        echo "<script>alert('이미 등록된 카드번호입니다.')</script>";
        echo "<script>history.back();</script>";
        
    }

    mysqli_close($mysqli);
?>
    