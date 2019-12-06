<?php
$title="Bulletin Board";
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
<h2>このサイトは掲示板です。</h2>
<p>
<?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y/m/d H:i:s");
 ?></p>

<?php
// SQL文を作成
$sql = "SELECT * FROM data";
// クエリ実行（データを取得）
$res = $pdo->query($sql);
// 取得したデータを出力

$sql2 = 'SELECT count(*) FROM data';
$stmt = $pdo->query($sql2);
$row_cnt = $stmt->fetchColumn();

?>
<hr>
<p><a href="./../">トップ</a>→掲示板</p>
&nbsp

<h3>掲示板</h3>
<p>総コメント数：<?php echo "$row_cnt"; ?></p>
<table>
  <hr>
  <tr>
    <th>番号</th>
    <th>名前</th>
    <th>年齢</th>
    <th>性別</th>
    <th>コメント</th>
  </tr>
<?php
foreach( $res as $value ) {
  echo "<tr>";
  echo "<td>$value[num]</td>";
  echo "<td>$value[name]</td>";
  echo "<td>$value[age]</td>";
  if ($value[sex] == 0){
    $sex = "m";
  }else if ($value[sex] == 1){
    $sex = "f";
  }else if ($value[sex] == 2){
    $sex = "else";
  }

  echo "<td>$sex</td>";
  echo "<td>$value[comment]</td>";
  echo "</tr>";
}
?>

</table>
<br />
<hr>

<h3>コメントを記入する</h3>
<form action="newevaluate.php" method="post">
  <fieldset>
    <legend>記入フォーム</legend>
    <label for="name">　名前　：</label>
    <input type="text" name="name" id="name" placeholder="名無しの権兵衛">
    <br/>

    <label for="age">　年齢　：</label>
    <select name="age" id ="age">
    <?php
    for($i=0; $i<101 ;$i+=1){
      if($i == 50){
        echo "<option value=$i selected>50</option>";
      }
      echo "<option value=$i>$i</option>";
    }
    ?>
    </select>
    <br/>

    <label for="sex">　性別　：</label>
    <select name="sex" id ="sex">
      <option value=0 selected>male</option>
      <option value=1>female</option>
      <option value=2>else</option>
    </select>
    <br/>

    <label for="comment">コメント：</label>
    <textarea rows="10" cols="60" name="comment" id="comment" placeholder="コメントをどうぞ"></textarea>
    <br/>
    <?php
      $num = $row_cnt + 1;
    ?>

    <input type="submit" value="決定">
    <input type="reset" value="リセット">
  </fieldset>

</form>

<!--
<h4>既存の授業</h4>
<form action="change.php" method="post">
  <fieldset>
    <legend>評価の記入</legend>
    <label for="kougi">講義名：</label>
    <select name="kougi" id ="kougi">
    <?php/*
    $res = $pdo->query($sql);
    foreach( $res as $value ){
      echo "<option value=$value[class] selected>$value[class]</option>";
    }
    */?>
    </select>
    <br/>
    <label for="evaluation">評価点：</label>
    <select name="evaluation" id ="evaluation">
    <?php/*
    for($i=0; $i<101 ;$i+=1){
      if($i == 50){
        echo "<option value=$i selected>50</option>";
      }
      echo "<option value=$i>$i</option>";
    }
    */?>
    </select>
    <br/>
    <label for="comment">コメント：</label>
    <input type="textarea" name="comment" id="comment" placeholder="コメントをどうぞ">
    <br/>
    <input type="submit" value="決定">
    <input type="reset" value="リセット">
  </fieldset>

</form>


<h3>授業の検索をする</h3>
<form action="search.php" method="post">
  <fieldset>
    <legend>探したい授業を選んでください</legend>
    <label for="kougi">講義名：</label>
    <select name="kougi" id ="kougi">
    <?php/*
    $res = $pdo->query($sql);
    foreach( $res as $value ){
      echo "<option value=$value[class] selected>$value[class]</option>";
    }
    */?>
    </select>
    <br/>
    <input type="submit" value="決定">

  </fieldset>

</form>-->
&nbsp
<h3><a href="./../">作品一覧へ</a></h3>
</body>
