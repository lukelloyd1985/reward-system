<?php
// index.php
include 'config.php';

$weekDay = getWeekDay();
$data = getData('kids.json');
$k1p = calculatePercentage($data->k1->rewards, $data->k1->maxRewards);
$k2p = calculatePercentage($data->k2->rewards, $data->k2->maxRewards);
?>

<html>
<head>
  <title>Kids Reward System</title>
  <link rel="stylesheet" type="text/css" href="./styles.php">
  <meta http-equiv="refresh" content="300" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
</head>
<body>
  <ul class="weekdays">
    <li><span class="<?php echo isActiveDay($weekDay, 'Mon'); ?>">Mon</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Tue'); ?>">Tue</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Wed'); ?>">Wed</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Thu'); ?>">Thu</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Fri'); ?>">Fri</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Sat'); ?>">Sat</span></li>
    <li><span class="<?php echo isActiveDay($weekDay, 'Sun'); ?>">Sun</span></li>
  </ul>

  <table>
    <tr>
      <th><a href="add.php?kid=k1">+</a> <?php echo htmlspecialchars($data->k1->name); ?> <?php if ($data->k1->rewards > 0 || $data->k1->allowNegativeRewards) { echo '<a href="remove.php?kid=k1">-</a>'; } ?></th>
      <th <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><a href="add.php?kid=k2">+</a> <?php echo htmlspecialchars($data->k2->name); ?> <?php if ($data->k2->rewards > 0 || $data->k2->allowNegativeRewards) { echo '<a href="remove.php?kid=k2">-</a>'; } ?></th>
    </tr>
    <tr>
      <td><div <?php if (!$data->k1->progressBar) { echo 'style="display:none"'; } ?> style="padding:10px 50px; font-size: 16px"><div style="background-color:lightblue; border-radius:8px"><div style="padding:5px; background-color:lightblue; border-radius:8px; width:<?php echo $k1p; ?>%">&nbsp;<img src="images/<?php echo htmlspecialchars($data->k1->image); ?>/icon.png" style="height:20px;float:right"></div></div></div></td>
      <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><div <?php if (!$data->k2->progressBar) { echo 'style="display:none"'; } ?> style="padding:10px 50px; font-size: 16px"><div style="background-color:lightblue; border-radius:8px"><div style="padding:5px; background-color:lightblue; border-radius:8px; width:<?php echo $k2p; ?>%">&nbsp;<img src="images/<?php echo htmlspecialchars($data->k2->image); ?>/icon.png" style="height:20px;float:right"></div></div></div></td>
    </tr>
    <tr>
      <td><?php echo htmlspecialchars($data->k1->currency), htmlspecialchars($data->k1->cash); ?> owed. <?php if ($data->k1->cash > 0) { echo '<a href="pay.php?kid=k1">Pay?</a>'; } ?></td>
      <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php echo htmlspecialchars($data->k2->currency), htmlspecialchars($data->k2->cash); ?> owed. <?php if ($data->k2->cash > 0) { echo '<a href="pay.php?kid=k2">Pay?</a>'; } ?></td>
    </tr>
    <tr>
      <td><?php echo displayIcons($data->k1->rewards, $data->k1->image); ?></td>
      <td <?php if (!$data->k2) { echo 'style="display:none"'; } ?>><?php echo displayIcons($data->k2->rewards, $data->k2->image); ?></td>
    </tr>
  </table>
</body>
</html>