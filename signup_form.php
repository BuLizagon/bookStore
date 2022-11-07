<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
</head>
<body>
<form>
	<p>
		<strong>아이디</strong>
			<input type="text" name="signup_id" placeholder="아이디 입력">
			<input type="submit" value="중복확인" formaction="http://bookdatabase.dothome.co.kr/check_id.php">
	</p>
	<p>
		<strong>비밀번호</strong>
		<input type="password" name="signup_pw" placeholder="비밀번호 입력">
	</p>
    <p>
		<strong>이름</strong>
		<input type="text" name="signup_name" placeholder="성명">
	</p>
	<p>
		<input type="submit" value="가입하기" formaction="http://bookdatabase.dothome.co.kr/join.php">
	</p>
</form>
</body>
</html>