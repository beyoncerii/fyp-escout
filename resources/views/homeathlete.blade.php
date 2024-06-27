@extends('applayout')

@section('content')

<title>Home EScout</title>


<link rel="stylesheet" href="{{asset('css/home.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<div class="homepage">

<div class="container">

    <h1 class="title">Get Scouted. Get Recruited.</h1>
    <h4 class="description">Embark on a journey to showcase your prowess and passion with our cutting-edge athlete profile platform. Your achievements, dedication, and victories deserve a spotlight that captures the essence of your athletic journey. <br><br>
    🏆 Stand Out: Craft a dynamic profile that highlights your accomplishments, personal milestones, and the essence of your sportsmanship.</h4>

        <div class="button">

                <a class="btn btn-success mt-2 mb-2"  href="{{route('createathlete')}}" style="text-decoration: none; color:white"> Create Athlete Profile </a>

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
