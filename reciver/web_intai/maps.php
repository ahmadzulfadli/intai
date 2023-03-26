<!DOCTYPE html>
<html>

<head>
    <title>Posisi Sensor Kebakaran Hutan</title>
    <style>
        #map {
            height: 100%;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: -6.229728,
                    lng: 106.689431
                } // Koordinat pusat peta
            });

            // Data lokasi sensor kebakaran hutan (dalam format GeoJSON)
            var sensorLocations = [{
                    "type": "Feature",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [106.701804, -6.305083]
                    },
                    "properties": {
                        "name": "Sensor 1"
                    }
                },
                {
                    "type": "Feature",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [106.753099, -6.318374]
                    },
                    "properties": {
                        "name": "Sensor 2"
                    }
                },
                {
                    "type": "Feature",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [106.765441, -6.204296]
                    },
                    "properties": {
                        "name": "Sensor 3"
                    }
                }
            ];

            // Menambahkan marker pada posisi sensor kebakaran hutan
            sensorLocations.forEach(function(sensor) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: sensor.geometry.coordinates[1],
                        lng: sensor.geometry.coordinates[0]
                    },
                    map: map,
                    title: sensor.properties.name
                });
            });
        }
    </script>
</head>

<body>
    <div id="map"></div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
</body>

</html>