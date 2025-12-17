<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dandelion</title>

    <!-- Font Awesome LOCAL -->
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>">

    <!-- Google Fonts (remoto, está bien así) -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    <!-- Bootstrap LOCAL -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <!-- SB Admin 2 LOCAL -->
    <link rel="stylesheet" href="<?= base_url('css/sb-admin-2.min.css') ?>">

</head>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar sesion</h1>
                                    </div>
                                    <form action="<?= site_url('login') ?>" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="usuario" name="usuario" aria-describedby="emailHelp"
                                                placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Contraseña">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <?php if (isset($validation)) : ?>
                                            <div class="alert alert-danger">
                                                <?php echo $validation->listErrors(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($error)) : ?>
                                            <div class="alert alert-danger">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- jQuery LOCAL -->
    <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>

    <!-- Bootstrap LOCAL -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- jQuery Easing LOCAL -->
    <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- SB Admin 2 -->
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>


</body>

</html>