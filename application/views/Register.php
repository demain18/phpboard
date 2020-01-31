<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>게시판</title>
    <link rel="stylesheet" href="/public/css/all.css">
</head>
<body>
    <h3>Boardcopy의 게시판에 오신걸 환영합니다.</h3>
    <div class="user">
        <p>
            <a href="/login">로그인</a>
            <a href="/register">회원가입</a>
            <a href="/write">글쓰기</a>
            <a href="/  ">뒤로가기</a>
        </p>
    </div>
-->
    <div class="container">
        <form action="/process/register" method="post">
            <h4>회원가입 하기</h4>
            <p>닉네임</p><input type="text" name="nickname"><br />
            <p>아이디</p><input type="text" name="id"><br />
            <p>비밀번호</p><input type="text" name="pw"><br />
            <p>비밀번호 재입력</p><input type="text" name="pwc"><br />
            <input type="submit" value="회원가입" class="submit">
        </form>
    </div>
</body>
</html>