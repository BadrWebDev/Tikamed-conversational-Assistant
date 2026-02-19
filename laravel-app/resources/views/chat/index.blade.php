<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tikamed - Excellence en Implantologie Dentaire</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary: #7b2cbf;
            /* Violet plus sophistiquÃ© */
            --primary-light: rgb(174, 69, 174);
            --primary-lighter: rgb(224, 166, 224);
            /* Violet trÃ¨s clair */
            --primary-dark: rgb(121, 51, 190);
            --secondary: #6c757d;
            --light: #ffffff;
            --dark: #212529;
            --light-bg: #f8f9fa;
            --dark-bg: #1a1a2e;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--dark);
            line-height: 1.8;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .display-1,
        .display-2,
        .display-3,
        .display-4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Navbar amÃ©liorÃ©e */
        .navbar {
            background-color: var(--light) !important;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--primary);
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-rdv {
            background-color: var(--primary);
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(123, 44, 191, 0.2);
        }

        .btn-rdv:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.3);
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background: white;
                padding: 20px;
                border-radius: 10px;
                margin-top: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .nav-link {
                padding: 10px 0;
            }

            .btn-rdv {
                margin-top: 10px;
                display: inline-block;
            }
        }

        /* Hero Section amÃ©liorÃ©e */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/IMPLANT_2_shutterstock_LYRAETK.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: var(--light);
            position: relative;
            overflow: hidden;
        }

        .hero-section:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(transparent, var(--light));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4.5rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .section-title {
            position: relative;
            margin-bottom: 4rem;
            color: var(--primary-dark);
            text-align: center;
            font-size: 2.5rem;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            margin: 20px auto;
            border-radius: 2px;
        }

        /* Cards amÃ©liorÃ©es */
        .service-card {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: var(--light);
            height: 100%;
            position: relative;
            z-index: 1;
            border-top: 4px solid transparent;
        }

        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(123, 44, 191, 0.1), rgba(157, 78, 221, 0.05));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 35px rgba(138, 43, 226, 0.2);
            border-top: 4px solid var(--primary);
        }

        .service-card:hover:before {
            opacity: 1;
        }

        .service-icon {
            font-size: 3rem;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
        }

        .testimonial-card {
            border-left: 4px solid var(--primary);
            background: var(--light);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card:before {
            content: '"';
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 5rem;
            color: rgba(123, 44, 191, 0.05);
            font-family: 'Playfair Display', serif;
            line-height: 1;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(138, 43, 226, 0.15);
        }

        .rating {
            color: var(--primary);
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            border: none;
            padding: 12px 35px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(123, 44, 191, 0.4);
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            color: var(--light);
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.2);
        }

        /* Style pour les partenaires */
        .partner-item {
            padding: 20px;
            transition: all 0.3s ease;
        }

        .partner-logo {
            filter: grayscale(100%);
            transition: all 0.3s ease;
            max-width: 100%;
            height: auto;
        }

        .partner-logo:hover {
            filter: grayscale(0%);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .partner-item {
                margin-bottom: 30px;
            }
        }

        footer {
            background: var(--dark-bg);
            color: var(--light);
            position: relative;
        }

        footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
        }

        .social-icon {
            color: var(--light);
            font-size: 1.2rem;
            margin: 0 12px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .social-icon:hover {
            color: var(--light);
            background: var(--primary);
            transform: translateY(-3px);
        }

        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .bg-light-custom {
            background-color: var(--light-bg);
        }

        /* Floating animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Pulse animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 4s ease infinite;
        }

        /* Form styling amÃ©liorÃ© */
        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(123, 44, 191, 0.15);
            transform: translateY(-2px);
        }

        /* Timeline for process section */
        .process-container {
            position: relative;
        }

        .process-container:before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--primary-light));
        }

        .process-step {
            position: relative;
            padding: 30px;
            background: var(--light);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .process-step:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(123, 44, 191, 0.1);
        }

        .process-step:before {
            content: '';
            position: absolute;
            top: 50%;
            left: -15px;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(to right, var(--primary), var(--primary-light));
            border: 5px solid var(--light);
            box-shadow: 0 0 0 2px var(--primary);
        }

        .process-step:nth-child(even) {
            margin-left: auto;
            text-align: right;
        }

        .process-step:nth-child(even):before {
            left: auto;
            right: -15px;
        }

        .process-step {
            margin-bottom: 30px;
        }

        .process-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .process-number {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--light);
            border-radius: 50%;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .process-number:hover {
            transform: scale(1.1);
        }

        .process-image {
            width: 100px;
            height: auto;
            border-radius: 10px;
            box-shadow: none;
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .process-image:hover {
            transform: scale(1.05);
        }

        .process1-image {
            width: 100px;
            height: auto;
            border-radius: 10px;
            box-shadow: none;
            margin-right: auto;
            transition: transform 0.3s ease;
        }

        .process-image1:hover {
            transform: scale(1.05);
        }


        /* Stats counter */
        .stats-item {
            text-align: center;
            padding: 30px 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stats-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(123, 44, 191, 0.1);
        }

        .counter {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            z-index: 0;
            opacity: 0.1;
        }

        .floating-element-1 {
            top: 20%;
            left: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element-2 {
            bottom: 15%;
            right: 8%;
            animation: float 7s ease-in-out infinite reverse;
        }

        .btn-dental {
            background-color: rgb(163, 40, 167);
            /* Couleur verte pour distinguer de la prise de RDV */
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(163, 40, 167, 0.2);
        }

        .btn-dental:hover {
            background-color: rgb(136, 33, 126);
            /* Vert plus foncÃ© au survol */
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.1);
        }

        /* Pour la version mobile */
        @media (max-width: 992px) {
            .btn-dental {
                margin-top: 10px;
                display: inline-block;
                width: auto;
            }
        }

        /* Styles pour la section Avantages */
        .advantages-section {
            padding: 80px 0;
            background-color: var(--light-bg);
        }

        .advantage-step {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-left: 4px solid transparent;
        }

        .advantage-step:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(123, 44, 191, 0.1);
            border-left: 4px solid var(--primary);
        }

        .advantage-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            font-weight: bold;
            border-radius: 50%;
            margin-bottom: 20px;
            font-size: 1.5rem;
            box-shadow: 0 4px 8px rgba(123, 44, 191, 0.2);
        }

        .advantage-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .advantage-text {
            flex: 1;
        }

        .advantage-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: contain;
            padding: 10px;
            background: white;
            border: 2px solid var(--primary-light);
            transition: transform 0.3s ease;
        }

        .advantage-image:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .advantage-content {
                flex-direction: column;
                text-align: center;
            }

            .advantage-number {
                margin: 0 auto 20px;
            }

            .advantage-image {
                margin-top: 20px;
            }
        }

        /* Bouton En savoir plus */
        .btn-en-savoir-plus {
            background-color: var(--primary-light);
            color: white;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            display: inline-block;
            margin-top: 15px;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(123, 44, 191, 0.2);
        }

        /* Style pour toutes les images circulaires */
        .service-icon.circle-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-light);
            padding: 5px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.1);
            transition: all 0.3s ease;
        }

        .service-icon.circle-img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(123, 44, 191, 0.2);
            border-color: var(--primary);
        }

        .service-icon.circle-img img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 50%;
        }

        .btn-en-savoir-plus:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(123, 44, 191, 0.2);
        }

        /* RDV Section - ModifiÃ© avec dÃ©gradÃ© violet clair */
        #rdv {
            background: linear-gradient(135deg, var(--primary-lighter), var(--primary-light));
            position: relative;
            overflow: hidden;
        }

        #rdv:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path fill="%239d4edd" fill-opacity="0.05" d="M44.6,-59.1C56.6,-50.5,64.6,-35.8,69.2,-19.5C73.8,-3.2,75,14.8,67.7,29.4C60.4,44,44.6,55.3,27.1,62.9C9.6,70.5,-9.6,74.4,-25.1,68.2C-40.6,62,-52.4,45.7,-59.8,27.9C-67.2,10,-70.2,-9.4,-63.9,-24.6C-57.6,-39.8,-42,-50.8,-27.2,-58.6C-12.4,-66.4,1.6,-71,16.9,-67.6C32.2,-64.2,48.8,-52.8,61.5,-38.3C74.2,-23.8,83,6.2,79.7,33.2C76.4,60.2,61,84.2,40.5,92.4C20,100.6,-5.6,93,-25.5,80.5C-45.4,68,-59.6,50.6,-66.8,30.8C-74,11,-74.2,-11.2,-66.2,-29.4C-58.2,-47.6,-42,-61.8,-26.1,-68.9C-10.3,-76,5.3,-76,20.8,-70.9C36.3,-65.8,51.7,-55.6,61.2,-41.9C70.7,-28.2,74.3,-11.1,73.5,5.5C72.7,22.1,67.5,44.2,55.3,58.1C43.1,72,23.9,77.7,4.6,71.4C-14.7,65.1,-29.4,46.8,-40.8,29.7C-52.2,12.6,-60.4,-3.3,-60.2,-19.9C-60,-36.5,-51.5,-53.8,-38.1,-61.9C-24.7,-70,-6.4,-68.9,10.3,-64.2C26.9,-59.5,53.8,-51.2,61.5,-38.3Z" transform="translate(100 100)" /></svg>');
            background-size: cover;
            opacity: 0.1;
            z-index: 0;
        }

        label {
            color: black;
        }

        #rdv .container {
            position: relative;
            z-index: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3.5rem;
            }

            .process-container:before {
                left: 15px;
            }

            .process-step {
                margin-left: 30px !important;
                text-align: left !important;
            }

            .process-step:before {
                left: -15px !important;
                right: auto !important;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .display-4 {
                font-size: 2rem;
            }
        }

        /* AmÃ©liorations supplÃ©mentaires */
        .lead {
            font-size: 1.1rem;
            font-weight: 400;
        }

        .card-body {
            padding: 2rem;
        }

        .map-container {
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            border-radius: 10px;
        }

        footer a {
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--primary-light) !important;
        }

        .back-to-top {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-nav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i><img src="image/Tikamed_Digital.png" alt="" height="55"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Ã€ propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Produits</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-rdv" href="{{ route('login') }}">Espace client</a>
                    </li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-dental" href="https://app.lyraetk.com/sign-in">Dental
                            App</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="hero-section text-white">
        <div class="floating-element floating-element-1">
            <i class="fas fa-circle" style="font-size: 150px;"></i>
        </div>
        <div class="floating-element floating-element-2">
            <i class="fas fa-square" style="font-size: 100px;"></i>
        </div>

        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                    <h1 class="hero-title mb-4">Excellence en Implantologie Dentaire</h1>
                    <p class="lead mb-5">TIKAMED offre des protocoles dentaires numÃ©riques simples, sÃ»rs et
                        accessibles
                        en implantologie.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#services" class="btn btn-primary btn-lg pulse">
                            <i class="fas fa-search me-2"></i>DÃ©couvrir nos produits
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light-custom position-relative">
        <div class="container">
            <h2 class="section-title">Ã€ propos de Tikamed</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="image/1-iphysio.png" alt="Tikamed Digital Solutions"
                            class="img-fluid rounded shadow-lg" width="580px">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h3 class="mb-4">Tikamed Digital Solutions</h3>
                    <p class="lead">Tikamed Digital Solutions accompagne les professionnels de santÃ© dentaire avec des
                        protocoles numÃ©riques simples, sÃ»rs et accessibles.</p>
                    <p>SpÃ©cialiste en implantologie, scanner intraoral et impression 3D, nous fournissons des solutions
                        innovantes et un support dÃ©diÃ© pour aider les praticiens Ã  dÃ©velopper leur cabinet grÃ¢ce Ã 
                        la
                        dentisterie digitale.</p>
                    <div class="mt-4" data-aos="fade-up" data-aos-delay="500">
                        <a href="#process" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-right me-2"></i>DÃ©couvrez nos solutions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 position-relative">
        <div class="container">
            <h2 class="section-title">Nos Produits</h2>
            <p class="text-center mb-5 lead mx-auto" style="max-width: 700px;">LYRA ETK offre des protocoles dentaires
                numÃ©riques simples, sÃ»rs et accessibles en implantologie et en prothÃ¨se</p>

            <div class="row g-4">
                <!-- Service 1 : iPhysio -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card card h-100">
                        <div class="card-body p-5 text-center">
                            <div class="service-icon circle-img">
                                <img src="image/iphysio.png" alt="iPhysio">
                            </div>
                            <h4 class="card-title mb-3">iPhysio</h4>
                            <p class="card-text">Simplifie et parfait le traitement implantaire grÃ¢ce Ã  un protocole
                                digital rÃ©volutionnaire, unique, et brevetÃ©.</p>
                            <a href="https://www.lyraetk.com/iphysio-protocole-numerique/"
                                class="btn btn-en-savoir-plus">En savoir +</a>
                        </div>
                    </div>
                </div>

                <!-- Service 2 : Implants dentaires -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card card h-100">
                        <div class="card-body p-5 text-center">
                            <div class="service-icon circle-img">
                                <img src="image/CONSOMMABLES2_PICTOS-SITE.jpg" alt="Implants dentaires">
                            </div>
                            <h4 class="card-title mb-3">Implants dentaires</h4>
                            <p class="card-text">Des caractÃ©ristiques Ã©prouvÃ©es depuis 30 ans et validÃ©es par des
                                organismes indÃ©pendants.</p>
                            <a href="https://www.lyraetk.com/je-suis-dentiste/implants-dentaires/"
                                class="btn btn-en-savoir-plus">En savoir +</a>
                        </div>
                    </div>
                </div>

                <!-- Service 3 : Chirurgie guidÃ©e -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card card h-100">
                        <div class="card-body p-5 text-center">
                            <div class="service-icon circle-img">
                                <img src="image/chirugie.png" alt="Chirurgie guidÃ©e">
                            </div>
                            <h4 class="card-title mb-3">Chirurgie guidÃ©e</h4>
                            <p class="card-text">Une trousse simple et un systÃ¨me ergonomique apportant confort de
                                travail et sÃ©curitÃ©.</p>
                            <a href="https://www.lyraetk.com/je-suis-dentiste/chirurgie-guidee/"
                                class="btn btn-en-savoir-plus">En savoir +</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                <a href="#contact" class="btn btn-primary btn-lg">
                    <i class="fas fa-phone-alt me-2"></i>Nous contacter
                </a>
            </div>
        </div>
    </section>

    <!-- Process Section - Avantages -->
    <section id="process" class="advantages-section">
        <div class="container">
            <h2 class="section-title">Les avantages des implants LYRA ETK</h2>
            <p class="text-center mb-5 lead mx-auto" style="max-width: 700px;">
                DÃ©couvrez pourquoi les professionnels choisissent notre solution d'implantologie
            </p>

            <div class="row">
                <!-- Avantage 1 -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">1</div>
                                <h4>MADE IN FRANCE</h4>
                                <p>Production totalement maÃ®trisÃ©e avec des standards de qualitÃ© europÃ©ens.</p>
                            </div>
                            <img src="image/MACARON-Qualite-FR_2023-1.png" alt="Made in France" class="advantage-image">
                        </div>
                    </div>
                </div>

                <!-- Avantage 2 -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">2</div>
                                <h4>30 ANS DE RECUL CLINIQUE</h4>
                                <p>Topographie et puretÃ© validÃ©es pour une ostÃ©ointÃ©gration optimale.</p>
                            </div>
                            <img src="image/MACARON-ReculClinique-FR_2023-30ans-1.png" alt="Recul clinique"
                                class="advantage-image">
                        </div>
                    </div>
                </div>

                <!-- Avantage 3 -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">3</div>
                                <h4>15 ANS DE RECUL PROTHÃ‰TIQUE</h4>
                                <p>Connexion Ã©tanche certifiÃ©e pour une durabilitÃ© exceptionnelle.</p>
                            </div>
                            <img src="image/MACARON-ReculClinique-FR_2023-15ans.png" alt="ProthÃ¨se"
                                class="advantage-image">
                        </div>
                    </div>
                </div>

                <!-- Avantage 4 -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">4</div>
                                <h4>GAMME SIMPLIFIÃ‰E</h4>
                                <p>Une connectique unique pour tous les diamÃ¨tres d'implants.</p>
                            </div>
                            <img src="image/Picto-cad-cam.png" alt="Gamme simplifiÃ©e" class="advantage-image">
                        </div>
                    </div>
                </div>

                <!-- Avantage 5 -->
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">5</div>
                                <h4>PROTOCOLE SIMPLIFIÃ‰</h4>
                                <p>iPhysio rÃ©duit par 2 les manipulations et le nombre de piÃ¨ces utilisÃ©es.</p>
                            </div>
                            <img src="image/iphysio.png" alt="Protocole iPhysio" class="advantage-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="Partenaires" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="section-title">Nos Partenaires</h2>
            <p class="text-center mb-5 lead mx-auto" style="max-width: 700px;">
                Nous collaborons avec les leaders mondiaux en dentisterie pour vous offrir les meilleures solutions.
            </p>

            <div class="row justify-content-center align-items-center">
                <!-- Partenaire 1 - CentrÃ© -->
                <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="zoom-in">
                    <div class="partner-item h-100 d-flex align-items-center justify-content-center">
                        <img src="image/LyraETK.png" alt="Lyra ETK" class="" style="max-height: 80px;">
                    </div>
                </div>

                <!-- Partenaire 2 - CentrÃ© -->
                <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="zoom-in" data-aos-delay="100">
                    <div class="partner-item h-100 d-flex align-items-center justify-content-center">
                        <img src="image/Alliedstar.png" alt="Alliedstar" class="" style="max-height: 200px;">
                    </div>
                </div>

                <!-- Partenaire 3 - CentrÃ© -->
                <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="partner-item h-100 d-flex align-items-center justify-content-center">
                        <img src="image/SprintRay.png" alt="SprintRay" class="" style="max-height: 80px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="section-title">Contactez-nous</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="row text-center">
                        <div class="col-md-4 mb-4" data-aos="fade-up">
                            <div class="p-4 bg-white rounded shadow-sm h-100">
                                <i class="fas fa-map-marker-alt fa-2x mb-3" style="color: var(--primary);"></i>
                                <h5>Casablanca</h5>
                                <p>23, Rue Ibnou Majid Al Bahar</p>
                                <p><a href="tel:05222-72787" class="text-decoration-none"
                                        style="color: var(--primary);">05222-72787</a></p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="p-4 bg-white rounded shadow-sm h-100">
                                <i class="fas fa-map-marker-alt fa-2x mb-3" style="color: var(--primary);"></i>
                                <h5>Rabat</h5>
                                <p>Zone industrielle, SalÃ© Tabriquet Lot 1234 SalÃ©</p>
                                <p><a href="tel:05377-00154" class="text-decoration-none"
                                        style="color: var(--primary);">05377-00154</a></p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="p-4 bg-white rounded shadow-sm h-100">
                                <i class="fas fa-map-marker-alt fa-2x mb-3" style="color: var(--primary);"></i>
                                <h5>Marrakech</h5>
                                <p>Ave Mohamed 5 centre d'affaire taleb 120 Etg2 Bureau 15</p>
                                <p><a href="tel:0524-20-74-13" class="text-decoration-none"
                                        style="color: var(--primary);">0524-20-74-13</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="map-container" style="height: 500px;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.635000!2d-7.6444028!3d33.5747923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d3616e68e9a7%3A0x67a0c80970d2529d!2sTikamed%20Digital!5e0!3m2!1sfr!2sfr!4vXXXXXXXXXXXX!5m2!1sfr!2sfr"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Footer -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <img src="{{ asset('image/logoTikamed.png') }}" alt="Logo" class="w-40 h-auto" width="150px"
                        height="auto">
                    <p>LYRA ETK offre des protocoles dentaires numÃ©riques simples, sÃ»rs et accessibles en
                        implantologie.
                    </p>
                    <div class="mt-4">
                        <a href="https://www.facebook.com/profile.php?id=61560998099607&locale=fr_FR"
                            class="social-icon me-2" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/tikamed.digital/" class="social-icon me-2" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/tikamedgroup/" class="social-icon me-2"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <h5 class="text-white mb-4">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-white-50">Accueil</a></li>
                        <li class="mb-2"><a href="#about" class="text-white-50">Ã€ propos</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Produits</a></li>
                        <li class="mb-2"><a href="#Partenaires" class="text-white-50">Partenaires</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Produits</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#services" class="text-white-50">iPhysio</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Implants dentaires</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Chirurgie guidÃ©e</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Adresse et TÃ©lÃ©phone</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-3">
                            <strong>Adresse :</strong> 23, Rue Ibnou Majid Al Bahar Casablanca, Morocco<br>
                            <strong>TÃ©lÃ©phone :</strong> <a href="tel:05222-72787"
                                class="text-white">05222-72787</a><br>
                            <strong>Email :</strong> contact@tikamed.com
                        </li>
                        <li class="mb-3">
                            <strong>Adresse :</strong> Zone industrielle, SalÃ© Tabriquet Lot 1234 SalÃ©, Rabat<br>
                            <strong>TÃ©lÃ©phone :</strong> <a href="tel:05377-00154" class="text-white">05377-00154</a>
                        </li>
                        <li class="mb-3">
                            <strong>Adresse :</strong> Ave Mohamed 5 centre d'affaire taleb 120 Etg2 Bureau 15 -
                            Marrakech<br>
                            <strong>Fixe :</strong> <a href="tel:0524-20-74-13" class="text-white">0524-20-74-13</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 bg-secondary">

            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 small text-white-50">&copy; 2025 Tikamed. Tous droits rÃ©servÃ©s.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white-50 small">Mentions lÃ©gales</a></li>
                        <li class="list-inline-item"><span class="text-white-50">â€¢</span></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50 small">ConfidentialitÃ©</a></li>
                        <li class="list-inline-item"><span class="text-white-50">â€¢</span></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50 small">CGU</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Back to top button
            const backToTopButton = document.querySelector('.back-to-top');
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        // Form submission handlers
        document.getElementById('appointmentForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Votre demande de rendez-vous a Ã©tÃ© envoyÃ©e avec succÃ¨s. Nous vous contacterons sous 24h.');
            this.reset();
        });

        document.getElementById('avisForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Merci pour votre avis. AprÃ¨s modÃ©ration, il sera publiÃ© sur notre site.');
            this.reset();
        });
    </script>
    <!-- WhatsApp Floating Button avec Popup -->
    <div class="whatsapp-float">
        <a href="#" class="whatsapp-link" onclick="openWhatsAppFromLauncher(); return false;">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Popup WhatsApp -->
    <div id="whatsappPopup" class="whatsapp-popup">
        <div class="popup-content">
            <div class="popup-header">
                <h5>TIKAMED</h5>
                <button type="button" class="btn-close" onclick="closeWhatsAppPopup()"></button>
            </div>
            <div class="popup-body">
                <div class="message-bubble">
                    <p>Bonjour, bienvenue Ã  TIKAMED comment puis-je vous aider?</p>
                </div>
            </div>
            <div class="popup-footer">
                <button class="btn btn-open-chat" onclick="redirectToWhatsApp()">
                    <i class="fab fa-whatsapp me-2"></i>Ouvrir le chat
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Styles pour le bouton WhatsApp flottant */
        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            right: 94px;
            z-index: 10004;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .whatsapp-float.chat-open {
            right: 24px;
        }

        .whatsapp-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            text-decoration: none;
            font-size: 28px;
            transition: all 0.3s ease;
            animation: pulse-whatsapp 2s infinite;
            cursor: pointer;
        }

        .whatsapp-link:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
            color: white;
        }

        @keyframes pulse-whatsapp {
            0% {
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7);
            }

            100% {
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            }
        }

        /* Styles pour le popup WhatsApp */
        .whatsapp-popup {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 25px;
            width: 300px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 10003;
            border: 1px solid #e0e0e0;
            font-family: 'Montserrat', sans-serif;
        }

        .popup-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .popup-header {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            padding: 15px;
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popup-header h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .popup-header .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .popup-body {
            padding: 20px;
            flex-grow: 1;
            background: #f0f0f0;
        }

        .message-bubble {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .message-bubble:after {
            content: '';
            position: absolute;
            bottom: -10px;
            right: 20px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid white;
        }

        .message-bubble p {
            margin: 0;
            color: #333;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .popup-footer {
            padding: 15px;
            background: white;
            border-radius: 0 0 15px 15px;
            text-align: center;
        }

        .btn-open-chat {
            background: #25D366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-open-chat:hover {
            background: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        /* Animation d'apparition */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .whatsapp-popup.show {
            display: block;
            animation: slideInUp 0.3s ease-out;
        }

        /* Pour les Ã©crans mobiles */
        @media (max-width: 1024px),
        (hover: none) and (pointer: coarse) {
            .whatsapp-float {
                bottom: calc(16px + env(safe-area-inset-bottom));
                right: 84px;
            }

            .whatsapp-float.chat-open {
                right: 16px;
            }

            .whatsapp-link {
                width: 56px;
                height: 56px;
                font-size: 27px;
            }

            .whatsapp-popup {
                width: 280px;
                right: 20px;
                bottom: 80px;
            }
        }

        /* Overlay pour fermer en cliquant Ã  l'extÃ©rieur */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 9998;
        }

        .popup-overlay.show {
            display: block;
        }
    </style>

    <script>
        function positionWhatsAppPopup() {
            const popup = document.getElementById('whatsappPopup');
            const wa = document.querySelector('.whatsapp-float');
            if (!popup || !wa) return;

            const waRect = wa.getBoundingClientRect();
            const rightOffset = Math.max(16, window.innerWidth - waRect.right);
            const bottomOffset = Math.max(80, window.innerHeight - waRect.top + 12);

            popup.style.right = `${rightOffset}px`;
            popup.style.bottom = `${bottomOffset}px`;
        }

        function openWhatsAppPopup(waitForSwap = false) {
            const popup = document.getElementById('whatsappPopup');
            const wa = document.querySelector('.whatsapp-float');
            if (!popup) return;

            const showPopup = () => {
                const existingOverlay = document.querySelector('.popup-overlay');
                const overlay = existingOverlay || document.createElement('div');
                overlay.className = 'popup-overlay';
                overlay.onclick = closeWhatsAppPopup;
                if (!existingOverlay) document.body.appendChild(overlay);

                positionWhatsAppPopup();
                popup.classList.add('show');
                overlay.classList.add('show');
                requestAnimationFrame(positionWhatsAppPopup);
            };

            if (!wa) {
                showPopup();
                return;
            }

            wa.classList.remove('chat-open');

            if (!waitForSwap) {
                showPopup();
                return;
            }

            let hasOpened = false;
            const openOnce = () => {
                if (hasOpened) return;
                hasOpened = true;
                wa.removeEventListener('transitionend', onSwapEnd);
                showPopup();
            };

            const onSwapEnd = (event) => {
                if (event.target === wa && event.propertyName === 'right') openOnce();
            };

            wa.addEventListener('transitionend', onSwapEnd);
            setTimeout(openOnce, 500);
        }

        function openWhatsAppFromLauncher() {
            const wasChatOpen = document.body.classList.contains('cw-open');
            closeChatWidget();
            openWhatsAppPopup(wasChatOpen);
        }

        function closeWhatsAppPopup() {
            const popup = document.getElementById('whatsappPopup');
            const overlay = document.querySelector('.popup-overlay');

            popup.classList.remove('show');
            if (overlay) {
                overlay.classList.remove('show');
                setTimeout(() => {
                    if (overlay.parentNode) {
                        overlay.parentNode.removeChild(overlay);
                    }
                }, 300);
            }
        }

        function redirectToWhatsApp() {
            window.open('https://wa.me/212660709317', '_blank');
            closeWhatsAppPopup();
        }

        function updateChatMobileOffset() {
            const root = document.documentElement;
            const nav = document.querySelector('.navbar');
            const safeMin = 64;
            let topOffset = 84;

            if (nav) {
                // Use the fixed top row (brand/toggler) as anchor, not expanded collapse height.
                const anchor = nav.querySelector('.navbar-brand') || nav.querySelector('.navbar-toggler');
                if (anchor) {
                    const anchorRect = anchor.getBoundingClientRect();
                    topOffset = Math.max(safeMin, Math.round(anchorRect.bottom + 42));
                } else {
                    const rect = nav.getBoundingClientRect();
                    topOffset = Math.max(safeMin, Math.round(rect.bottom + 42));
                }
            }

            root.style.setProperty('--cw-mobile-top-offset', `${topOffset}px`);
        }

        function closeMobileNavbarMenu() {
            const menu = document.getElementById('navbarNav');
            const toggler = document.querySelector('.navbar-toggler');
            if (!menu) return;

            if (window.bootstrap && typeof window.bootstrap.Collapse === 'function') {
                try {
                    const instance = window.bootstrap.Collapse.getOrCreateInstance(menu, { toggle: false });
                    instance.hide();
                } catch (_) { }
            }

            menu.classList.remove('show');
            menu.style.removeProperty('height');
            if (toggler) toggler.setAttribute('aria-expanded', 'false');
        }

        // Fermer le popup avec la touche ESC
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeWhatsAppPopup();
            }
        });

        window.addEventListener('resize', function () {
            const popup = document.getElementById('whatsappPopup');
            if (popup && popup.classList.contains('show')) {
                positionWhatsAppPopup();
            }
            updateChatMobileOffset();
        });

        window.addEventListener('scroll', () => {
            if (window.innerWidth <= 1024) updateChatMobileOffset();
        }, { passive: true });

        document.addEventListener('DOMContentLoaded', updateChatMobileOffset);
    </script>

    <!-- Chat Widget Styles - Intercom-Inspired Redesign -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        /* ===== LAUNCHER BUTTON ===== */
        .chat-widget-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 10002;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .chat-launcher {
            position: relative;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6c3fc5 0%, #9b59f5 100%);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(108, 63, 197, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .chat-launcher:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 28px rgba(108, 63, 197, 0.5);
        }

        .chat-launcher svg {
            width: 26px;
            height: 26px;
            color: #fff;
        }

        .chat-launcher-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #fff;
            font-size: 10px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        /* ===== CHAT WINDOW ===== */
        .cw-window {
            position: absolute;
            bottom: 72px;
            right: 0;
            width: 360px;
            height: min(520px, calc(100vh - 100px));
            max-height: calc(100vh - 100px);
            background: linear-gradient(145deg, #5c31c0 0%, #8b5cf6 60%, #a78bfa 100%);
            border-radius: 20px;
            box-shadow: 0 16px 56px rgba(0, 0, 0, 0.22), 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform-origin: bottom right;
        }

        /* ===== HEADER (banner style) ===== */
        .cw-header {
            background: linear-gradient(145deg, #5c31c0 0%, #8b5cf6 60%, #a78bfa 100%);
            padding: 20px 18px 22px;
            color: #fff;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
            margin: 0;
            border-radius: 0;
            transition: all 0.4s ease;
        }

        .cw-header.shrink {
            padding: 12px 18px;
        }

        .cw-header .cw-greeting {
            transition: all 0.4s ease;
            max-height: 200px;
            opacity: 1;
            overflow: hidden;
        }

        .cw-header.shrink .cw-greeting {
            max-height: 0;
            opacity: 0;
            margin: 0;
        }

        .cw-header.shrink .cw-header-top {
            margin-bottom: 0;
        }

        .cw-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .cw-header::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -30px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .cw-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .cw-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cw-brand-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.35);
        }

        .cw-brand-avatar img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .cw-brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
        }

        .cw-close-btn {
            background: rgba(255, 255, 255, 0.18);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            transition: all 0.2s ease;
        }

        .cw-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(1px);
        }

        .cw-close-btn svg {
            width: 18px;
            height: 18px;
        }

        .cw-greeting {
            position: relative;
            z-index: 1;
        }

        .cw-greeting h2 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px 0;
            color: #fff;
            line-height: 1.25;
        }

        .cw-greeting p {
            font-size: 13px;
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.45;
        }

        /* ===== HOME SCREEN ===== */
        .cw-home {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            margin-top: -18px;
            padding: 0 14px 14px;
            position: relative;
            z-index: 2;
        }

        .cw-home::-webkit-scrollbar {
            width: 4px;
        }

        .cw-home::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        .cw-topics-card {
            background: #fff;
            border-radius: 14px;
            margin: 0;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .cw-topics-label {
            padding: 12px 16px 9px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
        }

        .cw-topic-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            cursor: pointer;
            border-top: 1px solid #f3f4f6;
            transition: all 0.15s ease;
            gap: 12px;
        }

        .cw-topic-item:first-of-type {
            border-top: none;
        }

        .cw-topic-item:hover {
            background: #f8fafc;
        }

        .cw-topic-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .cw-topic-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cw-topic-icon svg {
            width: 15px;
            height: 15px;
            color: #6b7280;
        }

        .cw-topic-text {
            font-size: 13px;
            font-weight: 500;
            color: #1f2937;
            line-height: 1.35;
        }

        .cw-topic-chevron {
            color: #d1d5db;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .cw-topic-item:hover .cw-topic-chevron {
            transform: translateX(3px);
            color: #9ca3af;
        }

        .cw-topic-chevron svg {
            width: 14px;
            height: 14px;
        }

        .cw-start-chat-card {
            background: #fff;
            border-radius: 14px;
            margin: 10px 14px 14px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .cw-start-chat-label {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 10px;
        }

        .cw-start-btn {
            width: 100%;
            background: linear-gradient(135deg, #6c3fc5, #9b59f5);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: inherit;
            transition: opacity 0.2s, transform 0.2s;
        }

        .cw-start-btn:hover {
            opacity: 0.95;
            transform: scale(1.02);
        }

        .cw-start-btn svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* ===== MESSAGES SCREEN ===== */
        .cw-messages-screen {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .cw-messages-area {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cw-messages-area::-webkit-scrollbar {
            width: 4px;
        }

        .cw-messages-area::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        /* Message rows */
        .cw-msg-row {
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }

        .cw-msg-row.user {
            justify-content: flex-end;
        }

        .cw-msg-av {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cw-msg-av img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .cw-bubble {
            max-width: 240px;
            min-width: 60px;
            padding: 10px 14px;
            border-radius: 18px;
            font-size: 13.5px;
            line-height: 1.5;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            animation: cwSlideIn 0.25s ease-out;
        }

        @keyframes cwSlideIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cw-bubble.bot {
            background: #fff;
            color: #1f2937;
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        }

        .cw-bubble.user {
            background: linear-gradient(135deg, #6c3fc5, #9b59f5);
            color: #fff;
            border-bottom-right-radius: 4px;
            box-shadow: 0 2px 10px rgba(108, 63, 197, 0.3);
            margin-left: auto;
        }

        .cw-bubble.bot p {
            margin: 0 0 6px 0;
        }

        .cw-bubble.bot p:last-child {
            margin-bottom: 0;
        }

        .cw-bubble.bot ul,
        .cw-bubble.bot ol {
            margin: 6px 0;
            padding-left: 18px;
        }

        .cw-bubble.bot li {
            margin-bottom: 3px;
        }

        .cw-bubble.bot strong {
            font-weight: 600;
            color: #111827;
        }

        .cw-bubble.bot code {
            background: #f3f4f6;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 12px;
        }

        .cw-bubble.bot a {
            color: #7c3aed;
            text-decoration: none;
            font-weight: 500;
        }

        .cw-bubble.bot a:hover {
            text-decoration: underline;
        }

        /* Typing indicator */
        .cw-typing {
            display: flex;
            gap: 5px;
            align-items: center;
            padding: 12px 14px;
        }

        .cw-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #a78bfa;
            animation: cwDot 1.3s infinite ease-in-out;
        }

        .cw-dot:nth-child(2) {
            animation-delay: 0.15s;
        }

        .cw-dot:nth-child(3) {
            animation-delay: 0.30s;
        }

        @keyframes cwDot {

            0%,
            80%,
            100% {
                transform: scale(0.75);
                opacity: 0.5;
            }

            40% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        /* ===== INPUT BAR ===== */
        .cw-input-bar {
            padding: 12px 14px;
            background: #fff;
            border-top: 1px solid #f0f0f4;
        }

        .cw-input-form {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f4f4f8;
            border-radius: 24px;
            padding: 6px 6px 6px 14px;
            border: 1.5px solid transparent;
            transition: border-color 0.2s;
        }

        .cw-input-form:focus-within {
            border-color: #a78bfa;
            background: #faf9ff;
        }

        .cw-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 13.5px;
            color: #111827;
            font-family: inherit;
            padding: 5px 0;
        }

        .cw-input::placeholder {
            color: #9ca3af;
        }

        .cw-send-btn {
            background: linear-gradient(135deg, #6c3fc5, #9b59f5);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            flex-shrink: 0;
        }

        .cw-send-btn:hover:not(:disabled) {
            opacity: 0.88;
            transform: scale(1.05);
        }

        .cw-send-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .cw-send-btn svg {
            width: 16px;
            height: 16px;
            color: #fff;
        }

        /* ===== BOTTOM NAV REMOVED ===== */
        .cw-bottom-nav {
            display: none;
        }

        .cw-nav-tab svg {
            width: 20px;
            height: 20px;
        }

        /* ===== BACK BUTTON ===== */
        .cw-back-btn {
            background: rgba(255, 255, 255, 0.18);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .cw-back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .cw-back-btn svg {
            width: 16px;
            height: 16px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes cwWindowIn {
            from {
                opacity: 0;
                transform: scale(0.93) translateY(12px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes cwWindowOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }

            to {
                opacity: 0;
                transform: scale(0.95) translateY(8px);
            }
        }

        .cw-enter {
            animation: cwWindowIn 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .cw-leave {
            animation: cwWindowOut 0.2s ease-in forwards;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 1024px),
        (hover: none) and (pointer: coarse) {
            .cw-header .cw-greeting {
                max-height: none !important;
            }

            body.cw-open {
                overflow: hidden !important;
            }
        }
    </style>

    <style>
        :root {
            --cw-mobile-top-offset: 84px;
        }

        .chat-launcher {
            background: #7C3AED;
            box-shadow: 0 10px 28px rgba(124, 58, 237, 0.34);
        }

        .cw-window {
            width: 366px;
            height: min(510px, calc(100vh - 220px));
            max-height: calc(100vh - 220px);
            bottom: 78px;
            border-radius: 20px;
            border: none;
            outline: none;
            background: #f4f4f6;
            box-shadow: 0 22px 56px rgba(20, 20, 26, 0.26);
        }

        .cw-window.cw-home-mode {
            height: min(510px, calc(100vh - 220px));
            max-height: calc(100vh - 220px);
        }

        .cw-header {
            padding: 14px 16px 8px;
            background: linear-gradient(180deg, #f9faff 0%, #f4f4f6 100%);
            border-bottom: 1px solid #e4e6ec;
        }

        .cw-header-top {
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cw-brand {
            gap: 0;
        }

        .cw-brand-avatar {
            display: none;
        }

        .cw-brand-name {
            color: #111827;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .cw-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cw-action-btn {
            width: 30px;
            height: 30px;
            border: 0;
            border-radius: 50%;
            color: #7C3AED;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .cw-action-btn:hover {
            background: rgba(124, 58, 237, 0.1);
            transform: none;
        }

        .cw-action-btn svg {
            width: 18px;
            height: 18px;
        }

        .cw-greeting {
            text-align: left;
            padding: 14px 14px 13px;
            margin: 10px 0 8px;
            border-radius: 18px;
            border: 1px solid #ddd7f6;
            background: linear-gradient(145deg, #fbfbff 0%, #f1effd 58%, #e7e2fb 100%);
            box-shadow: 0 11px 24px rgba(124, 58, 237, 0.11);
            position: relative;
            overflow: hidden;
        }

        .cw-greeting::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 110px;
            left: -52px;
            bottom: -70px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(167, 139, 250, 0.2) 0%, rgba(167, 139, 250, 0) 72%);
        }

        .cw-greeting::after {
            content: '';
            position: absolute;
            width: 158px;
            height: 158px;
            right: -52px;
            top: -72px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.22) 0%, rgba(124, 58, 237, 0) 70%);
        }

        .cw-home-logo {
            width: 32px;
            height: 32px;
            margin-bottom: 10px;
            object-fit: contain;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 2px 6px rgba(124, 58, 237, 0.14));
        }

        .cw-greeting h2 {
            margin: 0;
            font-size: 24px;
            color: #111827;
            line-height: 1.16;
            letter-spacing: -0.01em;
            position: relative;
            z-index: 1;
        }

        .cw-greeting p {
            margin: 6px 0 0;
            color: #465066;
            font-size: 13px;
            line-height: 1.42;
            max-width: 250px;
            position: relative;
            z-index: 1;
        }

        .cw-home {
            margin-top: 0;
            padding: 0 12px 4px;
            flex: 1;
            overflow-y: auto;
        }

        .cw-topics-card {
            background: transparent;
            border: none;
            border-radius: 0;
            box-shadow: none;
        }

        .cw-topics-label {
            display: none;
        }

        .cw-topic-item {
            padding: 8px 2px;
            border-top: 1px solid #d7dbe2;
            gap: 0;
        }

        .cw-topic-item:first-of-type {
            border-top: none;
        }

        .cw-topic-item:hover {
            background: #f3ebff;
            border-radius: 10px;
        }

        .cw-topic-left {
            align-items: center;
            gap: 8px;
        }

        .cw-topic-left::before {
            content: '↗';
            color: #7C3AED;
            font-size: 19px;
            line-height: 1;
            flex-shrink: 0;
        }

        .cw-topic-icon {
            display: none;
        }

        .cw-topic-text {
            font-size: 13px;
            color: #1f2937;
            font-weight: 500;
            line-height: 1.25;
        }

        .cw-topic-chevron {
            display: none;
        }

        .cw-messages-screen {
            padding: 0 12px;
            background: #f4f4f5;
        }

        .cw-messages-area {
            padding: 10px 0 8px;
        }

        .cw-msg-av {
            width: 26px;
            height: 26px;
            border: none;
            background: transparent;
        }

        .cw-bubble {
            max-width: 286px;
            border-radius: 18px;
            font-size: 13px;
            box-shadow: none;
        }

        .cw-bubble.bot {
            border: 1px solid #e5e7ee;
            background: #f7f8fb;
            padding: 10px 12px;
            border-radius: 14px;
            color: #20242d;
        }

        .cw-bubble.user {
            background: #7C3AED;
            color: #fff;
            border-bottom-right-radius: 18px;
            border: none !important;
            box-shadow: none !important;
        }

        .cw-input-bar {
            margin: 6px 12px 12px;
            padding: 0;
            border: none;
            box-shadow: none;
            background: transparent;
            flex-shrink: 0;
        }

        .cw-input-form {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 44px;
            padding: 6px 8px 6px 11px;
            border: 1.5px solid #d5d7df;
            border-radius: 22px;
            background: #f2f2f4;
        }

        .cw-input-form:focus-within {
            border-color: #7C3AED;
            background: #f2f2f4;
        }

        .cw-input {
            flex: 1;
            min-height: 20px;
            max-height: 62px;
            border: none;
            outline: none;
            resize: none;
            overflow-y: hidden;
            background: transparent;
            color: #1f2937;
            font-size: 14px;
            line-height: 1.4;
            font-family: inherit;
            padding: 1px 0 0;
            margin: 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .cw-input::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .cw-input::placeholder {
            color: #6b7280;
        }

        .cw-send-btn {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            border: none;
            background: #7C3AED;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cw-send-btn svg {
            width: 16px;
            height: 16px;
        }

        .cw-send-btn:hover:not(:disabled) {
            transform: none;
            background: #6d2fe0;
        }

        .cw-send-btn:disabled {
            opacity: 1;
            background: #d9d2e9;
            color: #ffffff;
        }

        .cw-bubble.cw-typing-bubble {
            width: 54px;
            min-width: 54px;
            padding: 6px 8px;
            border: 1px solid #e5e7ee;
            background: #f7f8fb;
            box-shadow: none;
        }

        .cw-typing {
            padding: 0;
            gap: 4px;
            justify-content: center;
        }

        .cw-dot {
            width: 4px;
            height: 4px;
            background: #7C3AED;
        }

        @keyframes cwSheetIn {
            from {
                opacity: 0;
                transform: translateY(100%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== MOBILE BOTTOM SHEET ===== */
        @media (max-width: 1024px),
        (hover: none) and (pointer: coarse) {
            body.cw-open {
                overflow: hidden !important;
            }

            .chat-widget-container {
                position: fixed !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                pointer-events: none;
                z-index: 10010;
            }

            .chat-launcher {
                width: 56px;
                height: 56px;
                pointer-events: auto;
                position: fixed;
                right: 16px;
                bottom: calc(16px + env(safe-area-inset-bottom));
            }

            .cw-window {
                position: fixed !important;
                top: var(--cw-mobile-top-offset) !important;
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                /* Allow top/bottom pinning to determine height */
                max-height: none !important;
                border-radius: 20px 20px 0 0 !important;
                pointer-events: auto;
                margin: 0 !important;
                transform: translateY(0);
                opacity: 1;
                z-index: 10020 !important;
            }

            .cw-window.cw-enter {
                animation: cwSheetIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) forwards !important;
            }

            .cw-home,
            .cw-messages-screen {
                padding-left: 12px;
                padding-right: 12px;
            }

            .cw-greeting {
                padding: 18px 16px 16px !important;
                margin: 14px 0 12px !important;
                border-radius: 22px !important;
            }

            .cw-home-logo {
                width: 36px !important;
                height: 36px !important;
                margin-bottom: 12px !important;
            }

            .cw-greeting h2 {
                font-size: 30px !important;
                line-height: 1.14 !important;
            }

            .cw-greeting p {
                margin-top: 8px !important;
                font-size: 15px !important;
                line-height: 1.5 !important;
                max-width: 320px !important;
            }

            .cw-topic-item {
                padding: 13px 6px !important;
            }

            .cw-topic-left {
                gap: 12px !important;
            }

            .cw-topic-left::before {
                font-size: 22px !important;
            }

            .cw-topic-text {
                font-size: 17px !important;
                line-height: 1.34 !important;
            }

            .cw-action-btn {
                width: 38px !important;
                height: 38px !important;
            }

            .cw-action-btn svg {
                width: 21px !important;
                height: 21px !important;
            }

            .cw-msg-av {
                width: 36px !important;
                height: 36px !important;
            }

            .cw-msg-row {
                gap: 11px !important;
            }

            .cw-bubble {
                max-width: calc(100vw - 90px) !important;
                font-size: 17px !important;
                line-height: 1.6 !important;
            }

            .cw-bubble.user {
                padding: 15px 20px !important;
            }

            .cw-bubble.bot {
                padding: 15px 18px !important;
            }

            .cw-input-bar {
                margin: 12px 14px 16px !important;
            }

            .cw-input-form {
                min-height: 58px !important;
                padding: 10px 12px 10px 16px !important;
                border-radius: 26px !important;
            }

            .cw-input {
                min-height: 26px !important;
                max-height: 78px !important;
                font-size: 17px !important;
                line-height: 1.45 !important;
            }

            .cw-send-btn {
                width: 40px !important;
                height: 40px !important;
                min-width: 40px !important;
            }

            .cw-send-btn svg {
                width: 18px !important;
                height: 18px !important;
            }

            .whatsapp-float.chat-open {
                opacity: 0 !important;
                pointer-events: none !important;
                transform: scale(0.9);
            }
        }
    </style>

    <!-- Chat Widget HTML -->
    <div x-data="tikaChatWidget()" x-cloak class="chat-widget-container" id="tikaChatRoot">

        <!-- Launcher -->
        <button @click="openChat()" x-show="!isOpen" class="chat-launcher" aria-label="Ouvrir le chat">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
        </button>

        <!-- Chat Window -->
        <div x-show="isOpen" :class="['cw-window', 'cw-enter', activeTab === 'home' ? 'cw-home-mode' : '']">

            <!-- HEADER -->
            <div class="cw-header">
                <div class="cw-header-top">
                    <div class="cw-brand">
                        <div class="cw-brand-avatar">
                            <img src="{{ asset('image/Untitled_design__2_-removebg-preview.png') }}" alt="Tikamed">
                        </div>
                        <span class="cw-brand-name">Tikamed</span>
                    </div>

                    <div class="cw-actions">
                        <!-- Clear chat (only on messages tab) -->
                        <template x-if="activeTab === 'messages' && messages.length > 0">
                            <button @click="clearChat()" class="cw-action-btn" title="Effacer conversation">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </template>

                        <button @click="closeChat()" class="cw-action-btn" title="Fermer">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Greeting (only shown when not shrunk) -->
                <div x-show="activeTab === 'home'" class="cw-greeting">
                    <img class="cw-home-logo" src="{{ asset('image/Untitled_design__2_-removebg-preview.png') }}"
                        alt="Tikamed">
                    <h2>Comment puis-je vous aider aujourd'hui ?</h2>
                    <p>Posez vos questions sur nos produits, implants ou support.</p>
                </div>
            </div>

            <!-- HOME TAB -->
            <div x-show="activeTab === 'home'" class="cw-home">

                <!-- Quick suggestions -->
                <div class="cw-topics-card">
                    <div class="cw-topics-label">Questions frequentes</div>

                    <div class="cw-topic-item" @click="sendTopic('Parlez-moi de Tikamed')">
                        <div class="cw-topic-left">
                            <div class="cw-topic-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="cw-topic-text">Parlez-moi de Tikamed</span>
                        </div>
                        <span class="cw-topic-chevron">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>

                    <div class="cw-topic-item" @click="sendTopic('Ou se trouve votre bureau ?')">
                        <div class="cw-topic-left">
                            <div class="cw-topic-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="cw-topic-text">Ou se trouve votre bureau ?</span>
                        </div>
                        <span class="cw-topic-chevron">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>

                    <div class="cw-topic-item" @click="sendTopic('Montrez-moi vos produits')">
                        <div class="cw-topic-left">
                            <div class="cw-topic-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                                </svg>
                            </div>
                            <span class="cw-topic-text">Montrez-moi vos produits</span>
                        </div>
                        <span class="cw-topic-chevron">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            <!-- MESSAGES TAB -->
            <div x-show="activeTab === 'messages'" class="cw-messages-screen">

                <div x-ref="msgArea" class="cw-messages-area">

                    <!-- Empty state -->
                    <template x-if="messages.length === 0">
                        <div style="text-align:center;padding:30px 20px;color:#9ca3af;">
                            <div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#ede9fe,#ddd6fe);
                                        display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                <svg width="26" height="26" fill="none" stroke="#7c3aed" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <p style="font-size:14px;font-weight:600;color:#374151;margin:0 0 4px;">Demarrer une
                                conversation</p>
                            <p style="font-size:12px;margin:0;">Posez votre question ci-dessous.</p>
                        </div>
                    </template>

                    <!-- Messages -->
                    <template x-for="(msg, idx) in messages" :key="idx">
                        <div :class="['cw-msg-row', msg.isUser ? 'user' : '']">
                            <template x-if="!msg.isUser">
                                <div class="cw-msg-av">
                                    <img src="{{ asset('image/Untitled_design__2_-removebg-preview.png') }}" alt="Bot">
                                </div>
                            </template>
                            <template x-if="msg.isUser">
                                <div class="cw-bubble user" x-text="msg.text"></div>
                            </template>
                            <template x-if="!msg.isUser">
                                <div class="cw-bubble bot" x-html="formatMsg(msg.text)"></div>
                            </template>
                        </div>
                    </template>

                    <!-- Typing indicator -->
                    <div x-show="isLoading" class="cw-msg-row">
                        <div class="cw-msg-av">
                            <img src="{{ asset('image/Untitled_design__2_-removebg-preview.png') }}" alt="Bot">
                        </div>
                        <div class="cw-bubble bot cw-typing-bubble">
                            <div class="cw-typing">
                                <div class="cw-dot"></div>
                                <div class="cw-dot"></div>
                                <div class="cw-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Shared Input (home + messages) -->
            <div class="cw-input-bar">
                <form @submit.prevent="sendMessage()" class="cw-input-form">
                    <textarea x-model="inputText" x-ref="inputBox" @input="autoResizeInput()"
                        @keydown.enter.exact.prevent="sendMessage()" @keydown.shift.enter.stop
                        placeholder="Posez votre question a Tikamed..." class="cw-input" :disabled="isLoading"
                        rows="1"></textarea>
                    <button type="submit" :disabled="isLoading || !inputText.trim()" class="cw-send-btn">
                        <svg fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18V6m0 0l-4 4m4-4l4 4" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Bottom Navigation -->
            <div class="cw-bottom-nav">
                <button @click="activeTab = 'home'" :class="['cw-nav-tab', activeTab === 'home' ? 'active' : '']">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Accueil
                </button>
                <button @click="activeTab = 'messages'"
                    :class="['cw-nav-tab', activeTab === 'messages' ? 'active' : '']">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Messages
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeChatWidget() {
            window.dispatchEvent(new CustomEvent('close-tika-chat'));
        }

        function tikaChatWidget() {
            return {
                isOpen: false,
                activeTab: 'home',   // 'home' | 'messages'
                isLoading: false,
                inputText: '',
                messages: [],
                typingSpeed: 14,
                conversationId: Date.now(),
                abortController: null,

                init() {
                    window.addEventListener('close-tika-chat', () => {
                        this.isOpen = false;
                        this.activeTab = this.messages.length ? 'messages' : 'home';
                        document.body.classList.remove('cw-open');
                        const wa = document.querySelector('.whatsapp-float');
                        if (wa) wa.classList.remove('chat-open');
                    });

                    window.addEventListener('resize', () => {
                        if (!this.isOpen) return;
                        if (this.isMobileViewport()) {
                            if (typeof updateChatMobileOffset === 'function') updateChatMobileOffset();
                        }
                    });
                },

                isMobileViewport() {
                    return window.innerWidth <= 1024;
                },




                openChat() {
                    this.isOpen = true;
                    if (this.messages.length > 0) this.activeTab = 'messages';

                    if (this.isMobileViewport()) {
                        closeMobileNavbarMenu();
                        if (typeof updateChatMobileOffset === 'function') updateChatMobileOffset();
                    }

                    document.body.classList.add('cw-open');

                    // Toggle WhatsApp position
                    const wa = document.querySelector('.whatsapp-float');
                    if (wa) wa.classList.add('chat-open');

                    if (typeof closeWhatsAppPopup === 'function') closeWhatsAppPopup();

                    this.$nextTick(() => {
                        this.scrollBottom();
                        this.autoResizeInput();
                    });
                },

                closeChat() {
                    this.isOpen = false;
                    document.body.classList.remove('cw-open');
                    const wa = document.querySelector('.whatsapp-float');
                    if (wa) wa.classList.remove('chat-open');
                },

                clearChat() {
                    if (this.abortController) {
                        this.abortController.abort();
                        this.abortController = null;
                    }
                    this.messages = [];
                    this.isLoading = false;
                    this.conversationId = Date.now();
                    this.activeTab = 'home';
                    this.resetInputHeight();
                },

                sendTopic(text) {
                    this.activeTab = 'messages';
                    this.$nextTick(() => {
                        this.inputText = text;
                        this.sendMessage();
                    });
                },

                getPresetAnswer(text) {
                    const t = (text || '').toLowerCase().trim();

                    if (
                        t.includes('parlez-moi de tikamed') ||
                        t.includes('parlez moi de tikamed') ||
                        t.includes('tell me about tikamed') ||
                        t.includes('about tikamed')
                    ) {
                        return 'Tikamed accompagne les professionnels dentaires avec des systemes implantaires, des solutions prothetiques et un accompagnement du workflow digital. Je peux aussi vous aider a choisir les produits adaptes a votre cas.';
                    }

                    if (
                        t.includes('ou se trouve votre bureau') ||
                        t.includes('ou est votre bureau') ||
                        t.includes('where is your office') ||
                        t.includes('office')
                    ) {
                        return 'Tikamed est base a Casablanca, avec une disponibilite de support a Rabat. Si vous voulez, je peux vous partager l adresse exacte et les numeros de contact.';
                    }

                    if (
                        t.includes('montrez-moi vos produits') ||
                        t.includes('montrez moi vos produits') ||
                        t.includes('show me your products') ||
                        t.includes('products') ||
                        t.includes('produits')
                    ) {
                        return 'Nous proposons des systemes implantaires, des composants prothetiques, des kits chirurgicaux et des solutions digitales pour la planification et le workflow clinique. Dites-moi quelle categorie vous voulez explorer en premier.';
                    }

                    return null;
                },

                formatMsg(text) {
                    if (!text) return '';
                    let s = text
                        .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                        .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                        .replace(/`([^`]+)`/g, '<code>$1</code>')
                        .replace(/\[([^\]]+)\]\((https?:\/\/[^)]+)\)/g, '<a href="$2" target="_blank">$1</a>');

                    const lines = s.split('\n');
                    let html = '', inUl = false, inOl = false, buf = [];

                    for (const line of lines) {
                        const t = line.trim();
                        const bul = t.match(/^[*\-]\s+(.+)$/);
                        const num = t.match(/^(\d+)[.)\s]+(.+)$/);

                        if (bul) {
                            if (buf.length) { html += '<p>' + buf.join(' ') + '</p>'; buf = []; }
                            if (inOl) { html += '</ol>'; inOl = false; }
                            if (!inUl) { html += '<ul>'; inUl = true; }
                            html += '<li>' + bul[1] + '</li>';
                        } else if (num) {
                            if (buf.length) { html += '<p>' + buf.join(' ') + '</p>'; buf = []; }
                            if (inUl) { html += '</ul>'; inUl = false; }
                            if (!inOl) { html += '<ol>'; inOl = true; }
                            html += '<li>' + num[2] + '</li>';
                        } else {
                            if (inUl) { html += '</ul>'; inUl = false; }
                            if (inOl) { html += '</ol>'; inOl = false; }
                            if (t === '') {
                                if (buf.length) { html += '<p>' + buf.join(' ') + '</p>'; buf = []; }
                            } else {
                                buf.push(t);
                            }
                        }
                    }
                    if (buf.length) html += '<p>' + buf.join(' ') + '</p>';
                    if (inUl) html += '</ul>';
                    if (inOl) html += '</ol>';
                    return html;
                },

                async typeMessage(text, idx, cid) {
                    let cur = '';
                    for (let i = 0; i < text.length; i++) {
                        if (this.conversationId !== cid || !this.messages[idx]) return;
                        cur += text[i];
                        this.messages[idx].text = cur;
                        if (i % 10 === 0) this.scrollBottom();
                        await new Promise(r => setTimeout(r, this.typingSpeed));
                    }
                    this.scrollBottom();
                },

                async sendMessage() {
                    if (!this.inputText.trim()) return;
                    const userMsg = this.inputText;
                    const cid = this.conversationId;
                    this.messages.push({ text: userMsg, isUser: true });
                    this.inputText = '';
                    this.resetInputHeight();
                    this.isLoading = true;
                    this.scrollBottom();

                    const presetAnswer = this.getPresetAnswer(userMsg);
                    if (presetAnswer) {
                        await new Promise(r => setTimeout(r, 280));
                        if (this.conversationId !== cid) return;
                        const idx = this.messages.length;
                        this.messages.push({ text: '', isUser: false });
                        this.isLoading = false;
                        await this.typeMessage(presetAnswer, idx, cid);
                        this.scrollBottom();
                        return;
                    }

                    this.abortController = new AbortController();

                    try {
                        const resp = await fetch('/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ message: userMsg }),
                            signal: this.abortController.signal
                        });

                        if (this.conversationId !== cid) return;
                        const data = await resp.json();
                        if (this.conversationId !== cid) return;

                        if (resp.ok) {
                            const idx = this.messages.length;
                            this.messages.push({ text: '', isUser: false });
                            this.isLoading = false;
                            await this.typeMessage(data.answer, idx, cid);
                        } else {
                            this.isLoading = false;
                            this.messages.push({
                                text: 'Desole, je rencontre des difficultes temporaires. Veuillez reessayer.',
                                isUser: false
                            });
                        }
                    } catch (e) {
                        if (e.name === 'AbortError') return;
                        this.isLoading = false;
                        this.messages.push({
                            text: 'Une erreur de connexion est survenue. Verifiez votre connexion et reessayez.',
                            isUser: false
                        });
                    } finally {
                        this.abortController = null;
                        this.isLoading = false;
                        this.scrollBottom();
                    }
                },

                scrollBottom() {
                    this.$nextTick(() => {
                        const el = this.$refs.msgArea;
                        if (el) el.scrollTop = el.scrollHeight;
                    });
                },

                autoResizeInput() {
                    this.$nextTick(() => {
                        const el = this.$refs.inputBox;
                        if (!el) return;
                        el.style.height = 'auto';
                        const lineHeight = parseFloat(window.getComputedStyle(el).lineHeight) || 21;
                        const maxHeight = lineHeight * 3;
                        const nextHeight = Math.min(el.scrollHeight, maxHeight);
                        el.style.height = nextHeight + 'px';
                        el.style.overflowY = el.scrollHeight > maxHeight ? 'scroll' : 'hidden';
                    });
                },

                resetInputHeight() {
                    this.$nextTick(() => {
                        const el = this.$refs.inputBox;
                        if (!el) return;
                        el.style.height = 'auto';
                        el.style.overflowY = 'hidden';
                    });
                }
            };
        }
    </script>
</body>

</html>
