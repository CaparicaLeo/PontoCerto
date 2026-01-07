@extends('layouts.app')
@section('title', 'Registro de Ponto')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Card de Registro -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-white">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <div>
                            <h1 class="text-2xl font-bold">Registro de Ponto</h1>
                            <p class="text-indigo-100 text-sm mt-1">Gerencie seus horários de trabalho</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2 text-white">
                        <i class="fas fa-calendar-day mr-2"></i>
                        <input type="date" id="date" value="{{ now()->toDateString() }}"
                            class="bg-transparent border-none text-white font-semibold focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Timer Section -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <div id="timer" class="text-5xl font-light font-mono text-indigo-600 mb-2 tracking-wider">
                            00:00:00</div>
                        <span id="status"
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                            <span class="w-2 h-2 rounded-full bg-gray-400 mr-2"></span>
                            <span id="status-text">Pronto para iniciar</span>
                        </span>
                    </div>

                    <div class="flex gap-3">
                        <button id="start"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-lg flex items-center gap-2">
                            <i class="fas fa-play"></i> Iniciar
                        </button>
                        <button id="stop" disabled
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-lg flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-stop"></i> Parar
                        </button>
                        <button id="save" disabled
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow-lg flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Time Inputs -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sign-in-alt text-green-600 mr-2"></i>Horário de Entrada
                        </label>
                        <input type="time" id="clock_in" disabled
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-lg disabled:bg-gray-100 disabled:cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sign-out-alt text-red-600 mr-2"></i>Horário de Saída
                        </label>
                        <input type="time" id="clock_out" disabled
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-lg disabled:bg-gray-100 disabled:cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-purple-600 mr-2"></i>Descrição (Opcional)
                    </label>
                    <textarea id="description" rows="3" placeholder="O que você fez nesse período?"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"></textarea>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total de Registros</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $clocks->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Este Mês</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $clocks->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-hourglass-half text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Hoje</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $clocks->where('date', now()->toDateString())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Registros -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-history text-indigo-600 mr-2"></i>
                    Histórico de Registros
                </h2>
                <a href="{{ route('pdf.pessoal', $user->id) }}" class="btn btn-primary" target="_blank">
                    Imprimir Relatório PDF
                </a>
            </div>

            @if ($clocks->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Entrada</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Saída</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Duração</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descrição</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clocks as $clock)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-gray-400 mr-2"></i>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($clock->date)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm font-mono text-green-600 font-semibold">{{ \Carbon\Carbon::parse($clock->clock_in)->format('H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm font-mono text-red-600 font-semibold">{{ \Carbon\Carbon::parse($clock->clock_out)->format('H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-mono text-indigo-600 font-bold">
                                            @php
                                                $start = \Carbon\Carbon::parse($clock->clock_in);
                                                $end = \Carbon\Carbon::parse($clock->clock_out);
                                                $diff = $start->diff($end);
                                                echo sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
                                            @endphp
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-600 truncate max-w-xs block"
                                            title="{{ $clock->description }}">
                                            {{ $clock->description ?: '—' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('clocks.edit', $clock->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('clocks.destroy', $clock->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $clocks->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-clock text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg mb-2">Nenhum registro encontrado</p>
                    <p class="text-gray-400">Comece registrando seu primeiro ponto acima</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        let startTime = null;
        let interval = null;

        const timerEl = document.getElementById('timer');
        const statusEl = document.getElementById('status');
        const statusTextEl = document.getElementById('status-text');
        const startBtn = document.getElementById('start');
        const stopBtn = document.getElementById('stop');
        const saveBtn = document.getElementById('save');
        const dateInput = document.getElementById('date');
        const clockInInput = document.getElementById('clock_in');
        const clockOutInput = document.getElementById('clock_out');
        const descriptionInput = document.getElementById('description');

        function format(ms) {
            const totalSeconds = Math.floor(ms / 1000);
            const h = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            const m = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            const s = String(totalSeconds % 60).padStart(2, '0');
            return `${h}:${m}:${s}`;
        }

        function updateStatus(state, text, color) {
            statusEl.className = `inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${color}`;
            statusTextEl.textContent = text;
        }

        startBtn.onclick = () => {
            startTime = new Date();
            clockInInput.value = startTime.toTimeString().slice(0, 5);

            interval = setInterval(() => {
                const elapsed = new Date() - startTime;
                timerEl.innerText = format(elapsed);
            }, 1000);

            timerEl.className = 'text-5xl font-light font-mono text-green-600 mb-2 tracking-wider';
            updateStatus('running', 'Em execução', 'bg-green-100 text-green-800');

            startBtn.disabled = true;
            stopBtn.disabled = false;
            clockInInput.disabled = false;
        };

        stopBtn.onclick = () => {
            clearInterval(interval);
            const stopTime = new Date();
            clockOutInput.value = stopTime.toTimeString().slice(0, 5);

            timerEl.className = 'text-5xl font-light font-mono text-red-600 mb-2 tracking-wider';
            updateStatus('stopped', 'Parado - Pronto para salvar', 'bg-red-100 text-red-800');

            stopBtn.disabled = true;
            saveBtn.disabled = false;
            clockOutInput.disabled = false;
        };

        saveBtn.onclick = async () => {
            const payload = {
                date: dateInput.value,
                clock_in: clockInInput.value + ':00',
                clock_out: clockOutInput.value + ':00',
                description: descriptionInput.value || null,
            };

            try {
                const response = await fetch("{{ route('clocks.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload)
                });

                if (response.ok) {
                    updateStatus('idle', '✓ Salvo com sucesso!', 'bg-green-100 text-green-800');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    try {
                        const data = await response.json();
                        let errorMsg = 'Erro ao salvar:\n';
                        if (data.errors) {
                            Object.keys(data.errors).forEach(key => {
                                errorMsg += `${key}: ${data.errors[key].join(', ')}\n`;
                            });
                        } else {
                            errorMsg += data.message || 'Tente novamente';
                        }
                        alert(errorMsg);
                    } catch (e) {
                        alert('Erro ao salvar. Verifique os dados e tente novamente.');
                    }
                }
            } catch (error) {
                alert('Erro ao salvar o registro. Verifique sua conexão.');
            }
        };

        // Atualizar dot do status
        const updateStatusDot = () => {
            const dot = statusEl.querySelector('.w-2');
            if (dot) {
                if (statusTextEl.textContent.includes('execução')) {
                    dot.className = 'w-2 h-2 rounded-full bg-green-500 animate-pulse';
                } else if (statusTextEl.textContent.includes('Parado')) {
                    dot.className = 'w-2 h-2 rounded-full bg-red-500';
                } else {
                    dot.className = 'w-2 h-2 rounded-full bg-gray-400';
                }
            }
        };

        const originalUpdateStatus = updateStatus;
        updateStatus = function(state, text, color) {
            originalUpdateStatus(state, text, color);
            setTimeout(updateStatusDot, 0);
        };
    </script>
@endsection
