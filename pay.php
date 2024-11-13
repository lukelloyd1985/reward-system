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

      if ($data->$kid->pushoverAppToken && $data->$kid->pushoverUserKey) {
        $push = new Pushover();
        $push->setToken($data->$kid->pushoverAppToken);
        $push->setUser($data->$kid->pushoverUserKey);
        $push->setMessage($data->$kid->currency . $data->$kid->cash . ' paid to ' . $data->$kid->name . chr(10) . chr(10) . 'cash: ' . $data->$kid->currency . '0' . chr(10) . 'rewards: ' . $data->$kid->rewards);
        $push->setUrl($_SERVER['HTTP_REFERER']);
        $push->send();
      }

      $data->$kid->cash = 0;
      $newData = json_encode($data, JSON_PRETTY_PRINT);
      file_put_contents('kids.json', $newData);
    ?>

    <center><img src="images/money.gif" height="350"></center>
  </body>
</html>