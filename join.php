<?php
    header("Content-Type: text/html;charset=UTF-8");
    
    $db_user = "bookdatabase"; //데이터베이스 아이디
    
    $db_passwd = "MySQL80!";     //데이터베이스 비밀번호
        
    $db_name = "bookdatabase"; //데이터베이스 이름
        
    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);
        
    $signup_id = $_GET['signup_id'];
    $signup_pw = $_GET['signup_pw'];
    $signup_name = $_GET['signup_name'];
        


    //데이터베이스 삽입문
    if($mysqli){
        
        $query = "INSERT INTO 회원(아이디, 비밀번호, 성명) VALUES ('$signup_id', '$signup_pw', '$signup_name')";

        mysqli_query($mysqli, $query);

        echo "<script>alert('가입이 완료되었습니다.')</script>";
        echo "
            <script>
                location.href='http://bookdatabase.dothome.co.kr/main.php';
            </script>";
    }
    else{
        echo "DB연결실패";
    }

    mysqli_close($mysqli);
?>
    