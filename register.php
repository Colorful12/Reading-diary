<?php include(dirname(__FILE__).'/assets/header.html'); ?>

<?php 
require("./dbconnect.php");
session_start();

if(!empty($_POST)){
    if($_POST["mail"]=="") $error["mail"]="empty";
    if($_POST["password"]=="") $error["password"]="empty";
    /* メールアドレスの重複を検知する機能 https://www.tomotaku.com/programing-join-system/ */
    if (!isset($error)) {
    $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
    header('Location: check.php');   // check.phpへ移動
    exit();
    }
    
}

?>
<div class="content">
    <form action="" method="post">
        <h1>新規アカウント作成</h1>
        <p>アカウント作成にあたり, 次のフォームに必要事項をご入力ください。</p><br>
        <div class="control">
            <label for="name">ユーザー名</label>
            <input id="name" type="text" name="name">
        </div>
        <div class="control">
            <label for="mail">メールアドレス<span class="required">必須</span></label>
            <input id="mail" type="text" name="mail">
            <?php if(!empty($error["mail"]) && $error["mail"]=="empty"): ?>
                <p class="error">*メールアドレスを入力してください</p>
            <?php elseif(!empty($error["mail"]) && $error["mail"]=="duplicate"): ?>
                <p class="error">*このメールアドレスは登録済みです</p>
            <?php endif ?>
        </div>
        <div class="control">
            <label for="password">パスワード<span class="required">必須</span></label>
            <input id="password" type="text" name="password">
            <?php if(!empty($error["password"]) && $error["password"]=="empty"): ?>
                <p class="error">*パスワードを入力してください</p>
            <?php endif ?>
        </div>
        <div class="control">
            <button type="submit" class="btn">確認する</button>
        </div>
    </form>
</div>


<?php include(dirname(__FILE__).'/assets/footer.html'); ?>