<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=" ">
    <meta name="generator" content=" ">
    <title> HomePage</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#7952b3">
    <style>
        body {
            background-image: url('https://d3gribjq2zt3oj.cloudfront.net/blog-hub/wp-content/uploads/2017/08/Q119_Marketing_social_2_0124.png');
            background-size: cover;
            background-blend-mode: soft-light;
        }

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
</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Ravi M</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('index') }}">Register</a>
                </nav>
            </div>
        </header>
        <main class="px-3">
            <h1>Welcome to Link Hub.</h1>
            <p class="lead">Welcome to Link Hub—your gateway to seamless connectivity! Explore, connect, and elevate
                your digital experience with ease. </p>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary fw-bold border-white text-black">Get Start</a>
            </p>
        </main>
        <footer class="mt-auto text-white-50">
            <p> Developed by <a href="https://ravimanivel.github.io/websites/" target="_blank" class="text-white">Ravi
                    M</a> .</p>
        </footer>
    </div>
</body>
</html>
