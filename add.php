<html>
  <head>
    <title>Kids Reward System</title>
    <style>
      @font-face {
        font-family: kids;
        font-style: normal;
        font-weight: normal;
        src: url(fonts/3dumb.ttf);
      }

      body {
        background-color: #fef1de;
        background-repeat: no-repeat;
        background-size: 100% 100%;
      }
    </style>

    <meta http-equiv="refresh" content="2.5;url=<?php echo dirname($_SERVER['PHP_SELF']); ?>" />
  </head>

  <body>
    <?php
      $kid = $_GET["kid"];
      $data = json_decode(file_get_contents('kids.json'));
    ?>

    <?php echo $kid; ?>    
    <center><img src="<?php echo '<img src="images/', $data->$kid->image, '/add.gif'; ?>" width="400" height="400"></center>
  </body>
</html>
