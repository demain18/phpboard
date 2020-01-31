
    <div class="container">
        <?php

        

        foreach ($post as $list)
        {
            $id = $list->id_key;
            $uploader = $list->uploader_nickname;
            $time = $list->time;
            $title = $list->title;
            $desc = $list->description;
        }

        $sql = $this->db->query("SELECT * FROM posts WHERE `id_key` = $id");
        if($sql == false) {
            alert('인증과정에서 오류 발생.');   
        }
        foreach ($sql->result() as $list)
        {
            $id = $list->id_key;
            $uploader_id = $list->uploader_id;
            $uploader_nick = $list->uploader_nickname;
        }
        if (isset($_SESSION['user_id']))
        {
            if ($_SESSION['user_id'] == $uploader_id)
            {
                echo '<p><a href="">'.$uploader_nick.'</span></a>&nbsp<span>'.$time.'</span> <a href="/edit/'.$id.'">글 수정하기</a>&nbsp<a href="/process/delete/'.$id.'">글 삭제하기</a></p>';
            }
            else
            {
                echo '<p><a href="">'.$uploader_nick.'</span></a>&nbsp<span>'.$time.'</span>';
            }
        }
        else
        {
            echo '<p><a href="">'.$uploader_nick.'</span></a>&nbsp<span>'.$time.'</span>';
        }

        // echo '<p><a href="">'.$uploader.'</span></a>&nbsp<span>'.$time.'</span> <a href="/edit/'.$uploader.'">글 수정하기</a>&nbsp<a href="/process/delete/'.$uploader.'">글 삭제하기</a></p>';
        echo '
        <h4>'.$title.'</h4>
        '.$desc.'
        ';

        ?>

        <div class="line">
            <form action="/process/comment_write" method="post">
                <input type="hidden" name="post_id_join" value="<?php echo $id; ?>">
                <span><strong>댓글 작성 : </strong></span><input type="text" name="description" style="width: 100%;">
            </form>

            <!-- <div class="comment">
                <span class="comment-uploader"><strong>테스트 : </strong></span>
                <span>테스트 댓글</span>
            </div> -->

            <?php

            foreach ($comment as $list)
            {
                $nick = $list->uploader_nickname;
                $id = $list->uploader_id;
                $desc = $list->description;

                

                echo '
                <div class="comment">
                    <span class="comment-uploader"><strong>'.$nick.' : </strong></span>
                    <span>'.$desc.'</span>
                    ';
                    if(isset($_SESSION['user_id'])) {
                        if ($id == $_SESSION['user_id']) {
                            echo '<span><a href="">수정</a> <a href="">삭제</a></span>';
                        } else {
                            echo '';
                        }
                    }
                    
                echo ' 
                </div>
                ';
            }

            ?>
        </div>
    </div>
</body>
</html>