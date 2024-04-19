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
        font-weight:normal;
        color: #000000;
        text-align: center;
      }

      table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 25px;
        text-align: left;
        table-layout: fixed;
      }

      th {
        font-family: kids;
        font-size: 60px;
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
        font-size: 30px;
        font-weight:normal;
        vertical-align: top;
        text-align: center;
      }

      a { 
        text-decoration: none;
        color: #000000;
      }

      .weekdays {
        margin: 0;
        padding: 10px 0;
        background-color: lightblue;
        font-family: kids;
        font-size: 20px;
      }

      .weekdays li {
        display: inline-block;
        width: 13.6%;
        text-align: center;
      }

      .weekdays li .active {
        padding: 5px;
        background: orchid;
      }
    </style>

    <meta http-equiv="refresh" content="300" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>

  <body>
    <?php
      $weekDay = date('D');
      $data = json_decode(file_get_contents('kids.json'));
      $k1p = (int)(($data->k1->rewards / $data->k1->maxRewards) * 100);
      $k2p = (int)(($data->k2->rewards / $data->k2->maxRewards) * 100);
      if ($k1p < 5) { $k1p = 7; }
      if ($k1p > 95) { $k1p = 95; }
      if ($k2p < 5) { $k2p = 7; }
      if ($k2p > 95) { $k2p = 95; }
    ?>

    <ul class="weekdays">
      <li><span class="<?php if ($weekDay == "Mon") { echo 'active'; } ?>">Mon</span></li>
      <li><span class="<?php if ($weekDay == "Tue") { echo 'active'; } ?>">Tue</span></li>
      <li><span class="<?php if ($weekDay == "Wed") { echo 'active'; } ?>">Wed</span></li>
      <li><span class="<?php if ($weekDay == "Thu") { echo 'active'; } ?>">Thu</span></li>
      <li><span class="<?php if ($weekDay == "Fri") { echo 'active'; } ?>">Fri</span></li>
      <li><span class="<?php if ($weekDay == "Sat") { echo 'active'; } ?>">Sat</span></li>
      <li><span class="<?php if ($weekDay == "Sun") { echo 'active'; } ?>">Sun</span></li>
    </ul>

    <table>
      <tr>
        <th><a href="add.php?kid=k1">+</a> <?php echo $data->k1->name; ?> <?php if ($data->k1->rewards > 0) { echo '<a href="remove.php?kid=k1">-</a>'; } ?></th>
        <th <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><a href="add.php?kid=k2">+</a> <?php echo $data->k2->name; ?> <?php if ($data->k2->rewards > 0) { echo '<a href="remove.php?kid=k2">-</a>'; } ?></th>
      </tr>
      <tr>
        <td><div <?php if (!$data->k1->progressBar) { echo 'style="display:none"'; } ?> style="padding:10px 50px; font-size: 16px"><div style="background-color:lightblue; border-radius:8px"><div style="padding:5px; background-color:lightblue; border-radius:8px; width:<?php echo $k1p ?>%">&nbsp;<img src="images/<?php echo $data->k1->image ?>/icon.png" style="height:20px;float:right"></div></div></div></td>
        <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><div <?php if (!$data->k2->progressBar) { echo 'style="display:none"'; } ?> style="padding:10px 50px; font-size: 16px"><div style="background-color:lightblue; border-radius:8px"><div style="padding:5px; background-color:lightblue; border-radius:8px; width:<?php echo $k2p ?>%">&nbsp;<img src="images/<?php echo $data->k2->image ?>/icon.png" style="height:20px;float:right"></div></div></div></td>
      </tr>
      <tr>
        <td><?php echo $data->k1->currency, $data->k1->cash; ?> owed. <?php if ($data->k1->cash > 0) { echo '<a href="pay.php?kid=k1">Pay?</a>'; } ?></td>
        <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php echo $data->k2->currency, $data->k2->cash; ?> owed. <?php if ($data->k2->cash > 0) { echo '<a href="pay.php?kid=k2">Pay?</a>'; } ?></td>
      </tr>
      <tr>
        <td><?php for ($k = 0 ; $k < $data->k1->rewards; $k++){ echo '<img src="images/', $data->k1->image, '/icon.png" width="75" height="75">'; } ?></td>
        <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php for ($k = 0 ; $k < $data->k2->rewards; $k++){ echo '<img src="images/', $data->k2->image, '/icon.png" width="75" height="75">'; } ?></td>
      </tr>
    </table>
  </body>
</html>