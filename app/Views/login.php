<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dandelion</title>

  <!-- Font Awesome local -->
  <link rel="stylesheet" href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900">

  <!-- Bootstrap local -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

  <style>
    :root {
      --login-bg: #f3f5f8;
      --login-card: #ffffff;
      --login-accent: #1d4ed8;
      --login-text: #0f172a;
    }

    body.login-body {
      background: linear-gradient(135deg, #eef2f7 0%, #dbe4f0 100%);
      color: var(--login-text);
      font-family: 'Nunito', Arial, sans-serif;
      min-height: 100vh;
    }

    .login-shell {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .login-card {
      background: var(--login-card);
      border: 0;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
      overflow: hidden;
    }

    .login-visual {
      position: relative;
      background-image: var(--login-image);
      background-size: cover;
      background-position: center;
      color: #0f172a;
      min-height: 100%;
      padding: 3rem;
    }

    .login-visual-content {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.82);
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
    }

    .login-visual .brand {
      font-weight: 700;
      font-size: 1.75rem;
      margin-bottom: 0.75rem;
    }

    .image-placeholder {
      border: 1px dashed rgba(15, 23, 42, 0.3);
      border-radius: 0.75rem;
      padding: 1.5rem;
      margin-top: 2rem;
      font-size: 0.9rem;
      background: rgba(15, 23, 42, 0.04);
    }

    .form-control:focus {
      border-color: var(--login-accent);
      box-shadow: 0 0 0 0.2rem rgba(29, 78, 216, 0.15);
    }

    .btn-primary {
      background: var(--login-accent);
      border-color: var(--login-accent);
    }
  </style>
</head>

<body class="login-body">
  <div class="login-shell">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-9">
          <div class="card login-card">
            <div class="row g-0">
              <div class="col-lg-6 d-none d-lg-flex">
                <div class="login-visual w-100" style="--login-image: url('<?= base_url('images/Dandelion_login.png') ?>');">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-4 p-lg-5">
                  <h1 class="h4 mb-2">Iniciar sesion</h1>
                  <p class="text-muted small mb-4">Ingresa tus credenciales para continuar.</p>

                  <form action="<?= site_url('login') ?>" method="post" autocomplete="off">
                    <div class="mb-3">
                      <label class="form-label" for="usuario">Usuario</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="password">Contrasena</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>

                    <?php if (isset($validation)) : ?>
                      <div class="alert alert-danger mt-3">
                        <?php echo $validation->listErrors(); ?>
                      </div>
                    <?php endif; ?>
                    <?php if (isset($error)) : ?>
                      <div class="alert alert-danger mt-3">
                        <?php echo $error; ?>
                      </div>
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>
