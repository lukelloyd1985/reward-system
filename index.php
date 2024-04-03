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

      h1 {
        font-family: kids;
        font-size: 100px;
        font-weight:normal;
        color: #000000;
        text-align: center;
      }

      table {
        width: 100%;
        font-size: 20px;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 25px;
        text-align: left;
        table-layout: fixed;
      }

      th {
        font-family: kids;
        font-size: 90px;
        font-weight:normal;
        color: #000000;
        text-align: center;
      }

      .inlineTable {
        display: inline-block;
        margin: 1em;
      }

      td {
        font-family: kids;
        font-size: 40px;
        font-weight:normal;
        vertical-align: top;
        text-align: center;
      }

      a { 
        text-decoration: none;
        color: #000000;
      }
    </style>

    <meta http-equiv="refresh" content="300" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>

  <body>
    <?php
      $data = json_decode(file_get_contents('kids.json'));
      echo $data->k1->name;
    ?>

    <table>
      <tr>
        <th><a href="add.php">+</a> Kid1 <a href="remove.php">-</a></th>
        <th><a href="add.php">+</a> Kid2 <a href="remove.php">-</a></th>
      </tr>
      <tr>
        <td><br></td>
      </tr>
      <tr>
        <td>£<?php echo $owed; ?> owed. <a href="pay.php">Pay?</a></td>
        <td>£<?php echo $owed; ?> owed. <a href="pay.php">Pay?</a></td>
      </tr>
      <tr>
        <td><?php for ($k = 0 ; $k < $kid1; $k++){ echo '<img src="images/stars/icon.png" width="87" height="89">'; } ?></td>
        <td><?php for ($k = 0 ; $k < $kid2; $k++){ echo '<img src="images/stars/icon" width="87" height="89">'; } ?></td>
      </tr>
    </table>
  </body>
</html>
