<?php
session_start();
include("functions.php");
check_session_id();

//var_dump($_POST);
//var_dump($_FILES);
//exit();

//データが存在するかCheckする※messageを追加する際はAdminのカラムも忘れずに！
if (
  //!isset($_POST['fullcode']) || $_POST['fullcode'] == '' ||
  //!isset($_POST['dnar']) || $_POST['dnar'] == '' ||
  //!isset($_POST['bsc']) || $_POST['bsc'] == '' ||
  //!isset($_POST['handsonly']) || $_POST['handsonly'] == '' ||
  //!isset($_POST['other']) || $_POST['other'] == '' ||
  //!isset($_FILES['message']) || $_FILES['message'] == '' ||
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_FILES['evidence']) || $_FILES['evidence'] == ''
) {
  echo json_encode(["error_msg" => "no input123"]);
  exit();
}

//データがあれば値を取得して変数へ格納する
$fullcode = $_POST['fullcode'];
$dnar = $_POST['dnar'];
$bsc = $_POST['bsc'];
$handsonly = $_POST['handsonly'];
$other = $_POST['other'];
$message = $_FILES['message'];
$date = $_POST['date'];
$name = $_POST['name'];
$evidence = $_FILES['evidence'];


// videoデータの確認
if (isset($_FILES['message']) && $_FILES['message']['error'] == 0) {
  // 情報の取得
  $uploaded_file_name_m = $_FILES['message']['name'];
  $temp_path_m  = $_FILES['message']['tmp_name'];
  $directory_path_m = 'message_file/';

  // ファイル名が重複しないようにする記述
  $extension_m = pathinfo($uploaded_file_name_m, PATHINFO_EXTENSION);
  $unique_name_m = date('YmdHis') . md5(session_id()) . '.' . $extension_m;
  $save_path_m = $directory_path_m . $unique_name_m;

  if (is_uploaded_file($temp_path_m)) {
    if (move_uploaded_file($temp_path_m, $save_path_m)) {
      chmod($save_path_m, 0644);
    }
    // else {
    //  exit('Error:アップロードできんやったよゴメン');
    // }
    // } else {
    // exit('Error:画像がないよアレ？');
    // }
    //} else {
    // exit('Error:画像が送信されんやったみないよプっ');
  }
}
////↑ファイルがなくてもエラーにならない処理にする。


// videoデータの確認
if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == 0) {
  // 情報の取得
  $uploaded_file_name = $_FILES['evidence']['name'];
  $temp_path  = $_FILES['evidence']['tmp_name'];
  $directory_path = 'upload/';

  // ファイル名が重複しないようにする記述
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . '.' . $extension;
  $save_path = $directory_path . $unique_name;

  if (is_uploaded_file($temp_path)) {
    if (move_uploaded_file($temp_path, $save_path)) {
      chmod($save_path, 0644);
    } else {
      exit('Error:アップロードできませんでした');
    }
  } else {
    exit('Error:画像がありません');
  }
} else {
  exit('Error:画像が送信されていません');
}


//DB接続の関数
$pdo = connect_to_db();

//will_tableに入力(INSERT)  ※↓後程messageを追加する(VALUESの方にも忘れずに！)
$sql = 'INSERT INTO will_table(id, fullcode, dnar, bsc, handsonly, other, message, date, name, evidence, created_at, updated_at) VALUES(NULL, :fullcode, :dnar, :bsc, :handsonly, :other, :message, :date, :name, :evidence, now(), now())';

//バインド変数：悪意ある入力を防ぐ
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':fullcode', $fullcode, PDO::PARAM_STR);
$stmt->bindValue(':dnar', $dnar, PDO::PARAM_STR);
$stmt->bindValue(':bsc', $bsc, PDO::PARAM_STR);
$stmt->bindValue(':handsonly', $handsonly, PDO::PARAM_STR);
$stmt->bindValue(':other', $other, PDO::PARAM_STR);
$stmt->bindValue(':message', $save_path_m, PDO::PARAM_STR); //←後程追加する
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':evidence', $save_path, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:m_input.php");
exit();
