<!DOCTYPE html>
<html lang='en'>
  <head>
    @include("head.html")
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

        $('button').click(function(){
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
    </script>
  </head>
  <body>
    <div class="viewport">
      <div class="plane">
        <div class='banner-wrap'>
          <div class='banner'></div>
        </div>

        <div class="panel">

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
          <h2>Since the last Brutal For Landon.</h2>

          <div class='text-center'>
            <button value='increment'>Tap if Landon is brutal</button>
          </div>

          <h2>Landon has been brutal <span id='times'></span> times.</h2>
        </div>
      </div>
    </div>

    <script src="/assets/js/scripts.js"></script>
  </body>
</html>
