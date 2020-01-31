
    <div class="container">
        <form action="/" method="GET">
            검색하기 : 
            <select name="type">
                <option value="title" id="sel_title">제목</option>
                <option value="desc" id="sel_desc">본문</option>
            </select>
            <input type="text" id="question" name="q" value="" class="search">
            <?php

            if (isset($_GET['q']))
            {
                echo '<a href="/">초기화</a>';
            }
            else
            {

            }

            ?>
        </form>
        <!-- <a href="/post/1"><p>새로운 글이 생성되었습니다.</p></a> -->   
        <?php

        if (isset($_GET['q']))
        {
            // $this->db->escape_str($this->security->xss_clean($_GET['type']));
            // $this->db->escape_str($this->security->xss_clean($_GET['q']));
            $type = $this->db->escape_str($this->security->xss_clean($_GET['type']));
            $ques = $this->db->escape_str($this->security->xss_clean($_GET['q']));

            if ($type == 'title') {
                $sql = $this->db->query("SELECT * FROM posts WHERE `title` LIKE '%$ques%' ORDER BY id_key DESC");
                echo "
                <script>
                    document.getElementById('sel_title').setAttribute('selected', '');
                </script>
                ";
            } else if ($type == 'desc') {
                $sql = $this->db->query("SELECT * FROM posts WHERE `description` LIKE '%$ques%' ORDER BY id_key DESC");
                echo "
                <script>
                    document.getElementById('sel_desc').setAttribute('selected', '');
                </script>
                ";
            } else {
                $sql = $this->db->query("SELECT * FROM posts WHERE `title` LIKE '%$ques%' ORDER BY id_key DESC");
            }

            if($sql == false) {
                alert('인증과정에서 오류 발생.');
            }
            echo '<h3>검색결과 '.$sql->num_rows().'개</h3>';

            foreach ($sql->result() as $list)
            {
                $title = $list->title;
                $id_key = $list->id_key;
                echo '
                <a href="/post/'.$id_key.'"><p>'.$title.'</p></a>
                ';
            }

            // 페이지 board->post->board 이동해도 값 남아있도록 하는 코드
            echo "
            <script>
                document.getElementById('question').setAttribute('value', '$ques');
            </script>
            ";
            
        }
        else
        {
            echo '<h3>게시판 전체보기</h3>';
            foreach ($posts_all as $list) {
            $title = $list->title;
            $id_key = $list->id_key;
            echo '
            <a href="/post/'.$id_key.'"><p>'.$title.'</p></a>
            ';
            }
        }


        ?>
    </div>
    <div class="paging">
        <p><a href="">1</a></p>
    </div>
</body>
</html>