<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSVP Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Signatie';
            src: url('{{ asset('fonts/Signatie.otf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .wedding-title {
            font-family: 'Signatie', sans-serif;
            font-size: 6vw;
        }

        .wedding-subtitle {
            font-family: 'Signatie', sans-serif;
            font-size: 3vw;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .full-screen-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            transform: scale(1.05);
            z-index: -1;
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
            padding: 1rem;
        }
    </style>
</head>

<body>
    <img src="@yield('bg_src')" alt="Background" class="full-screen-bg">

    <div class="content-wrapper">
        @yield('content')
    </div>
</body>

</html>
