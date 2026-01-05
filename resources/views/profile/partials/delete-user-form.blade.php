<section class="space-y-6">
    <!-- Alerta de Aviso -->
    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-4 mt-1"></i>
            <div>
                <h3 class="text-lg font-bold text-red-900 mb-2">
                    Zona de Perigo
                </h3>
                <p class="text-sm text-red-800 leading-relaxed">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Formulário de Exclusão -->
    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock text-red-500 mr-2"></i>
                {{ __('Password') }}
            </label>
            <div class="relative">
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-100 transition duration-200 outline-none" 
                    placeholder="Digite sua senha para confirmar"
                    required
                />
                <button 
                    type="button" 
                    onclick="togglePasswordDelete()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                >
                    <i class="fas fa-eye" id="password-icon"></i>
                </button>
            </div>
            @error('password', 'userDeletion')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
            <p class="mt-2 text-xs text-red-600">
                <i class="fas fa-info-circle mr-1"></i>
                Esta ação é permanente e não pode ser desfeita
            </p>
        </div>

        <!-- Botão de Excluir -->
        <button
            type="submit"
            onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')"
            class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-700 focus:ring-4 focus:ring-red-200 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
        >
            <i class="fas fa-trash-alt mr-2"></i>
            {{ __('Delete Account') }}
        </button>
    </form>

    <script>
        function togglePasswordDelete() {
            const input = document.getElementById('password');
            const icon = document.getElementById('password-icon');
            
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