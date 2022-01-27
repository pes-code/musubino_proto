<?php
session_start();
include("functions.php");

$pdo = connect_to_db();

$name = $_POST["name"];
$mail = $_POST["mail"];
$pass = $_POST["pass"];

$sql = 'SELECT * FROM user_table WHERE name=:name AND mail=:mail AND pass=:pass AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$val) {
  echo "<p>ログイン情報に誤りがあります．</p>";
  echo '<a href="u_login.php">ログイン画面へ</a>';
  exit();
} else {
  $_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["name"] = $val["name"];
  $_SESSION["id"] = $val["id"];
  header("Location:m_input.php");
  exit();
}
