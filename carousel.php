<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adaptor :: jQuery content slider</title>

  <link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
    <link href="carousel/css/screen.css" rel="stylesheet">
  <script src="carousel/js/lib/modernizr.min.js"></script>
</head>
    <body>

      <div id="page">
      <section>
        <header>
          <div id="time-indicator"></div>
        </header>

        <div id="viewport">
          <div id="box">
            <figure class="slide jbs-current">
              <img src="carousel/img/the-battle.jpg">
            </figure>
            <figure class="slide">
              <img src="carousel/img/hiding-the-map.jpg">
            </figure>
            <figure class="slide">
              <img src="carousel/carousel/img/theres-the-buoy.jpg">
            </figure>
            <figure class="slide">
              <img src="carousel/img/finding-the-key.jpg">
            </figure>
            <figure class="slide">
              <img src="carousel/img/lets-get-out-of-here.jpg">
            </figure>
          </div>
        </div>

        <footer>
          <nav class="slider-controls">
            <a class="increment-control" href="#" id="prev" title="go to the next slide">&laquo; Prev</a>
            <a class="increment-control" href="#" id="next" title="go to the next slide">Next &raquo;</a>

            <ul id="controls">
              <li><a class="goto-slide current" href="#" data-slideindex="0"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="1"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="2"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="3"></a></li>
              <li><a class="goto-slide" href="#" data-slideindex="4"></a></li>
            </ul>
          </nav>
        </footer>
      </section>

    
      </div>

        <script src="//code.jquery.com/jquery-1.7.2.min.js"></script>
    <script>window.jQuery || document.write('<script src="carousel/js/lib/jquery-1.7.2.min.js"><\/script>')</script>
        <script src="carousel/js/box-slider-all.jquery.min.js"></script>
        <script>
          $(function () {
        // This function runs before the slide transition starts
        var switchIndicator = function ($c, $n, currIndex, nextIndex) {
          // kills the timeline by setting it's width to zero
          $timeIndicator.stop().css('width', 0);
          // Highlights the next slide pagination control
          $indicators.removeClass('current').eq(nextIndex).addClass('current');
        };

        // This function runs after the slide transition finishes
        var startTimeIndicator = function () {
          // start the timeline animation
          $timeIndicator.animate({width: '100%'}, slideInterval);
        };

        var $box = $('#box')
          , $indicators = $('.goto-slide')
          , $effects = $('.effect')
          , $timeIndicator = $('#time-indicator')
          , slideInterval = 5000
          , defaultOptions = {
                speed: 1200
              , autoScroll: true
              , timeout: slideInterval
              , next: '#next'
              , prev: '#prev'
              , pause: '#pause'
              , onbefore: switchIndicator
              , onafter: startTimeIndicator
            }
          , effectOptions = {
              'blindLeft': {blindCount: 15}
            , 'blindDown': {blindCount: 15}
            , 'tile3d': {tileRows: 6, rowOffset: 80}
            , 'tile': {tileRows: 6, rowOffset: 80}
          };

        // initialize the plugin with the desired settings
        $box.boxSlider(defaultOptions);
        // start the time line for the first slide
        startTimeIndicator();

        // Paginate the slides using the indicator controls
        $('#controls').on('click', '.goto-slide', function (ev) {
          $box.boxSlider('showSlide', $(this).data('slideindex'));
          ev.preventDefault();
        });

        // This is for demo purposes only, kills the plugin and resets it with
        // the newly selected effect
        $('#effect-list').on('click', '.effect', function (ev) {
          var $effect = $(this)
            , fx = $effect.data('fx')
            , extraOptions = effectOptions[fx];

          $effects.removeClass('current');
          $effect.addClass('current');
          switchIndicator(null, null, 0, 0);
          $box
            .boxSlider('destroy')
            .boxSlider($.extend({effect: fx}, defaultOptions, extraOptions));
          startTimeIndicator();

          ev.preventDefault();
        });
          });
        </script>
   
    </body>
</html>
