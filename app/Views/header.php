<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dandelion | Tablas</title>

  <!-- Bootstrap LOCAL -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">

  <!-- Estilos mínimos para lograr “look & feel” tipo admin (sin SB Admin) -->
  <style>
    :root {
      --sidebar-w: 260px;
    }

    body {
      background: #f8f9fa;
    }

    .app-shell {
      min-height: 100vh;
    }

    .sidebar {
      width: var(--sidebar-w);
      background: #0d6efd;
      color: #fff;
    }

    .sidebar a {
      color: rgba(255, 255, 255, .9);
      text-decoration: none;
    }

    .sidebar a:hover {
      color: #fff;
      background: rgba(255, 255, 255, .12);
    }

    .sidebar .brand {
      font-weight: 700;
      letter-spacing: .3px;
    }

    .sidebar .nav-link.active {
      background: rgba(255, 255, 255, .18);
    }

    .content {
      flex: 1;
    }

    .topbar {
      background: #fff;
      border-bottom: 1px solid rgba(0, 0, 0, .08);
    }

    .card {
      border: 0;
      box-shadow: 0 1px 2px rgba(0, 0, 0, .06);
    }

    .card-header {
      background: #fff;
      border-bottom: 1px solid rgba(0, 0, 0, .06);
      font-weight: 600;
    }

    .table thead th {
      white-space: nowrap;
    }

    .badge-soft {
      background: rgba(13, 110, 253, .12);
      color: #0d6efd;
      border: 1px solid rgba(13, 110, 253, .18);
    }
  </style>
</head>

<body>
  <div class="d-flex app-shell">

    <!-- SIDEBAR -->
    <aside class="sidebar d-none d-lg-flex flex-column p-3">
      <div class="d-flex align-items-center mb-3">
        <span class="brand fs-5">Dandelion</span>
        <span class="ms-auto badge badge-soft rounded-pill">Admin</span>
      </div>

      <hr class="border-light opacity-25">

      <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/') ?>">Dashboard</a>
        </li>

        <li class="nav-item mt-2 text-uppercase small opacity-75 px-2">Gestión</li>

        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('tables') ?>">Tablas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('ventas') ?>">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('clientes') ?>">Clientes</a>
        </li>

        <li class="nav-item mt-2 text-uppercase small opacity-75 px-2">Cuenta</li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('logout') ?>">Salir</a>
        </li>
      </ul>

      <div class="mt-auto small opacity-75">
        <hr class="border-light opacity-25">
        <div>© <?= date('Y') ?> Dandelion</div>
      </div>
    </aside>

    <!-- CONTENT -->
    <div class="content d-flex flex-column">

      <!-- TOPBAR -->
      <header class="topbar">
        <div class="container-fluid py-2 px-3 d-flex align-items-center gap-2">
          <!-- Botón para abrir sidebar en móvil -->
          <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMobile">
            Menú
          </button>

          <div class="fw-semibold">Tablas</div>

          <form class="ms-auto d-none d-md-flex" role="search" style="max-width: 420px; width: 100%;">
            <input class="form-control" type="search" placeholder="Buscar..." aria-label="Buscar">
          </form>

          <div class="dropdown">
            <button class="btn btn-light border dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Usuario
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= base_url('perfil') ?>">Perfil</a></li>
              <li><a class="dropdown-item" href="<?= base_url('cambiar-password') ?>">Cambiar contraseña</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Salir</a></li>
            </ul>
          </div>
        </div>
      </header>