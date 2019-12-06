<?php
$title="Teacher Evaluate";
$dsn = 'mysql:host=localhost:8889;dbname=bulletin_board;charset=utf8;';
$db_user = 'root';
$db_pass = 'root';

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
} catch (PDOException $e) {
    exit('データベース接続失敗。' . $e->getMessage());
}

$sql = 'SELECT count(*) FROM data';
$stmt = $pdo->query($sql);
$row_cnt = $stmt->fetchColumn();

?>
<!DOCTYPE html>
<header>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
</header>
<body>
<h1><?php echo $title; ?></h1>
<h2>データ受け取り完了</h2>

<?php
$age = $_POST['age'];
$sex = $_POST['sex'];
$name = $_POST['name'];
$comment = $_POST['comment'];
/*入力フォームでmethodをpostに指定しているため＄＿POSTによって受け取る。入力したテキストはnameという名前で送信されているので＄_POST['name']となる*/

// SQL文を作成
//$sql = "UPDATE evaluate2 SET evaluation=:evaluation WHERE class=:class";
$sql = "INSERT INTO data (num,name,sex,age,comment) VALUES (:num,:name,:sex,:age,:comment)";
$stmt = $pdo->prepare($sql);
// 更新する値と該当のIDを配列に格納する
$num = $row_cnt + 1;
$params = array(':num' => $num, ':name' => $name, ':sex' =>$sex, ':age' => $age, ':comment' => $comment);
// クエリ実行（データを取得）
$stmt->execute($params);

print ("次の新規データを追加しました<br />");
print ("$num<br />");
print ("$name<br />");
print ("$age<br />");
print ("$sex<br />");
print ("$comment<br />");


//一覧表示
$sql = "SELECT * FROM data";
$res = $pdo->query($sql);
?>

<h3>授業一覧</h3>
<p>授業総数</p>

<p><a href="index.php">トップへ戻る</a></p>
</body>
