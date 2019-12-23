<?php
  function brutal($numberFile = "number.txt", $dateFile = "date.txt") {

    $return = array();

    if (!is_file($numberFile)) {
      file_put_contents($numberFile, 0);
      $return['number'] = 0;
    }

    if (!is_file($dateFile)) {
      file_put_contents($dateFile, time());
      $return['date'] = time();
    }

    $return['number'] = file_get_contents($numberFile);
    $return['date'] = file_get_contents($dateFile);

    if (isset($_POST['action'])) {
      $return['number'] ++;
      file_put_contents($numberFile, $return['number'], LOCK_EX); // LOCK the file

      file_put_contents($dateFile, time(), LOCK_EX); // LOCK the file
      $return['date'] = time();
    };

    return $return;
  }

  echo json_encode(brutal());
?>
