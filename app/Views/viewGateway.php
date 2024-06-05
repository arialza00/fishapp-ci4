<!DOCTYPE html>
<html lang="en">

<head>
    <title>GATEWAY DATA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .custom {
            position: fixed;
            right: 10px;
            z-index: 999998;
        }

        .btn-width-fixed {
            width: 110px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="min-width:700px; max-width:800px;">
        <?php if (session()->getFlashdata('pesanAdd')) : ?>
            <div class="alert alert-success alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>SUKSES</strong> berhasil menambahkan data gateway
            </div>
        <?php elseif (session()->getFlashdata('pesanEdit')) : ?>
            <div class="alert alert-success alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>SUKSES</strong> berhasil mengubah data gateway
            </div>
        <?php elseif (session()->getFlashdata('pesanDelete')) : ?>
            <div class="alert alert-success alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>SUKSES</strong> berhasil menghapus data gateway
            </div>
        <?php elseif ($validation->getError('gatewayName')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('gatewayName'); ?>
            </div>
        <?php elseif ($validation->getError('gatewayId')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('gatewayId'); ?>
            </div>
        <?php elseif ($validation->getError('apiKey')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('apiKey'); ?>
            </div>
        <?php elseif ($validation->getError('latitude')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('latitude'); ?>
            </div>
        <?php elseif ($validation->getError('longitude')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('longitude'); ?>
            </div>
        <?php endif; ?>
        <h2 style="text-align:center; font-weight:bolder; font-size:xx-large;">GATEWAY DATA</h2>
        <p style="text-align:center;">Anda dapat menghapus atau menambahkan data gateway melalui tombol yang disediakan.</p><br>
        <form role="form" method="post" action="/Gateway/index/">
            <div class="input-group">
                <?= csrf_field(); ?>
                <input type="search" class="form-control" name="searchKeyword">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true">
                        </span> Cari!</button>
                </span>
            </div>
        </form>
        <br>
        <table class="table table-hover" style="font-size:smaller;">
            <thead>
                <tr>
                    <th>gateway id</th>
                    <th>gateway name</th>
                    <th>api key</th>
                    <th>latitude</th>
                    <th>longitude</th>
                    <th>detail</th>
                    <th>edit</th>
                    <th>delete</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($gateway as $gateway) : ?>
                    <?php if ($gateway->gateway_id != 0 and $gateway->delete_stat == 0) : ?>
                        <tr>
                            <td><?= $gateway->gateway_id; ?></td>
                            <td><?= $gateway->gateway_name; ?></td>
                            <td><?= $gateway->api_key; ?></td>
                            <td><?= $gateway->latitude; ?></td>
                            <td><?= $gateway->longitude; ?></td>
                            <td><button type="button" onclick="window.location.href='/Fisherman/<?= $gateway->gateway_id; ?>';" class="btn btn-xs">detail</button></td>
                            <td><button type="button" onclick="editFunc('<?= $gateway->latitude; ?>', '<?= $gateway->longitude; ?>', '<?= $gateway->gateway_id; ?>', '<?= $gateway->gateway_name; ?>', '<?= $gateway->api_key; ?>', '<?= $gateway->id; ?>')" class="btn btn-xs" data-toggle="modal" data-target="#Modal">edit</button></td>
                            <td><button type="button" onclick="deleteFunc('<?= $gateway->id; ?>', '<?= $gateway->gateway_name; ?>')" class="btn btn-xs" data-toggle="modal" data-target="#Modal1">delete</button></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="custom" style="top:10px;"><button type="button" onClick="showMenu()" class="btn btn-primary btn-xs btn-width-fixed">fishAPP</button></div>
    <div class="custom" style="top:40px;"><button type="button" id="buttonMAP" style="visibility:hidden;" onclick="window.location.href='/';" class="btn btn-primary btn-xs btn-width-fixed">MAP</button></div>
    <div class="custom" style="top:65px;"><button type="button" id="buttonData" style="visibility:hidden;" class="btn btn-primary btn-xs active btn-width-fixed">DATA</button></div>
    <div class="custom" style="top:90px;"><button type="button" id="buttonAdd" style="visibility:hidden;" onclick="addFunc('<?= $endGateway['gateway_id']; ?>')" class="btn btn-primary btn-xs btn-width-fixed" data-toggle="modal" data-target="#Modal">ADD GATEWAY</button></div>
    <div class="custom" style="top:115px;"><button type="button" id="buttonLogout" style="visibility:hidden;" onclick="window.location.href='/Login/logout';" class="btn btn-primary btn-xs btn-width-fixed">LOGOUT</button></div>

    <div id="Modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="title_Id" style="text-align:center; font-weight:bold;"></h1>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="/Gateway/gatewaySave">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="method" id="method_Id">
                        <input type="hidden" name="id" id="id_Id">
                        <div class="form-group">
                            <label class="control-label">Gateway Id</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="gatewayId_Id" name="gatewayId" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gateway Name</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="gatewayName_id" name="gatewayName" pattern="([A-Za-z0-9\s]){5,50}" required title="Jumlah karakter minimal 5 dan maksimal 50, hanya huruf dan angka yang diizinkan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">API Key</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="apiKey_id" name="apiKey" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Latitude</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="latitude_id" name="latitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Longitude</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="longitude_id" name="longitude" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="button" class="btn" onclick="generateUUID()">Generate API Key</button>&nbsp;
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="Modal1" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="title_Id2" style="text-align:center; font-weight:bold;"></h1>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="/Gateway/gatewaySave">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="method" id="method_Id2">
                        <input type="hidden" name="id" id="id_Id2">
                        <span id="infoDelete"></span><span style="color:red;" id="gatewayName_id2"></span><span> ?</span><br>
                        <span>data fisherman yang ada dalam data gateway juga akan terhapus.</span><br><br>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

<script>
    function editFunc(b, c, x, y, z, a) {
        document.getElementById("title_Id").innerHTML = "EDIT GATEWAY";
        document.getElementById("gatewayId_Id").value = x;
        document.getElementById("gatewayName_id").value = y;
        document.getElementById("apiKey_id").value = z;
        document.getElementById("method_Id").value = "edit";
        document.getElementById("id_Id").value = a;
        document.getElementById("latitude_id").value = b;
        document.getElementById("longitude_id").value = c;
    }

    function deleteFunc(x, y) {
        document.getElementById("title_Id2").innerHTML = "DELETE GATEWAY";
        document.getElementById("method_Id2").value = "delete";
        document.getElementById("id_Id2").value = x;
        document.getElementById("gatewayName_id2").innerHTML = y;
        document.getElementById("infoDelete").innerHTML = "Apakah anda yakin ingin menghapus data gateway ";
    }

    function addFunc(x) {
        var a = parseInt(x) + 100001;
        var b = a.toString();
        b = b.substring(1);
        var c = parseInt(x) + 1;
        document.getElementById("gatewayId_Id").value = b;
        document.getElementById("gatewayName_id").value = "";
        document.getElementById("title_Id").innerHTML = "ADD GATEWAY";
        document.getElementById("method_Id").value = "add";
        generateUUID();
    }

    function generateUUID() {
        var d = new Date().getTime();

        if (window.performance && typeof window.performance.now === "function") {
            d += performance.now();
        }

        var uuid = 'xxxxxxxxxxxx4xxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });

        document.getElementById("apiKey_id").value = uuid;
    }

    function showMenu() {
        if (document.getElementById("buttonMAP").style.visibility == "hidden") {
            document.getElementById("buttonMAP").style.visibility = "visible";
            document.getElementById("buttonData").style.visibility = "visible";
            document.getElementById("buttonAdd").style.visibility = "visible";
            document.getElementById("buttonLogout").style.visibility = "visible";
        } else {
            document.getElementById("buttonMAP").style.visibility = "hidden";
            document.getElementById("buttonData").style.visibility = "hidden";
            document.getElementById("buttonAdd").style.visibility = "hidden";
            document.getElementById("buttonLogout").style.visibility = "hidden";
        }
    }
</script>

</html>