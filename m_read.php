<?php
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION['id'];

$pdo = connect_to_db();

//Like機能
//$sql = 'SELECT * FROM will_table LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS like_count FROM like_table GROUP BY todo_id) AS result_table ON todo_table.id = result_table.todo_id';
$sql = 'SELECT * FROM will_table WHERE is_deleted=0 ORDER BY date ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";

foreach ($result as $record) {
  $output .= "
    <tr>
     <td>{$record["fullcode"]}</td> 
     <td>{$record["dnar"]}</td>
     <td>{$record["bsc"]}</td>
     <td>{$record["handsonly"]}</td>   
     <td>{$record["other"]}</td>
     <td><video controls controlsList='nodownload' oncontextmenu='return false;' src='{$record["message"]}' height='150px'></td>
     <td>{$record["date"]}</td>
     <td>{$record["name"]}</td>
     <td><video controls controlsList='nodownload' oncontextmenu='return false;' src='{$record["evidence"]}' height='150px'></td>
       <td>
       <a href='m_edit.php?id={$record["id"]}'>変更</a>
       </td>
         <td>
       <a href='m_delete.php?id={$record["id"]}'>削除</a>
       </td> 
    </tr>
  ";
}
//↑後程追加： <td><video controls controlsList='nodownload' oncontextmenu='return false;' src='{$record["message"]}' height='150px'></td>

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MUSUBINO</title>
</head>

<body>
  <fieldset>
    <legend>MUSUBINO（一覧画面）</legend>
    <a href="m_input.php">入力画面</a>
    <a href="m_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>希望する医療行為</th>
          <th>その他の希望</th>
          <th>作成日</th>
          <th>氏名</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>