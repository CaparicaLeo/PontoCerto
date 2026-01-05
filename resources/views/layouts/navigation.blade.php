<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar - PontoCerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-menu {
            animation: slideDown 0.3s ease-out;
        }
        
        .mobile-menu {
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .notification-badge {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo e Nome -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition transform">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            PontoCerto
                        </span>
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    @auth
                        <!-- Dashboard -->
                        <a href="{{ route('clocks.index') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                        
                        <!-- Admin Dashboard (somente para admins) -->
                        @if(Auth::user()->role !== 'user')
                            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition font-medium {{ request()->routeIs('admin.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                <i class="fas fa-users-cog mr-2"></i>
                                Administração
                            </a>
                        @endif
                        
                        <!-- Notificações -->
                        <div class="relative">
                            <button onclick="toggleNotifications()" class="relative px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="notification-badge absolute top-1 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                            
                            <!-- Dropdown de Notificações -->
                            <div id="notificationsDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl overflow-hidden dropdown-menu">
                                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-3">
                                    <h3 class="text-white font-semibold">Notificações</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-check text-green-600"></i>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Ponto registrado</p>
                                                <p class="text-xs text-gray-500 mt-1">Entrada às 08:00 - Hoje</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-info text-blue-600"></i>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Lembrete</p>
                                                <p class="text-xs text-gray-500 mt-1">Não esqueça de registrar a saída</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition">
                                        <div class="flex items-start">
                                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-file-alt text-purple-600"></i>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900">Novo relatório</p>
                                                <p class="text-xs text-gray-500 mt-1">Relatório mensal disponível</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-center">
                                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold">Ver todas</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Perfil do Usuário -->
                        <div class="relative ml-3">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                                <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="text-gray-700 font-medium hidden lg:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                            </button>
                            
                            <!-- Dropdown do Usuário -->
                            <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl overflow-hidden dropdown-menu">
                                <div class="px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600">
                                    <p class="text-sm text-white">Logado como</p>
                                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                        <i class="fas fa-user w-5"></i>
                                        <span class="ml-3">Meu Perfil</span>
                                    </a>
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                                            <i class="fas fa-users-cog w-5"></i>
                                            <span class="ml-3">Admin Dashboard</span>
                                        </a>
                                    @endif
                                    <div class="border-t border-gray-100 my-2"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-sign-out-alt w-5"></i>
                                            <span class="ml-3">Sair</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Links para visitantes -->
                        <a href="{{ url('/') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition font-medium">
                            <i class="fas fa-home mr-2"></i>
                            Início
                        </a>
                        <a href="{{ url('/#recursos') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition font-medium">
                            Recursos
                        </a>
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Entrar
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                            <i class="fas fa-rocket mr-2"></i>
                            Cadastrar
                        </a>
                    @endauth
                </div>

                <!-- Botão Menu Mobile -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                    <i id="menuIcon" class="fas fa-bars text-gray-700 text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 mobile-menu">
            <div class="px-4 py-3 space-y-1">
                @auth
                    <!-- Perfil Mobile -->
                    <div class="flex items-center space-x-3 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg mb-3">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-semibold truncate">{{ auth()->user()->name }}</p>
                            <p class="text-white/80 text-sm truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('clocks.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('clocks.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('clocks.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <i class="fas fa-clock w-5"></i>
                        <span class="ml-3 font-medium">Meus Registros</span>
                    </a>
                    @if(!Auth::user()->role == 'user')
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('admin.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                            <i class="fas fa-users-cog w-5"></i>
                            <span class="ml-3 font-medium">Administração</span>
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <i class="fas fa-user w-5"></i>
                        <span class="ml-3 font-medium">Meu Perfil</span>
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="ml-3 font-medium">Sair</span>
                        </button>
                    </form>
                @else
                    <a href="{{ url('/') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3 font-medium">Início</span>
                    </a>
                    <a href="{{ url('/#recursos') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                        <i class="fas fa-star w-5"></i>
                        <span class="ml-3 font-medium">Recursos</span>
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                        <i class="fas fa-sign-in-alt w-5"></i>
                        <span class="ml-3 font-medium">Entrar</span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg font-semibold">
                        <i class="fas fa-rocket w-5"></i>
                        <span class="ml-3">Cadastrar Agora</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Espaçamento para o conteúdo -->
    <div class="h-16"></div>

    

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');
            
            menu.classList.toggle('hidden');
            
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            }
        }

        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
            
            // Fechar notificações se estiver aberto
            document.getElementById('notificationsDropdown').classList.add('hidden');
        }

        function toggleNotifications() {
            const dropdown = document.getElementById('notificationsDropdown');
            dropdown.classList.toggle('hidden');
            
            // Fechar menu do usuário se estiver aberto
            document.getElementById('userDropdown').classList.add('hidden');
        }

        // Fechar dropdowns ao clicar fora
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userDropdown');
            const notificationsMenu = document.getElementById('notificationsDropdown');
            
            if (!event.target.closest('#userDropdown') && !event.target.closest('button[onclick="toggleUserMenu()"]')) {
                userMenu.classList.add('hidden');
            }
            
            if (!event.target.closest('#notificationsDropdown') && !event.target.closest('button[onclick="toggleNotifications()"]')) {
                notificationsMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>