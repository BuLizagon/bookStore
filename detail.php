<?php

include "./dbconn.php";

    $bookNumber=$_GET['bookNumber']; //도서번호


        if($mysqli){
            //DB검색문
            $query = "SELECT * FROM `도서` WHERE 도서번호='$bookNumber';";
        
            $res = mysqli_query($mysqli, $query);

            $arrayBookNumber = array();  //도서번호
            $arrayBookName = array();    //도서명
            $arrayBookAuthor = array();  //저자
            $arrayBookPublish = array(); //출판사
            $arrayBookPrice = array();   //판매가
            $arrayBookStroy = array();   //줄거리
                        
            while($row = mysqli_fetch_array($res)){
                $arrayBookNumber[] = $row['도서번호'];
                $arrayBookName[] = $row['도서명'];
                $arrayBookAuthor[] = $row['저자'];
                $arrayBookPublish[] = $row['출판사'];
                $arrayBookPrice[] = $row['판매가'];
                $arrayBookStroy[] = $row['줄거리'];
            }
        }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<style type="text/css">
    .line{border-bottom: 1px solid gray;}
</style>
<body>
    <script>

        var arrayBookName =  <?php echo json_encode($arrayBookName)?>;
        var arrayBookNumber = <?php echo json_encode($arrayBookNumber)?>;
        var arrayBookAuthor =  <?php echo json_encode($arrayBookAuthor)?>;
        var arrayBookPublish = <?php echo json_encode($arrayBookPublish)?>;
        var arrayBookPrice = <?php echo json_encode($arrayBookPrice)?>;
        var arrayBookStroy = <?php echo json_encode($arrayBookStroy)?>;
                
                //테이블 생성
                document.write('<table border="1" width="500" height="300" align="center">');
                
                //도서번호
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("도서번호 : ");
                document.write(arrayBookNumber[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('<tr>');

                //도서명
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("도서명 : ");
                document.write(arrayBookName[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('<tr>');
                

                //저자
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("저자 : ");
                document.write(arrayBookAuthor[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('<tr>');

                //출판사
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("저자 : ");
                document.write(arrayBookPublish[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('<tr>');

                //판매가
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("판매가 : ");
                document.write(arrayBookPrice[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('</tr>');
                
                //줄거리
                document.write('<tr>');
                document.write('<td width="100%" height="12.5%">');
                document.write('<div>');
                document.write("줄거리");
                document.write('</div>');
                document.write('</td>');
                document.write('</tr>');

                //줄거리 내용
                document.write('<tr>');
                document.write('<td rowspan="2" width="100%" height="12.5%">');
                document.write('<div>');
                document.write(arrayBookStroy[0]);
                document.write('</div>');
                document.write('</td>');
                document.write('</tr>');

                document.write('</table>');
                
                
    </script>
</body>