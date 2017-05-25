<?php $GetContentRecord = $objContent->getContent($_GET['content']);?>
<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?php echo $GetContentRecord["cms_title"];?></h2>
                </div>
                 
            </div>
        </div>
        <section id="content">
            <div class="container" style="min-height: 700px">
                <div id="main">
                    <div class="image-style1 style1 large-block">
                        
 
                       <h1 class="title"><?php echo $GetContentRecord["cms_title"];?></h1>
<?php echo $GetContentRecord["cms_detail"];?>           

 </div>

<?php if($_GET["content"]=='contact-us'){?>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
                    
     <div id="map"></div>
    
     <script>
	  var locations = [
      ['Main Office', 26.214941, 50.588762, 4],
      ['Manama Beach', 26.233051, 50.569368, 5],
      ['Muharraq Beach', 26.269460, 50.626345, 3],
      ['Exhibition Road Beach', 26.227880, 50.596193, 2],
      ['Salmabad Beach', 26.174641, 50.543603, 1]
    ];
    var map;
    var markers = [];

    function init(){
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(26.174644, 50.547149),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var num_markers = locations.length;
      for (var i = 0; i < num_markers; i++) {  
        markers[i] = new google.maps.Marker({
          position: {lat:locations[i][1], lng:locations[i][2]},
          map: map,
          html: locations[i][0],
          id: i,
        });

        google.maps.event.addListener(markers[i], 'click', function(){
          var infowindow = new google.maps.InfoWindow({
            id: this.id,
            content:this.html,
            position:this.getPosition()
          });
          google.maps.event.addListenerOnce(infowindow, 'closeclick', function(){
            markers[this.id].setVisible(true);
          });
          this.setVisible(false);
          infowindow.open(map);
        });
      }
    }

google.maps.event.addDomListener(window, 'load', init);
    </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwUr6calybPnlLXSSeMfsEUMLXy3AG3wg&callback=init"></script>
                    <?php } ?>
                </div> <!-- end main -->
            </div>
        </section>
       
       