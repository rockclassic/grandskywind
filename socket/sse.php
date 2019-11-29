<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

/*echo "retry: 2000\n";
echo "data: {".time()."}\n";*/

/*$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush();*/

//$counter = rand(1, 10);
while (1) {
  $res = array(
      'a' => date('Y-m-d H:i:s'),
      'b' => 2,
      'c' => 3,
  );
  $counter = rand(1, 10);
  //echo $counter;
  //if($counter < 5) echo "data: Data is change.\n\n";
  if($counter < 5) echo "data: ".json_encode($res)."\n\n";
  if($counter == 10) echo "data: retry\n\n";
  // Every second, send a "ping" event.

  //echo "event: ping\n";
  //$curDate = date(DATE_ISO8601)." - ".time();
  //echo 'data: {"time": "' . $curDate . '"}';
  //echo "\n\n";

  // Send a simple message at random intervals.


  //echo 'data: This is a message at time ' . $curDate . "\n\n";
  //if (!$counter) {
    //echo "data: retry\n\n";
    //echo 'data: This is a message at time ' . $curDate . "\n\n";
    //$counter = rand(1, 10);
  //}

  ob_end_flush();
  flush();
  sleep(1);
  //usleep(300000);
}
