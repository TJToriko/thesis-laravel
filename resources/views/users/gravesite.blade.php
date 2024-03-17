@extends('users.user_layouts.app')

@section('page_title', 'Hillside Memorial Garden | Gravesite Look Up')
@section('grave', 'active')

@section('content')
<style>
    #locateBtn {
        position: absolute;
        top: 53px;
        left: 60px;
        z-index: 1000;
        background-color: #fff;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
  
          <div class="row">
  
            <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                
                <div id="map">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control" style="border:none;">
                        <div class="search-container" style="margin-left: 60px;margin-top: 20px;">
                            <input type="text" id="lotNumberInput" placeholder="Enter Lot Number">
                            <button onclick="searchLot()">Search</button>
                        </div>
                        <button id="locateBtn">My Location</button>
                    </div>
                </div>
                
                


                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                <script src="{{ asset('assets/data/wholehillside.js') }}"></script>
                <script src="{{ asset('assets/data/3sideshillside.js') }}"></script>
                
                <script>
                    var rectangles = {
                        "type": "FeatureCollection",
                        "features": [
                            @foreach($lotstatusget as $lot)
                            {
                                "type": "Feature",
                                "properties": {
                                    "lotID": "{{ $lot->id }}",
                                    "lotStatus": "{{ $lot->lot_status }}",
                                    "lotSection": "{{ $lot->section }}",
                                    "lotNo": "{{ $lot->lot_no }}",
                                    "lotType": "{{ $lot->lotType->lot_type_name }}"
                                    @if($lot->lotClass && !empty($lot->lotClass->lot_class_name)),
                                    "lotClass": "{{ $lot->lotClass->lot_class_name }}",
                                    @endif
                                },
                                "geometry": {
                                    "coordinates": [[
                                        {{ $lot->coordinates }}
                                    ]],
                                    "type": "Polygon"
                                }
                            },
                            @endforeach
                        ]
                    };
                </script>
                <style>
                    .contact .info {
                        padding: 9px !important;
                    }
                </style>
            
                <script>
                    var map = L.map('map').setView([6.968534, 122.103685], 17);
                    
            
                    // Create GeoJSON layers
                    var geojsonLayer1 = L.geoJson(wholehillsidegeojson);
                    var geojsonLayer2 = L.geoJson(sidehillsidegeojson);
                    var geojsonLayer3 = L.geoJson(rectangles, {
                            style: styleLayer3,
                            onEachFeature: function (feature, layer) {
                                var lotID = feature.properties.lotID;
                                var lotStatus = feature.properties.lotStatus;
                                var lotSection = feature.properties.lotSection;
                                var lotNo = feature.properties.lotNo;
                                var lotType = feature.properties.lotType;
                                var lotClass = feature.properties.lotClass;

                                // Set default popup content
                                var popupContent = '<b>Lot Status:</b> ' + lotStatus;
                                popupContent += '<br><b>Section:</b> ' + lotSection; // Concatenate to add Section
                                popupContent += '<br><b>Lot #:</b> <span id="lot_number">' + lotNo + '</span>';       // Concatenate to add Lot No
                                popupContent += '<br><b>Lot Type:</b> <span id="lot_number">' + lotType + '</span>';
                                // Check if Lot Class is not empty before adding it to the popup
                                if (lotClass && lotClass.trim() !== '') {
                                    popupContent += '<br><b>Lot Class:</b> <span id="lot_number">' + lotClass + '</span>';
                                }

                                // You can customize the popup content based on the lot status or add more information
                                // For example, add more details if the lot is Reserved or Intered
                                if (lotStatus === 'Available') {
                                    popupContent += '<br><a class="btn" href="{{ url('lot-user/session-lot-store/') }}/' + lotID + '">Select Lot</a>';
                                } else if (lotStatus === 'Intered') {
                                    popupContent += '<br><i>Someone has been interred in this lot.</i>';
                                } else if (lotStatus === 'Reserved') {
                                    popupContent += '<br><i>This Lot is Reserved.</i>';
                                } else if (lotStatus === 'Unavailable') {
                                    popupContent += '<br><i>Lot is Unavailable.</i>';
                                }

                                layer.bindPopup(popupContent);
                            }
                        });


            
            
                    // Satelite Layer
                    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                    maxZoom: 25,
                    subdomains:['mt0','mt1','mt2','mt3']
                    });
                    googleSat.addTo(map);
            
                    // Google Map Layer
            
                    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                        maxZoom: 25,
                        subdomains:['mt0','mt1','mt2','mt3']
                    });
                    googleStreets.addTo(map);
            
            
                    var baseLayers = {
                        "Satellite":googleSat,
                        "Google Map":googleStreets,
                    };
            
                    L.control.layers(baseLayers).addTo(map);
            
                    // Add GeoJSON layers to the map initially
                    geojsonLayer1.addTo(map);
            
                    var sectionLayer = L.geoJson(wholehillsidegeojson, {
                        style: style,
                        onEachFeature: onEachFeature
                    }).addTo(map);

                    // Create a legend for the colors indicating status
                    var statusLegend = L.control({ position: 'topright' });

                    statusLegend.onAdd = function (map) {
                        var div = L.DomUtil.create('div', 'info legend');
                        div.innerHTML += '<div>Lot Status</div>';
                        
                        // Add legend items for different statuses with color indicators
                        div.innerHTML += '<div><i class="legend-icon" style="background: green;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Intered</div>';
                        div.innerHTML += '<div><i class="legend-icon" style="background: black;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Unavailable</div>';
                        div.innerHTML += '<div><i class="legend-icon" style="background: blue;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Available</div>';
                        div.innerHTML += '<div><i class="legend-icon" style="background: yellow;width: 15px;height: 15px;margin-right: 5px;border-radius: 0;"></i> Reserved</div>';
                        // Add more legend items as needed for other statuses
                        
                        return div;
                    };

                    statusLegend.addTo(map);
            
                    // Listen for zoom events on the map
                    map.on('zoomend', function () {
                        var currentZoom = map.getZoom();
            
                        // Check the current zoom level and show/hide layers accordingly
                        if (currentZoom > 18) {
                            map.removeLayer(hsmLayer);
                            map.removeLayer(geojsonLayer2);
                            map.addLayer(geojsonLayer3);
                        } else if (currentZoom > 17 && currentZoom <= 18) {
                            map.removeLayer(geojsonLayer1);
                            map.removeLayer(sectionLayer);
                            map.removeLayer(geojsonLayer3);
                            map.addLayer(geojsonLayer2);
                            map.addLayer(hsmLayer);
                        } else {
                            map.removeLayer(hsmLayer);
                            map.removeLayer(geojsonLayer2);
                            map.addLayer(geojsonLayer1);
                            map.addLayer(sectionLayer);
                        }            
                    });
            
                    // Define styling for the Hsm GeoJSON layer
                    function style(feature) {
                        return {
                            fillColor: '#3388ff',
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0
                        };
                    }
            
                    // Define highlight and resetHighlight functions for the Hsm GeoJSON layer
                    function highlightFeature(e) {
                        var layer = e.target;
            
                        layer.setStyle({
                            weight: 5,
                            color: '#666',
                            dashArray: '',
                            fillOpacity: 0.7
                        });
            
                        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                            layer.bringToFront();
                        }
            
                        info.update(layer.feature.properties);
                    }
            
                    function resetHighlight(e) {
                        hsmLayer.resetStyle(e.target);
                        info.update();
                    }
            
                    // Create the Hsm GeoJSON layer with the defined style and interactions
                    var hsmLayer = L.geoJson(sidehillsidegeojson, {
                        style: style,
                        onEachFeature: onEachFeature
                    });
            
                    function resetHighlight(e) {
                        sectionLayer.resetStyle(e.target);
                        info.update();
                    }
            
                    // Create the Hsm GeoJSON layer with the defined style and interactions
            
            
            
                    // Define the info control for displaying feature properties
                    var info = L.control();
            
                    // Define the zoomToFeature function for zooming to a feature's bounds
                    function zoomToFeature(e) {
                        map.fitBounds(e.target.getBounds());
                    }
            
                    // Define onEachFeature function for adding interactions to Hsm features
                    function onEachFeature(feature, layer) {
                        layer.on({
                            mouseover: highlightFeature,
                            mouseout: resetHighlight,
                            click: zoomToFeature
                        });
                    }

                    // Define styling for Layer 3 (rectangles GeoJSON layer)
                    function styleLayer3(feature) {
                        var lotStatus = feature.properties.lotStatus;

                        // Set default style
                        var defaultStyle = {
                            weight: 2,
                            opacity: 1,
                            color: 'blue',
                            dashArray: '3',
                            fillOpacity: 0
                        };

                        // Check lot status and set fillColor accordingly
                        if (lotStatus === 'Unavailable') {
                            return { ...defaultStyle, color: 'black' };
                        } else if (lotStatus === 'Reserved') {
                            return { ...defaultStyle, color: 'yellow' };
                        } else if (lotStatus === 'Intered') {
                            return { ...defaultStyle, color: 'green' };
                        }else {
                            // Default color for other cases
                            return defaultStyle;
                        }
                    }
                    // Declare the searchMarker variable in the global scope
                    var searchMarker;

                    function searchLot() {
                        var lotNumber = document.getElementById('lotNumberInput').value.toUpperCase(); // Convert to uppercase for case-insensitivity
                        var found = false;

                        // Loop through GeoJSON features to find the matching lot number
                        geojsonLayer3.eachLayer(function (layer) {
                            if (layer.feature.properties.lotNo.toUpperCase() === lotNumber) {
                                // Found the matching lot, zoom to its bounds
                                map.fitBounds(layer.getBounds());
                                map.setZoom(23); // Set the zoom level to 23

                                // Remove any existing markers before adding a new one
                                if (searchMarker) {
                                    map.removeLayer(searchMarker);
                                }

                                // Add a marker at the center of the lot's bounds
                                searchMarker = L.marker(layer.getBounds().getCenter()).addTo(map);

                                found = true;
                            }
                        });

                        // Display an alert if the lot number is not found
                        if (!found) {
                            alert('Lot number not found.');
                        }
                    }


                    // Locate Me button click event
                    document.getElementById('locateBtn').addEventListener('click', function() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(getPosition);
                        } else {
                            console.log("Geolocation is not supported by this browser.");
                        }
                    });

                    function getPosition(position){
                        var lat = position.coords.latitude
                        var long = position.coords.longitude
                        var fixedAccuracy = 5; // Set your desired fixed accuracy in meters

                        var marker = L.marker([lat,long]).addTo(map)
                        
                        var circle = L.circle([lat, long], {radius: fixedAccuracy}).addTo(map);

                        console.log("your coordinates is Lat:" + lat + " Long:" + long + " Accuracy:" + fixedAccuracy)
                    }
                </script>

            </div>
  
          </div>
  
        </div>
        
    </section><!-- End Contact Section -->
      
@endsection