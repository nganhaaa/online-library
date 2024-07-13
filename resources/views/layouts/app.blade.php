<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
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
                <a href="#">LOGO</a>
            </div>
            <nav>
                <a href="#">HƯỚNG DẪN</a>
                <div class="dropdown">
                    <a href="#">GENRE</a>
                    @foreach ($genres as $genre)
                            <a href="#">{{ $genre->genre_name }}</a>
                        @endforeach
                </div>
                <a href="#">AUTHOR</a>
                <a href="#">NXB</a>
                <div class="dropdown">
                    <a href="#">NHÓM TUỔI</a>
                    <div class="dropdown-content">
                        <a href="#">Nhóm tuổi 1</a>
                        <a href="#">Nhóm tuổi 2</a>
                    </div>
                </div>
                <a href="#"><i class="icon-search"></i></a>
                <a href="#"><i class="icon-user"></i></a>
                <a href="#"><i class="icon-cart"></i></a>
            </nav>
        </div>
    </header>
    
    <main class="content">
        <!-- Your main content here -->
        <img src="your-image-path.png" alt="Sách mới cập nhật">
    </main>
    
    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>LOGO</h3>
                <p>Địa chỉ: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p>Hỗ trợ tư vấn: <br> Điện thoại: 0987654321 <br> Email: abc@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Chính sách</h3>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
            </div>
            <div class="footer-section">
                <h3>Hỗ trợ khách hàng</h3>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
                <a href="#">hushushusuh</a>
            </div>
            <div class="footer-section">
                <h3>Xem thêm</h3>
                <a href="#"><img src="appstore.png" alt="App Store"></a>
                <a href="#"><img src="googleplay.png" alt="Google Play"></a>
                <div class="social-media">
                    <a href="#"><i class="icon-facebook"></i></a>
                    <a href="#"><i class="icon-instagram"></i></a>
                    <a href="#"><i class="icon-twitter"></i></a>
                    <a href="#"><i class="icon-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
