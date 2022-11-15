<?php session_start();
    $userid="";
    $userpw="";

    if( isset($_SESSION['userid'])) $userid= $_SESSION['userid'];
    if( isset($_SESSION['userpw'])) $username= $_SESSION['userpw'];

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <h2 align="center"><a href="http://bookdatabase.dothome.co.kr/main.php">인터넷도서사이트</a></h2>
    <!-- 공통 스타일시트 연결 -->
    <link rel="stylesheet" href="./common.css">
</head>
<!-- 헤더 영역의 로고와 회원가입/로그인 표시 영역 -->
<div id="top">
            <!-- 1. 로고영역 -->
            <!-- include되면 삽입된 문서의 위치를 기준으로 -->

            <!-- 2. 회원가입/로그인 버튼 표시 영역 -->
            <ul id="top_menu">
                <!-- 로그인 안되었을 때 -->
                <?php if(!$userid){  ?>
                    <li><a href="http://bookdatabase.dothome.co.kr/login_form.php">로그인</a></li>
                    <li> | </li>
                    <li><a href="http://bookdatabase.dothome.co.kr/signup_form.php">회원가입</a></li>
                <?php }else{ ?>
                    <li><a href="http://bookdatabase.dothome.co.kr/logout.php">로그아웃</a></li>
                    <li> | </li>
                    <li><a href="http://bookdatabase.dothome.co.kr/basket_form.php">장바구니</a></li>
                    <li> | </li>
                    <li><a href="http://bookdatabase.dothome.co.kr/register_form.php">등록</a></li>
                    <li> | </li>
                    <li><a href="http://bookdatabase.dothome.co.kr/deliver_form.php">배송</a></li>
                    <li> | </li>
                    <li><a href="http://bookdatabase.dothome.co.kr/refund.php">환불내역</a></li>
                <?php }?>
 
            </ul>
        </div>

        <div align="center">
            <form action="http://bookdatabase.dothome.co.kr/bookSelect.php">
                <input type="text" style="text-align:center; width:500px; height:25px;" name=bookName placeholder="도서입력"/>
                <button style="height:30px;">검색</button>
            </form>
        </div>
