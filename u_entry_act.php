<?php
include('functions.php');

if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['mail']) || $_POST['mail'] == '' ||
  !isset($_POST['pass']) || $_POST['pass'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$name = $_POST["name"];
$mail = $_POST["mail"];
$pass = $_POST["pass"];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM user_table WHERE name=:name';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $username, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  echo "<p>すでに登録されているユーザです．</p>";
  echo '<a href="todo_login.php">login</a>';
  exit();
}

$sql = 'INSERT INTO user_table(id, name, mail, pass, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :name, :mail, :pass, 0, 0, sysdate(), sysdate())';

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

header("Location:u_login.php");
exit();
