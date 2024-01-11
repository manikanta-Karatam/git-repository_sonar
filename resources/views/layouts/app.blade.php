<!doctype html>
<html lang="en">
  <head>
    @stack('title')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    a {
    text-decoration: none;
    }
    body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set the minimum height of the body to the viewport height */
        }
 
        footer {
            background-color: #f8f9fa; /* Change the background color if needed */
            margin-top: auto; /* Push the footer to the bottom */
        }  
    </style>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <!-- based on the link the nav bar will be selected -->
            <div class="container">
                <span class="navbar-brand mb-0 h1">Covalense Digital</span>
                @if(request()->is('login'))
                    <a class="navbar" href={{route('register.form')}}>
                    <button class="btn btn-outline-info">SIGN-UP</button>
                    </a> 

                @elseif(request()->is('register'))
                    <a class="navbar" href={{route('login.form')}}>
                    <button  class="btn btn-outline-info">LOGIN</button>
                    </a>
                @else
                    <a class="navbar" href={{route('user.logout',['sessionid'=>@encrypt(session()->get('loginId'))])}}>
                    <button  class="btn btn-outline-info">logout</button>
                    </a>
                @endif
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer class="bg-dark text-white text-center py-2">
        <p>&copy; {{ date('Y') }}  Covalense Digital. All rights reserved.</p>
    </footer>
  <!-- Bootstrap JS and dependencies (Popper.js is not needed in Bootstrap 5) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

