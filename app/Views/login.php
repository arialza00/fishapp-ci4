<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="min-width:700px; max-width:800px;">
        <div class="row justify-content-md-center">

            <div class="col-6">
                <h2 style="text-align:center; font-weight:bolder; font-size:xx-large;">LOGIN</h2>
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>
                <form action="/login/auth" method="post">
                    <div class="mb-3">
                        <label for="InputForName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="InputForName">
                    </div>
                    <div class="mb-3">
                        <label for="InputForPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="InputForPassword">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>