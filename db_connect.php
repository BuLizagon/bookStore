<?php

    header("Content-Type: text/html;charset=UTF-8");
 
    $db_user = "bookdatabase"; //데이터베이스 아이디

    $db_passwd = "MySQL80!";     //데이터베이스 비밀번호

    $db_name = "bookdatabase"; //데이터베이스 이름 

    $mysqli = new mysqli("localhost", $db_user, $db_passwd, $db_name);

    $bookNumber=$_GET['bookNumber']; //도서번호
    $bookName=$_GET['bookName']; //도서명
    $bookCount=$_GET['bookCount']; //재고량
    $bookPrice=$_GET['bookPrice']; //판매가

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <h2 align="center">인터넷도서사이트</h2>
</head>
<style type="text/css">
    .line{border-bottom: 1px solid gray;}
</style>
<body>
    <div align="center">
        <form action="http://bookdatabase.dothome.co.kr/databasetest.php">
            <input type="text" name=bookName value = <?php echo $bookName ?>>
            <button>검색</button>
        </form>
    </div>

    <?php
            //DB검색문
            $query = "SELECT * FROM `도서` WHERE 도서명 LIKE '%$bookName%';";
            
            $res = mysqli_query($mysqli, $query);

            $arrayBook = array();
                    
            while($row = mysqli_fetch_array($res)){
                $arrayBook[] = $row['도서명'];
            }
    ?>
    


    <script>

        var arrayBook = <?= json_encode($arrayBook)?>

            for(i=0; i< <?php echo count($arrayBook); ?>; i++){
                
                //테이블 생성
                document.write('<table border="0" width="500" height="300" align="center">');
                
                //첫 줄 공백
                document.write('<tr>');
                document.write('<td colspan="10" width="100%" height="10%">');
                document.write('</td>');
                document.write('</tr>');

                //이미지
                document.write('<tr>');
                document.write('<td rowspan="2" colspan="2" widhth="30%" height="60%" align="center">');
                document.write('<img src="null">');
                document.write('</td>');

                //도서명, 저자
                document.write('<td colspan="2" width="20%" height="30%">');
                document.write('<div>');
                document.write("도서명 :");
                document.write(arrayBook[i]);
                document.write('</div>');

                document.write('<div>');
                document.write("저자");
                document.write('</div>');
                document.write('</td>');
                document.write('<td colspan="3" width="25%" height="30%">');
                document.write('</td>');
                document.write('<td colspan="3" width="25%" height="30%">');
                document.write('</td>');
                document.write('</tr>');
                
                //별점, 예상배송일자
                document.write('<tr>');
                document.write('<td colspan="2" width="20%" height="30%">');
                document.write('<div>');
                document.write("별점");
                document.write('</div>');

                document.write('<div style="font-size: 13px;">');
                document.write('<strong>');
                document.write("예상배송일자");
                document.write('</strong>');
                document.write('</div>');

                document.write('</td>');
                document.write('<td colspan="3" width="25%" height="30%">');
                document.write('</td>');
                document.write('<td colspan="3" width="25%" height="30%">');
                document.write('</td>');
                document.write('</tr>');
                
                //미리보기
                document.write('<tr>');
                document.write('<td colspan="2" widhth="10%" height="30%" valign="top" align="center" class="line">');
                document.write('<button>');
                document.write("미리보기");
                document.write('</button>');
                document.write('</td>');

                //줄거리
                document.write('<td colspan="8" valign="top" class="line">');
                document.write('<div>');
                document.write("줄거리");
                document.write('</div>');
                document.write('</td>');
                document.write('</tr>');
                
                document.write('</table>');
            }
    </script>
</body>