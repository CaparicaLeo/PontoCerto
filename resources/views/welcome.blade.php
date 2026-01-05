<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PontoCerto - Sistema de Registro de Ponto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-gradient {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-clock text-indigo-600 text-2xl mr-3"></i>
                    <span class="text-2xl font-bold text-gray-800">PontoCerto</span>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('clocks.index') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-indigo-600 transition">
                            Entrar
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-lg">
                            Cadastrar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 animated-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Controle de Ponto
                        <span class="block text-yellow-300">Simples e Eficiente</span>
                    </h1>
                    <p class="text-xl mb-8 text-white/90">
                        Gerencie os horários de trabalho da sua equipe de forma inteligente e automatizada.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 transition shadow-xl text-center font-semibold">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Ir para Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 transition shadow-xl text-center font-semibold">
                                <i class="fas fa-rocket mr-2"></i>
                                Começar Agora
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white/10 transition text-center font-semibold">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Fazer Login
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="hidden lg:block float-animation">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-6 text-white mb-4">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-sm opacity-80">Horário Atual</span>
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <div class="text-5xl font-bold font-mono" id="currentTime">--:--:--</div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <span class="text-sm text-gray-600">Entrada</span>
                                <span class="text-green-600 font-mono font-semibold">08:00</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                <span class="text-sm text-gray-600">Saída</span>
                                <span class="text-red-600 font-mono font-semibold">17:00</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg">
                                <span class="text-sm text-gray-600">Total</span>
                                <span class="text-indigo-600 font-mono font-semibold">9h 00min</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Por que escolher o PontoCerto?
                </h2>
                <p class="text-xl text-gray-600">
                    Simplifique o gerenciamento de horários com recursos poderosos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Registro Rápido</h3>
                    <p class="text-gray-600">
                        Registre entrada e saída com apenas um clique. Sistema intuitivo e fácil de usar.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Relatórios Detalhados</h3>
                    <p class="text-gray-600">
                        Acompanhe horas trabalhadas, histórico completo e estatísticas em tempo real.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-users-cog text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Gestão de Equipe</h3>
                    <p class="text-gray-600">
                        Administradores podem visualizar e gerenciar registros de toda a equipe.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">100% Responsivo</h3>
                    <p class="text-gray-600">
                        Acesse de qualquer dispositivo - desktop, tablet ou smartphone.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Seguro e Confiável</h3>
                    <p class="text-gray-600">
                        Seus dados protegidos com criptografia e backups automáticos.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="group p-8 bg-gray-50 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-edit text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Edição Flexível</h3>
                    <p class="text-gray-600">
                        Corrija registros facilmente com descrições personalizadas para cada ponto.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-white">
                <div>
                    <div class="text-5xl font-bold mb-2">99.9%</div>
                    <div class="text-xl text-indigo-100">Uptime</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="text-xl text-indigo-100">Registros Ilimitados</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">24/7</div>
                    <div class="text-xl text-indigo-100">Disponibilidade</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Pronto para começar?
            </h2>
            <p class="text-xl text-gray-600 mb-8">
                Cadastre-se agora e comece a gerenciar seus horários de forma profissional.
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-xl text-lg font-semibold">
                    <i class="fas fa-rocket mr-2"></i>
                    Criar Conta Gratuitamente
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-clock text-indigo-400 text-2xl mr-3"></i>
                        <span class="text-2xl font-bold">PontoCerto</span>
                    </div>
                    <p class="text-gray-400">
                        Sistema inteligente de registro de ponto para empresas modernas.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Sobre</a></li>
                        <li><a href="#" class="hover:text-white transition">Recursos</a></li>
                        <li><a href="#" class="hover:text-white transition">Preços</a></li>
                        <li><a href="#" class="hover:text-white transition">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Redes Sociais</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} PontoCerto. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Relógio em tempo real
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeElement = document.getElementById('currentTime');
            if (timeElement) {
                timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }

        updateClock();
        setInterval(updateClock, 1000);

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>