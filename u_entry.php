<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MUSUBINO</title>
</head>

<body>
  <form action="u_entry_act.php" method="POST">
    <fieldset>
      <legend>ユーザー登録</legend>
      <div>
        <input type="text" name="name" placeholder="むすび のりお">
      </div>
      <div>
        <input type="text" name="mail" placeholder="omusubikorori@gmail.com">
      </div>
      <div>
        <input type="text" name="pass" placeholder="半角英数字6文字">
      </div>
      <div>
        <button>登録</button>
      </div>
    </fieldset>
    <p>既に登録済の方は<a href="u_login.php">こちら</a></p>
  </form>
</body>

</html>