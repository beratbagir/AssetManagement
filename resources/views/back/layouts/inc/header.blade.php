<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href="/">
          <img src="{{ asset('back/static/projectx.png') }}" alt="projectx" class="navbar-brand-image" style="width: 400; height: 50px;">
        </a>
      </h1>
      <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
            <span class="avatar avatar-sm" style="background-image: url('{{ asset('back/static/avatars/avatar.img') }}')"></span>
            <div class="d-none d-xl-block ps-2">
              @if(Auth::check())
                <div>{{ Auth::user()->name }}</div>
              @else
                <div>Guest</div>
              @endif
              <div class="mt-1 small text-secondary">
                {{ Auth::user()->tittle ?? 'No Title Available' }}
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ route('author.settings') }}" class="dropdown-item">Edit Your Profile</a>
            <a href="login" class="dropdown-item">Logout</a>
          </div>
        </div>
      </div>
    </div>
</header>
