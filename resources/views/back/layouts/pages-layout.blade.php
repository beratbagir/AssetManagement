<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link href="{{ asset('back/dist/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>
    @stack('stylesheets')
    <link href="./back/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      .nav-link-icon {
        margin-right: 8px;
        font-size: 1.2em;
        color: #007bff;
        transition: color 0.3s ease;
      }
      .nav-link-title {
        font-weight: bold;
        font-size: 1.1em;
        color: #333;
        transition: color 0.3s ease;
      }
      .navbar-nav .nav-item .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
      }
      .navbar-nav .nav-item .nav-link:hover {
        background-color: #f0f0f0;
      }
      .navbar-nav .nav-item .nav-link:hover .nav-link-icon,
      .navbar-nav .nav-item .nav-link:hover .nav-link-title {
        color: #0056b3;
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <script src="./back/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">

      <!-- Navbar -->
      @include('back.layouts.inc.header')
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="/">
                    <span class="fas fa-tachometer-alt" style="color: #007bff;"></span> <!-- Mavi renk -->
                    <span class="nav-link-title">&nbsp;&nbsp;&nbsp;Dashboard</span>
                  </a>
                </li>
                
                <li class="nav-item active">
                  <a class="nav-link" href="/assets">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-box"></i>
                    </span>
                    <span class="nav-link-title">Assets</span>
                  </a>
                </li>
                
                <li class="nav-item active">
                  <a class="nav-link" href="/barcode">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-barcode"></i>
                    </span>
                    <span class="nav-link-title">Barcodes</span>
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/products">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-cube"></i>
                    </span>
                    <span class="nav-link-title">Products</span>
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/licences">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-key"></i>
                    </span>
                    <span class="nav-link-title">Licences</span>
                  </a>
                </li>
                <!-- Dropdown menu for related items -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-cog" style="color: #007bff;"></i> <!-- Settings simgesi ve mavi renk -->
                    </span>
                    <span class="nav-link-title">Settings</span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                    <li><a class="dropdown-item" href="/users">
                      <i class="fas fa-user" style="color: #007bff;"></i> <!-- Mavi renkli kullanıcı simgesi -->
                      &nbsp;&nbsp;Users
                    </a></li>
                    <li><a class="dropdown-item" href="/suppliers">
                      <i class="fas fa-truck" style="color: #007bff;"></i> <!-- Mavi renkli tedarikçi simgesi -->
                      &nbsp;&nbsp;Suppliers
                    </a></li>
                    <li><a class="dropdown-item" href="/manufacturers">
                      <i class="fas fa-industry" style="color: #007bff;"></i> <!-- Mavi renkli üretici simgesi -->
                      &nbsp;&nbsp;Manufacturers
                    </a></li>
                    <li><a class="dropdown-item" href="/categories">
                      <i class="fas fa-tag" style="color: #007bff;"></i> <!-- Mavi renkli kategori simgesi -->
                      &nbsp;&nbsp;Categories
                    </a></li>
                    <li><a class="dropdown-item" href="/companies">
                      <i class="fas fa-building" style="color: #007bff;"></i> <!-- Mavi renkli şirket simgesi -->
                      &nbsp;&nbsp;Companies
                    </a></li>
                    <li><a class="dropdown-item" href="/departments">
                      <i class="fas fa-sitemap" style="color: #007bff;"></i> <!-- Mavi renkli departman simgesi -->
                      &nbsp;&nbsp;Departments
                    </a></li>
                  </ul>
                </li>
                
              </ul>
              
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last"></div>
            </div>
          </div>
        </div>
      </header>
      
      <div class="page-wrapper">
        <!-- Page header -->
        @yield('pageHeader')

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>

        @include('back.layouts.inc.footer')
      </div>
    </div>

    <!-- Libs JS -->
    <script src="./back/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1692870487" defer></script>
    @stack('scripts')
    <script src="./back/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>
