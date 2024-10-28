
<nav class="nav_bg">
    <div id="nav_fullscreenmobile" class="flex flex-wrap items-center justify-between mx-auto p-4 md:bg-transparent">
        <a href="" class="flex items-center space-x-3 rtl:space-x-reverse ms-2 md:ms-5 lg:ms-5">
            <img src="{{ asset('assets/icons/supaw-logo.png') }}" class="w-10 md:w-16 lg:w-20 rounded-lg" alt="Flowbite Logo">
            <!-- <span class="self-center text-2xl font-bold whitespace-nowrap dark:text-white">Supaw Warriors</span> -->
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse me-5">
            <!-- btn toggle dark mode -->
             <div class="hidden md:block">
                <button id="theme-toggle" type="button" class="text-black bg-supaw_green dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700  focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </div>
    
            <button id="navbar-toggle" data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full h-full bg-transparent md:bg-transparent md:flex md:w-auto md:order-1 transition-all duration-500 ease-in-out" id="navbar-sticky">
            <ul class="flex flex-col h-[100vh] md:h-full justify-center p-4 md:p-0 mt-4 font-medium md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="#" class="nav_current" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#" class="nav_options">About</a>
                </li>
                <li>
                    <a href="#" class="nav_options">FAQ</a>
                </li>
                <li>
                    <a href="#" class="nav_options">Programs</a>
                </li>
                <li>
                    <a href="#" class="nav_options">Adoption List</a>
                </li>
                @if (Auth::check())
                <li>
                    <h1 href="#" class="nav_options">Hello, {{session('name') }}</h1>
                </li>                  
                <li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav_options">
                        Logout
                    </a>
                </li>
                @else
                <li>
                    <a href="/login" class="nav_options">Login</a>
                </li>
                @endif`
            </ul>
        </div>
    </div>
</nav>

<style>
    body.no-scroll {
    overflow: hidden;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }
    .slide-down {
        animation: slideDown 0.5s forwards;
    }
</style>

@section('script')
<script>
    const navHead = document.getElementById('nav_fullscreenmobile');
    const navbarToggle = document.getElementById('navbar-toggle');
    const isNavOpen = document.getElementById('navbar-sticky');
    var isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';

    navbarToggle.addEventListener('click', () => {
    
    if (!isExpanded) {
        isExpanded = true;
        navHead.style.backgroundColor = 'black';
        isNavOpen.classList.remove('hidden'); 
        isNavOpen.classList.add('slide-down');

        navbarToggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('no-scroll');
        console.log(isExpanded)
        console.log('buka')
    } 
    else {
        isExpanded = false;
        navHead.style.backgroundColor = 'transparent';  
        isNavOpen.classList.remove('slide-down');
        
        isNavOpen.classList.add('hidden');
        
        navbarToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('no-scroll');
        console.log(isExpanded)
        console.log('tutup')
    }
    });

    // isNavOpen.addEventListener('click', () => {
    //     isExpanded = false;
    //     navHead.style.backgroundColor = 'transparent';  
    //     isNavOpen.classList.add('hidden');
    //     isNavOpen.classList.remove('slide-down');

        
    //     document.body.classList.remove('no-scroll');
    //     navbarToggle.setAttribute('aria-expanded', 'false');
    //     console.log(isExpanded)
    //     console.log('tutup body')
    // });

    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function() {

        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
        
    });

    let lastScrollTop = 0;
    const navbar = document.querySelector('.nav_bg');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // User is scrolling down - hide navbar
            navbar.classList.add('nav-hidden');
        } else {
            // User is scrolling up - show navbar
            navbar.classList.remove('nav-hidden');
        }

        lastScrollTop = scrollTop;
    });
</script>
@endsection
