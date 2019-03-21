<img src="https://lorempixel.com/400/400" id="target">

  <script type="text/javascript">


      jQuery(function($) {
          $('#target').Jcrop({
              onSelect:    showCoords,
              bgColor:     'black',
              bgOpacity:   .4,
              setSelect:   [ 200, 200, 0, 0 ],
              aspectRatio: 1 / 1
          });
      });

      function showCoords(c){
        alert('X: ' + c.x + ' / Y: ' + c.y);
      };



  </script>