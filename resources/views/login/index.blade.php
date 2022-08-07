<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">

  @if(session()->has('loginError'))
    <div class="alert alert-danger" role="alert">
        {!! session('loginError') !!}
    </div>
  @endif

  <form action="/login" method="POST">
    @csrf
    <h1 class="h3 mb-3 fw-normal"><strong>Login Aplikasi</strong></h1>

    <div class="form-floating">
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="M" name="email" value="{{ old('email') }}">
      <label for="floatingInput">Email</label>
      @error('email')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-1"></div>
    <div class="form-floating">
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
      @error('password')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-1"></div>
    <div class="mb-3"></div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
  </form>
</main>


    
  </body>
</html>
