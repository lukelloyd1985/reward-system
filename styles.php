<?php
// styles.php - Dynamic CSS generation
header('Content-Type: text/css');
include 'config.php';

$data = getData('kids.json');
$font = isset($data->font) ? htmlspecialchars($data->font) : 'maple3cartoon.woff';
$textColor = isset($data->textColor) ? htmlspecialchars($data->textColor) : '#000000';
$backgroundColor = isset($data->backgroundColor) ? htmlspecialchars($data->backgroundColor) : '#fef1de';
$accentColor = isset($data->accentColor) ? htmlspecialchars($data->accentColor) : 'lightblue';
?>
@font-face {
    font-family: kids;
    font-style: normal;
    font-weight: normal;
    src: url(fonts/<?php echo $font; ?>);
  }

  body {
    background-color: <?php echo $backgroundColor; ?>;
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }

  h1 {
    font-family: kids;
    font-weight: normal;
    color: <?php echo $textColor; ?>;
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
    font-weight: normal;
    color: <?php echo $textColor; ?>;
    text-align: center;
  }

  .inlineTable {
    display: inline-block;
    margin: 1em;
  }

  td {
    font-family: kids;
    font-size: 30px;
    font-weight: normal;
    vertical-align: top;
    text-align: center;
  }

  a {
    text-decoration: none;
    color: <?php echo $textColor; ?>;
  }

  .weekdays {
    margin: 0;
    padding: 10px 0;
    background-color: <?php echo $accentColor; ?>;
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

  .progressbar-container {
    padding: 10px 50px;
    font-size: 16px;
  }

  .progressbar-outer {
    background-color: <?php echo $accentColor; ?>;
    border-radius: 8px;
  }

  .progressbar-inner {
    padding: 5px;
    background-color: <?php echo $accentColor; ?>;
    border-radius: 8px;
  }

  .progressbar-inner img {
    height: 20px;
    float: right;
  }
