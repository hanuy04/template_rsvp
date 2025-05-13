<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSVP Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

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

        .full-screen-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            transform: scale(1.05);
            z-index: -1;
            filter: blur(3px);
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.3));
            z-index: -1;
        }

        .content-wrapper {
            text-align: center;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
            margin: auto;
        }

        /* form.blade.php style */
        /* Container spacing */
        .rsvp-container {
            padding: 3rem 1rem;
            max-width: 500px;
            margin: auto;
        }

        /* Wood-inspired palette */
        .card-rsvp {
            background: rgba(245, 230, 211, 0.85);
            /* light wood grain */
            backdrop-filter: blur(6px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(166, 124, 82, 0.6);
        }

        /* Input focus effect - warm brown */
        .form-control:focus {
            border-color: #A67C52;
            box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.25);
            transition: all .3s ease;
        }

        /* Button styling - deeper wood tone */
        .btn-rsvp {
            background-color: #8B5E3C;
            color: #fff;
            border-radius: 50px;
            padding: .75rem 1.5rem;
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .btn-rsvp:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 94, 60, 0.4);
        }

        /* Headers & labels in dark brown */
        .rsvp-container h2,
        .form-label {
            color: #5C4033;
        }

        /* Fade-in-up animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out both;
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
