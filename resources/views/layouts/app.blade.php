<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
