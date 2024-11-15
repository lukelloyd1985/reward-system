<?php
define('MIN_PERCENTAGE', 5);
define('MAX_PERCENTAGE', 95);
define('DEFAULT_PERCENTAGE', 7);

function getWeekDay() {
  return date('D');
}

function getData($file) {
  return json_decode(file_get_contents($file));
}

function calculatePercentage($rewards, $maxRewards) {
  if ($maxRewards == 0) {
    return DEFAULT_PERCENTAGE;
  }
  $percentage = (int)(($rewards / $maxRewards) * 100);
  if ($percentage < MIN_PERCENTAGE) {
    return DEFAULT_PERCENTAGE;
  }
  if ($percentage > MAX_PERCENTAGE) {
    return MAX_PERCENTAGE;
  }
  return $percentage;
}

function isActiveDay($currentDay, $day) {
  return $currentDay === $day ? 'active' : '';
}

function displayIcons($count, $image) {
  $icons = '';
  for ($i = 0; $i < $count; $i++) {
    $icons .= '<img src="images/' . htmlspecialchars($image) . '/icon.png" width="75" height="75">';
  }
  return $icons;
}