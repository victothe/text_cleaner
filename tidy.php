#!/usr/local/bin/php
<?php
$fileName = $_FILES['their_file']['name'];
if (isset($_POST['submit']) && $fileName != "") {
  $tidyName = "tidy_";
  $tidyName .= $fileName;

  $currentLocation = $_FILES['their_file']['tmp_name'];

  header('Content-Disposition: attachment; filename="' . $tidyName);

  $file = fopen($currentLocation, 'r');
  if ($file) {

    while ($line = fgets($file)) {
      if (strpos($line, "\r\n") !== false){
        echo rtrim($line) . "\r\n";
      } else if (strpos($line, "\n") !== false) {
        echo rtrim($line) . "\n";
      } else {
        echo rtrim($line);
      }
      //echo(rtrim($line));
    }

    fclose($file);
  }

  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PIC 40A Demo</title>
</head>

<body>
  <header>
    <h1>PIC 40A Demo - Tidy Trailing Space</h1>
  </header>
</body>

<main>
  <section>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
      <input type="file" name="their_file" accept=".txt" /><br>
      <input type="submit" value="Submit" name="submit" />
    </form>
  </section>

</main>

<footer>
  <hr>
  <small>
    &copy; Victor He, 2022
  </small>
</footer>

</html>