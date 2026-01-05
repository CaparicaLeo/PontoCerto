@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header com gradiente -->
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-user-circle text-white text-4xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Meu Perfil
                </h1>
                <p class="text-gray-600">
                    Gerencie suas informações pessoais e configurações de segurança
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Sidebar com Menu -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-6">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-white text-3xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <nav class="space-y-2">
                            <a href="#profile-info" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition group">
                                <i class="fas fa-user mr-3 group-hover:scale-110 transition"></i>
                                <span class="font-medium">Informações</span>
                            </a>
                            <a href="#password" class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition group">
                                <i class="fas fa-lock mr-3 group-hover:scale-110 transition"></i>
                                <span class="font-medium">Senha</span>
                            </a>
                            <a href="#delete-account" class="flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition group">
                                <i class="fas fa-trash-alt mr-3 group-hover:scale-110 transition"></i>
                                <span class="font-medium">Excluir Conta</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Conteúdo Principal -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Update Profile Information -->
                    <div id="profile-info" class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:shadow-2xl transition">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-user-edit text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-white">
                                        Informações do Perfil
                                    </h2>
                                    <p class="text-indigo-100 text-sm">
                                        Atualize suas informações pessoais
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div id="password" class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:shadow-2xl transition">
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 px-8 py-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-key text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-white">
                                        Alterar Senha
                                    </h2>
                                    <p class="text-green-100 text-sm">
                                        Mantenha sua conta segura com uma senha forte
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div id="delete-account" class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:shadow-2xl transition">
                        <div class="bg-gradient-to-r from-red-500 to-pink-600 px-8 py-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-white">
                                        Excluir Conta
                                    </h2>
                                    <p class="text-red-100 text-sm">
                                        Exclua permanentemente sua conta e dados
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script para scroll suave -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
@endsection