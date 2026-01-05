<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        
        <!-- Nome -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-user text-indigo-500 mr-2"></i>
                {{ __('Nome') }}
            </label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition duration-200 outline-none" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Digite seu nome completo"
            />
            @error('name')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope text-indigo-500 mr-2"></i>
                {{ __('Email') }}
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition duration-200 outline-none" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username"
                placeholder="seu@email.com"
            />
            @error('email')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
            
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm text-yellow-800 font-medium">
                                {{ __('O seu email está sem verificação') }}
                            </p>
                            <button 
                                form="send-verification" 
                                class="mt-2 text-sm text-yellow-700 hover:text-yellow-900 underline font-semibold transition"
                            >
                                {{ __('Clique aqui para verificar seu email') }}
                            </button>
                        </div>
                    </div>
                </div>
                
                @if (session('status') === 'verification-link-sent')
                    <div class="mt-3 p-4 bg-green-50 border-l-4 border-green-400 rounded-r-lg">
                        <p class="text-sm text-green-800 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ __('Um novo link de verificação foi enviado ao seu email.') }}
                        </p>
                    </div>
                @endif
            @endif
        </div>

        <!-- Botão Salvar -->
        <div class="flex items-center gap-4 pt-4">
            <button 
                type="submit" 
                class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:ring-4 focus:ring-indigo-200 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <i class="fas fa-save mr-2"></i>
                {{ __('Salvar') }}
            </button>
            
            @if (session('status') === 'profile-updated')
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
</section>