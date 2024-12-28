
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="./back/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="./back/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./back/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="/signup" class="navbar-brand navbar-brand-autodark">
            <style>
              .navbar-brand-image {
                  width: 350px;
                  height: 100px;
              }
          </style>
            <img src="./back/static/project.png" alt="Tabler" class="navbar-brand-image">
          </a>
        </div>
        <form action="{{ route('signup.submit') }}" method="POST">
          @csrf
          <div class="card-body">
              <h2 class="card-title text-center mb-4">Create new account</h2>
              <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name">
              </div>
              <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email">
              </div>
              <div class="mb-3">
                <label class="form-label">Tittle</label>
                <input type="text" name="tittle" class="form-control" placeholder="Enter Title">
            </div>
              <div class="mb-3">
                  <label class="form-label">Password</label>
                  <div class="input-group input-group-flat">
                      <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                      <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                              <!-- SVG icon -->
                          </a>
                      </span>
                  </div>
              </div>
              <div class="form-footer">
                  <button type="submit" class="btn btn-primary w-100">Create new account</button> 
              </div>
          </div>
      </form>
      
        <div class="text-center text-secondary mt-3">
          Already have account? <a href="{{route('author.login')}}" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="./back/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>