<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/dash.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <a class="navbar-brand" href="">
            <strong> Escout</strong>
        </a>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#" title="Logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        </div>
    </nav>

    <body>

    <div class="container-fluid">
        <div class="row content">
        <div class="col-sm-3 sidenav">
            <ul class="nav nav-pills nav-stacked" style="margin-top: 50px">
            <li><a href="#" title="Admin Profile"><i class="fas fa-user"></i> Admin Profile</a></li>
            <li><a href="#" title="List of Athletes"><i class="fas fa-users"></i> List of Athletes</a></li>
            <li><a href="#" title="List of Staff"><i class="fas fa-users"></i> List of Staff</a></li>
            <li><a href="#" title="Athlete Profile Request"><i class="fas fa-file"></i> Athlete Profile Request</a></li>
            </ul>
        </div>


        <div class="col-sm-9" style="overflow-y: auto; height: calc(100vh - 50px); padding: 20px;">
            <div class="well">
                <h4>Dashboard</h4>
                <p>Some text..</p>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="well">
                        <h4>Users</h4>
                        <p>Users</p>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

    </body>
    </html>
