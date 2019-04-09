<?php include 'application/models/stadium_model.php'; ?>
<!-- Page Content -->
<div class="container">

<!-- Portfolio Item Heading -->
<h1 class="my-4">Football Centre</h1>

<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="home">Home</a></li>
<li class="breadcrumb-item"><a href="members">Members</a></li>
<li class="breadcrumb-item active" aria-current="page">Map</li>
</ol>
</nav>
<h3 class="my-4">Football Stadiums Map</h3>

<div id='map' style='width: 100%; height: 100%;'></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiaWt6IiwiYSI6ImNqbzdqaWdzNjB0cnczcXBxN2o4ZTYwa3YifQ.69sovdUGQm1icLhDz1Hu8A';

// Set max bounds
var bounds = [
[-2.133172, 52.580687], // Southwest coordinates
[-2.106686, 52.601291]  // Northeast coordinates
];
// Set map settings
var map = new mapboxgl.Map({
                           container: 'map', // container id
                           style: 'mapbox://styles/ikz/cjp18sivd0ys52srm3fd3ckil',
                           center: [-2.127493, 52.588062], // starting position
                           zoom: 3, // starting zoom
                           pitch: 45,
                           bearing: -17.6,
                           //maxBounds: bounds // Sets bounds as max
                           });


// Marker
var stadium_markers = <?php get_stadium() ?>;
var popup = new mapboxgl.Popup({ offset: 25 })
.setText('Stadium');

//Controls

// Add geolocate control to the map.
map.addControl(new mapboxgl.GeolocateControl({
                                             positionOptions: {
                                             enableHighAccuracy: true
                                             },
                                             trackUserLocation: true
                                             }));
// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl());

// Add geocoder
//map.addControl(new MapboxGeocoder({ accessToken: mapboxgl.accessToken }));

// The 'building' layer in the mapbox-streets vector source contains building-height
// data from OpenStreetMap.
map.on('load', function() {
       add_markers(stadium_markers);
       // Insert the layer beneath any symbol layer.
       var layers = map.getStyle().layers;
       
       var labelLayerId;
       for (var i = 0; i < layers.length; i++) {
       if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
       labelLayerId = layers[i].id;
       break;
       }
       }
       
       map.addLayer({
                    'id': '3d-buildings',
                    'source': 'composite',
                    'source-layer': 'building',
                    'filter': ['==', 'extrude', 'true'],
                    'type': 'fill-extrusion',
                    'minzoom': 15,
                    'paint': {
                    'fill-extrusion-color': '#aaa',
                    
                    // use an 'interpolate' expression to add a smooth transition effect to the
                    // buildings as the user zooms in
                    'fill-extrusion-height': [
                    "interpolate", ["linear"], ["zoom"],
                    15, 0,
                    15.05, ["get", "height"]
                    ],
                    'fill-extrusion-base': [
                    "interpolate", ["linear"], ["zoom"],
                    15, 0,
                    15.05, ["get", "min_height"]
                    ],
                    'fill-extrusion-opacity': .6
                    }
                    }, labelLayerId);
       
       // Add markers showing the treasure.
       function add_markers(coordinates) {
       
       var geojson = (stadium_markers == coordinates ? stadium_markers : '');
       
       console.log(geojson);
       // add markers to map
       geojson.forEach(function (stadium) {
                       console.log(stadium);
                       // make a marker for each feature and add to the map
                       new mapboxgl.Marker()
                       .setLngLat(stadium)
                       .setPopup(popup) // sets a popup on this marker
                       .addTo(map);
                       });
       
       }
       
       // Change the cursor to a pointer when the mouse is over the places layer.
       map.on('mouseenter', 'places', function () {
              map.getCanvas().style.cursor = 'pointer';
              });
       
       // Change it back to a pointer when it leaves.
       map.on('mouseleave', 'places', function () {
              map.getCanvas().style.cursor = '';
              });
       });
</script>
<br>
</div>
<!-- /.container -->
