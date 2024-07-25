@extends('applayoutadmin')

@section('content')

<title>View Request</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-sm">

        <div style="margin-top: 50px">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" style="text-align: center;">Athlete ID</th>
                    <th scope="col" style="text-align: center;">Athlete Name</th>
                    <th scope="col" style="text-align: center;">Request Date</th>
                    <th scope="col" style="text-align: center;">Profile Link</th>
                    <th scope="col" style="text-align: center;">Status</th>
                    <th scope="col" style="text-align: center;">Accept</th>
                    <th scope="col" style="text-align: center;">Reject</th>
                  </tr>
                </thead>

                <tbody>

                @foreach ($athletes as $athlete)
                <tr>
                    <td style="text-align: center;">{{ $athlete->id }}</td>
                    <td style="text-align: center;">{{ $athlete->name }}</td>
                    <td style="text-align: center;">{{ $athlete->created_at }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('demo', $athlete->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View Profile
                        </a>
                    </td>
                    <td style="text-align: center;">{{ $athlete->status }}</td>

                    <td style="text-align: center;">
                        @if ($athlete->status == 'Pending')
                            <form action="{{ route('acceptathlete', $athlete->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> Accept</button>
                            </form>
                        @endif
                    </td>

                    <td style="text-align: center;">
                        @if ($athlete->status == 'Pending')
                            <form action="{{ route('rejectathlete', $athlete->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="remarks" class="form-control form-control-sm" placeholder="Enter remarks" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i> Reject</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
              </table>
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
