<?php include(dirname(__FILE__).'/assets/header.html'); ?>
<?php
require("./dbconnect.php");
session_start();

/*会員登録手続き以外のアクセスをとばす*/
if(!isset($_SESSION["join"])){
    header("Location: register.php");
    exit();
}

if (!empty($_POST['check'])) {
    
    $hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

    $inputdata = $pdo->prepare("INSERT INTO mydb SET name=?, mail=?, password=?");
    $inputdata->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['mail'],
        $hash
    ));

    unset($_SESSION['join']);   // セッションを破棄
    header('Location: compregister.php');   
    exit();
}
?>

<div class="content">
        <form action="" method="POST">
            <input type="hidden" name="check" value="checked">
            <h1>入力情報の確認</h1>
            <p>変更が必要な場合、下のボタンを押し、変更を行ってください。</p>
            <?php if (!empty($error) && $error === "error"): ?>
                <p class="error">＊会員登録に失敗しました。</p>
            <?php endif ?>
            <br>
 
            <div class="control">
                <p>ユーザー名</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?></span></p>
            </div>
 
            <div class="control">
                <p>メールアドレス</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['mail'], ENT_QUOTES); ?></span></p>
            </div>
            
            <br>
            <a href="register.php" class="back-btn">変更する</a>
            <button type="submit" class="btn next-btn">登録する</button>
            <div class="clear"></div>
        </form>
</div>


<?php include(dirname(__FILE__).'/assets/footer.html'); ?>