<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="wrapper">
        <header class="header-container">
            <div class="container">
                <div class="logo">
                    <a href="#">LOGO</a>
                </div>
                <nav>
                    <a href="{{ route('books.index') }}">Books</a>
                    <a href="{{ route('genres.index') }}">Genres</a>
                    <a href="{{ route('authors.index') }}">Authors</a>
                    <a href="{{ route('publishers.index') }}">Publishers</a>
                    <a href="{{ route('users.index') }}">Users</a>
                </nav>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>

        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 Your Company</p>
            </div>
        </footer>
    </div>
</body>
</html>
