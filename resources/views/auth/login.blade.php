<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased hold-transition login-page">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <!--<a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                        -->
                    @endauth
                </div>
            @endif
            
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="login-box">
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <a href="../../index2.html" class="h1"><b>GOU</b></a>
                            </div>  
                            <div class="card-body">
                                <p class="login-box-msg">Iniciar Sesión</p>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required autofocus>
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                          Recordarme
                                        </label>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>

                
            
        </div>
    </body>
</html>




