<?php
// settings.php
include 'config.php';

$data = getData('kids.json');

// Get available reward types from images directory
$imageDir = 'images/';
$rewardTypes = array_filter(scandir($imageDir), function($item) use ($imageDir) {
    return is_dir($imageDir . $item) && $item != '.' && $item != '..';
});
sort($rewardTypes);
?>

<html>
<head>
  <title>Settings - Kids Reward System</title>
  <link rel="stylesheet" type="text/css" href="./styles.php">
</head>
<body>
  <div style="padding: 20px;">
    <h1>Settings</h1>

    <form method="post" action="update-settings.php">
      <table style="width: 100%; max-width: 600px;">
        <tr>
          <th>Kid</th>
          <th>Reward Type</th>
        </tr>
        <tr>
          <td><?php echo htmlspecialchars($data->k1->name); ?></td>
          <td>
            <select name="k1_image" style="font-size: 1.5em; padding: 10px;">
              <?php foreach ($rewardTypes as $type): ?>
                <option value="<?php echo htmlspecialchars($type); ?>"
                        <?php if ($data->k1->image === $type) echo 'selected'; ?>>
                  <?php echo htmlspecialchars(ucfirst($type)); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <?php if ($data->k2): ?>
        <tr>
          <td><?php echo htmlspecialchars($data->k2->name); ?></td>
          <td>
            <select name="k2_image" style="font-size: 1.5em; padding: 10px;">
              <?php foreach ($rewardTypes as $type): ?>
                <option value="<?php echo htmlspecialchars($type); ?>"
                        <?php if ($data->k2->image === $type) echo 'selected'; ?>>
                  <?php echo htmlspecialchars(ucfirst($type)); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <?php endif; ?>
      </table>

      <div style="margin-top: 20px;">
        <button type="submit" style="font-size: 1.5em; padding: 15px 30px; cursor: pointer;">
          Save Changes
        </button>
        <a href="index.php" style="font-size: 1.5em; padding: 15px 30px; text-decoration: none; margin-left: 10px;">
          Cancel
        </a>
      </div>
    </form>
  </div>
</body>
</html>
