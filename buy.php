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



    $address_query = "SELECT * FROM `배송지` WHERE 아이디 = '$userid';";
    $card_query = "SELECT * FROM `신용카드정보` WHERE 아이디 = '$userid';";

    $address_res = mysqli_query($mysqli, $address_query);        
    $card_res = mysqli_query($mysqli, $card_query);

    //배송지 신용카드정보
    $arrayAddress = array();
    $arrayCardinfo = array();

    //배송지 정보 배열로 담기
    while($address_row = mysqli_fetch_array($address_res)){
        $arrayAddress[] = $address_row['배송지'];
    }
    //신용카드 정보 배열로 담기
    while($card_row = mysqli_fetch_array($card_res)){
        $arrayCardinfo[] = $card_row['신용카드정보'];
    }
    


    //주문번호 만들기

    $order_query = "SELECT * FROM `주문`ORDER BY 주문번호 DESC";

    $orderres = mysqli_query($mysqli, $order_query);

    $arrayOrderNumber = array();

    //주문번호 생성
    while($orderrow = mysqli_fetch_array($orderres)){
        $arrayOrderNumber[] = $orderrow['주문번호'];
    }





    //도서목록코드 만들기

    $bookListCode_query = "SELECT * FROM `도서목록` ORDER BY 도서목록코드 DESC";

    $bookListCoderes = mysqli_query($mysqli, $bookListCode_query);

    $arraybookListCode = array();

    //도서목폭코드 생성
    while($bookListCoderow = mysqli_fetch_array($bookListCoderes)){
        $arraybookListCode[] = $bookListCoderow['도서목록코드'];
    }






    //DB검색문
    $query1 = "SELECT * FROM 장바구니 WHERE 아이디='$userid';";
                
    $res1 = mysqli_query($mysqli, $query1);

    //장바구니번호, 도서번호, 수량
    $arrayBasketNumber = array();
    $arrayBookNumber = array();
    $arrayBookCount = array();

    //도서명,저자,출판사,판매가
    $arrayBookName = array();
    $arrayBookAuthor = array();
    $arrayBookPublish = array();
    $arrayBookPrice = array();

    //총액
    $totalPrice = 0;

    //상세정보
    $detailInfo = "";
    
    //장바구니번호 배열 넣기
    while($row1 = mysqli_fetch_array($res1)){
        $arrayBasketNumber[] = $row1['장바구니번호'];
    }
    //장바구니번호로 주문목록에서 추출
    for($i=0; $i < count($arrayBasketNumber); $i++){
        $j=$arrayBasketNumber[$i];
        $query2 = "SELECT * FROM 주문목록 WHERE 장바구니번호='$j'";

        $res2 = mysqli_query($mysqli, $query2);

        //추출한 장바구니 번호로 도서번호와 수량 추출
        while($row2 = mysqli_fetch_array($res2)){
            $arrayBookNumber[] = $row2['도서번호'];
            $arrayBookCount[] = $row2['수량'];
        }
    }

    //도서번호로 도서추출
    for($k=0; $k < count($arrayBookNumber); $k++){
        $l=$arrayBookNumber[$k];
        $query3 = "SELECT * FROM 도서 WHERE 도서번호='$l'";

        $res3 = mysqli_query($mysqli, $query3);

        while($row3 = mysqli_fetch_array($res3)){
            $arrayBookName[] = $row3['도서명'];
            $arrayBookAuthor[] = $row3['저자'];
            $arrayBookPublish[] = $row3['출판사'];
            $arrayBookPrice[] = $row3['판매가'];
        }
    }
    //총액 계산문
    for($t=0; $t<count($arrayBasketNumber);$t++){
        $price = 0;
        $price = $arrayBookPrice[$t]*$arrayBookCount[$t];
        $totalPrice = $price + $totalPrice; 
    }
    //상세정보 만들기
    for($s=0; $s<count($arrayBasketNumber); $s++){
        $bn=$arrayBookName[$s];          //도서명
        $bx=$arrayBookCount[$s];         //x
        $bk="권, ";                      //권
        $mix = $bn.$bx.$bk;              //위의 3개 합체
        $detailInfo = $detailInfo.$mix;
    }
    if(!$userid){
        echo "<script>alert('회원가입 해주세요.');history.back();</script>";
    }


    if(count($arrayAddress)!=0 && count($arrayCardinfo)!= 0){

            //주문번호
            $valNumber = $arrayOrderNumber[0] + 1;

            $query = "INSERT INTO 주문(주문번호, 상세정보, 주문총액, 주문일자, 아이디) VALUES ('$valNumber', '$detailInfo', '$totalPrice', now(), '$userid')";
        
            mysqli_query($mysqli, $query);

            for($a=0; $a<count($arrayBasketNumber); $a++){
                $aban = "";
                $abna = $arrayBookNumber[$a];
                
                //도서목록코드
                if($arraybookListCode[0]>=5000){
                    $strval = $arraybookListCode[0] + 1;
                }else{
                    $arraybookListCode[0]=5000;
                    $strval = $arraybookListCode[0];
                }

                
                $query5 = "INSERT INTO 도서목록(도서번호, 주문번호, 도서목록코드) VALUES ('$abna','$valNumber', '$strval')";
        
                mysqli_query($mysqli, $query5);
            }


        echo "<script>alert('구매가 완료되었습니다.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";

        $query6 = "DELETE FROM `장바구니`;";
        
        mysqli_query($mysqli, $query6);
    }
    else{
        echo "<script>alert('등록을 해주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/main.php'</script>";
    }

    mysqli_close($mysqli);
?>