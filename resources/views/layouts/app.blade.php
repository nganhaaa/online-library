<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }

        .header-container {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #007bff;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .footer-container {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .footer-section {
            flex: 1;
            margin: 0 10px;
        }

        .footer-section h3 {
            margin-bottom: 10px;
        }

        .footer-section p, .footer-section a {
            margin-bottom: 5px;
            color: #fff;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .social-media a {
            margin: 0 5px;
            color: #fff;
            text-decoration: none;
        }

        .social-media a:hover {
            color: #007bff;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header class="header-container">
        <div class="container">
            <div class="logo">
                <a href="{{ route('dashboard') }}">LOGO</a>
            </div>
            <nav>
                <a href="#">GUIDES</a>
                <div class="dropdown">
                    <a href="#">GENRE</a>
                    <div class="dropdown-content">
                        @foreach ($genres->take(5) as $genre)
                        <a href="#">{{ $genre->genre_name }}</a>
                        @endforeach
                        <a href="#">More</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">AUTHOR</a>
                    <div class="dropdown-content">
                        @foreach ($authors->take(5) as $author)
                        <a href="#">{{ $author->first_name.' '.$author->last_name }}</a>
                        @endforeach
                        <a href="#">More</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">PUBLISHER</a>
                    <div class="dropdown-content">
                        @foreach ($publishers->take(5) as $publisher)
                        <a href="#">{{ $publisher->publisher_name }}</a>
                        @endforeach
                        <a href="#">More</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">AGE GROUP</a>
                    <div class="dropdown-content">
                        @foreach ($agegroups as $agegroup)
                        <a href="#">{{ $agegroup->age_group_name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
                <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #333; cursor: pointer;">Log Out</button>
                </form>
            </nav>
        </div>
    </header>
    
    <main class="content">
        @yield('content')
    </main>
    
    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>LOGO</h3>
                <p>Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p>Support: <br> Phone: 0987654321 <br> Email: abc@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Policies</h3>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Refund Policy</a>
                <a href="#">Shipping Policy</a>
                <a href="#">FAQs</a>
            </div>
            <div class="footer-section">
                <h3>Customer Support</h3>
                <a href="#">Contact Us</a>
                <a href="#">Returns</a>
                <a href="#">Order Tracking</a>
                <a href="#">Help Center</a>
                <a href="#">Live Chat</a>
            </div>
            <div class="footer-section">
                <h3>More</h3>
                <div class="social-media">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
