
    <div class="container">

        <!-- <a href="/post/1"><p>새로운 글이 생성되었습니다.</p></a> -->   
        <?php
        // session_start();
        // $name = $this->session->user_nickname;
        // echo $_SESSION['user_nickname'];

        echo '<strong>'.$_SESSION['user_nickname'].'</strong>님이 작성한 글';

        foreach ($posts_user as $list)
        {
            $title = $list->title;
            $id_key = $list->id_key;
            echo '
            <a href="/post/'.$id_key.'"><p>'.$title.'</p></a>
            ';
        }

        ?>
    </div>
    <div class="paging">
        <p><a href="">1</a></p>
    </div>
</body>
</html>