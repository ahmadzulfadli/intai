<!DOCTYPE html>
<html>

<head>
    <title>Temperature and Humidity Monitoring</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin: 0 0 20px 0;
        }

        #map {
            height: 100%;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Temperature and Humidity Monitoring</h1>
        <div id="map"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/@esri/arcgis-to-geojson-utils@3.17.0/dist/umd/arcgisToGeoJSONUtils.min.js"></script>
    <script src="https://unpkg.com/@esri/arcgis-rest-request@3.17.0/dist/umd/arcgisRestRequest.min.js"></script>
    <script src="https://unpkg.com/@esri/arcgis-rest-auth@3.17.0/dist/umd/arcgisRestAuth.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var sensorData = {
            temperature: 21,
            humidity: 22,
            latitude: -0.8175,
            longitude: 102.4710833,
            status: "Aman"
        };

        var myLatLng = L.latLng(sensorData.latitude, sensorData.longitude);
        var map = L.map('map').setView(myLatLng, 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        var markerIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        if (sensorData.status === "Aman") {
            markerIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        } else if (sensorData.status === "Bahaya") {
            markerIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }

        var marker = L.marker(myLatLng, {
            icon: markerIcon
        }).addTo(map);

        var popupContent = "<b>Temperature:</b> " + sensorData.temperature + " &deg;C<br>" + "<b>Humidity:</b> " + sensorData.humidity + " %<br>";
        var popup = L.popup().setContent(popupContent);
        marker.bindPopup(popup);
    </script>
</body>

</html>