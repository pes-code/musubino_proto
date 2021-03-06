<?php
session_start();

include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = 'SELECT * FROM will_table WHERE id=:id AND other=:other AND message=:message AND date=:date AND name=:name AND evidence=:evidence ';
//↑後ほど追加 fullcode=:fullcode AND dnar=:dnar AND bsc=:bsc AND handsonly=:handsonly AND
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':other', $other, PDO::PARAM_STR);
$stmt->bindValue(':message', $save_path_m, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':evidence', $save_path, PDO::PARAM_STR);


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC); //fetch→fetchAllへ変更

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MUSUBINO</title>
</head>

<body>
  <form action="m_update.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>MUSUBINO~医療における私の希望~（編集）</legend>

      <div class="item_box1">
        <input type="checkbox" name="fullcode" value="Full Code"><label class="item1">Full Code</label>
        <span class="text1">【Full Code】
          <br>あらゆる蘇生行為を行ないます。
        </span>
      </div>
      <div class="item_box2">
        <input type="checkbox" name="dnar" value="DNAR"><label class="item2">DNAR</label>
        <span class="text2">【DNAR】
          <br>心肺が停止した際は蘇生行為は行ないません。しかし心肺が停止していない場合は救命行為を行なう事になります。
      </div>
      <div class="item_box3">
        <input type="checkbox" name="bsc" value="BSC"><label class="item3">BSC</label>
        <span class="text3">【BSC】
          <br>病気に対する治療ではなく、病気に伴う苦痛症状の緩和を目的とした対症療法を行ないます。
        </span>
      </div>
      <div class="item_box4">
        <input type="checkbox" name="handsonly" value="Hands Only"><label class="item4">Hands Only</label>
        <span class="text4">【Hands Only】
          <br>人工呼吸以外の蘇生行為（胸骨圧迫、除細動、薬剤投与）を行ないます。
        </span>
      </div>
      </div>
      <div class="other_hope">
        <h4>2．その他の希望</h4>
        <input type="textaria" name="other">
      </div>

      <div class="message_mive">
        <h4>3．大切なあなたへ</h4>
        <input type="file" name="message" accept="video/*" capture="camera" />
      </div>

    </fieldset>
    <div>
      <p>以上、私の要望を忠実に果たしてくださった方々に深く感謝申し上げるとともに、
        <br>その方々が私の要望に従って下さった行為一切の責任は私自身にあることを付記いたします。
      </p>
    </div>
    <div class="sign">
      <label>記入日</label><input type="date" name="date">
      <label>本人署名</label><input type="text" name="name">
      <label>本人証明<input type="file" name="evidence" accept="video/*" capture="camera" />
    </div>
    <button>登録</button>
    <input type="hidden" name="id" value="<?= $record["id"] ?>">
    <a href="m_read.php">確認画面</a>
    <a href="u_logout.php">ログアウト</a>
    </fieldset>
  </form>

</body>

<style>
  .text1 {
    display: none;
    width: 1000px;
    position: absolute;
    top: 50%;
    left: 250px;
    padding: 16px;
    border-radius: 5px;
    background: #33cc99;
    color: #fff;
    font-weight: bold;
  }

  .item1:hover+.text1 {
    display: block;
  }

  .text2 {
    display: none;
    width: 1000px;
    position: absolute;
    top: 50%;
    left: 250px;
    padding: 16px;
    border-radius: 5px;
    background: #33cc99;
    color: #fff;
    font-weight: bold;
  }

  .item2:hover+.text2 {
    display: block;
  }

  .text3 {
    display: none;
    width: 1000px;
    position: absolute;
    top: 50%;
    left: 250px;
    padding: 16px;
    border-radius: 5px;
    background: #33cc99;
    color: #fff;
    font-weight: bold;
  }

  .item3:hover+.text3 {
    display: block;
  }

  .text4 {
    display: none;
    width: 1000px;
    position: absolute;
    top: 50%;
    left: 250px;
    padding: 16px;
    border-radius: 5px;
    background: #33cc99;
    color: #fff;
    font-weight: bold;
  }

  .item4:hover+.text4 {
    display: block;
  }
</style>

</html>