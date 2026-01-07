{{-- resources/views/admin/show.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detalhes do Usuário - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <i class="fas fa-shield-alt text-indigo-600 text-2xl mr-3"></i>
                    <span class="text-xl font-bold text-gray-800">Admin Panel</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <div class="flex">
                <i class="fas fa-check-circle mr-2 mt-1"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
            <div class="flex">
                <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- Informações do Usuário -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center text-indigo-600 font-bold text-3xl shadow-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="ml-6 text-white">
                            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                            <p class="text-indigo-100 mt-1">{{ $user->email }}</p>
                            <div class="flex items-center mt-2 space-x-3">
                                <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm">
                                    <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($user->role) }}
                                </span>
                                <span class="px-3 py-1 bg-green-500 rounded-full text-sm">
                                    <i class="fas fa-circle text-xs mr-1"></i>Ativo
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Tem certeza que deseja deletar este usuário? Esta ação não pode ser desfeita.')"
                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition shadow-lg">
                                <i class="fas fa-trash mr-2"></i>Deletar Usuário
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Detalhes -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border-l-4 border-indigo-500 pl-4">
                        <p class="text-gray-500 text-sm">ID do Usuário</p>
                        <p class="text-gray-900 font-mono text-sm mt-1">{{ $user->id }}</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-4">
                        <p class="text-gray-500 text-sm">Cadastrado em</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <p class="text-gray-500 text-sm">Última atualização</p>
                        <p class="text-gray-900 font-semibold mt-1">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas de Clocks -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total de Registros</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->clocks->count() }}</p>
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
                            {{ $user->clocks->filter(function($clock) {
                                return \Carbon\Carbon::parse($clock->date)->isCurrentMonth();
                            })->count() }}
                        </p>
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
                            {{ $user->clocks->where('date', now()->toDateString())->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-business-time text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Horas Totais</p>
                        <p class="text-2xl font-bold text-gray-900">
                            @php
                                $totalMinutes = 0;
                                foreach($user->clocks as $clock) {
                                    $start = \Carbon\Carbon::parse($clock->clock_in);
                                    $end = \Carbon\Carbon::parse($clock->clock_out);
                                    $totalMinutes += $start->diffInMinutes($end);
                                }
                                $hours = floor($totalMinutes / 60);
                                echo $hours . 'h';
                            @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Clocks -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-history text-indigo-600 mr-2"></i>
                    Histórico de Registros
                </h2>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="date" 
                           id="filterDate"
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <input type="text"
                           id="searchDescription"
                           placeholder="Buscar descrição..."
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Entrada
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Saída
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duração
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descrição
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Criado em
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Atualizado em
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="clocksTableBody">
                        @forelse($user->clocks->sortByDesc('date') as $clock)
                        <tr class="hover:bg-gray-50 transition clock-row" 
                            data-date="{{ $clock->date }}" 
                            data-description="{{ strtolower($clock->description ?? '') }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs font-mono text-gray-500" title="{{ $clock->id }}">
                                    {{ substr($clock->id, 0, 8) }}...
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-day text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($clock->date)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-mono text-green-600 font-semibold">
                                    {{ \Carbon\Carbon::parse($clock->clock_in)->format('H:i:s') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-mono text-red-600 font-semibold">
                                    {{ \Carbon\Carbon::parse($clock->clock_out)->format('H:i:s') }}
                                </span>
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
                            <td class="px-6 py-4 max-w-xs">
                                @if($clock->description)
                                <div class="text-sm text-gray-600 truncate" title="{{ $clock->description }}">
                                    {{ $clock->description }}
                                </div>
                                @else
                                <span class="text-sm text-gray-400 italic">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-500">
                                    {{ $clock->created_at->format('d/m/Y') }}
                                    <div class="text-xs text-gray-400">{{ $clock->created_at->format('H:i') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-500">
                                    {{ $clock->updated_at->format('d/m/Y') }}
                                    <div class="text-xs text-gray-400">{{ $clock->updated_at->format('H:i') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ route('admin.clocks.destroy', $clock->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Tem certeza que deseja deletar este registro?')"
                                            class="text-red-600 hover:text-red-900" 
                                            title="Deletar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <i class="fas fa-clock text-gray-300 text-4xl mb-3"></i>
                                <p class="text-gray-500">Nenhum registro de ponto encontrado</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Filtro por data e descrição
        document.getElementById('filterDate').addEventListener('change', filterClocks);
        document.getElementById('searchDescription').addEventListener('input', filterClocks);

        function filterClocks() {
            const dateFilter = document.getElementById('filterDate').value;
            const searchFilter = document.getElementById('searchDescription').value.toLowerCase();
            const rows = document.querySelectorAll('.clock-row');

            rows.forEach(row => {
                const rowDate = row.getAttribute('data-date');
                const rowDescription = row.getAttribute('data-description');

                let showRow = true;

                if (dateFilter && rowDate !== dateFilter) {
                    showRow = false;
                }

                if (searchFilter && !rowDescription.includes(searchFilter)) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }
    </script>
</body>
</html>