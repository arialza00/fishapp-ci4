<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fishAPP</title>

    <style>
        #map {
            height: 100vh;
            width: 100vw;
        }

        .custom {
            position: absolute;
            right: 10px;
            z-index: 999999;
        }

        .btn-width-fixed {
            width: 110px;
        }

        .custom1 {
            position: absolute;
            z-index: 999999;
            right: 130px;
            top: 10px;
            width: 95px;
            border-radius: 5px;
            text-align: center;
            background-color: beige;
        }

        .custom2 {
            position: absolute;
            z-index: 999999;
            left: 5px;
            bottom: 5px;
            width: 130px;
            border-radius: 5px;
            text-align: center;
            background-color: beige;
            visibility: hidden;
        }

        .buttonModal {
            width: 250px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="map"></div>
    <div class="custom1" id="viewLiveTimelapse"></div>
    <div><button class="custom2" type="button" onClick="playPauseTimelapse()" id="timeLapseClock"></button></div>
    <div class="custom" style="top:10px;"><button type="button" onClick="showMenu()" class="btn btn-primary btn-xs btn-width-fixed">fishAPP</button></div>
    <div class="custom" style="top:40px;"><button type="button" id="buttonMAP" style="visibility:hidden;" class="btn btn-primary btn-xs active btn-width-fixed">MAP</button></div>
    <div class="custom" style="top:65px;"><button type="button" id="buttonData" style="visibility:hidden;" onclick="window.location.href='/Gateway';" class="btn btn-primary btn-xs btn-width-fixed">DATA</button></div>
    <div class="custom" style="top:95px;"><button type="button" id="buttonTimelapse" onClick="timeLapse()" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed" data-toggle="modal" data-target="#Modal">TIMELAPSE</button></div>
    <div class="custom" style="top:120px;"><button type="button" id="buttonLive" onClick="live()" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed">LIVE</button></div>
    <div class="custom" style="top:150px;"><button type="button" id="buttonZoomDefault" onClick="zoomTo(-2.45, 120, 5)" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed">FIT ZOOM</button></div>

    <div id="Modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" style="text-align:center; font-weight:bold;">TIMELAPSE SETTING</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="ex1">START DATE</label>
                            <input class="form-control" type="date" id="startDate">
                        </div>
                        <div class="col-xs-6">
                            <label for="ex2">START TIME</label>
                            <input class="form-control" type="time" id="startTime">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="ex1">END DATE</label>
                            <input class="form-control" type="date" id="endDate">
                        </div>
                        <div class="col-xs-6">
                            <label for="ex2">END TIME</label>
                            <input class="form-control" type="time" id="endTime">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>SHOW OPTIONS :</label>
                        <select class="form-control" id="selectOpt">
                            <option value="1">Fisherman Race, Fish Heaven, and High Wave</option>
                            <option value="2">Only Fish Heaven and High Wave</option>
                            <option value="3">Only Fish Heaven</option>
                            <option value="4">Only High Wave</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="button" onClick="loadTimeLapse()" data-dismiss="modal" class="btn btn-success">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tik = 80;
        const myInterval = setInterval(myTimer, tik);

        var startDateTimeInt;
        var endDateTimeInt;
        var currentDateTimeInt;
        var datetimeShow;
        var dataAllTL = [];
        var dataFisherman = [];
        var dataNameFisherman = [];
        var queryAJAXsuccess = 0;
        var polylineFisherman = [];
        var markerFisherman = [];
        var circleFisherman = [];
        var colorArr = ['purple', 'olive', 'navy', 'teal', 'fuchsia', 'lime', 'yellow', 'blue'];
        var pointerFishermanData = [];
        var releaseXYstat = [];
        var liveTimelapseStat = "live";
        var buttonPlayPauseStat = 0;
        var liveCountReset = 15; //update live setiap 15 detik sekali
        var liveCount = liveCountReset * (1000 / tik);
        var showOpt = "";
        var showOptTemp = 0;

        var map = L.map('map', {
            center: [-2.45, 120],
            zoom: 5,
        });

        var layerGrup = new L.LayerGroup().addTo(map);
        var timeLapseLayerGrup = new L.LayerGroup().addTo(map);
        var circleGrup = new L.LayerGroup().addTo(map);

        var towerIcon = L.icon({
            iconUrl: 'tower.png',

            iconSize: [32, 32], // size of the icon
            iconAnchor: [0, 32], // point of the icon which will correspond to marker's location
            popupAnchor: [16, -20] // point from which the popup should open relative to the iconAnchor
        });

        var boatIcon = L.icon({
            iconUrl: 'fishing-boat.png',

            iconSize: [24, 24], // size of the icon
            iconAnchor: [0, 24], // point of the icon which will correspond to marker's location
            popupAnchor: [12, -15] // point from which the popup should open relative to the iconAnchor
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        $(document).ready(function() {
            document.getElementById("viewLiveTimelapse").innerHTML = "LIVE";

            var layerGrupArray = [];
            <?php foreach ($dataGateway as $dataGateway) : ?>
                var marker<?= $dataGateway['id']; ?> = new L.marker([<?= $dataGateway['latitude']; ?>, <?= $dataGateway['longitude']; ?>], {
                    icon: towerIcon
                });
                marker<?= $dataGateway['id']; ?>.bindPopup("<p style='font-size:10px;'><?= $dataGateway['gateway_name']; ?></p><button type='button' onClick='zoomTo(<?= $dataGateway['latitude']; ?>, <?= $dataGateway['longitude']; ?>, 12)' class='btn btn-primary btn-xs btn-width-fixed'>zoom to</button>");
                layerGrup.addLayer(marker<?= $dataGateway['id']; ?>);
            <?php endforeach; ?>

            <?php foreach ($dataFisherman as $dataFisherman) : ?>
                dataFisherman.push("<?= $dataFisherman['fisherman_id']; ?>");
                dataNameFisherman.push("<?= $dataFisherman['fisherman_name']; ?>");
                pointerFishermanData.push(0);
                releaseXYstat.push(0);
            <?php endforeach; ?>

            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                var z = colorArr[a1 % colorArr.length];
                var j = L.polyline([], {
                    weight: 3,
                    opacity: 0.5
                });
                polylineFisherman.push(j);
                polylineFisherman[a1].addTo(timeLapseLayerGrup);

                polylineFisherman[a1].setStyle({
                    color: z
                });

                polylineFisherman[a1].on('mouseover', function(e) {
                    this.openPopup();
                });

                polylineFisherman[a1].on('mouseout', function(e) {
                    this.closePopup();
                });

                var k = L.marker([0, 0], { //bersambung
                    icon: boatIcon,
                    opacity: 0
                });
                markerFisherman.push(k);
                markerFisherman[a1].addTo(timeLapseLayerGrup);

                markerFisherman[a1].on('mouseover', function(e) {
                    this.openPopup();
                });

                markerFisherman[a1].on('mouseout', function(e) {
                    this.closePopup();
                });
            };
        });

        map.on('zoomstart', function(e) {
            map.removeLayer(timeLapseLayerGrup);
            map.removeLayer(circleGrup);
        });

        map.on('zoomend', function(e) {
            map.addLayer(timeLapseLayerGrup);
            map.addLayer(circleGrup);
        });

        function prepareTimelapse() {
            var startDateTimeTL = new Date(document.getElementById("startDate").value + " " + document.getElementById("startTime").value);
            var endDateTimeTL = new Date(document.getElementById("endDate").value + " " + document.getElementById("endTime").value);
            startDateTimeInt = startDateTimeTL.getTime();
            endDateTimeInt = endDateTimeTL.getTime();
            currentDateTimeInt = startDateTimeInt;

            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                pointerFishermanData[a1] = 0; //pointer id
                releaseXYstat[a1] = 0; //status data sudah masuk ke array latlong atau belum, 0 jika sudah, 1 jika belum.
                polylineFisherman[a1].setLatLngs([]);
                markerFisherman[a1].setOpacity(0);
                markerFisherman[a1].setLatLng([0, 0]);
            }
            circleGrup.clearLayers();
        }

        function collectDataTimelapse(item, a, b, c) {
            $.ajax({
                url: 'dataAll/dataFilterTimelapse',
                type: 'POST',
                data: {
                    startTimestamp: a,
                    endTimestamp: b,
                    showOptions: c,
                    fishermanId: item
                },
                success: function(response) {
                    dataAllTL.push(response);
                    queryAJAXsuccess++;
                }
            });
        }

        function loadTimeLapse() {
            document.getElementById("viewLiveTimelapse").innerHTML = "TIMELAPSE";
            liveTimelapseStat = "timelapse";
            document.getElementById("timeLapseClock").style.visibility = "visible";
            var startDateTimeTL = new Date(document.getElementById("startDate").value + " " + document.getElementById("startTime").value);
            var endDateTimeTL = new Date(document.getElementById("endDate").value + " " + document.getElementById("endTime").value);
            var a = startDateTimeTL.getTime() / 1000;
            var b = endDateTimeTL.getTime() / 1000;
            var c = document.getElementById("selectOpt").value;
            showOpt = c;

            dataAllTL.length = 0;
            queryAJAXsuccess = 0;

            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                collectDataTimelapse(dataFisherman[a1], a, b, c);
            }

            prepareTimelapse();
        }

        function showMenu() {
            if (document.getElementById("buttonMAP").style.visibility == "hidden") {
                document.getElementById("buttonMAP").style.visibility = "visible";
                document.getElementById("buttonData").style.visibility = "visible";
                document.getElementById("buttonTimelapse").style.visibility = "visible";
                document.getElementById("buttonLive").style.visibility = "visible";
                document.getElementById("buttonZoomDefault").style.visibility = "visible";
            } else {
                document.getElementById("buttonMAP").style.visibility = "hidden";
                document.getElementById("buttonData").style.visibility = "hidden";
                document.getElementById("buttonLive").style.visibility = "hidden";
                document.getElementById("buttonTimelapse").style.visibility = "hidden";
                document.getElementById("buttonZoomDefault").style.visibility = "hidden";
            }
        }

        function fillZero(x, y) {
            z = "";
            if (x.toString().length < y) {
                for (let a = 0; a < x.toString().length; a++) {
                    z = z + "0";
                }
            }
            z = z + x.toString();
            return z;
        }

        function timeLapse() {
            document.getElementById("buttonMAP").style.visibility = "hidden";
            document.getElementById("buttonData").style.visibility = "hidden";
            document.getElementById("buttonLive").style.visibility = "hidden";
            document.getElementById("buttonTimelapse").style.visibility = "hidden";
            document.getElementById("buttonZoomDefault").style.visibility = "hidden";
            var now = new Date();
            now.setDate(now.getDate() - 1);
            var pickDate = fillZero(now.getFullYear(), 4) + "-" + fillZero((parseInt(now.getMonth()) + 1).toString(), 2) + "-" + fillZero(now.getDate(), 2);
            document.getElementById("startDate").value = pickDate;
            now.setDate(now.getDate());
            pickDate = fillZero(now.getFullYear(), 4) + "-" + fillZero((parseInt(now.getMonth()) + 1).toString(), 2) + "-" + fillZero(now.getDate(), 2);
            document.getElementById("endDate").value = pickDate;
            document.getElementById("startTime").value = "04:00";
            document.getElementById("endTime").value = "22:00";
        }

        function live() {
            document.getElementById("viewLiveTimelapse").innerHTML = "LIVE";
            document.getElementById("buttonMAP").style.visibility = "hidden";
            document.getElementById("buttonData").style.visibility = "hidden";
            document.getElementById("buttonLive").style.visibility = "hidden";
            document.getElementById("buttonTimelapse").style.visibility = "hidden";
            document.getElementById("buttonZoomDefault").style.visibility = "hidden";
            document.getElementById("timeLapseClock").style.visibility = "hidden";
            liveTimelapseStat = "live";
            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                polylineFisherman[a1].setLatLngs([]);
                markerFisherman[a1].setOpacity(0);
                markerFisherman[a1].setLatLng([0, 0]);
            }
            circleGrup.clearLayers();
        }

        function zoomTo(x, y, z) {
            map.flyTo([x, y], z);
            document.getElementById("buttonMAP").style.visibility = "hidden";
            document.getElementById("buttonData").style.visibility = "hidden";
            document.getElementById("buttonLive").style.visibility = "hidden";
            document.getElementById("buttonTimelapse").style.visibility = "hidden";
            document.getElementById("buttonZoomDefault").style.visibility = "hidden";
        }

        function intToDatetime(x) {
            var y = new Date(x);
            return y;
        }

        function playPauseTimelapse() {
            if (buttonPlayPauseStat == 1) {
                buttonPlayPauseStat = 2;
            } else if (buttonPlayPauseStat == 3) {
                buttonPlayPauseStat = 4;
            } else if (buttonPlayPauseStat == 4) {
                buttonPlayPauseStat = 3;
            }
        }

        function myTimer() {
            if (liveTimelapseStat == "timelapse" & showOpt == "1") {
                if (queryAJAXsuccess < dataFisherman.length) {
                    document.getElementById("timeLapseClock").innerHTML = "loading data...";
                    buttonPlayPauseStat = 0;
                    document.getElementById("timeLapseClock").style.backgroundColor = "beige";
                    document.getElementById("timeLapseClock").style.color = "black";
                } else {
                    var a, b, c, d, e, f, x, y, z, zz;
                    if (buttonPlayPauseStat == 0) {
                        circleFisherman = [];
                        for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                            for (var b1 = 0; b1 < dataAllTL[a1].result.length; b1++) {
                                x = dataAllTL[a1].result[b1].latitude;
                                y = dataAllTL[a1].result[b1].longitude;
                                z = new Date(parseInt(dataAllTL[a1].result[b1].timestamp) * 1000);
                                polylineFisherman[a1].addLatLng([Number(x), Number(y)]);
                                if (dataAllTL[a1].result[b1].stat == "1") {
                                    var j = L.circle([Number(x), Number(y)], {
                                        weight: 1,
                                        radius: 200,
                                        color: "green",
                                        opacity: 0.8,
                                        fillColor: "green",
                                        fillOpacity: 0.2
                                    });
                                    circleFisherman.push(j);
                                    circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                    circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>fish heaven</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                        "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                            closeButton: false
                                        });

                                    circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                        this.openPopup();
                                    });

                                    circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                        this.closePopup();
                                    });
                                } else if (dataAllTL[a1].result[b1].stat == "2") {
                                    var j = L.circle([Number(x), Number(y)], {
                                        weight: 1,
                                        radius: 200,
                                        color: "red",
                                        opacity: 0.8,
                                        fillColor: "red",
                                        fillOpacity: 0.2
                                    });
                                    circleFisherman.push(j);
                                    circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                    circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>high wave</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                        "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                            closeButton: false
                                        });

                                    circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                        this.openPopup();
                                    });

                                    circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                        this.closePopup();
                                    });
                                }
                            }

                            if (dataAllTL[a1].result.length > 0) {
                                z = new Date(parseInt(dataAllTL[a1].result[0].timestamp) * 1000);
                                zz = new Date(parseInt(dataAllTL[a1].result[dataAllTL[a1].result.length - 1].timestamp) * 1000);
                                polylineFisherman[a1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>fisherman race</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                    "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + " =><br>" +
                                    zz.toString().slice(0, 33) + "</p>", {
                                        closeButton: false
                                    });
                                markerFisherman[a1].bindPopup("<p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                    "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + " =><br>" +
                                    zz.toString().slice(0, 33) + "</p>", {
                                        closeButton: false
                                    });
                            }
                        }
                        buttonPlayPauseStat = 1;
                        document.getElementById("timeLapseClock").innerHTML = "PLAY";
                        document.getElementById("timeLapseClock").style.backgroundColor = "maroon";
                        document.getElementById("timeLapseClock").style.color = "white";
                    } else if (buttonPlayPauseStat == 2) {
                        for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                            pointerFishermanData[a1] = 0; //pointer id
                            releaseXYstat[a1] = 0; //status data sudah masuk ke array latlong atau belum, 0 jika sudah, 1 jika belum.
                            polylineFisherman[a1].setLatLngs([]);
                            markerFisherman[a1].setOpacity(0);
                            markerFisherman[a1].setLatLng([0, 0]);
                        }
                        circleGrup.clearLayers();
                        buttonPlayPauseStat = 3;
                    } else if (buttonPlayPauseStat == 3) {
                        document.getElementById("timeLapseClock").style.backgroundColor = "beige";
                        document.getElementById("timeLapseClock").style.color = "black";
                        if (currentDateTimeInt < endDateTimeInt) {
                            currentDateTimeInt = currentDateTimeInt + 60000;
                            datetimeShow = intToDatetime(currentDateTimeInt);
                            document.getElementById("timeLapseClock").innerHTML = fillZero(datetimeShow.getDate(), 2) + "-" + fillZero((parseInt(datetimeShow.getMonth()) + 1).toString(), 2) + "-" + fillZero(datetimeShow.getFullYear(), 4) + " " + fillZero(datetimeShow.getHours(), 2) + ":" + fillZero(datetimeShow.getMinutes(), 2);
                            for (a = 0; a < dataFisherman.length; a++) { //for loop setiap fisherman
                                if (dataAllTL[a].result.length >= pointerFishermanData[a] + 1) {
                                    b = 0;
                                    while (b == 0 & dataAllTL[a].result.length >= pointerFishermanData[a] + 1) {
                                        e = new Date(parseInt(dataAllTL[a].result[pointerFishermanData[a]].timestamp) * 1000);
                                        f = e.getTime();
                                        if (f > currentDateTimeInt) { //jika datetime dari dataAll dengan urutan ke g[a] masih lebih kecil dari currentdatetime, 
                                            //g[a] ditambah 1 dan while loop kan lagi.
                                            b = 1;
                                        } else {
                                            releaseXYstat[a] = 1;
                                            x = dataAllTL[a].result[pointerFishermanData[a]].latitude;
                                            y = dataAllTL[a].result[pointerFishermanData[a]].longitude;

                                            if (dataAllTL[a].result[pointerFishermanData[a]].stat == "1") {
                                                var j = L.circle([Number(x), Number(y)], {
                                                    weight: 1,
                                                    radius: 200,
                                                    color: "green",
                                                    opacity: 0.8,
                                                    fillColor: "green",
                                                    fillOpacity: 0.2
                                                });
                                                circleFisherman.push(j);
                                                circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                                circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>fish heaven</p><p style='font-size:10px;'>" + dataNameFisherman[a] + " (" + dataFisherman[a] + ")</p>" +
                                                    "<p style='font-size:10px;'>" + e.toString().slice(0, 33) + "</p>", {
                                                        closeButton: false
                                                    });

                                                circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                                    this.openPopup();
                                                });

                                                circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                                    this.closePopup();
                                                });
                                            } else if (dataAllTL[a].result[pointerFishermanData[a]].stat == "2") {
                                                var j = L.circle([Number(x), Number(y)], {
                                                    weight: 1,
                                                    radius: 200,
                                                    color: "red",
                                                    opacity: 0.8,
                                                    fillColor: "red",
                                                    fillOpacity: 0.2
                                                });
                                                circleFisherman.push(j);
                                                circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                                circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>high wave</p><p style='font-size:10px;'>" + dataNameFisherman[a] + " (" + dataFisherman[a] + ")</p>" +
                                                    "<p style='font-size:10px;'>" + e.toString().slice(0, 33) + "</p>", {
                                                        closeButton: false
                                                    });

                                                circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                                    this.openPopup();
                                                });

                                                circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                                    this.closePopup();
                                                });
                                            }

                                            pointerFishermanData[a]++;
                                        }
                                    }
                                    if (releaseXYstat[a] == 1) {
                                        releaseXYstat[a] = 0;
                                        polylineFisherman[a].addLatLng([Number(x), Number(y)]);
                                        markerFisherman[a].setOpacity(1);
                                        markerFisherman[a].setLatLng([Number(x), Number(y)]);
                                    }
                                }
                            }
                        } else {
                            datetimeShow = intToDatetime(endDateTimeInt);
                            document.getElementById("timeLapseClock").innerHTML = fillZero(datetimeShow.getDate(), 2) + "-" + fillZero((parseInt(datetimeShow.getMonth()) + 1).toString(), 2) + "-" + fillZero(datetimeShow.getFullYear(), 4) + " " + fillZero(datetimeShow.getHours(), 2) + ":" + fillZero(datetimeShow.getMinutes(), 2);
                        }
                    } else if (buttonPlayPauseStat == 4) {
                        document.getElementById("timeLapseClock").style.backgroundColor = "maroon";
                        document.getElementById("timeLapseClock").style.color = "white";
                    }
                }
            } else if (liveTimelapseStat == "timelapse" & showOpt != "1") {
                if (queryAJAXsuccess < dataFisherman.length) {
                    document.getElementById("timeLapseClock").innerHTML = "loading data...";
                    buttonPlayPauseStat = 0;
                    document.getElementById("timeLapseClock").style.backgroundColor = "beige";
                    document.getElementById("timeLapseClock").style.color = "black";
                    showOptTemp = 0;
                } else if (showOptTemp == 0) {
                    showOptTemp = 1;
                    var a, b, c, d, e, f, x, y, z, zz;
                    circleFisherman = [];
                    for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                        for (var b1 = 0; b1 < dataAllTL[a1].result.length; b1++) {
                            x = dataAllTL[a1].result[b1].latitude;
                            y = dataAllTL[a1].result[b1].longitude;
                            z = new Date(parseInt(dataAllTL[a1].result[b1].timestamp) * 1000);
                            if (dataAllTL[a1].result[b1].stat == "1") {
                                var j = L.circle([Number(x), Number(y)], {
                                    weight: 1,
                                    radius: 200,
                                    color: "green",
                                    opacity: 0.8,
                                    fillColor: "green",
                                    fillOpacity: 0.2
                                });
                                circleFisherman.push(j);
                                circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>fish heaven</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                    "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                        closeButton: false
                                    });

                                circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                    this.openPopup();
                                });

                                circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                    this.closePopup();
                                });
                            } else if (dataAllTL[a1].result[b1].stat == "2") {
                                var j = L.circle([Number(x), Number(y)], {
                                    weight: 1,
                                    radius: 200,
                                    color: "red",
                                    opacity: 0.8,
                                    fillColor: "red",
                                    fillOpacity: 0.2
                                });
                                circleFisherman.push(j);
                                circleFisherman[circleFisherman.length - 1].addTo(circleGrup);

                                circleFisherman[circleFisherman.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>high wave</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                    "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                        closeButton: false
                                    });

                                circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                    this.openPopup();
                                });

                                circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                    this.closePopup();
                                });
                            }
                        }
                    }
                    buttonPlayPauseStat = 1;
                    document.getElementById("timeLapseClock").innerHTML = "DATA READY";
                    document.getElementById("timeLapseClock").style.backgroundColor = "maroon";
                    document.getElementById("timeLapseClock").style.color = "white";
                }
            } else if (liveTimelapseStat == "live") {
                liveCount++;
                if (liveCount >= liveCountReset * (1000 / tik)) {
                    liveCount = 0;
                }
            }
        }
    </script>
</body>

</html>