<?php
// update-settings.php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('kids.json'));

    // Update k1 image if provided
    if (isset($_POST['k1_image'])) {
        $newImage = $_POST['k1_image'];
        // Validate that the image directory exists
        if (is_dir('images/' . $newImage)) {
            $data->k1->image = $newImage;
        }
    }

    // Update k2 image if provided and k2 exists
    if (isset($_POST['k2_image']) && isset($data->k2)) {
        $newImage = $_POST['k2_image'];
        // Validate that the image directory exists
        if (is_dir('images/' . $newImage)) {
            $data->k2->image = $newImage;
        }
    }

    // Save updated data
    $newData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('kids.json', $newData);
}
?>

<html>
<head>
  <title>Settings Updated - Kids Reward System</title>
  <link rel="stylesheet" type="text/css" href="./styles.php">
  <meta http-equiv="refresh" content="1;url=index.php" />
</head>
<body>
  <center>
    <h1>Settings Updated!</h1>
    <p>Redirecting to home page...</p>
  </center>
</body>
</html>
