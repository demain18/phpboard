
    <div class="container">
        <form action="/process/write" method="post" onsubmit="return FormSubmit(this);">

            <p class="form-content">제목</p>
            <input type="text" class="form-title" name="title" placeholder="이곳에 제목을 작성해주세요">
            <p class="form-content">본문</p>
            <textarea name="description" id="description" class="form-description" name="description" rows="5" cols="15"></textarea>
            <input type="submit" value="작성완료" class="submit">

        </form>
    </div>
</body>
<script>

    // ttps://offbyone.tistory.com/207
    CKEDITOR.replace( 'description',
    {
        toolbar : 'Basic', /* this does the magic */
        uiColor : '#ffffff',
        width: 820,
        height: 300
    });

    function FormSubmit(f) {
        CKEDITOR.instances.descriptions.updateElement();
        if(f.descriptions.value == "") {
            alert("내용을 입력해 주세요.");
            return false;
        }
        alert(f.descriptions.value);
        
        // 전송은 하지 않습니다.
        return false;
    }

    //  var data = CKEDITOR.instances.editor1.getData();

</script>
</html>