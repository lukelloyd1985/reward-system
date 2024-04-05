<html>
  <head>
    <title>Kids Reward System</title>
    <style>
      @font-face {
        font-family: kids;
        font-style: normal;
        font-weight: normal;
        src: url(fonts/maple3cartoon.woff);
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
    ?>

    <table>
      <tr>
        <th><a href="add.php?kid=k1">+</a> <?php echo $data->k1->name; ?> <?php if ($data->k1->rewards > 0) { echo '<a href="remove.php?kid=k1">-</a>'; } ?></th>
        <th <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><a href="add.php?kid=k2">+</a> <?php echo $data->k2->name; ?> <?php if ($data->k2->rewards > 0) { echo '<a href="remove.php?kid=k2">-</a>'; } ?></th>
      </tr>
      <tr>
        <td><br></td>
      </tr>
      <tr>
        <td><?php echo $data->k1->currency, $data->k1->cash; ?> owed. <a href="pay.php?kid=k1">Pay?</a></td>
        <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php echo $data->k2->currency, $data->k2->cash; ?> owed. <a href="pay.php?kid=k2">Pay?</a></td>
      </tr>
      <tr>
        <td><?php for ($k = 0 ; $k < $data->k1->rewards; $k++){ echo '<img src="images/', $data->k1->image, '/icon.png" width="75" height="75">'; } ?></td>
        <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php for ($k = 0 ; $k < $data->k2->rewards; $k++){ echo '<img src="images/', $data->k2->image, '/icon.png" width="75" height="75">'; } ?></td>
      </tr>
    </table>
  </body>
</html>