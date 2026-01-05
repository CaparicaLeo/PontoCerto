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
                        <p class="text-gray-500 text-sm">Total de Clocks</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->clocks->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-sign-in-alt text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Check-ins</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->clocks->where('type', 'in')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-sign-out-alt text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Check-outs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->clocks->where('type', 'out')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-hourglass-half text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Este Mês</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->clocks->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Clocks -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-history text-indigo-600 mr-2"></i>
                    Histórico de Registros
                </h2>
                <div class="flex space-x-3">
                    <input type="date" 
                           id="filterDate"
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <select id="filterType" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todos os tipos</option>
                        <option value="in">Check-in</option>
                        <option value="out">Check-out</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data/Hora
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Localização
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="clocksTableBody">
                        @forelse($user->clocks->sortByDesc('created_at') as $clock)
                        <tr class="hover:bg-gray-50 transition clock-row" 
                            data-date="{{ $clock->created_at->format('Y-m-d') }}" 
                            data-type="{{ $clock->type }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-day text-gray-400 mr-2"></i>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $clock->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $clock->created_at->format('H:i:s') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($clock->type === 'in')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Check-in
                                </span>
                                @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Check-out
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($clock->latitude && $clock->longitude)
                                    <a href="https://www.google.com/maps?q={{ $clock->latitude }},{{ $clock->longitude }}" 
                                       target="_blank" 
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Ver no mapa
                                    </a>
                                    @else
                                    <span class="text-gray-400">Não disponível</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Registrado
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewClockDetails({{ $clock->id }})" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-3" 
                                        title="Ver detalhes">
                                    <i class="fas fa-info-circle"></i>
                                </button>
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
                            <td colspan="5" class="px-6 py-12 text-center">
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

    <!-- Modal de Confirmação de Delete Usuário -->
    <div id="deleteUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar Exclusão do Usuário</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Tem certeza que deseja deletar o usuário <strong>{{ $user->name }}</strong>? 
                        Esta ação irá deletar todos os registros de ponto associados e não pode ser desfeita.
                    </p>
                </div>
                <div class="flex justify-center space-x-4 px-4 py-3">
                    <button onclick="closeUserModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <form id="deleteUserForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Deletar Usuário
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Delete Clock -->
    <div id="deleteClockModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirmar Exclusão do Registro</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Tem certeza que deseja deletar este registro de ponto? Esta ação não pode ser desfeita.
                    </p>
                </div>
                <div class="flex justify-center space-x-4 px-4 py-3">
                    <button onclick="closeClockModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <form id="deleteClockForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Deletar Registro
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filtro por data
        document.getElementById('filterDate').addEventListener('change', filterClocks);
        document.getElementById('filterType').addEventListener('change', filterClocks);

        function filterClocks() {
            const dateFilter = document.getElementById('filterDate').value;
            const typeFilter = document.getElementById('filterType').value;
            const rows = document.querySelectorAll('.clock-row');

            rows.forEach(row => {
                const rowDate = row.getAttribute('data-date');
                const rowType = row.getAttribute('data-type');

                let showRow = true;

                if (dateFilter && rowDate !== dateFilter) {
                    showRow = false;
                }

                if (typeFilter && rowType !== typeFilter) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }

        // Modal de confirmação de delete usuário
        function confirmDelete(userId) {
            const modal = document.getElementById('deleteUserModal');
            const form = document.getElementById('deleteUserForm');
            form.action = `/admin/dashboard/${userId}`;
            modal.classList.remove('hidden');
            modal.style.display = 'block';
        }

        function closeUserModal() {
            const modal = document.getElementById('deleteUserModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }

        // Modal de confirmação de delete clock
        function confirmDeleteClock(clockId) {
            const modal = document.getElementById('deleteClockModal');
            const form = document.getElementById('deleteClockForm');
            form.action = `/admin/clocks/${clockId}`;
            modal.classList.remove('hidden');
            modal.style.display = 'block';
        }

        function closeClockModal() {
            const modal = document.getElementById('deleteClockModal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }

        // Ver detalhes do clock
        function viewClockDetails(clockId) {
            // Implementar visualização de detalhes se necessário
            alert('Detalhes do clock ID: ' + clockId);
        }

        // Fechar modais ao clicar fora
        document.getElementById('deleteUserModal').addEventListener('click', function(e) {
            if (e.target === this) closeUserModal();
        });

        document.getElementById('deleteClockModal').addEventListener('click', function(e) {
            if (e.target === this) closeClockModal();
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeUserModal();
                closeClockModal();
            }
        });
    </script>
</body>
</html>