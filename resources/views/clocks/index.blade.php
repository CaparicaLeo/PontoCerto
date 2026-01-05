@extends('layouts.app')
@section('title', 'Registro de Ponto')
@section('content')
<style>
    .time-tracker-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .tracker-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 24px;
        margin-bottom: 24px;
    }

    .tracker-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 20px;
        border-bottom: 1px solid #e8e8e8;
        margin-bottom: 20px;
    }

    .tracker-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    .date-display {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 14px;
    }

    .timer-section {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 0;
    }

    .timer-display {
        font-size: 48px;
        font-weight: 300;
        font-family: 'Courier New', monospace;
        color: #03a9f4;
        min-width: 200px;
        letter-spacing: 2px;
    }

    .timer-display.running {
        color: #4caf50;
    }

    .control-buttons {
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-start {
        background: #03a9f4;
        color: white;
    }

    .btn-start:hover:not(:disabled) {
        background: #0288d1;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(3, 169, 244, 0.3);
    }

    .btn-stop {
        background: #f44336;
        color: white;
    }

    .btn-stop:hover:not(:disabled) {
        background: #d32f2f;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
    }

    .btn-save {
        background: #4caf50;
        color: white;
    }

    .btn-save:hover:not(:disabled) {
        background: #388e3c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .btn-small {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-edit {
        background: #ff9800;
        color: white;
    }

    .btn-edit:hover {
        background: #f57c00;
    }

    .btn-delete {
        background: #f44336;
        color: white;
    }

    .btn-delete:hover {
        background: #d32f2f;
    }

    .time-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #e8e8e8;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .input-group label {
        font-size: 13px;
        font-weight: 500;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-group input, .input-group textarea {
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 15px;
        color: #333;
        background: #f9f9f9;
        transition: all 0.2s ease;
    }

    .input-group textarea {
        font-family: inherit;
        resize: vertical;
        min-height: 60px;
    }

    .input-group input[type="time"] {
        font-family: 'Courier New', monospace;
    }

    .input-group input:focus, .input-group textarea:focus {
        outline: none;
        border-color: #03a9f4;
        background: white;
        box-shadow: 0 0 0 3px rgba(3, 169, 244, 0.1);
    }

    .input-group input:disabled {
        background: #f5f5f5;
        cursor: not-allowed;
    }

    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-indicator.idle {
        background: #e0e0e0;
        color: #666;
    }

    .status-indicator.running {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-indicator.stopped {
        background: #ffebee;
        color: #c62828;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-indicator.running .status-dot {
        animation: pulse 1.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Lista de Registros */
    .records-section {
        margin-top: 32px;
    }

    .records-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .records-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .records-count {
        font-size: 14px;
        color: #666;
        background: #f5f5f5;
        padding: 4px 12px;
        border-radius: 12px;
    }

    .records-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .records-table thead {
        background: #f9f9f9;
        border-bottom: 2px solid #e8e8e8;
    }

    .records-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .records-table td {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        color: #333;
    }

    .records-table tbody tr {
        transition: background 0.2s ease;
    }

    .records-table tbody tr:hover {
        background: #fafafa;
    }

    .time-cell {
        font-family: 'Courier New', monospace;
        color: #03a9f4;
        font-weight: 500;
    }

    .duration-cell {
        font-family: 'Courier New', monospace;
        color: #4caf50;
        font-weight: 600;
    }

    .description-cell {
        color: #666;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .empty-state-subtext {
        font-size: 14px;
        color: #bbb;
    }

    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .timer-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .timer-display {
            font-size: 36px;
        }

        .time-inputs {
            grid-template-columns: 1fr;
        }

        .records-table {
            font-size: 12px;
        }

        .records-table th,
        .records-table td {
            padding: 8px;
        }

        .actions-cell {
            flex-direction: column;
        }
    }
</style>

<div class="time-tracker-container">
    <!-- Card de Registro -->
    <div class="tracker-card">
        <div class="tracker-header">
            <h2>⏱️ Registro de Ponto</h2>
            <div class="date-display">
                <span>📅</span>
                <input type="date" id="date" value="{{ now()->toDateString() }}" 
                       style="border: none; font-size: 14px; color: #666; background: transparent;">
            </div>
        </div>

        <div class="timer-section">
            <div>
                <div id="timer" class="timer-display">00:00:00</div>
                <span id="status" class="status-indicator idle">
                    <span class="status-dot"></span>
                    <span id="status-text">Pronto para iniciar</span>
                </span>
            </div>
            
            <div class="control-buttons">
                <button id="start" class="btn btn-start">▶️ Iniciar</button>
                <button id="stop" class="btn btn-stop" disabled>⏹️ Parar</button>
                <button id="save" class="btn btn-save" disabled>💾 Salvar</button>
            </div>
        </div>

        <div class="time-inputs">
            <div class="input-group">
                <label>🕐 Horário de Entrada</label>
                <input type="time" id="clock_in" disabled>
            </div>
            <div class="input-group">
                <label>🕐 Horário de Saída</label>
                <input type="time" id="clock_out" disabled>
            </div>
        </div>

        <div class="time-inputs" style="grid-template-columns: 1fr; margin-top: 16px; padding-top: 0;">
            <div class="input-group">
                <label>📝 Descrição (Opcional)</label>
                <textarea id="description" placeholder="O que você fez nesse período?"></textarea>
            </div>
        </div>
    </div>

    <!-- Lista de Registros -->
    <div class="tracker-card">
        <div class="records-section">
            <div class="records-header">
                <h3>📋 Histórico de Registros</h3>
                <span class="records-count">{{ $clocks->total() }} registro(s)</span>
            </div>

            @if($clocks->count() > 0)
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Duração</th>
                            <th>Descrição</th>
                            <th style="text-align: right;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clocks as $clock)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($clock->date)->format('d/m/Y') }}</td>
                                <td class="time-cell">{{ \Carbon\Carbon::parse($clock->clock_in)->format('H:i') }}</td>
                                <td class="time-cell">{{ \Carbon\Carbon::parse($clock->clock_out)->format('H:i') }}</td>
                                <td class="duration-cell">
                                    @php
                                        $start = \Carbon\Carbon::parse($clock->clock_in);
                                        $end = \Carbon\Carbon::parse($clock->clock_out);
                                        $diff = $start->diff($end);
                                        echo sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s);
                                    @endphp
                                </td>
                                <td class="description-cell" title="{{ $clock->description }}">
                                    {{ $clock->description ?: '—' }}
                                </td>
                                <td class="actions-cell">
                                    <a href="{{ route('clocks.edit', $clock->id) }}" class="btn btn-small btn-edit">✏️ Editar</a>
                                    <form action="{{ route('clocks.destroy', $clock->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-small btn-delete">🗑️ Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    {{ $clocks->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">⏱️</div>
                    <div class="empty-state-text">Nenhum registro encontrado</div>
                    <div class="empty-state-subtext">Comece registrando seu primeiro ponto acima</div>
                </div>
            @endif
        </div>
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

    function updateStatus(state, text) {
        statusEl.className = `status-indicator ${state}`;
        statusTextEl.textContent = text;
    }

    startBtn.onclick = () => {
        startTime = new Date();
        clockInInput.value = startTime.toTimeString().slice(0, 5);
        
        interval = setInterval(() => {
            const elapsed = new Date() - startTime;
            timerEl.innerText = format(elapsed);
        }, 1000);

        timerEl.classList.add('running');
        updateStatus('running', 'Em execução');
        
        startBtn.disabled = true;
        stopBtn.disabled = false;
        clockInInput.disabled = false;
    };

    stopBtn.onclick = () => {
        clearInterval(interval);
        const stopTime = new Date();
        clockOutInput.value = stopTime.toTimeString().slice(0, 5);

        timerEl.classList.remove('running');
        updateStatus('stopped', 'Parado - Pronto para salvar');
        
        stopBtn.disabled = true;
        saveBtn.disabled = false;
        clockOutInput.disabled = false;
    };

    saveBtn.onclick = async () => {
        // Envia HH:mm:ss conforme esperado pela validação 'time'
        const payload = {
            date: dateInput.value,
            clock_in: clockInInput.value + ':00',  // Formato HH:mm:ss
            clock_out: clockOutInput.value + ':00', // Formato HH:mm:ss
            description: descriptionInput.value || null,
        };

        console.log('Enviando payload:', payload); // Debug

        try {
            const response = await fetch("{{ route('clocks.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json', // Importante para receber JSON de volta
                },
                body: JSON.stringify(payload)
            });

            console.log('Status da resposta:', response.status); // Debug

            if (response.ok) {
                updateStatus('idle', '✓ Salvo com sucesso!');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                // Tenta ler a resposta como JSON
                try {
                    const data = await response.json();
                    console.error('Erro de validação:', data);
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
            console.error('Erro na requisição:', error);
            alert('Erro ao salvar o registro. Verifique sua conexão.');
        }
    };
</script>
@endsection