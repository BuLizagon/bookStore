<?php
    include "./dbconn.php";
        
    $signup_id = $_GET['signup_id'];
    $signup_pw = $_GET['signup_pw'];
    $signup_name = $_GET['signup_name'];

    //데이터베이스 아이디 검색문        
    $query = "SELECT * FROM 회원 WHERE 아이디='$signup_id'";

    $res=mysqli_query($mysqli, $query);
    
    $arraySignup_id = array();
                        
    while($row = mysqli_fetch_array($res)){
        $arraySignup_id[] = $row['아이디'];
    }
        


    if(!$signup_id){
        echo "<script>alert('아이디를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/signup_form.php';</script>";
    }
    if(!$signup_pw){
        echo "<script>alert('패스워드를 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/signup_form.php';</script>";
    }
    if(!$signup_name){
        echo "<script>alert('성명을 적어주세요.')</script>";
        echo "<script>location.href='http://bookdatabase.dothome.co.kr/signup_form.php';</script>";
    }
    //데이터베이스 삽입문
    if($arraySignup_id[0]!=$signup_id and $singup_pw!='' and $signup_name!=''){
        
        $query = "INSERT INTO 회원(아이디, 비밀번호, 성명) VALUES ('$signup_id', '$signup_pw', '$signup_name')";

        mysqli_query($mysqli, $query);

        echo "<script>alert('가입이 완료되었습니다.')</script>";
        echo "
            <script>
                location.href='http://bookdatabase.dothome.co.kr/main.php';
            </script>";
    }
    else{
        echo "<script>alert('중복확인을 해주세요.')</script>";
        echo "<script>history.back();</script>";
    }

    mysqli_close($mysqli);
?>
    