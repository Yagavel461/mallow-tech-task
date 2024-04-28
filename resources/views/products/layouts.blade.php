<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add some bottom space to the navbar */
        .navbar {
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            transition: background-color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: 'transparent';
            /* Change this color to your preferred hover color */
        }
    </style>
</head>

<body>

    <div class="container-fluid mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="#">Mallow Tech task</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}" style="color:white">Discover Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.generatebill') }}" style="color:white">Generate a Bill</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.purchases') }}" style="color:white">Purchase History</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
