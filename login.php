<?php include(dirname(__FILE__).'/assets/header.html'); ?>

<?php 
require("./dbconnect.php");
session_start();

/* 新規登録の方をクリックした場合 */
if (!empty($_POST['check'])) {
    header('Location: register.php');   
    exit();
}

if(!empty($_POST)){
    if($_POST["mail"]=="") $error["mail"]="empty";
    if($_POST["password"]=="") $error["password"]="empty";
    /* メールアドレスの重複を検知する機能 https://www.tomotaku.com/programing-join-system/ */
    if (!isset($error)) {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        
        $stmt = $pdo->prepare("SELECT * FROM mydb WHERE mail = :mail");
        $stmt->bindValue(":mail", $mail);
        $stmt->execute();
        $user = $stmt->fetch();
        if(empty($user)) $msg = "存在しないメールアドレスです。";
        elseif(password_verify($_POST['password'], $user['password'])){
            $_SESSION["num"] = $user["num"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["iflogin"] = "true";
            $msg = "ログインしました。";
            header('Location: mypage.php'); 
            exit();
            
        }else{
            $msg = "パスワードが違います。";
        }
    }
}

?>

<div class="content">
    <form action="" method="post">
        <h1>ログイン</h1>
        
        <div class="control">
            <input id="mail" type="text" name="mail" placeholder="メールアドレス">
            <?php if(!empty($error["mail"]) && $error["mail"]=="empty"): ?>
            <p class="error">*メールアドレスを入力してください</p>
            <?php endif ?>
        </div>
        
        <div class="control">
            <input id="password" type="text" name="password" placeholder="パスワード">
            <?php if(!empty($error["password"]) && $error["password"]=="empty"): ?>
                <p class="error">*パスワードを入力してください</p>
            <?php endif ?>
        </div>
        
        <div class="control">
            <button type="submit" class="btn">ログイン</button>
        </div>
    </form>
</div>

<div class="content">      
        はじめてのご利用の方はこちら<br>
        <form action="" method="post">
            <input type="hidden" name="check" value="checked">
            <button type="submit" class="btn">新規登録</button>
        </form>
</div>
<h2><?php if(!isset($error) && !empty($_POST))echo $msg; ?></h2>
    
<?php include(dirname(__FILE__).'/assets/footer.html'); ?>