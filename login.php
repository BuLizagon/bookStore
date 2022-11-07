<?php 
 
    $prevPage = $_SERVER['HTTP_REFERER'];
   
    header('loaction:'.$prevPage);
    header("Content-Type: text/html;charset=UTF-8");
    
    $db_user = "bookdatabase"; //데이터베이스 아이디
    
    $db_passwd = "MySQL80!";     //데이터베이스 비밀번호
        
    $db_name = "bookdatabase"; //데이터베이스 이름
        
    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);
        
    $login_id = $_GET['login_id'];
    $login_pw = $_GET['login_pw'];
        

    if(!$login_id){
        // 경고창 보여주고 이전 페이지로 이동 [JS의 history객체 이동]
        // history.go(-1); : 이전 페이지로
        echo "<script>alert('아이디를 입력하세요.');</;script>";
        echo "<script>history.back();</script>";
    }
    if(!$login_pw){
        // 경고창 보여주고 이전 페이지로 이동 [JS의 history객체 이동]
        // history.back(); : 이전 페이지로
        echo "<script>alert('비밀번호를 입력하세요.');</script>";
        echo "<script>history.back();</script>";

    }

    else{
        //데이터베이스 검색문        
        $query = "SELECT * FROM 회원 WHERE 아이디='$login_id' and 비밀번호='$login_pw'";

        $res=mysqli_query($mysqli, $query);
        $rowNum=mysqli_num_rows($res);
        // $rowNum이 0이면 아이디와 패스워드가 맞지 않는 것
        if(!$rowNum){
            echo "
            <script>alert('아이디와 비밀번호를 확인하세요.');history.back();</script>";
        }
    
 
        // exit가 안되었다면 로그인이 되었다는 것임!!
        // 다른 페이지에서 로그인 되었다고 인지하기 위해, 회원정보를 세션에 저장
        // 해당하는 id의 회원정보 얻어오기

        $row = mysqli_fetch_array($res);
    

        session_start();
        $_SESSION['userid'] = $row['아이디'];
        $_SESSION['userpw'] = $row['비밀번호'];
        echo "
            <script>
                location.href='http://bookdatabase.dothome.co.kr/main.php';
            </script>";
        }
 
?>