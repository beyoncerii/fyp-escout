<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/browser.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- style css -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">

</head>

<body>
    <header class="header">

        @auth('staff')

        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
              <a class="navbar-brand" href="">

                <strong> Escout</strong>
              </a>
              <div class="collapseNavBar navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('homecoach')}} ">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route ('listathletes')}}">View Athletes</a>
                          </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('listscouted')}}">Scout History</a>
                        </li>

                    <li>
                        <form action="{{ route('logout')}}" method="POST">
                            @csrf

                            <button type="submit" class="btn nav-link">Logout</button>
                            </form>
                    </li>
                </ul>
              </div>
            </div>
          </nav>

        @endauth

        @guest('staff')
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
              <a class="navbar-brand" href="">

                <strong> Escout</strong>
              </a>
              <div class="collapseNavBar navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('home')}}">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{ route ('listathletes')}}">Our Athletes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{url ('login')}}">Login</a>
                    </li>
                </ul>
              </div>
            </div>
          </nav>
        @endguest


	</header>
<main>

    @yield('content')

</main>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/667a45929d7f358570d308e7/1i16pvhd9';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>
