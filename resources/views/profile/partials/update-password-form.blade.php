<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')
        
        <!-- Senha Atual -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock text-green-500 mr-2"></i>
                {{ __('Senha Atual') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition duration-200 outline-none" 
                    autocomplete="current-password"
                    placeholder="Digite sua senha atual"
                />
                <button 
                    type="button" 
                    onclick="togglePassword('update_password_current_password')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                >
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Nova Senha -->
        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-key text-green-500 mr-2"></i>
                {{ __('Nova Senha') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition duration-200 outline-none" 
                    autocomplete="new-password"
                    placeholder="Digite sua nova senha"
                />
                <button 
                    type="button" 
                    onclick="togglePassword('update_password_password')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                >
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Use pelo menos 8 caracteres com letras maiúsculas, minúsculas e números
            </p>
        </div>

        <!-- Confirmar Senha -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-check-double text-green-500 mr-2"></i>
                {{ __('Confirmar Senha') }}
            </label>
            <div class="relative">
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition duration-200 outline-none" 
                    autocomplete="new-password"
                    placeholder="Confirme sua nova senha"
                />
                <button 
                    type="button" 
                    onclick="togglePassword('update_password_password_confirmation')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                >
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Botão Salvar -->
        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit" 
                class="px-6 py-3 bg-gradient-to-r from-green-500 to-teal-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-teal-700 focus:ring-4 focus:ring-green-200 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <i class="fas fa-shield-alt mr-2"></i>
                {{ __('Salvar') }}
            </button>
            
            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center text-green-600 bg-green-50 px-4 py-2 rounded-lg"
                >
                    <i class="fas fa-check-circle mr-2"></i>
                    <span class="text-sm font-medium">{{ __('Salvo.') }}</span>
                </div>
            @endif
        </div>
    </form>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = event.currentTarget.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</section>