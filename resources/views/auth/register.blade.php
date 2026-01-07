<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - PontoCerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="animated-gradient min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo e Título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-2xl mb-4">
                <i class="fas fa-clock text-indigo-600 text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">PontoCerto</h1>
            <p class="text-white/90 text-lg">Crie sua conta gratuitamente</p>
        </div>

        <!-- Card de Cadastro -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Criar Conta</h2>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Nome -->
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-indigo-600 mr-2"></i>Nome Completo
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}"
                        required 
                        autofocus 
                        autocomplete="name"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 transition outline-none"
                        placeholder="João Silva"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-indigo-600 mr-2"></i>Email
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autocomplete="username"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 transition outline-none"
                        placeholder="seu@email.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Senha -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-indigo-600 mr-2"></i>Senha
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            oninput="checkPasswordStrength()"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 transition outline-none pr-12"
                            placeholder="Mínimo 8 caracteres"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password', 'toggleIcon1')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                        >
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <!-- Barra de força da senha -->
                    <div class="mt-2 flex gap-1">
                        <div id="strength1" class="strength-bar flex-1 bg-gray-200"></div>
                        <div id="strength2" class="strength-bar flex-1 bg-gray-200"></div>
                        <div id="strength3" class="strength-bar flex-1 bg-gray-200"></div>
                        <div id="strength4" class="strength-bar flex-1 bg-gray-200"></div>
                    </div>
                    <p id="strengthText" class="mt-1 text-xs text-gray-500"></p>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Senha -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-indigo-600 mr-2"></i>Confirmar Senha
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 transition outline-none pr-12"
                            placeholder="Digite a senha novamente"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                        >
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botão de Cadastro -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-[1.02] transition shadow-lg hover:shadow-xl"
                >
                    <i class="fas fa-rocket mr-2"></i>
                    Criar Conta
                </button>
            </form>

            <!-- Divisor -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">ou</span>
                </div>
            </div>

            <!-- Link para Login -->
            <div class="text-center">
                <p class="text-gray-600">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition">
                        Faça login
                    </a>
                </p>
            </div>
        </div>

        <!-- Link para voltar -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="inline-flex items-center text-white hover:text-white/80 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Voltar para o início
            </a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strength1 = document.getElementById('strength1');
            const strength2 = document.getElementById('strength2');
            const strength3 = document.getElementById('strength3');
            const strength4 = document.getElementById('strength4');
            const strengthText = document.getElementById('strengthText');
            
            // Reset
            [strength1, strength2, strength3, strength4].forEach(el => {
                el.style.backgroundColor = '#e5e7eb';
            });
            
            if (password.length === 0) {
                strengthText.textContent = '';
                return;
            }
            
            let strength = 0;
            
            // Critérios de força
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            // Aplicar cores
            const colors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e'];
            const texts = ['Fraca', 'Razoável', 'Boa', 'Forte'];
            
            if (strength >= 1) strength1.style.backgroundColor = colors[strength - 1];
            if (strength >= 2) strength2.style.backgroundColor = colors[strength - 1];
            if (strength >= 3) strength3.style.backgroundColor = colors[strength - 1];
            if (strength >= 4) strength4.style.backgroundColor = colors[strength - 1];
            
            strengthText.textContent = `Força da senha: ${texts[strength - 1]}`;
            strengthText.style.color = colors[strength - 1];
        }
    </script>
</body>
</html>