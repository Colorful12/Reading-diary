<?php include(dirname(__FILE__).'/assets/header.html'); ?>

<?php
require("./dbconnect.php");
session_start();

/* ログインしていない場合はログインページに誘導 */
if($_SESSION["iflogin"]!="true"){
    header("Location: login.php");
    exit();
}

if(!empty($_POST)){
    if($_POST["title"]=="") $error["title"]="empty";
    if (!isset($error)) {
        $_SESSION["posttitle"] = $_POST["title"];
        if(!empty($_FILES["file"])) {
            $_SESSION["postfile"] = file_get_contents($_FILES['file']['tmp_name']);
            $_SESSION["postext"] = $_FILES['file']['type'];
        }
        $_SESSION["postmsg"] = $_POST["msg"];
        header('Location: mypage.php');
        exit();
    }
}


?>

<div class="content">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="タイトル">
        <?php if(!empty($error["title"]) && $error["title"]=="empty"): ?>
            <p class="error">*タイトルを入力してください</p>
        <?php endif ?>
        <br><br>
        <div class="upload">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <p>ドラッグ＆ドロップ</p>
            <input type="file" name="file" id="files">
        </div>
        <br>
        <textarea name="msg" cols="60" rows="20"></textarea>
        <input type="submit" id="submit-btn" value="投稿">
    </form>
</div>


<?php include(dirname(__FILE__).'/assets/footer.html'); ?>