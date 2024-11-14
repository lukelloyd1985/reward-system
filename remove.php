<?php include('pushover.php'); ?>

<html>
<head>
  <title>Kids Reward System</title>
  <link rel="stylesheet" type="text/css" href="./styles.css">
  <meta http-equiv="refresh" content="1;url=<?php echo $_SERVER['HTTP_REFERER']; ?>" />
</head>

<body>
  <?php
    $kid = $_GET["kid"];
    $data = json_decode(file_get_contents('kids.json'));
    $data->$kid->rewards = $data->$kid->rewards - 1;
    $newData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('kids.json', $newData);

    if ($data->$kid->pushoverAppToken && $data->$kid->pushoverUserKey) {
      $push = new Pushover();
      $push->setToken($data->$kid->pushoverAppToken);
      $push->setUser($data->$kid->pushoverUserKey);
      $push->setMessage($data->$kid->name . ' removed reward' . chr(10) . chr(10) . 'cash: ' . $data->$kid->currency . $data->$kid->cash . chr(10) . 'rewards: ' . $data->$kid->rewards);
      $push->setUrl($_SERVER['HTTP_REFERER']);
      $push->send();
    }
  ?>

  <center><img src="<?php echo 'images/', $data->$kid->image, '/remove.gif'; ?>" height="350"></center>
</body>
</html>