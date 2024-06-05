<!DOCTYPE html>
<html lang="en">

<head>
    <title>FISHERMAN DATA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .custom {
            position: fixed;
            right: 10px;
            z-index: 999999;
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
                <strong>SUKSES</strong> berhasil menambahkan data fisherman
            </div>
        <?php elseif (session()->getFlashdata('pesanEdit')) : ?>
            <div class="alert alert-success alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>SUKSES</strong> berhasil mengubah data fisherman
            </div>
        <?php elseif (session()->getFlashdata('pesanDelete')) : ?>
            <div class="alert alert-success alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>SUKSES</strong> berhasil menghapus data fisherman
            </div>
        <?php elseif ($validation->getError('fishermanGateway')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('fishermanGateway'); ?>
            </div>
        <?php elseif ($validation->getError('fishermanId')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('fishermanId'); ?>
            </div>
        <?php elseif ($validation->getError('fishermanName')) : ?>
            <div class="alert alert-warning alert-dismissible fade in" style="position:fixed; width:50vw;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="z-index:999999;"><span aria-hidden="true">&times;</span></button>
                <strong>GAGAL</strong> <?= $validation->getError('fishermanName'); ?>
            </div>
        <?php endif; ?>
        <h2 style="text-align:center; font-weight:bolder; font-size:xx-large;">FISHERMAN DATA</h2>
        <?php foreach ($gateway as $gateway) : ?>
            <?php if ($gatewayChoice == $gateway['gateway_id']) : ?>
                <h2 style="text-align:center; font-weight:bolder; font-size:xx-large;"><?= $gateway['gateway_name']; ?></h2>
            <?php endif; ?>
        <?php endforeach; ?><br>
        <form role="form" method="post" action="/Fisherman/index/<?= $gatewayChoice; ?>">
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
                    <th>fisherman gateway</th>
                    <th>fisherman id</th>
                    <th>fisherman name</th>
                    <th>edit</th>
                    <th>delete</th>

                </tr>
            </thead>
            <tbody>
                <?php $lastFishermanId = ""; ?>
                <?php foreach ($fisherman as $fisherman) : ?>
                    <?php if ($gatewayChoice == $fisherman->fisherman_gateway and $gatewayChoice != '00000' and $fisherman->delete_stat == 0) : ?>
                        <tr>
                            <td><?= $fisherman->fisherman_gateway; ?></td>
                            <td><?= $fisherman->fisherman_id; ?></td>
                            <td><?= $fisherman->fisherman_name; ?></td>
                            <td><button type="button" onclick="editFunc('<?= $fisherman->fisherman_gateway; ?>', '<?= $fisherman->fisherman_id; ?>', '<?= $fisherman->fisherman_name; ?>', '<?= $fisherman->id; ?>')" class="btn btn-xs" data-toggle="modal" data-target="#Modal">edit</button></td>
                            <td><button type="button" onclick="deleteFunc('<?= $fisherman->id; ?>', '<?= $fisherman->fisherman_name; ?>', '<?= $fisherman->fisherman_gateway; ?>')" class="btn btn-xs" data-toggle="modal" data-target="#Modal1">delete</button></td>
                            <?php $lastFishermanId = $fisherman->fisherman_id; ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="custom" style="top:10px;"><button type="button" onClick="showMenu()" class="btn btn-primary btn-xs btn-width-fixed">fishAPP</button></div>
    <div class="custom" style="top:40px;"><button type="button" id="buttonMAP" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed disabled">MAP</button></div>
    <div class="custom" style="top:65px;"><button type="button" id="buttonBack" style="visibility:hidden;" onclick="window.location.href='/Gateway';" class="btn btn-primary btn-xs btn-width-fixed">BACK</button></div>
    <?php if ($gatewayChoice != "00000") : ?>
        <div class="custom" style="top:90px;"><button type="button" id="buttonAdd" style="visibility:hidden;" onclick="addFunc('<?= $lastFishermanId; ?>', '<?= $gatewayChoice; ?>', '<?= $endFisherman['id']; ?>')" data-toggle="modal" data-target="#Modal" class="btn btn-primary btn-xs btn-width-fixed">ADD FISHERMAN</button></div>
    <?php else : ?>
        <div class="custom" style="top:90px;"><button type="button" id="buttonAdd" style="visibility:hidden;" class="btn btn-primary btn-xs btn-width-fixed disabled">ADD FISHERMAN</button></div>
    <?php endif; ?>
    <div class="custom" style="top:115px;"><button type="button" id="buttonLogout" style="visibility:hidden;" onclick="window.location.href='/Login/logout';" class="btn btn-primary btn-xs btn-width-fixed">LOGOUT</button></div>

    <div id="Modal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="title_Id" style="text-align:center; font-weight:bold;"></h1>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="/Fisherman/fishermanSave">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="method" id="method_Id">
                        <input type="hidden" name="id" id="id_Id">
                        <div class="form-group">
                            <label class="control-label">Fisherman Gateway</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="fishermanGateway_Id" name="fishermanGateway" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Fisherman Id</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="fishermanId_id" name="fishermanId" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Fisherman Name</label>
                            <div>
                                <input type="text" class="form-control input-sm" id="fishermanName_id" name="fishermanName" pattern="([A-Za-z0-9\s]){5,50}" title="Jumlah karakter minimal 5 dan maksimal 50, hanya huruf dan angka yang diizinkan">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
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
                    <form role="form" method="POST" action="/Fisherman/fishermanSave">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="method" id="method_Id2">
                        <input type="hidden" name="id" id="id_Id2">
                        <input type="hidden" name="fishermanGateway" id="fishermanGateway_Id2">
                        <span id="infoDelete"></span><span style="color:red;" id="fihsermanName_id2"></span><span> ?</span><br><br>
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
    function addFunc(x, y, z) {
        var a;
        var b;
        var c;
        var d;
        var e;
        var f;

        if (x == "") {
            d = "00001";
        } else {
            a = x.split("-");
            b = parseInt(a[1]) + 100001;
            c = b.toString();
            d = c.substring(1);
        }
        e = y + "-" + d;

        if (z == "") {
            f = 1;
        } else {
            f = parseInt(z) + 1;
        }

        document.getElementById("fishermanGateway_Id").value = y;
        document.getElementById("id_Id").value = f;
        document.getElementById("fishermanId_id").value = e;
        document.getElementById("fishermanName_id").value = "";
        document.getElementById("title_Id").innerHTML = "ADD FISHERMAN";
        document.getElementById("method_Id").value = "add";
    }

    function editFunc(x, y, z, a) {
        document.getElementById("title_Id").innerHTML = "EDIT FISHERMAN";
        document.getElementById("fishermanGateway_Id").value = x;
        document.getElementById("fishermanId_id").value = y;
        document.getElementById("fishermanName_id").value = z;
        document.getElementById("method_Id").value = "edit";
        document.getElementById("id_Id").value = a;
    }

    function deleteFunc(x, y, z) {
        document.getElementById("title_Id2").innerHTML = "DELETE FISHERMAN";
        document.getElementById("method_Id2").value = "delete";
        document.getElementById("id_Id2").value = x;
        document.getElementById("fihsermanName_id2").innerHTML = y;
        document.getElementById("infoDelete").innerHTML = "Apakah anda yakin ingin menghapus data fisherman ";
        document.getElementById("fishermanGateway_Id2").value = z;
    }

    function showMenu() {
        if (document.getElementById("buttonMAP").style.visibility == "hidden") {
            document.getElementById("buttonMAP").style.visibility = "visible";
            document.getElementById("buttonBack").style.visibility = "visible";
            document.getElementById("buttonAdd").style.visibility = "visible";
            document.getElementById("buttonLogout").style.visibility = "visible";
        } else {
            document.getElementById("buttonMAP").style.visibility = "hidden";
            document.getElementById("buttonBack").style.visibility = "hidden";
            document.getElementById("buttonAdd").style.visibility = "hidden";
            document.getElementById("buttonLogout").style.visibility = "hidden";
        }
    }
</script>

</html>