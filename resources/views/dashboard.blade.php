<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page with Bootstrap Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles to remove padding and margins */
        body, html {
            height: 100%;
        }
        .full-height {
            height: 100%;
        }
        .section {
            height: 100%;
            padding: 20px; /* Adjust padding as needed */
        }
        .section-left {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }
        .section-right {
            background-color: #dc3545; /* Bootstrap danger color */
            color: white;
        }
    </style>
</head>
<body class="full-height">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container-fluid full-height">
        <div class="row no-gutters full-height">
            <!-- First section (25% width) -->
            <div class="col-md-3">
                <div class="section section-left">
                    <h5>First Section</h5>
                    <p>This section takes up 25% width.</p>
                </div>
            </div>

            <!-- Second section (75% width) -->
            <div class="col-md-9">
                <div class="section section-right">
                    <h5>Second Section</h5>
                    <p>This section takes up 75% width.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero id malesuada fermentum. Pellentesque varius, ipsum vel viverra eleifend, justo justo rhoncus eros, in hendrerit lacus mi vel arcu. Curabitur faucibus, felis nec efficitur lacinia, erat purus semper lorem, non hendrerit nisi velit sit amet mauris.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
