<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['fullcode']) || $_POST['fullcode'] == '' ||
  !isset($_POST['dnar']) || $_POST['dnar'] == '' ||
  !isset($_POST['bsc']) || $_POST['bsc'] == '' ||
  !isset($_POST['handsonly']) || $_POST['handsonly'] == '' ||
  !isset($_POST['other']) || $_POST['other'] == '' ||
  //!isset($_FILES['message']) || $_FILES['message'] == '' ||
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_FILES['evidence']) || $_FILES['evidence'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$fullcode = $_POST['fullcode'];
$dnar = $_POST['dnar'];
$bsc = $_POST['bsc'];
$handsonly = $_POST['handsonly'];
$other = $_POST['other'];
//$message = $_FILES['message'];
$date = $_POST['date'];
$name = $_POST['name'];
$evidence = $_FILES['evidence'];
$id = $_POST["id"];

$pdo = connect_to_db();

//↓後程message=:message,を追加する。
$sql = "UPDATE will_table SET fullcode=:fullcode, dnar=:dnar, bsc=:bsc, handsonly=:handsonly, other=:other, date=:date, name=:name, evidence=:evidence, updated_at=now() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':fullcode', $fullcode, PDO::PARAM_STR);
$stmt->bindValue(':dnar', $dnar, PDO::PARAM_STR);
$stmt->bindValue(':bsc', $bsc, PDO::PARAM_STR);
$stmt->bindValue(':handsonly', $handsonly, PDO::PARAM_STR);
$stmt->bindValue(':other', $other, PDO::PARAM_STR);
//$stmt->bindValue(':message', $save_path, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':evidence', $save_path, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:m_read.php");
exit();
