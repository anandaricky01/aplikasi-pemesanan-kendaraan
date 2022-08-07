

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li> --}}
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <p class="nav-link">
          Halo, {{ Auth::user()->name }}!
        </p>
      </li>
      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="btn nav-link">
              Sign Out&nbsp;
              <i class="fas fa-sign-out-alt"></i>
          </button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
