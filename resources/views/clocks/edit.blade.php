@extends('layouts.app')
@section('title', 'Editar Registro')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botão Voltar -->
    <a href="{{ route('clocks.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition mb-6">
        <i class="fas fa-arrow-left"></i>
        Voltar para lista
    </a>

    <!-- Card de Edição -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-6">
            <div class="flex items-center text-white">
                <i class="fas fa-edit text-3xl mr-3"></i>
                <div>
                    <h1 class="text-2xl font-bold">Editar Registro de Ponto</h1>
                    <p class="text-indigo-100 text-sm mt-1">Atualize as informações do seu registro</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Alertas -->
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <div class="flex">
                    <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
                    <div>
                        <p class="font-bold">Erro ao salvar:</p>
                        <ul class="mt-2 ml-4 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <div class="flex">
                    <i class="fas fa-check-circle mr-2 mt-1"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- Info Box -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                <div class="flex">
                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
                    <div>
                        <p class="font-semibold text-blue-900 text-sm">Editando registro</p>
                        <p class="text-blue-700 text-sm mt-1">
                            Criado em {{ \Carbon\Carbon::parse($clock->created_at)->format('d/m/Y \à\s H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Duração Display -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-hourglass-half text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Duração Total</p>
                        <p id="durationValue" class="text-2xl font-bold font-mono text-green-600">--:--:--</p>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <form action="{{ route('clocks.update', $clock->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Data -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar text-indigo-600 mr-2"></i>Data
                        </label>
                        <input 
                            type="date" 
                            id="date" 
                            name="date" 
                            value="{{ old('date', \Carbon\Carbon::parse($clock->date)->format('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono"
                        >
                    </div>

                    <!-- Espaço vazio -->
                    <div></div>

                    <!-- Horário de Entrada -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sign-in-alt text-green-600 mr-2"></i>Horário de Entrada
                        </label>
                        <input 
                            type="time" 
                            id="clock_in" 
                            name="clock_in" 
                            value="{{ old('clock_in', \Carbon\Carbon::parse($clock->clock_in)->format('H:i')) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-lg"
                        >
                    </div>

                    <!-- Horário de Saída -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sign-out-alt text-red-600 mr-2"></i>Horário de Saída
                        </label>
                        <input 
                            type="time" 
                            id="clock_out" 
                            name="clock_out" 
                            value="{{ old('clock_out', \Carbon\Carbon::parse($clock->clock_out)->format('H:i')) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-lg"
                        >
                    </div>
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-purple-600 mr-2"></i>Descrição
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        placeholder="O que você fez nesse período?"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                    >{{ old('description', $clock->description) }}</textarea>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col-reverse sm:flex-row gap-3 justify-end pt-6 border-t border-gray-200">
                    <a href="{{ route('clocks.index') }}" 
                       class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-lg flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const clockInInput = document.getElementById('clock_in');
    const clockOutInput = document.getElementById('clock_out');
    const durationValue = document.getElementById('durationValue');

    function calculateDuration() {
        const clockIn = clockInInput.value;
        const clockOut = clockOutInput.value;

        if (clockIn && clockOut) {
            const [inHour, inMin] = clockIn.split(':').map(Number);
            const [outHour, outMin] = clockOut.split(':').map(Number);

            let totalMinutes = (outHour * 60 + outMin) - (inHour * 60 + inMin);
            
            if (totalMinutes < 0) {
                totalMinutes += 24 * 60;
            }

            const hours = Math.floor(totalMinutes / 60);
            const minutes = totalMinutes % 60;

            durationValue.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:00`;
        } else {
            durationValue.textContent = '--:--:--';
        }
    }

    clockInInput.addEventListener('change', calculateDuration);
    clockOutInput.addEventListener('change', calculateDuration);

    // Calcula duração ao carregar
    calculateDuration();

    // Converte para datetime ao enviar
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const dateValue = document.getElementById('date').value;
        
        if (clockInInput.value && dateValue) {
            const hiddenIn = document.createElement('input');
            hiddenIn.type = 'hidden';
            hiddenIn.name = 'clock_in';
            hiddenIn.value = `${dateValue} ${clockInInput.value}:00`;
            this.appendChild(hiddenIn);
            clockInInput.removeAttribute('name');
        }

        if (clockOutInput.value && dateValue) {
            const hiddenOut = document.createElement('input');
            hiddenOut.type = 'hidden';
            hiddenOut.name = 'clock_out';
            hiddenOut.value = `${dateValue} ${clockOutInput.value}:00`;
            this.appendChild(hiddenOut);
            clockOutInput.removeAttribute('name');
        }
    });
</script>
@endsection