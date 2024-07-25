<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter les Résultats</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white p-6">
<header class="bg-white">
    <nav class="flex justify-between items-center p-6 mx-auto relative">
        <div>
            <a href="{{ route('dashboard') }}"><img class="w-40" src="{{ URL('images/logo-ensa.png') }}" alt="ENSA Logo"></a>
        </div>
        <div id="nav-links" class="nav-links fixed top-0 left-0 w-full h-full bg-white hidden flex-col justify-center items-center z-10 md:relative md:flex md:flex-row md:items-center md:gap-[4vw] md:bg-transparent md:h-auto md:w-auto">
            <ul class="flex flex-col md:flex-row md:items-center md:gap-[4vw] gap-8">
                <li>
                    <a href="{{ route('profile.edit') }}" class="hover:text-gray-500 {{ request()->routeIs('profile.edit') ? 'text-gray-500' : '' }}">
                        {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="{{ route('view_results') }}">Mes resultats</a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="#">Contact us</a>
                </li>
            </ul>
            <ion-icon id="close-icon" name="close" class="text-3xl cursor-pointer absolute top-4 right-4 md:hidden hidden"></ion-icon>
        </div>
<div class="flex items-center gap-6">
    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="auth-btn bg-blue-900 text-white px-8 py-3 rounded-lg hover:bg-blue-800">
            Logout
        </button>
    </form>

    <ion-icon id="menu-icon" onclick="onToggleMenu()" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
</div>

    </nav>
</header>

<script>
    function onToggleMenu() {
        const navLinks = document.getElementById('nav-links');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (menuIcon.name === 'menu') {
            menuIcon.name = 'close';
            navLinks.classList.remove('hidden');
            navLinks.classList.add('flex');
            closeIcon.classList.remove('hidden');
        } else {
            menuIcon.name = 'menu';
            navLinks.classList.add('hidden');
            navLinks.classList.remove('flex');
            closeIcon.classList.add('hidden');
        }
    }

    document.getElementById('close-icon').addEventListener('click', onToggleMenu);
</script>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Mes Résultats</h1>

        @if($results->isEmpty())
            <p>Aucun résultat trouvé.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Matière</th>
                        <th class="py-2 px-4 border-b text-left">Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $result->subject->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $result->grade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>