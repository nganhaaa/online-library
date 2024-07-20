<link rel="stylesheet" href="{{ asset('css/styles.css')}}">
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

.wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.header-container {
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 1000;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    flex: 1;
    justify-content: space-between;
}

nav a {
    text-decoration: none;
    color: #333;
    transition: color 0.3s;
}

nav a:hover {
    color: #007bff;
}

.content {
    flex: 1;
}
</style>
<header class="sticky top-0 bg-white shadow z-50">
    <div class="container mx-auto flex items-center justify-between py-4">
        <div class="logo">
            <a href="#">LOGO</a>
        </div>
        <nav class="flex items-center flex-1 justify-between space-x-4">
            <a href="#" class="hover:text-gray-700">HƯỚNG DẪN</a>

            <x-dropdown align="left">
                <x-slot name="trigger">
                    <a href="#" class="hover:text-gray-700">GENRE</a>
                </x-slot>

                <x-slot name="content">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Thể loại 1</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Thể loại 2</a>
                </x-slot>
            </x-dropdown>

            <a href="#" class="hover:text-gray-700">AUTHOR</a>
            <a href="#" class="hover:text-gray-700">PUBLISHER</a>

            <x-dropdown align="left">
                <x-slot name="trigger">
                    <a href="#" class="hover:text-gray-700">AGE GROUP</a>
                </x-slot>

                <x-slot name="content">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nhóm tuổi 1</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Nhóm tuổi 2</a>
                </x-slot>
            </x-dropdown>
        </nav>
    </div>
</header>
