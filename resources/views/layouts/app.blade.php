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
    <header class="w-full">
        <nav class="fixed left-0 right-0 top-0 z-40 w-full bg-white shadow">
            <div class="container mx-20 flex items-center justify-between px-10 py-4">
                <div class="mr-35 block lg:hidden">
                    <button @click="open = !open" class="text-gray-800 hover:text-gray-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <div><a href="{{ route('dashboard') }}" class="a font-serif text-2xl">LOGO</a></div>
                <div><a href="{{ route('dashboard') }}" class="hidden lg:flex">GUIDE</a></div>

                <x-dropdown>
                    <x-slot:trigger>
                        GENRE

                    </x-slot:trigger>
                    <x-slot:content>
                        <ul>

                            @foreach ($genres->take(5) as $genre)
                                <li><a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $genre->genre_name }}</a>
                                </li>
                            @endforeach
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">More</a></li>

                        </ul>
                    </x-slot:content>
                </x-dropdown>

                <x-dropdown>
                    <x-slot:trigger>

                        AUTHOR

                    </x-slot:trigger>
                    <x-slot:content>
                        <ul>

                            @foreach ($authors->take(5) as $author)
                                <li><a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $author->first_name . ' ' . $author->last_name }}</a>
                                </li>
                            @endforeach
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">More</a></li>

                        </ul>
                    </x-slot:content>
                </x-dropdown>

                <x-dropdown>
                    <x-slot:trigger>

                        PUBLISHER

                    </x-slot:trigger>
                    <x-slot:content>
                        <ul>

                            @foreach ($publishers->take(5) as $publisher)
                                <li><a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $publisher->publisher_name }}</a>
                                </li>
                            @endforeach
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">More</a></li>

                        </ul>
                    </x-slot:content>
                </x-dropdown>

                <x-dropdown>
                    <x-slot:trigger>

                        AGE GROUP

                    </x-slot:trigger>
                    <x-slot:content>
                        <ul>

                            @foreach ($agegroups as $agegroup)
                                <li><a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $agegroup->age_group_name }}</a>
                                </li>
                            @endforeach
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">More</a></li>

                        </ul>
                    </x-slot:content>
                </x-dropdown>

             
                <a href="#"><i class="fas fa-search"></i></a>

                <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>


                <x-dropdown>
                    <x-slot:trigger>
                        <a href="#"><i class="fas fa-user"></i></a>
                    </x-slot:trigger>
                    <x-slot:content>
                        <ul>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            </li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">History</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    @csrf
                                    <button type="submit">Log
                                        Out</button>
                                </form>
                            </li>

                        </ul>
                    </x-slot:content>
                </x-dropdown>
       
            </div>
        </nav>
    </header>

    <main class="mt-20">
        @yield('content')
    </main>

    <footer class="w-full bg-[#2e2e2e]">
        <div class="container mx-20 mb-auto flex flex-wrap items-start justify-between px-10 py-4 text-white">
            <div class="">
                <h3>LOGO</h3>
                <p>Address: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p>Support: <br> Phone: 0987654321 <br> Email: abc@gmail.com</p>
            </div>
            <div class="">
                <h3>Policies</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>

                    <li><a href="#">Terms of Service</a></li>
                    <li> <a href="#">Refund Policy</a></li>
                    <li> <a href="#">Shipping Policy</a></li>
                    <li> <a href="#">FAQs</a></li>
                </ul>




            </div>
            <div class="">
                <h3>Customer Support</h3>
                <ul>
                    <li> <a href="#">Contact Us</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Order Tracking</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li> <a href="#">Live Chat</a></li>
                </ul>





            </div>
            <div class="">
                <h3>More</h3>
                <div class="space-x-2">
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
