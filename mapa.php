<?php
session_start();

if (!isset($_SESSION['nome_usuario'])) {
    header('Location: login.html');
    exit();
}

include_once("conexao.php"); // incluindo a conexao com banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" 
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="anonymous" />
    <style>
      #map {
        height: 98vh;
        width: 100%;
      }
    </style>
</head>
<body>
    <div id="map"></div> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" 
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>

    <script>
      var map = L.map('map').setView([-24.10508, -46.650696], 15);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        minZoom: 1,
        maxZoom: 19
      }).addTo(map);

      const url = 'coordenadas.php';

      fetch(url)
        .then(response => response.json())
        .then(result => {
          result.forEach(function(retorno) {
            var latLng = L.latLng([retorno.latitude, retorno.longitude]);
            var markerGroup = L.featureGroup([]).addTo(map);
            L.marker(latLng).bindPopup('Nome: ' + retorno.nome +
              '<br>Endereço: ' + retorno.ponto_referencia +
              '<br>Data: ' + retorno.data_hora).addTo(markerGroup).addTo(map);
          });
        })
        .catch(function(err) {
          console.error(err);
        });
    </script>
</body>
</html>
