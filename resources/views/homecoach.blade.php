@extends('applayoutcoach')

@section('content')

<title>Home EScout</title>


<link rel="stylesheet" href="{{asset('css/home.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<div class="homepage">

<div class="container">

    <h1 class="title">Welcome to the Ultimate Athlete Showcase!</h1>
    <h4 class="description">Discover the stories behind the stars, learn about their training regimens, and get inspired by their relentless pursuit of excellence. Whether it's on the field, on the court, or in the arena, our athletes redefine what it means to be truly extraordinary. <br><br>
    🏆 Don't miss your chance to be part of the action. Join us as we celebrate the incredible world of sports and the athletes who make it all possible. Get ready to witness greatness – it's time to experience the Ultimate Athlete Showcase!</h4>

        <div class="button">

                <a class="btn btn-primary mt-2 mb-2"  href="{{ route('listathletes')}} " style="text-decoration: none; color:white"> Our Athletes </a>

        </div>

</div>

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

</div>

@endsection
