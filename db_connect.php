<?php

    header("Content-Type: text/html;charset=UTF-8");
 
    $db_user = "bookdatabase"; //데이터베이스 아이디

    $db_passwd = "MySQL80!";   //데이터베이스 비밀번호

    $db_name = "bookdatabase"; //데이터베이스 이름 

    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);



    $bookNumber=$_GET['bookNumber']; //도서번호
    $bookName=$_GET['bookName']; //도서명
    $bookCount=$_GET['bookCount']; //재고량
    $bookPrice=$_GET['bookPrice']; //판매가

    //문자셋 설정
    mysqli_set_charset($mysqli, "utf8");

    //테이블 쿼리 후 내용 출력

    $sql = "SELECT * FROM `도서` WHERE 도서명 LIKE '%$bookName%'";

    if($result= mysqli_query($mysqli, $sql)){
        echo 
        "
        <table border='1'>
        <tr>
        <th>도서번호</th>
        <th>도서명</th>
        <th>재고량</th>
        <th>판매가</th>
        </tr>
        ";

        echo "</table>";

        mysqli_close($mysqli);

        while($row = mysqli_fetch_array($result)){

            echo "<tr>";
            
            echo "<td>" . $row['도서번호'] . "</td>";
            
            echo "<td>" . $row['도서명'] . "</td>";
            
            echo "<td>" . $row['재고량'] . "</td>";
            
            echo "<td>" . $row['판매가'] . "</td>";
            
            echo "</tr>";
            
            } 
    }
    else{
        echo "오류";
    }
?>