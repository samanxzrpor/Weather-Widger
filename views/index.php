<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>SamanXp - آب و هوا</title>
  <script src="https://unpkg.com/feather-icons"></script><link rel="stylesheet" href="<?= getUrl('assets') ?>/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <div class="weather-side">
    <div class="weather-gradient"></div>
    <div class="date-container">
      <h2 class="date-dayname"><?= $data['date']['day'] ?></h2><span class="date-day"><?= $data['date']['fullDate'] ?></span><i class="location-icon" data-feather="map-pin"></i><span class="location"><?= $data['weatherData']['city'] ?>, <?= $data['weatherData']['country'] ?></span>
    </div>
    <div class="weather-container"><i class="weather-icon" data-feather="<?= $data['weatherData']['icon'] ?>"></i>
      <h1 class="weather-temp"><?= (int)$data['weatherData']['tempData']->temp ?> °C</h1>
      <h3 class="weather-desc"><?= $data['weatherData']['dis'] ?> </h3>
    </div>
  </div>
  <div class="info-side">
    <div class="today-info-container">
      <div class="today-info">
        <div class="precipitation"> <span class="title">فشار هوا</span><span class="value"><?= $data['weatherData']['tempData']->pressure ?> hPa</span>
          <div class="clear"></div>
        </div>
        <div class="humidity"> <span class="title">رطوبت</span><span class="value"><?= $data['weatherData']['tempData']->humidity ?> %</span>
          <div class="clear"></div>
        </div>
        <div class="wind"> <span class="title">سرعت باد</span><span class="value"><?= $data['weatherData']['windSpeed'] ?> km/h</span>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="week-container">
      <ul class="week-list">
        <!-- <li class="active"><i class="day-icon" data-feather="sun"></i><span class="day-name">Tue</span><span class="day-temp">29°C</span></li> -->
        <li><i class="day-icon" data-feather="cloud"></i><span class="day-name">Wed</span><span class="day-temp">21°C</span></li>
        <li><i class="day-icon" data-feather="cloud"></i><span class="day-name">Wed</span><span class="day-temp">21°C</span></li>
        <li><i class="day-icon" data-feather="cloud-snow"></i><span class="day-name">Thu</span><span class="day-temp">08°C</span></li>
        <!-- <li><i class="day-icon" data-feather="cloud-rain"></i><span class="day-name">Fry</span><span class="day-temp">19°C</span></li> -->
        <li><i class="day-icon" data-feather="cloud"></i><span class="day-name">Fry</span><span class="day-temp">19°C</span></li>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="location-container">
      <form id="change-loc" action="<?= getUrl() ?>" method="POST">
        <input class="location-input" type="text" id="location" name="location" placeholder="City Name ..." autocomplete="off">
        <div class="search-res">

        </div>
        <button type="submit" class="location-button"> <i data-feather="map-pin"></i><span>Change location</span></button>
      </form>
    </div>
  </div>
</div>
<!-- partial -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script  src="<?= getUrl('assets') ?>/script.js"></script>
  <script>
    $(document).ready(function() {

      $("#location").keyup(function(event){

          var loc = $("#location").val();
          const result = $(".search-res");

          event.preventDefault();

          $.ajax({
              url: '<?= getUrl('search') ?>',
              type: 'POST',
              data: $(this).serialize(),
              success: function(res) {
                  result.slideDown().html(res);
              }
          })

      })

    })
  </script>
</body>
</html>
