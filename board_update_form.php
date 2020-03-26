<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>board_update.php</title>
        <link rel="stylesheet" href="//unpkg.com/bootstrap@4/dist/css/bootstrap.min.css">
        <script src='//unpkg.com/jquery@3/dist/jquery.min.js'></script>
        <script src='//unpkg.com/popper.js@1/dist/umd/popper.min.js'></script>
        <script src='//unpkg.com/bootstrap@4/dist/js/bootstrap.min.js'></script>
        <!-- 테이블 크기 조절용 css -->
        <style>
            table {
                table-layout: fixed;
                word-wrap: break-word;
            }
        </style>
    </head>
    <body>
        <h1 class="display-4">board_update.php</h1>
        <?php
            //커넥션 객체 생성 (데이터 베이스 연결)
            $conn = mysqli_connect("localhost", "sample", "password","sampledb");
            //연결 성공 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            $board_no = $_GET["board_no"];
            echo $board_no."번째 글 수정 페이지<br>";
            //board 테이블을 조회하여 board_no의 값이 일치하는 행의 board_no, board_title, board_content, board_user, board_date 필드의 값을 가져오는 쿼리
            $sql = "SELECT board_no, board_title, board_content, board_user, board_date FROM board WHERE board_no = '".$board_no."'";
            $result = mysqli_query($conn,$sql);
            if($row = mysqli_fetch_array($result)){
        ?>
        <br>
        <form action="/board_update_action.php" method="post">
            <table class="table table-bordered" style="width:30%">
                <tr>
                    <td style="width:10%">글 번호</td>
                    <td style="width:20%"><input type="text" name="board_no" value="<?php echo $row["board_no"]?>" readonly></td>
                </tr>
                <tr>
                    <td style="width:10%">글 제목</td>
                    <td style="width:20%"><input type="text" name="board_title" value="<?php echo $row["board_title"]?>"></td>
                </tr>
                <tr>
                    <td style="width:10%">글 내용</td>
                    <td style="width:20%"><input type="text" name="board_content" value="<?php echo $row["board_content"]?>"></td>
                </tr>
            </table>
            <br>
        <?php
            }
            //커넥션 객체 종료
            mysqli_close($conn);
        ?>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary" type="submit">글 수정</button>
            &nbsp;&nbsp;
            <a class="btn btn-primary" href="/board_list.php"> 리스트로 돌아가기</a>
        </form>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>
