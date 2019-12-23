<?php
  function brutalTitle($numberFile = "number.txt") {
    $number = '';
    if (!is_file($numberFile)) {
      file_put_contents($numberFile, 0);
      $number = 0;
    }
    $number = file_get_contents($numberFile);
    return $number;
  }
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BFL Counter: <?=brutalTitle()?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script>
      var curday;
      var secTime;
      var ticker;

      function getSeconds(date) {
        var lastBrutal = moment.unix(date);
        var today = moment();
        var timeSince = moment.duration(today.diff(lastBrutal));

        // console.log(lastBrutal.format(), today.format(), timeSince.asSeconds());

        startTimer(timeSince.asSeconds());
      }

      function startTimer(secs) {
        secTime = parseInt(secs);
        // console.log('secTime', secTime);
        ticker = setInterval("tick()",1000);
        tick(); //initial count display
      }

      function tick() {
        var secs = secTime;

        if (secs == 0) {
          clearInterval(ticker);
        }

        secTime++;

        var days = Math.floor(secs/86400);
        secs %= 86400;
        var hours= Math.floor(secs/3600);
        secs %= 3600;
        var mins = Math.floor(secs/60);
        secs %= 60;

        // update the time display
        document.getElementById("days").innerHTML = ((days < 10 ) ? "0" : "" ) + days;
        document.getElementById("hours").innerHTML = ((hours < 10 ) ? "0" : "" ) + hours;
        document.getElementById("minutes").innerHTML = ( (mins < 10) ? "0" : "" ) + mins;
        document.getElementById("seconds").innerHTML = ( (secs < 10) ? "0" : "" ) + secs;
      }

      $(document).ready(function(){
        $.ajax({
          type: 'GET',
          url: 'counter.php',
          data: { },
          success: function(response) {
            response = JSON.parse(response)
            // console.log(response.date);
            $('#times').text(response.number);
            getSeconds(parseInt(response.date));
          }
        });

        $('button.show-confirm').click(function() {
          $('body').addClass('confirm-is-active');
        });

        $('button.hide-confirm').click(function() {
          $('body').removeClass('confirm-is-active');
        });

        $('button.trigger-brutal').click(function(){
          $.ajax({
            type: 'POST',
            url: 'counter.php',
            data: { action: $(this).val() },
            success: function(response) {
              response = JSON.parse(response)
              $('#times').text(response.number);
              getSeconds(parseInt(response.date));
            }
          });
        });
      });

      // iOS is dumb
      let vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);

      window.addEventListener('resize', () => {
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
      });
    </script>
  </head>
  <body>
    <div class="viewport">
      <div class="plane">
        <div class='banner-wrap'>
        </div>

        <div class="main">
          <div class="content">

            <h2>It has been</h2>
            <h1>
              <div>
              <span id='days'></span> days
              </div>
              <div>
              <span id='hours'></span> hours
              </div>
              <div>
              <span id='minutes'></span> minutes
              </div>
              <div>
              <span id='seconds'></span> seconds
              </div>
            </h1>
            <h2 class='type-scale-2'>Since the last <span class='text-grey-5'>Brutal For Landon</span>.</h2>

            <h2 class='type-scale-4'><span class='icon icon-arrow-down'></span></h2>

          </div>
          <div class='actions'>
            <h2 class='type-scale-2'>Landon has been brutal <span class='type-scale-2' id='times'></span> times.</h2>

            <div class='text-center'>
              <button class='button-white show-confirm'>Landon is being brutal</button>
            </div>

            <div class='action-confirm'>
              <h2 class='type-scale-2'>Are you sure?</h2>

              <div class='button-row text-center'>
                <button class='button-grey-2 hide-confirm'>No, he's ok</button>
                <button class='button-primary trigger-brutal hide-confirm' value='increment'>Yes, BFL</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/assets/js/scripts.js"></script>
  </body>
</html>
