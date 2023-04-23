<!-- index.phpメインの投稿の表示 -->
<?php
// データベースを接続する記述
$pdo = new PDO(
    "mysql:dbname=sample;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);

// データベースに接続確認の記述
if ($pdo) {
    echo "データベース接続済み";
} else {
    echo "データベース接続不可。接続を確認してください。";
}
//SQLを実行。
$regist = $pdo->prepare("SELECT * FROM post");
$regist->execute();
//ここで「登録失敗」だった場合、SQL文に誤りがあります。
if ($regist) {
    echo "登録成功";
} else {
    echo "登録失敗";
}
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<title>大脱出スクール投稿掲示板</title>
<h1>好きなことを書き込んでね</h1>
<section>
    <h2>新規投稿</h2>
    <form action="send.php" method="post">
        ペンネーム : <input type="text" name="name" value=""><br>
        投稿内容: <input type="text" name="contents" value=""><br>
        <button type="submit">投稿</button>
    </form>
</section>
 

<section>
	<h2>投稿内容一覧</h2>
		<?php foreach($regist as $loop):?>
			<div>No：<?php echo $loop['id']?></div>
			<div>ペンネーム：<?php echo $loop['name']?></div>
			<div>投稿内容：<?php echo $loop['contents']?></div>
			<div>------------------------------------------</div>
		<?php endforeach;?>
	
</section>
