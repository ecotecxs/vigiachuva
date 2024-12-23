<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Start - Leaflet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['nome_usuario'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header('Location: login.html');
    exit();
}
?>

<div id="map" style="width: 900px; height: 500px;"></div>

<script>
    const map = L.map('map').setView([-24.10508, -46.650696], 16);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 50,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    function onMapClick(e) {
        let lat = e.latlng.lat.toFixed(6);
        let lon = e.latlng.lng.toFixed(6);

        // Redirecionar para o formulário com a latitude e longitude na query string
        window.location.href = `sinalizacao.html?lat=${lat}&lon=${lon}`;
    }

    map.on('click', onMapClick);
</script>

</body>
</html>
