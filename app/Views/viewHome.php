<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fishAPP</title>

    <style>
        #map {
            height: 95vh;
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
            right: 300px;
            top: 12px;
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

        .custom3 {
            position: absolute;
            z-index: 999999;
            right: 130px;
            top: 10px;
            text-align: center;
        }

        .buttonModal {
            width: 250px;
        }

        .btn:focus,
        .btn:active {
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

    <link rel="stylesheet" href="<?php echo base_url('css/leaflet.legend.css'); ?>" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="<?php echo base_url('js/leaflet.legend.js'); ?>"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="map"></div>
    <div class="custom1" id="viewLiveTimelapse"></div>
    <div class="custom3"><button type="button" class="btn btn-xs btn-warning" onClick="changeMarkStat()" id="viewMarkingStat"></button></div>
    <div><button class="custom2" type="button" onClick="playPauseTimelapse()" id="timeLapseClock"></button></div>
    <div class="custom" style="top:10px;"><button type="button" onClick="showMenu()" class="btn btn-primary btn-xs btn-width-fixed">fishAPP</button></div>
    <div class="custom" style="top:40px;"><button type="button" id="buttonMAP" style="visibility:hidden;" class="btn btn-primary btn-xs active btn-width-fixed">MAP</button></div>
    <div class="custom" style="top:65px;"><button type="button" id="buttonData" style="visibility:hidden;" onclick="window.location.href='/Gateway';" class="btn btn-primary btn-xs btn-width-fixed">DATA</button></div>
    <div class="custom" style="top:95px;"><button type="button" id="buttonTimelapse" onClick="timeLapse()" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed" data-toggle="modal" data-target="#Modal">TIMELAPSE</button></div>
    <div class="custom" style="top:120px;"><button type="button" id="buttonLive" onClick="live()" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed">LIVE</button></div>
    <div class="custom" style="top:150px;"><button type="button" id="buttonZoomDefault" onClick="zoomTo(-2.45, 120, 5)" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed">FIT ZOOM</button></div>

    <div id="ModalMark" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" style="text-align:center; font-weight:bold;">PENGATURAN MARK INFO</h1>
                </div>
                <div class="modal-body">
                    <div class="error-message" style="color: red;"></div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="ex1">TANGGAL MULAI</label>
                            <input class="form-control" type="datetime-local" id="startDateMark">
                        </div>
                        <div class="col-xs-6">
                            <label for="ex2">TANGGAL BERAKHIR</label>
                            <input class="form-control" type="datetime-local" id="endDateMark">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="ex1">LINTANG</label>
                            <input class="form-control" id="latitudeMark" type="number">
                        </div>
                        <div class="col-xs-6">
                            <label for="ex2">BUJUR</label>
                            <input class="form-control" id="longitudeMark" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <label for="ex1">RADIUS (KM)</label>
                            <input class="form-control" type="number" id="radiusMark">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>STATUS :</label>
                        <select class="form-control" id="statMark">
                            <option value="1">Persebaran Ikan Tinggi</option>
                            <option value="2">Persebaran Ikan Rendah</option>
                            <option value="3">Gelombang Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="button" onClick="createMark()" class="btn btn-success">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tik = 80;
        var myInterval = setTimeout(myTimer, tik);
        var markStat = 0;
        var defaultMarkExpiredTime = 6;
        var defaultMarkRadius = 1;

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
        var markerFishermanLive = [];
        var circleFishermanLive = [];
        var colorArr = ['purple', 'olive', 'navy', 'teal', 'fuchsia', 'lime', 'yellow', 'blue'];
        var pointerFishermanData = [];
        var releaseXYstat = [];
        var liveTimelapseStat = "live";
        var buttonPlayPauseStat = 0;
        var liveCountReset = 5000;
        var showOpt = "";
        var showOptTemp = 0;
        var lastIdRecLive = 0;
        var markerOnMouseDown = false;

        var map = L.map('map', {
            center: [-2.45, 120],
            zoom: 5,
        });
        var layerGrup = new L.LayerGroup().addTo(map);
        var timeLapseLayerGrup = new L.LayerGroup().addTo(map);
        var circleGrup = new L.LayerGroup().addTo(map);
        var liveLayerGrup = new L.LayerGroup().addTo(map);
        var circleLiveGrup = new L.LayerGroup().addTo(map);
        var markerInfoGroup = new L.LayerGroup().addTo(map);
        var markerCircleGroup = new L.LayerGroup().addTo(map);

        var towerIcon = L.icon({
            iconUrl: 'tower.png',

            iconSize: [20, 20], // size of the icon
            iconAnchor: [0, 20], // point of the icon which will correspond to marker's location
            popupAnchor: [8, -12] // point from which the popup should open relative to the iconAnchor
        });

        var locationBlueIcon = L.icon({
            iconUrl: 'fish.png',

            iconSize: [16, 16], // size of the icon
            iconAnchor: [8, 16], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -16] // point from which the popup should open relative to the iconAnchor
        });

        var locationGreyIcon = L.icon({
            iconUrl: 'fish_grey.png',

            iconSize: [16, 16], // size of the icon
            iconAnchor: [8, 16], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -16] // point from which the popup should open relative to the iconAnchor
        });

        var locationRedIcon = L.icon({
            iconUrl: 'wave.png',

            iconSize: [16, 16], // size of the icon
            iconAnchor: [8, 16], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -16] // point from which the popup should open relative to the iconAnchor
        });

        var boatIcon = L.icon({
            iconUrl: 'fishing-boat.png',

            iconSize: [16, 16], // size of the icon
            iconAnchor: [0, 16], // point of the icon which will correspond to marker's location
            popupAnchor: [8, -10] // point from which the popup should open relative to the iconAnchor
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        $(document).ready(function() {
            document.getElementById("viewLiveTimelapse").innerHTML = "LIVE";
            document.getElementById("timeLapseClock").style.visibility = "visible";
            document.getElementById("viewMarkingStat").innerHTML = "DISABLE ADD MARK INFO";

            var layerGrupArray = [];
            <?php foreach ($dataGateway as $dataGateway) : ?>
                <?php if ($dataGateway['delete_stat'] == 0) : ?>
                    var marker<?= $dataGateway['id']; ?> = new L.marker([<?= $dataGateway['latitude']; ?>, <?= $dataGateway['longitude']; ?>], {
                        icon: towerIcon,
                    });
                    marker<?= $dataGateway['id']; ?>.bindPopup("<p style='font-size:10px;'><?= $dataGateway['gateway_name']; ?></p><button type='button' onClick='zoomTo(<?= $dataGateway['latitude']; ?>, <?= $dataGateway['longitude']; ?>, 12)' class='btn btn-primary btn-xs btn-width-fixed'>zoom to</button>", {
                        closeButton: false
                    });
                    layerGrup.addLayer(marker<?= $dataGateway['id']; ?>);
                <?php endif; ?>
            <?php endforeach; ?>

            <?php foreach ($dataFisherman as $dataFisherman) : ?>
                <?php if ($dataFisherman['delete_stat'] == 0) : ?>
                    dataFisherman.push("<?= $dataFisherman['fisherman_id']; ?>");
                    dataNameFisherman.push("<?= $dataFisherman['fisherman_name']; ?>");
                    pointerFishermanData.push(0);
                    releaseXYstat.push(0);
                <?php endif; ?>
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

                markerFishermanLive.push(k);
                markerFishermanLive[a1].addTo(liveLayerGrup);

                markerFisherman[a1].on('mouseover', function(e) {
                    this.openPopup();
                });

                markerFisherman[a1].on('mouseout', function(e) {
                    this.closePopup();
                });

                markerFishermanLive[a1].on('mouseover', function(e) {
                    this.openPopup();
                });

                markerFishermanLive[a1].on('mouseout', function(e) {
                    this.closePopup();
                });
            };

        });

        map.on('zoomstart', function(e) {
            map.removeLayer(timeLapseLayerGrup);
            map.removeLayer(circleGrup);
            if (liveTimelapseStat == "live") {
                map.removeLayer(liveLayerGrup);
                map.removeLayer(circleLiveGrup);
            }
        });

        map.on('zoomend', function(e) {
            map.addLayer(timeLapseLayerGrup);
            map.addLayer(circleGrup);
            if (liveTimelapseStat == "live") {
                map.addLayer(liveLayerGrup);
                map.addLayer(circleLiveGrup);
            }
        });

        map.on('mousedown', function(e) {
            if (markStat && !markerOnMouseDown) {
                // marker = L.marker(e.latlng).addTo(map);
                // marker.bindPopup("Marker created!").openPopup();
                document.getElementById("latitudeMark").value = e.latlng.lat;
                document.getElementById("longitudeMark").value = e.latlng.lng;
                var now = new Date();
                var moreHourLater = new Date(now);
                moreHourLater.setHours(now.getHours() + defaultMarkExpiredTime);
                var pickDate = fillZero(now.getFullYear(), 4) + "-" + fillZero((parseInt(now.getMonth()) + 1).toString(), 2) + "-" + fillZero(now.getDate(), 2);
                var pickTime = fillZero(now.getHours(), 2) + ":" + fillZero(now.getMinutes(), 2);
                document.getElementById("startDateMark").value = pickDate + " " + pickTime;
                pickDate = fillZero(moreHourLater.getFullYear(), 4) + "-" + fillZero((parseInt(moreHourLater.getMonth()) + 1).toString(), 2) + "-" + fillZero(moreHourLater.getDate(), 2);
                var pickTime = fillZero(moreHourLater.getHours(), 2) + ":" + fillZero(moreHourLater.getMinutes(), 2);
                document.getElementById("endDateMark").value = pickDate + " " + pickTime;
                $('#ModalMark').modal('show');
            } else {
                markerOnMouseDown = false;
            }
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

        function loadMark() {
            $.ajax({
                url: "infoData",
                type: "GET",
                success: function(response) {
                    markerInfoGroup.clearLayers();
                    markerCircleGroup.clearLayers();

                    if (response.data.length > 0) {
                        for (const data of response.data) {
                            if (data.delete_stat === "0") {
                                var endDate = new Date(data.finish_time);
                                var startDate = new Date(data.start_time);
                                var nowDate = new Date();
                                let textEndDate = endDate.toString();
                                let textStartDate = startDate.toString();
                                let textNowDate = nowDate.toString();
                                if (data.stat === "1") {
                                    customIcon = locationBlueIcon;
                                    text = "Pesebaran Ikan Tinggi";
                                } else if (data.stat === "2") {
                                    customIcon = locationGreyIcon;
                                    text = "Pesebaran Ikan Rendah";
                                } else {
                                    customIcon = locationRedIcon;
                                    text = "Gelombang Tinggi";
                                }
                                var marker = new L.marker([data.latitude, data.longitude], {
                                        icon: customIcon,
                                    })
                                    .on("mousedown", function(e) {
                                        markerOnMouseDown = true;
                                    })
                                    .bindPopup(
                                        "<p style='font-size:10px;'>" + text +
                                        (nowDate.getTime() < Number(data.start_time) * 1000 ?
                                            "</p style='font-size:9px;'>start time " + textStartDate + "</p>" : "") +
                                        "</p style='font-size:9px;'>end time " + textEndDate + "</p>" +
                                        "</p style='font-size:9px;'>radius " + data.radius + " km</p>" +
                                        "<button type='button' onclick='zoomTo(" + data.latitude + "," + data.longitude + ", 12)' class='btn btn-primary btn-xs btn-width-fixed'>zoom to</button><br><br>" +
                                        "<button type='button' onclick='removeMarkerInfo(" + data.id + ")' class='btn btn-danger btn-xs btn-width-fixed'>delete this</button>", {
                                            closeButton: true,
                                        },
                                    )
                                var circle = new L.circle([data.latitude, data.longitude], {
                                    weight: 1,
                                    radius: data.radius * 1000,
                                    color: nowDate.getTime() < Number(data.start_time) * 1000 ? "grey" : data.stat === "1" ? "blue" : "red",
                                    opacity: 0.4,
                                    fillColor: nowDate.getTime() < Number(data.start_time) * 1000 ? "grey" : data.stat === "1" ? "blue" : "red",
                                    fillOpacity: 0.1,
                                });

                                markerInfoGroup.addLayer(marker);
                                markerCircleGroup.addLayer(circle);

                            }
                        }
                    }
                }
            });
        }

        function padTwoDigits(num) {
            return num.toString().padStart(2, "0");
        }

        function dateInYyyyMmDdHhMmSs(date, dateDiveder = "-") {
            // :::: Exmple Usage ::::
            // The function takes a Date object as a parameter and formats the date as YYYY-MM-DD hh:mm:ss.
            // 👇️ 2023-04-11 16:21:23 (yyyy-mm-dd hh:mm:ss)
            //console.log(dateInYyyyMmDdHhMmSs(new Date()));

            //  👇️️ 2025-05-04 05:24:07 (yyyy-mm-dd hh:mm:ss)
            // console.log(dateInYyyyMmDdHhMmSs(new Date('May 04, 2025 05:24:07')));
            // Date divider
            // 👇️ 01/04/2023 10:20:07 (MM/DD/YYYY hh:mm:ss)
            // console.log(dateInYyyyMmDdHhMmSs(new Date(), "/"));
            return (
                [
                    date.getFullYear(),
                    padTwoDigits(date.getMonth() + 1),
                    padTwoDigits(date.getDate()),
                ].join(dateDiveder) +
                " " + [
                    padTwoDigits(date.getHours()),
                    padTwoDigits(date.getMinutes()),
                    padTwoDigits(date.getSeconds()),
                ].join(":")
            );
        }

        function createMark() {
            var startDate = document.getElementById("startDateMark").value;
            var endDate = document.getElementById("endDateMark").value;
            var latitude = document.getElementById("latitudeMark").value;
            var longitude = document.getElementById("longitudeMark").value;
            var radius = document.getElementById("radiusMark").value;
            var stat = document.getElementById("statMark").value;

            var startObject = Date.parse("startDate");
            var startTimestamp = startObject;
            var endObject = Date.parse("endDate");
            var endTimestamp = endObject;
            var now = Date.parse();
            var nowTimeStamp = now(getTime());

            if (endObject < startObject || endObject < nowTimeStamp) {
                const errorMessage = document.querySelector('.error-message');
                errorMessage.textContent = 'kesalahan dalam input tanggal dan waktu, silahkan coba lagi.';
                return;
            }

            $.ajax({
                url: "InfoData/infoDataSave",
                type: "POST",
                data: {
                    startDate: startTimestamp,
                    endDate: endTimestamp,
                    latitude: latitude,
                    longitude: longitude,
                    stat: stat,
                    method: "add"
                },
                success: function(response) {
                    loadMark();
                    zoomTo(latitude, longitude, 12);
                    $('#ModalMark').modal('hide');
                }
            });
        }

        function removeMarkerInfo(index) {
            $.ajax({
                url: "InfoData/infoDataSave",
                type: "POST",
                data: {
                    id: index,
                    method: "delete",
                },
                success: function(response) {
                    loadMark();
                }
            });
        }

        function collectDataTimelapse(item, a, b, c) {
            $.ajax({
                url: "DataAll/dataFilterTimelapse",
                type: "POST",
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

        function collectDataLive(a, b, c) {
            $.ajax({
                url: "DataAll/dataFilterLive",
                type: "POST",
                data: {
                    startTimestamp: a,
                    endTimestamp: b,
                    lastId: c
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
            markStat = 0;
            document.getElementById("viewMarkingStat").innerHTML = "DISABLE ADD MARK INFO";
            if (document.getElementById("viewMarkingStat").classList.contains("btn-info")) {
                document.getElementById("viewMarkingStat").classList.remove("btn-info");
                document.getElementById("viewMarkingStat").classList.add("btn-warning");
            }
            document.getElementById("timeLapseClock").style.visibility = "visible";
            var startDateTimeTL = new Date(document.getElementById("startDate").value + " " + document.getElementById("startTime").value);
            var endDateTimeTL = new Date(document.getElementById("endDate").value + " " + document.getElementById("endTime").value);
            var a = startDateTimeTL.getTime() / 1000;
            var b = endDateTimeTL.getTime() / 1000;
            var c = document.getElementById("selectOpt").value;
            showOpt = c;

            dataAllTL = [];
            queryAJAXsuccess = 0;

            map.removeLayer(liveLayerGrup);
            map.removeLayer(circleLiveGrup);

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
            document.getElementById("timeLapseClock").style.visibility = "visible";
            liveTimelapseStat = "live";
            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                polylineFisherman[a1].setLatLngs([]);
                markerFisherman[a1].setOpacity(0);
                markerFisherman[a1].setLatLng([0, 0]);
            }
            circleGrup.clearLayers();
            map.addLayer(liveLayerGrup);
            map.addLayer(circleLiveGrup);

            dataAllTL = [];
            queryAJAXsuccess = 0;
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

        function changeMarkStat() {
            var element = document.getElementById("viewMarkingStat");
            if (markStat === 0 && liveTimelapseStat === "live") {
                markStat = 1;
                element.innerHTML = "ENABLE ADD MARK INFO";

                if (element.classList.contains("btn-warning")) {
                    element.classList.remove("btn-warning");
                    element.classList.add("btn-info");
                }
            } else {
                markStat = 0;
                element.innerHTML = "DISABLE ADD MARK INFO";
                if (element.classList.contains("btn-info")) {
                    element.classList.remove("btn-info");
                    element.classList.add("btn-warning");
                }
            }
        }

        function myTimer() {
            if (liveTimelapseStat == "live") {
                document.getElementById("timeLapseClock").style.backgroundColor = "beige";
                document.getElementById("timeLapseClock").style.color = "black";
                datetimeShow = new Date();
                document.getElementById("timeLapseClock").innerHTML = fillZero(datetimeShow.getDate(), 2) + "-" + fillZero((parseInt(datetimeShow.getMonth()) + 1).toString(), 2) + "-" + fillZero(datetimeShow.getFullYear(), 4) + " " + fillZero(datetimeShow.getHours(), 2) + ":" + fillZero(datetimeShow.getMinutes(), 2);
                if (queryAJAXsuccess == 0) {
                    queryAJAXsuccess = 1;
                    var nowDate = new Date();
                    var b = parseInt(nowDate.getTime() / 1000);
                    var a = b - 60;
                    var c = lastIdRecLive;
                    var x;
                    var y;
                    var z;

                    collectDataLive(a, b, c);
                    loadMark();
                } else if (queryAJAXsuccess >= 2) {
                    if (dataAllTL[0].result.length > 0) {
                        lastIdRecLive = dataAllTL[0].result[dataAllTL[0].result.length - 1].id;

                        for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                            for (var a2 = 0; a2 < dataAllTL[0].result.length; a2++) {
                                if (dataFisherman[a1] == dataAllTL[0].result[a2].fisherman_id) {
                                    x = dataAllTL[0].result[a2].latitude;
                                    y = dataAllTL[0].result[a2].longitude;
                                    z = new Date(parseInt(dataAllTL[0].result[a2].timestamp) * 1000);
                                    markerFishermanLive[a1].setOpacity(1);
                                    markerFishermanLive[a1].setLatLng([Number(x), Number(y)]);
                                    markerFishermanLive[a1].bindPopup("<p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                        "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y + "<br>" +
                                        "last update : " + z.toString().slice(0, 33) + "</p>", {
                                            closeButton: false
                                        });

                                    if (dataAllTL[0].result[a2].stat == "1") {
                                        var j = L.circle([Number(x), Number(y)], {
                                            weight: 1,
                                            radius: 200,
                                            color: "green",
                                            opacity: 0.8,
                                            fillColor: "green",
                                            fillOpacity: 0.2
                                        });
                                        circleFishermanLive.push(j);
                                        circleFishermanLive[circleFishermanLive.length - 1].addTo(circleLiveGrup);

                                        circleFishermanLive[circleFishermanLive.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>fish heaven</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                            "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y + "<br>" + z.toString().slice(0, 33) + "</p>", {
                                                closeButton: false
                                            });

                                        circleFishermanLive[circleFishermanLive.length - 1].on('mouseover', function(e) {
                                            this.openPopup();
                                        });

                                        circleFishermanLive[circleFishermanLive.length - 1].on('mouseout', function(e) {
                                            this.closePopup();
                                        });
                                    } else if (dataAllTL[0].result[a2].stat == "2") {
                                        var j = L.circle([Number(x), Number(y)], {
                                            weight: 1,
                                            radius: 200,
                                            color: "red",
                                            opacity: 0.8,
                                            fillColor: "red",
                                            fillOpacity: 0.2
                                        });
                                        circleFishermanLive.push(j);
                                        circleFishermanLive[circleFishermanLive.length - 1].addTo(circleLiveGrup);

                                        circleFishermanLive[circleFishermanLive.length - 1].bindPopup("<p style='font-size:10px; color:white; background-color:black; text-align:center;'>high wave</p><p style='font-size:10px;'>" + dataNameFisherman[a1] + " (" + dataFisherman[a1] + ")</p>" +
                                            "<p style='font-size:10px;'>" + "latitude " + x + "<br>" + "longitude " + y + "<br>" + z.toString().slice(0, 33) + "</p>", {
                                                closeButton: false
                                            });

                                        circleFishermanLive[circleFishermanLive.length - 1].on('mouseover', function(e) {
                                            this.openPopup();
                                        });

                                        circleFishermanLive[circleFishermanLive.length - 1].on('mouseout', function(e) {
                                            this.closePopup();
                                        });
                                    }
                                }
                            }
                        }

                    }
                    dataAllTL = [];
                    queryAJAXsuccess = 0;
                }

                myInterval = setTimeout(myTimer, liveCountReset);
            } else {
                markerInfoGroup.clearLayers();
                markerCircleGroup.clearLayers();

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
                            var a3 = -1;
                            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                                for (var a2 = 0; a2 < dataAllTL.length; a2++) {
                                    if (dataAllTL[a2].hasOwnProperty("fishermanId")) {
                                        if (dataFisherman[a1] == dataAllTL[a2].fishermanId) {
                                            a3 = a2;
                                            break;
                                        }
                                    }
                                }
                                if (a3 != -1) {
                                    for (var b1 = 0; b1 < dataAllTL[a3].result.length; b1++) {
                                        x = dataAllTL[a3].result[b1].latitude;
                                        y = dataAllTL[a3].result[b1].longitude;
                                        lat_gateway = dataAllTL[a3].GatewayLat;
                                        long_gateway = dataAllTL[a3].GatewayLong;

                                        lat1 = x;
                                        lat2 = lat_gateway;
                                        lon1 = y;
                                        lon2 = long_gateway;

                                        // haversine
                                        let R = 6371e3; // metres
                                        let pi1 = lat1 * Math.PI / 180; // φ, λ in radians
                                        let pi2 = lat2 * Math.PI / 180;
                                        let delta_pi = (lat2 - lat1) * Math.PI / 180;
                                        let delta_lambda = (lon2 - lon1) * Math.PI / 180;

                                        let a = Math.sin(delta_pi / 2) * Math.sin(delta_pi / 2) +
                                            Math.cos(pi1) * Math.cos(pi2) *
                                            Math.sin(delta_lambda / 2) * Math.sin(delta_lambda / 2);
                                        let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                                        let d = R * c

                                        z = new Date(parseInt(dataAllTL[a3].result[b1].timestamp) * 1000);
                                        polylineFisherman[a1].addLatLng([Number(x), Number(y)]);
                                        if (dataAllTL[a3].result[b1].stat == "1") {
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
                                                "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
                                                "<br>jarak dengan gateway : " + (d / 1000.0).toFixed(4) + " Km<br>" +
                                                "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                                    closeButton: false
                                                });

                                            circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                                this.openPopup();
                                            });

                                            circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                                this.closePopup();
                                            });
                                        } else if (dataAllTL[a3].result[b1].stat == "2") {
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
                                                "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
                                                "<br>jarak dengan gateway : " + (d / 1000.0).toFixed(4) + " Km<br>" +
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

                                    if (dataAllTL[a3].result.length > 0) {
                                        z = new Date(parseInt(dataAllTL[a3].result[0].timestamp) * 1000);
                                        zz = new Date(parseInt(dataAllTL[a3].result[dataAllTL[a3].result.length - 1].timestamp) * 1000);
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
                            }
                            buttonPlayPauseStat = 1;
                            document.getElementById("timeLapseClock").innerHTML = "PLAY";
                            document.getElementById("timeLapseClock").style.backgroundColor = "maroon";
                            document.getElementById("timeLapseClock").style.color = "white";
                        } else if (buttonPlayPauseStat == 2) {
                            map.removeLayer(timeLapseLayerGrup);
                            for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                                pointerFishermanData[a1] = 0; //pointer id
                                releaseXYstat[a1] = 0; //status data sudah masuk ke array latlong atau belum, 0 jika sudah, 1 jika belum.
                                polylineFisherman[a1].setLatLngs([]);
                                markerFisherman[a1].setOpacity(0);
                                markerFisherman[a1].setLatLng([0, 0]);
                            }
                            circleGrup.clearLayers();
                            map.addLayer(timeLapseLayerGrup);
                            buttonPlayPauseStat = 3;
                        } else if (buttonPlayPauseStat == 3) {
                            document.getElementById("timeLapseClock").style.backgroundColor = "beige";
                            document.getElementById("timeLapseClock").style.color = "black";
                            if (currentDateTimeInt < endDateTimeInt) {
                                currentDateTimeInt = currentDateTimeInt + 60000;
                                datetimeShow = intToDatetime(currentDateTimeInt);
                                document.getElementById("timeLapseClock").innerHTML = fillZero(datetimeShow.getDate(), 2) + "-" + fillZero((parseInt(datetimeShow.getMonth()) + 1).toString(), 2) + "-" + fillZero(datetimeShow.getFullYear(), 4) + " " + fillZero(datetimeShow.getHours(), 2) + ":" + fillZero(datetimeShow.getMinutes(), 2);
                                var a3 = -1;
                                for (a = 0; a < dataFisherman.length; a++) { //for loop setiap fisherman
                                    for (var a2 = 0; a2 < dataAllTL.length; a2++) {
                                        if (dataAllTL[a2].hasOwnProperty("fishermanId")) {
                                            if (dataFisherman[a] == dataAllTL[a2].fishermanId) {
                                                a3 = a2;
                                                break;
                                            }
                                        }
                                    }
                                    if (a3 != -1) {
                                        if (dataAllTL[a3].result.length >= pointerFishermanData[a] + 1) {
                                            b = 0;
                                            while (b == 0 & dataAllTL[a3].result.length >= pointerFishermanData[a] + 1) {
                                                e = new Date(parseInt(dataAllTL[a3].result[pointerFishermanData[a]].timestamp) * 1000);
                                                f = e.getTime();
                                                if (f > currentDateTimeInt) { //jika datetime dari dataAll dengan urutan ke g[a] masih lebih kecil dari currentdatetime, 
                                                    //g[a] ditambah 1 dan while loop kan lagi.
                                                    b = 1;
                                                } else {
                                                    releaseXYstat[a] = 1;
                                                    x = dataAllTL[a3].result[pointerFishermanData[a]].latitude;
                                                    y = dataAllTL[a3].result[pointerFishermanData[a]].longitude;

                                                    if (dataAllTL[a3].result[pointerFishermanData[a]].stat == "1") {
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
                                                            "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
                                                            "<p style='font-size:10px;'>" + e.toString().slice(0, 33) + "</p>", {
                                                                closeButton: false
                                                            });

                                                        circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                                            this.openPopup();
                                                        });

                                                        circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                                            this.closePopup();
                                                        });
                                                    } else if (dataAllTL[a3].result[pointerFishermanData[a]].stat == "2") {
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
                                                            "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
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
                        var a3 = -1;
                        for (var a1 = 0; a1 < dataFisherman.length; a1++) {
                            for (var a2 = 0; a2 < dataAllTL.length; a2++) {
                                if (dataAllTL[a2].hasOwnProperty("fishermanId")) {
                                    if (dataFisherman[a1] == dataAllTL[a2].fishermanId) {
                                        a3 = a2;
                                        break;
                                    }
                                }
                            }
                            if (a3 != -1) {
                                for (var b1 = 0; b1 < dataAllTL[a3].result.length; b1++) {
                                    x = dataAllTL[a3].result[b1].latitude;
                                    y = dataAllTL[a3].result[b1].longitude;
                                    z = new Date(parseInt(dataAllTL[a3].result[b1].timestamp) * 1000);
                                    if (dataAllTL[a3].result[b1].stat == "1") {
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
                                            "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
                                            "<p style='font-size:10px;'>" + z.toString().slice(0, 33) + "</p>", {
                                                closeButton: false
                                            });

                                        circleFisherman[circleFisherman.length - 1].on('mouseover', function(e) {
                                            this.openPopup();
                                        });

                                        circleFisherman[circleFisherman.length - 1].on('mouseout', function(e) {
                                            this.closePopup();
                                        });
                                    } else if (dataAllTL[a3].result[b1].stat == "2") {
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
                                            "<p style='font-size:10px;'>" + "latitude : " + x + "<br>" + "longitude : " + y +
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
                        }
                        buttonPlayPauseStat = 1;
                        document.getElementById("timeLapseClock").innerHTML = "DATA READY";
                        document.getElementById("timeLapseClock").style.backgroundColor = "maroon";
                        document.getElementById("timeLapseClock").style.color = "white";
                    }
                }

                myInterval = setTimeout(myTimer, tik);
            }
        }
    </script>
</body>

</html>