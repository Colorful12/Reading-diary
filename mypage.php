<?php include(dirname(__FILE__).'/assets/header.html'); ?>

<?php
require("./dbconnect.php");
session_start();

/* ログインしていない場合はログインページに誘導 */

if($_SESSION["iflogin"]!="true"){
    header("Location: login.php");
    exit();
}

?>

<?php if($_SESSION["iflogin"]=="true"): ?>
<h1 id="user"><?php echo $_SESSION["name"]."  さん";?></h1>
<a href="newpost.php">新規投稿</a>
<?php endif?>

<?php 
if(isset($_SESSION["posttitle"])){
    if($_SESSION["postfile"]!=""){
        $inputdata = $pdo->prepare("INSERT INTO postdb SET num=?, title=?, img=?, ext=?, comment=?");
        $inputdata->execute(array(
            $_SESSION["num"],
            $_SESSION['posttitle'],
            $_SESSION["postfile"],
            $_SESSION["postext"],
            $_SESSION["postmsg"]
        ));
        unset($_SESSION['posttitle']);
        unset($_SESSION['postfile']);
        unset($_SESSION['postmsg']);
       
    }
}
$stmt = $pdo->prepare("SELECT * FROM postdb WHERE num = :num");
$stmt->bindValue(":num", $_SESSION["num"]);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($posts as $post){ ?>
<div class="postcontent">
    <div class="titleimg">
        <?php $img = base64_encode($post['img']); ?>
        <img src="data:<?php echo $post['ext'] ?>;base64,<?php echo $img; ?>" style="width: 100%;"><br>
        <?php echo $post["title"]."<br>";?>
    </div>
    <div class="comment">
        <?php echo $post["comment"]."<br>";?>
    </div>
</div>
<?php } ?>


<?php include(dirname(__FILE__).'/assets/footer.html'); ?>
