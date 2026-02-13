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
            /* Violet plus sophistiqué */
            --primary-light: rgb(174, 69, 174);
            --primary-lighter: rgb(224, 166, 224);
            /* Violet très clair */
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

        /* Navbar améliorée */
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

        /* Hero Section améliorée */
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

        /* Cards améliorées */
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

        /* Form styling amélioré */
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
            /* Vert plus foncé au survol */
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

        /* RDV Section - Modifié avec dégradé violet clair */
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

        /* Améliorations supplémentaires */
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
                    <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
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
                    <p class="lead mb-5">TIKAMED offre des protocoles dentaires numériques simples, sûrs et accessibles
                        en implantologie.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#services" class="btn btn-primary btn-lg pulse">
                            <i class="fas fa-search me-2"></i>Découvrir nos produits
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light-custom position-relative">
        <div class="container">
            <h2 class="section-title">À propos de Tikamed</h2>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="image/1-iphysio.png" alt="Tikamed Digital Solutions"
                            class="img-fluid rounded shadow-lg" width="580px">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h3 class="mb-4">Tikamed Digital Solutions</h3>
                    <p class="lead">Tikamed Digital Solutions accompagne les professionnels de santé dentaire avec des
                        protocoles numériques simples, sûrs et accessibles.</p>
                    <p>Spécialiste en implantologie, scanner intraoral et impression 3D, nous fournissons des solutions
                        innovantes et un support dédié pour aider les praticiens à développer leur cabinet grâce à la
                        dentisterie digitale.</p>
                    <div class="mt-4" data-aos="fade-up" data-aos-delay="500">
                        <a href="#process" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-right me-2"></i>Découvrez nos solutions
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
                numériques simples, sûrs et accessibles en implantologie et en prothèse</p>

            <div class="row g-4">
                <!-- Service 1 : iPhysio -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card card h-100">
                        <div class="card-body p-5 text-center">
                            <div class="service-icon circle-img">
                                <img src="image/iphysio.png" alt="iPhysio">
                            </div>
                            <h4 class="card-title mb-3">iPhysio</h4>
                            <p class="card-text">Simplifie et parfait le traitement implantaire grâce à un protocole
                                digital révolutionnaire, unique, et breveté.</p>
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
                            <p class="card-text">Des caractéristiques éprouvées depuis 30 ans et validées par des
                                organismes indépendants.</p>
                            <a href="https://www.lyraetk.com/je-suis-dentiste/implants-dentaires/"
                                class="btn btn-en-savoir-plus">En savoir +</a>
                        </div>
                    </div>
                </div>

                <!-- Service 3 : Chirurgie guidée -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card card h-100">
                        <div class="card-body p-5 text-center">
                            <div class="service-icon circle-img">
                                <img src="image/chirugie.png" alt="Chirurgie guidée">
                            </div>
                            <h4 class="card-title mb-3">Chirurgie guidée</h4>
                            <p class="card-text">Une trousse simple et un système ergonomique apportant confort de
                                travail et sécurité.</p>
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
                Découvrez pourquoi les professionnels choisissent notre solution d'implantologie
            </p>

            <div class="row">
                <!-- Avantage 1 -->
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">1</div>
                                <h4>MADE IN FRANCE</h4>
                                <p>Production totalement maîtrisée avec des standards de qualité européens.</p>
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
                                <p>Topographie et pureté validées pour une ostéointégration optimale.</p>
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
                                <h4>15 ANS DE RECUL PROTHÉTIQUE</h4>
                                <p>Connexion étanche certifiée pour une durabilité exceptionnelle.</p>
                            </div>
                            <img src="image/MACARON-ReculClinique-FR_2023-15ans.png" alt="Prothèse"
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
                                <h4>GAMME SIMPLIFIÉE</h4>
                                <p>Une connectique unique pour tous les diamètres d'implants.</p>
                            </div>
                            <img src="image/Picto-cad-cam.png" alt="Gamme simplifiée" class="advantage-image">
                        </div>
                    </div>
                </div>

                <!-- Avantage 5 -->
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="advantage-step">
                        <div class="advantage-content">
                            <div class="advantage-text">
                                <div class="advantage-number">5</div>
                                <h4>PROTOCOLE SIMPLIFIÉ</h4>
                                <p>iPhysio réduit par 2 les manipulations et le nombre de pièces utilisées.</p>
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
                <!-- Partenaire 1 - Centré -->
                <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="zoom-in">
                    <div class="partner-item h-100 d-flex align-items-center justify-content-center">
                        <img src="image/LyraETK.png" alt="Lyra ETK" class="" style="max-height: 80px;">
                    </div>
                </div>

                <!-- Partenaire 2 - Centré -->
                <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="zoom-in" data-aos-delay="100">
                    <div class="partner-item h-100 d-flex align-items-center justify-content-center">
                        <img src="image/Alliedstar.png" alt="Alliedstar" class="" style="max-height: 200px;">
                    </div>
                </div>

                <!-- Partenaire 3 - Centré -->
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
                                <p>Zone industrielle, Salé Tabriquet Lot 1234 Salé</p>
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
                    <p>LYRA ETK offre des protocoles dentaires numériques simples, sûrs et accessibles en implantologie.
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
                        <li class="mb-2"><a href="#about" class="text-white-50">À propos</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Produits</a></li>
                        <li class="mb-2"><a href="#Partenaires" class="text-white-50">Partenaires</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Produits</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#services" class="text-white-50">iPhysio</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Implants dentaires</a></li>
                        <li class="mb-2"><a href="#services" class="text-white-50">Chirurgie guidée</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h5 class="text-white mb-4">Adresse et Téléphone</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-3">
                            <strong>Adresse :</strong> 23, Rue Ibnou Majid Al Bahar Casablanca, Morocco<br>
                            <strong>Téléphone :</strong> <a href="tel:05222-72787"
                                class="text-white">05222-72787</a><br>
                            <strong>Email :</strong> contact@tikamed.com
                        </li>
                        <li class="mb-3">
                            <strong>Adresse :</strong> Zone industrielle, Salé Tabriquet Lot 1234 Salé, Rabat<br>
                            <strong>Téléphone :</strong> <a href="tel:05377-00154" class="text-white">05377-00154</a>
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
                    <p class="mb-0 small text-white-50">&copy; 2025 Tikamed. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white-50 small">Mentions légales</a></li>
                        <li class="list-inline-item"><span class="text-white-50">•</span></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50 small">Confidentialité</a></li>
                        <li class="list-inline-item"><span class="text-white-50">•</span></li>
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
            alert('Votre demande de rendez-vous a été envoyée avec succès. Nous vous contacterons sous 24h.');
            this.reset();
        });

        document.getElementById('avisForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Merci pour votre avis. Après modération, il sera publié sur notre site.');
            this.reset();
        });
    </script>
    <!-- WhatsApp Floating Button avec Popup -->
    <div class="whatsapp-float">
        <a href="#" class="whatsapp-link" onclick="closeChatWidget(); openWhatsAppPopup(); return false;">
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
                    <p>Bonjour, bienvenue à TIKAMED comment puis-je vous aider?</p>
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
            bottom: 25px;
            right: 25px;
            z-index: 10004;
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

        /* Pour les écrans mobiles */
        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-link {
                width: 55px;
                height: 55px;
                font-size: 26px;
            }

            .whatsapp-popup {
                width: 280px;
                right: 20px;
                bottom: 80px;
            }
        }

        /* Overlay pour fermer en cliquant à l'extérieur */
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
        function openWhatsAppPopup() {
            const popup = document.getElementById('whatsappPopup');
            const overlay = document.createElement('div');
            overlay.className = 'popup-overlay';
            overlay.onclick = closeWhatsAppPopup;
            document.body.appendChild(overlay);

            popup.classList.add('show');
            overlay.classList.add('show');
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

        // Fermer le popup avec la touche ESC
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeWhatsAppPopup();
            }
        });
    </script>

    <!-- Chat Widget Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
        }

        .chat-widget-container {
            position: fixed;
            bottom: 24px;
            right: 120px;
            z-index: 10002;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Chat Toggle Button - Clean Professional Style */
        .chat-toggle-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.9) 0%, rgba(139, 92, 246, 0.95) 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35), 0 0 0 0 rgba(124, 58, 237, 0.3);
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            white-space: nowrap;
            animation: pulse-glow 3s infinite;
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35), 0 0 0 0 rgba(124, 58, 237, 0.3);
            }
            50% {
                box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35), 0 0 15px 4px rgba(124, 58, 237, 0.15);
            }
        }

        .chat-toggle-btn:hover {
            box-shadow: 0 6px 24px rgba(124, 58, 237, 0.45), 0 0 20px 6px rgba(124, 58, 237, 0.2);
            transform: translateY(-2px);
        }

        .chat-toggle-btn svg {
            width: 20px;
            height: 20px;
        }

        /* Chat Window - AWS/LiveChat Inspired */
        .chat-window {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 375px;
            height: 575px;
            background: linear-gradient(180deg, #faf5ff 0%, #ffffff 100%);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(124, 58, 237, 0.2), 0 4px 16px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(124, 58, 237, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform-origin: bottom right;
        }

        /* Header - Clean and Minimal */
        .chat-header {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.85) 0%, rgba(139, 92, 246, 0.9) 100%);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 2px 12px rgba(124, 58, 237, 0.12);
            position: relative;
        }

        .chat-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        }

        .chat-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .chat-header-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .chat-header-title {
            font-weight: 600;
            color: white;
            font-size: 15px;
            margin: 0;
            line-height: 1.3;
        }

        .chat-header-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
        }

        .chat-status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: statusPulse 2s ease-in-out infinite;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }

        @keyframes statusPulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            50% {
                box-shadow: 0 0 0 4px rgba(16, 185, 129, 0);
            }
        }

        .chat-menu-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
            padding: 9px;
            border-radius: 10px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-menu-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .chat-menu-btn svg {
            width: 16px;
            height: 16px;
        }



        .chat-menu-dropdown {
            position: absolute;
            top: 64px;
            left: 16px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            z-index: 1000;
            overflow: hidden;
        }

        .chat-menu-item {
            padding: 12px 16px;
            cursor: pointer;
            border: none;
            background: white;
            width: 100%;
            text-align: left;
            font-size: 14px;
            color: #374151;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chat-menu-item:hover {
            background: #f9fafb;
        }

        .chat-menu-item.danger {
            color: #dc2626;
        }

        .chat-menu-item.danger:hover {
            background: #fee2e2;
        }

        .chat-minimize-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
            padding: 9px;
            border-radius: 10px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-minimize-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .chat-minimize-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Messages Area - Clean Background */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 15px 16px;
            background: linear-gradient(180deg, rgba(124, 58, 237, 0.02) 0%, transparent 100%);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        /* Scrollbar Styling */
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(124, 58, 237, 0.2);
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: rgba(124, 58, 237, 0.4);
        }

        /* Onboarding Screen - AWS Style */
        .chat-onboarding {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            height: 100%;
            padding: 24px 16px;
        }

        .chat-onboarding-header {
            margin-bottom: 20px;
        }

        .chat-onboarding-title {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.9) 0%, rgba(139, 92, 246, 0.95) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .chat-onboarding-desc {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            line-height: 1.5;
        }

        .chat-suggestions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        /* Suggestion Buttons - AWS/LiveChat Style */
        .chat-suggestion-btn {
            background: white;
            border: 2px solid rgba(124, 58, 237, 0.2);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13px;
            color: #1f2937;
            cursor: pointer;
            text-align: left;
            transition: all 0.3s ease;
            font-family: inherit;
            font-weight: 500;
            position: relative;
            line-height: 1.4;
            box-shadow: 0 2px 4px rgba(124, 58, 237, 0.05);
        }

        .chat-suggestion-btn:hover {
            border-color: rgba(124, 58, 237, 0.6);
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.04), rgba(168, 85, 247, 0.04));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.12);
        }

        /* Message Row */
        .chat-msg-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 4px;
        }

        .chat-msg-row.user {
            justify-content: flex-end;
        }

        /* Avatar - Clean Circle */
        .chat-msg-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7C3AED, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.3);
        }

        .chat-msg-content {
            flex: 1;
            max-width: 85%;
        }

        .chat-msg-row.user .chat-msg-content {
            flex: unset;
            max-width: 75%;
        }

        /* Chat Bubbles - Professional Style */
        .chat-bubble {
            padding: 12px 16px;
            border-radius: 16px;
            font-size: 13px;
            line-height: 1.5;
            word-wrap: break-word;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-bubble.bot {
            background: #ffffff;
            color: #1f2937;
            border: 1px solid rgba(124, 58, 237, 0.15);
            border-top-left-radius: 4px;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.08);
        }

        .chat-bubble.user {
            background: linear-gradient(135deg, #7C3AED 0%, #a855f7 100%);
            color: #ffffff;
            border-top-right-radius: 4px;
            font-weight: 500;
            margin-left: auto;
            box-shadow: 0 2px 12px rgba(124, 58, 237, 0.3);
        }

        .chat-bubble.bot p {
            margin: 0 0 8px 0;
        }

        .chat-bubble.bot p:last-child {
            margin-bottom: 0;
        }

        .chat-bubble.bot ul,
        .chat-bubble.bot ol {
            margin: 8px 0;
            padding-left: 20px;
        }

        .chat-bubble.bot li {
            margin-bottom: 4px;
        }

        .chat-bubble.bot strong {
            font-weight: 600;
            color: #111827;
        }

        .chat-bubble.bot code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
        }

        .chat-bubble.bot a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .chat-bubble.bot a:hover {
            text-decoration: underline;
        }

        /* Badge - Minimal Style */
        .chat-badge {
            display: inline-block;
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 12px;
            margin-top: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .chat-badge.faq {
            background: #d1fae5;
            color: #047857;
        }

        .chat-badge.rag {
            background: #e0e7ff;
            color: #4338ca;
        }

        .chat-badge.web_search {
            background: #fed7aa;
            color: #c2410c;
        }

        .chat-badge.fallback {
            background: #e5e7eb;
            color: #6b7280;
        }

        /* Loading Animation */
        .chat-loading-dots {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
        }

        /* Compact bubble for loading dots only */
        .chat-bubble.bot:has(.chat-loading-dots) {
            width: fit-content;
            min-width: 60px;
            padding: 10px 16px;
        }

        .chat-loading-dot {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.85), rgba(168, 85, 247, 0.9));
            border-radius: 50%;
            animation: chatBounce 1.4s infinite ease-in-out;
            box-shadow: 0 0 4px rgba(124, 58, 237, 0.25);
        }

        .chat-loading-dot:nth-child(2) {
            animation-delay: 0.16s;
        }

        .chat-loading-dot:nth-child(3) {
            animation-delay: 0.32s;
        }

        @keyframes chatBounce {

            0%,
            80%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            40% {
                transform: scale(1.2);
                opacity: 1;
            }
        }

        /* Input Area - Clean Bottom Bar */
        .chat-input-area {
            padding: 14px 16px;
            background: white;
            border-top: 1px solid rgba(124, 58, 237, 0.1);
            box-shadow: 0 -2px 8px rgba(124, 58, 237, 0.05);
        }

        .chat-input-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            background: white;
            border: 1px solid rgba(124, 58, 237, 0.2);
            border-radius: 24px;
            padding: 11px 16px;
            font-size: 13px;
            color: #111827;
            outline: none;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .chat-input::placeholder {
            color: #9ca3af;
        }

        .chat-input:focus {
            border-color: rgba(124, 58, 237, 0.6);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
        }

        .chat-send-btn {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.9) 0%, rgba(168, 85, 247, 0.95) 100%);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25);
        }

        .chat-send-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, rgba(109, 40, 217, 0.95) 0%, rgba(147, 51, 234, 1) 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.35);
        }

        .chat-send-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .chat-send-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Smooth Elegant Animations */
        @keyframes chatBtnEnter {
            0% {
                opacity: 0;
                transform: scale(0.6) translateY(10px);
            }

            60% {
                opacity: 1;
                transform: scale(1.05);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes chatBtnLeave {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }



        /* Smooth window opening */
        @keyframes chatWindowEnter {
            0% {
                opacity: 0;
                transform: scale(0.94) translateY(12px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Smooth window closing */
        @keyframes chatWindowLeave {
            0% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }

            100% {
                opacity: 0;
                transform: scale(0.96) translateY(8px);
            }
        }

        .chat-btn-enter {
            animation: chatBtnEnter 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 0.35s;
        }

        .chat-btn-leave {
            animation: chatBtnLeave 0.25s ease-out forwards;
        }

        .chat-window-enter {
            animation: chatWindowEnter 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .chat-window-leave {
            animation: chatWindowLeave 0.25s cubic-bezier(0.55, 0.085, 0.68, 0.53) forwards;
        }

        .chat-menu-dropdown {
            opacity: 1 !important;
            animation: none !important;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            /* Position chat widget beside WhatsApp button - perfectly aligned */
            .chat-widget-container {
                bottom: 20px;
                right: 95px; /* Position beside WhatsApp icon (20px + 55px + 20px spacing) */
            }

            /* Make chat toggle button match WhatsApp exactly */
            .chat-toggle-btn {
                width: 55px;
                height: 55px;
                padding: 0;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0;
                box-shadow: 0 4px 20px rgba(124, 58, 237, 0.5);
                animation: pulse-glow 3s infinite;
            }

            .chat-toggle-btn:hover {
                box-shadow: 0 6px 28px rgba(124, 58, 237, 0.6);
            }

            /* Hide text on mobile, show only icon */
            .chat-toggle-btn span {
                display: none;
            }

            .chat-toggle-btn svg {
                width: 24px;
                height: 24px;
                margin: 0;
            }

            /* Adjust chat window for mobile - full width with proper margins */
            .chat-window {
                position: fixed;
                width: calc(100vw - 32px);
                max-width: 100vw;
                height: calc(100vh - 100px);
                bottom: 16px;
                right: 16px;
                left: 16px;
                transform-origin: bottom center;
                box-shadow: 0 8px 32px rgba(124, 58, 237, 0.25), 0 4px 16px rgba(0, 0, 0, 0.15);
            }
        }

        @media (max-width: 480px) {
            .chat-widget-container {
                bottom: 20px;
                right: 85px; /* Adjust for smaller screens */
            }

            /* Keep same size as WhatsApp on small screens */
            .chat-toggle-btn {
                width: 55px;
                height: 55px;
            }

            .chat-toggle-btn svg {
                width: 24px;
                height: 24px;
            }

            .chat-window {
                bottom: 10px;
                right: 10px;
                left: 10px;
                width: calc(100vw - 20px);
                height: calc(100vh - 80px);
            }
        }
    </style>

    <!-- Chat Widget HTML -->
    <div x-data="chatWidget()" x-cloak class="chat-widget-container" id="chatWidgetRoot">

        <button @click="toggleChat()" x-show="!isOpen" x-transition:enter="chat-btn-enter"
            x-transition:leave="chat-btn-leave" class="chat-toggle-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                </path>
            </svg>
            <span>Discuter avec l'IA</span>
        </button>

        <div x-show="isOpen" x-transition:enter="chat-window-enter" x-transition:leave="chat-window-leave"
            class="chat-window" :class="{ 'chat-window-enter': isOpen }">
            <div class="chat-header">
                <div class="chat-header-left">
                    <button @click="showMenu = !showMenu" class="chat-menu-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="5" cy="12" r="2" />
                            <circle cx="12" cy="12" r="2" />
                            <circle cx="19" cy="12" r="2" />
                        </svg>
                    </button>
                    <div class="chat-header-info">
                        <h3 class="chat-header-title">Assistant Tikamed</h3>
                        <div class="chat-header-status">
                            <span class="chat-status-dot"></span>
                            <span>En ligne</span>
                        </div>
                    </div>
                </div>
                <button @click="toggleChat()" class="chat-minimize-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                    </svg>
                </button>

                <div x-show="showMenu" @click.away="showMenu = false" x-transition class="chat-menu-dropdown">
                    <button @click="clearConversation()" class="chat-menu-item danger">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Effacer la conversation
                    </button>
                </div>
            </div>

            <div x-ref="messagesContainer" class="chat-messages">
                <!-- Onboarding screen - shown before first interaction -->
                <div x-show="messages.length === 0" class="chat-onboarding">
                    <div class="chat-onboarding-header">
                        <h2 class="chat-onboarding-title">Demandez à Tikamed</h2>
                        <p class="chat-onboarding-desc">Obtenez des conseils et recommandations sur les implants
                            dentaires, les solutions prothétiques et les spécifications techniques.</p>
                    </div>

                    <div class="chat-suggestions">
                        <button @click="sendSuggestion('Qu\'est-ce que Tikamed ?')" class="chat-suggestion-btn">
                            Qu'est-ce que Tikamed ?
                        </button>
                        <button @click="sendSuggestion('Parlez-moi du produit NCI_BL')" class="chat-suggestion-btn">
                            Parlez-moi du produit NCI_BL
                        </button>
                        <button @click="sendSuggestion('Montrez-moi les spécifications des implants bone level')"
                            class="chat-suggestion-btn">
                            Montrez-moi les spécifications des implants bone level
                        </button>
                        <button @click="sendSuggestion('Quels produits proposez-vous ?')" class="chat-suggestion-btn">
                            Quels produits proposez-vous ?
                        </button>
                    </div>
                </div>

                <!-- Chat conversation - shown after first message -->
                <div x-show="messages.length > 0">
                    <template x-for="(msg, index) in messages" :key="index">
                        <div :class="'chat-msg-row' + (msg.isUser ? ' user' : '')">
                            <div x-show="!msg.isUser" class="chat-msg-avatar">T</div>
                            <div class="chat-msg-content">
                                <div x-show="msg.isUser" class="chat-bubble user" x-text="msg.text"></div>
                                <div x-show="!msg.isUser" class="chat-bubble bot" x-html="formatMessage(msg.text)">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="isLoading" class="chat-msg-row">
                    <div class="chat-msg-avatar">T</div>
                    <div class="chat-msg-content">
                        <div class="chat-bubble bot">
                            <div class="chat-loading-dots">
                                <div class="chat-loading-dot"></div>
                                <div class="chat-loading-dot"></div>
                                <div class="chat-loading-dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chat-input-area">
                <form @submit.prevent="sendMessage()" class="chat-input-form">
                    <input type="text" x-model="currentMessage"
                        :placeholder="messages.length === 0 ? 'Posez une question...' : 'Écrivez un message...'"
                        class="chat-input" :disabled="isLoading">
                    <button type="submit" :disabled="isLoading || !currentMessage.trim()" class="chat-send-btn">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global function to close chat from WhatsApp button
        function closeChatWidget() {
            window.dispatchEvent(new CustomEvent('close-chat-widget'));
        }

        function chatWidget() {
            return {
                isOpen: false,
                isLoading: false,
                currentMessage: '',
                messages: [],
                typingSpeed: 15,
                showMenu: false,
                abortController: null,
                conversationId: Date.now(), // Track current conversation session

                init() {
                    // Listen for close event from WhatsApp
                    window.addEventListener('close-chat-widget', () => {
                        this.isOpen = false;
                    });
                },

                toggleChat() {
                    this.isOpen = !this.isOpen;
                    if (this.isOpen) {
                        // Close WhatsApp popup if it's open
                        closeWhatsAppPopup();
                        this.$nextTick(() => this.scrollToBottom());
                    }
                },

                clearConversation() {
                    // Abort any ongoing request
                    if (this.abortController) {
                        this.abortController.abort();
                        this.abortController = null;
                    }
                    // Reset state and create new conversation session
                    this.conversationId = Date.now();
                    this.isLoading = false;
                    this.messages = [];
                    this.showMenu = false;
                    this.$nextTick(() => this.scrollToBottom());
                },

                sendSuggestion(text) {
                    this.currentMessage = text;
                    this.sendMessage();
                },

                formatMessage(text) {
                    if (!text) return '';
                    let s = text;
                    // Escape HTML entities
                    s = s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    // Bold: **text**
                    s = s.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
                    // Inline code: `code`
                    s = s.replace(/`([^`]+)`/g, '<code>$1</code>');
                    // Links: [text](url)
                    s = s.replace(/\[([^\]]+)\]\((https?:\/\/[^)]+)\)/g, '<a href="$2" target="_blank">$1</a>');

                    // Process lines for lists and paragraphs
                    const lines = s.split('\n');
                    let html = '';
                    let inUl = false;
                    let inOl = false;
                    let normalText = [];

                    for (const line of lines) {
                        const trimmed = line.trim();
                        const bulletMatch = trimmed.match(/^[*\-•]\s+(.+)$/);
                        const numMatch = trimmed.match(/^(\d+)[.)\s]+(.+)$/);

                        if (bulletMatch) {
                            // Flush normal text first
                            if (normalText.length > 0) {
                                html += '<p>' + normalText.join(' ') + '</p>';
                                normalText = [];
                            }
                            if (inOl) { html += '</ol>'; inOl = false; }
                            if (!inUl) { html += '<ul>'; inUl = true; }
                            html += '<li>' + bulletMatch[1] + '</li>';
                        } else if (numMatch) {
                            // Flush normal text first
                            if (normalText.length > 0) {
                                html += '<p>' + normalText.join(' ') + '</p>';
                                normalText = [];
                            }
                            if (inUl) { html += '</ul>'; inUl = false; }
                            if (!inOl) { html += '<ol>'; inOl = true; }
                            html += '<li>' + numMatch[2] + '</li>';
                        } else {
                            if (inUl) { html += '</ul>'; inUl = false; }
                            if (inOl) { html += '</ol>'; inOl = false; }
                            if (trimmed === '') {
                                // Empty line - flush current paragraph and add break
                                if (normalText.length > 0) {
                                    html += '<p>' + normalText.join(' ') + '</p>';
                                    normalText = [];
                                }
                            } else {
                                // Normal text - accumulate
                                normalText.push(trimmed);
                            }
                        }
                    }
                    // Flush any remaining normal text
                    if (normalText.length > 0) {
                        html += '<p>' + normalText.join(' ') + '</p>';
                    }
                    if (inUl) html += '</ul>';
                    if (inOl) html += '</ol>';
                    return html;
                },

                async typeMessage(text, messageIndex, conversationId) {
                    const message = this.messages[messageIndex];
                    if (!message) return; // Message was cleared
                    
                    let currentText = '';
                    for (let i = 0; i < text.length; i++) {
                        // Check if conversation was cleared
                        if (this.conversationId !== conversationId) return;
                        if (!this.messages[messageIndex]) return;
                        
                        currentText += text[i];
                        this.messages[messageIndex].text = currentText;
                        if (i % 10 === 0) this.scrollToBottom();
                        await new Promise(resolve => setTimeout(resolve, this.typingSpeed));
                    }
                    this.scrollToBottom();
                },

                async sendMessage() {
                    if (!this.currentMessage.trim()) return;
                    const userMessage = this.currentMessage;
                    const currentConversationId = this.conversationId; // Capture current session ID
                    
                    this.messages.push({ text: userMessage, isUser: true });
                    this.currentMessage = '';
                    this.isLoading = true;
                    this.scrollToBottom();

                    // Create new abort controller for this request
                    this.abortController = new AbortController();

                    try {
                        const response = await fetch('/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ message: userMessage }),
                            signal: this.abortController.signal
                        });
                        
                        // Check if conversation was cleared while waiting for response
                        if (this.conversationId !== currentConversationId) return;
                        
                        const data = await response.json();
                        
                        // Check again after parsing JSON
                        if (this.conversationId !== currentConversationId) return;
                        
                        if (response.ok) {
                            const messageIndex = this.messages.length;
                            this.messages.push({ text: '', isUser: false, type: data.response_type, sources: data.sources || [] });
                            this.isLoading = false;
                            await this.typeMessage(data.answer, messageIndex, currentConversationId);
                        } else {
                            this.isLoading = false;
                            this.messages.push({ text: 'Désolé, je rencontre des difficultés temporaires. Veuillez réessayer dans un instant.', isUser: false });
                        }
                    } catch (error) {
                        // Ignore abort errors (user cleared conversation)
                        if (error.name === 'AbortError') {
                            console.log('Request aborted');
                            return;
                        }
                        console.error('Chat error:', error);
                        this.isLoading = false;
                        this.messages.push({ text: 'Une erreur de connexion est survenue. Vérifiez votre connexion internet et réessayez.', isUser: false });
                    } finally {
                        this.abortController = null;
                        this.isLoading = false;
                        this.scrollToBottom();
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messagesContainer;
                        if (container) container.scrollTop = container.scrollHeight;
                    });
                }
            }
        }
    </script>
</body>

</html>