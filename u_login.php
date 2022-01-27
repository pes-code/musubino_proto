<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MUSUBINO</title>
</head>

<body>
  <form action="u_login_act.php" method="POST">
    <fieldset>
      <legend>ログイン</legend>
      <div>
        <input type="text" name="name" placeholder="なまえ">
      </div>
      <div>
        <input type="text" name="mail" placeholder="メール">
      </div>
      <div>
        <input type="text" name="pass" placeholder="パスワード">
      </div>
      <div>
        <button>ログイン</button>
      </div>
    </fieldset>
    <p>ユーザー登録は<a href="u_entry.php">こちら</a></p>
  </form>

</body>

</html>