@extends('layouts.app')
@section('title', 'Editar Registro')
@section('content')
<style>
    .edit-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .edit-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .edit-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e8e8e8;
        margin-bottom: 24px;
    }

    .edit-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: #333;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #f5f5f5;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        color: #666;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .back-button:hover {
        background: #e0e0e0;
        color: #333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 500;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group textarea {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
        color: #333;
        background: #f9f9f9;
        transition: all 0.2s ease;
    }

    .form-group input[type="time"],
    .form-group input[type="date"] {
        font-family: 'Courier New', monospace;
    }

    .form-group textarea {
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #03a9f4;
        background: white;
        box-shadow: 0 0 0 3px rgba(3, 169, 244, 0.1);
    }

    .info-box {
        background: #e3f2fd;
        border-left: 4px solid #03a9f4;
        padding: 16px;
        border-radius: 6px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
    }

    .info-box-icon {
        font-size: 20px;
        flex-shrink: 0;
    }

    .info-box-content {
        flex: 1;
    }

    .info-box-title {
        font-weight: 600;
        color: #01579b;
        margin-bottom: 4px;
        font-size: 14px;
    }

    .info-box-text {
        color: #0277bd;
        font-size: 13px;
        line-height: 1.5;
    }

    .duration-display {
        background: #f5f5f5;
        padding: 12px 16px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .duration-label {
        font-size: 13px;
        color: #666;
        font-weight: 500;
    }

    .duration-value {
        font-family: 'Courier New', monospace;
        font-size: 18px;
        color: #4caf50;
        font-weight: 600;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid #e8e8e8;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel {
        background: #f5f5f5;
        color: #666;
    }

    .btn-cancel:hover {
        background: #e0e0e0;
        color: #333;
    }

    .btn-save {
        background: #4caf50;
        color: white;
    }

    .btn-save:hover {
        background: #388e3c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .error-message {
        background: #ffebee;
        border-left: 4px solid #f44336;
        padding: 12px 16px;
        border-radius: 6px;
        color: #c62828;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .success-message {
        background: #e8f5e9;
        border-left: 4px solid #4caf50;
        padding: 12px 16px;
        border-radius: 6px;
        color: #2e7d32;
        font-size: 14px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="edit-container">
    <a href="{{ route('clocks.index') }}" class="back-button">
        ← Voltar para lista
    </a>

    <div class="edit-card" style="margin-top: 20px;">
        <div class="edit-header">
            <h2>✏️ Editar Registro de Ponto</h2>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <strong>Erro ao salvar:</strong>
                <ul style="margin: 8px 0 0 20px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="info-box">
            <div class="info-box-icon">ℹ️</div>
            <div class="info-box-content">
                <div class="info-box-title">Editando registro</div>
                <div class="info-box-text">
                    Criado em {{ \Carbon\Carbon::parse($clock->created_at)->format('d/m/Y \à\s H:i') }}
                </div>
            </div>
        </div>

        <div class="duration-display" id="durationDisplay">
            <span class="duration-label">⏱️ Duração total:</span>
            <span class="duration-value" id="durationValue">--:--:--</span>
        </div>

        <form action="{{ route('clocks.update', $clock->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="date">📅 Data</label>
                    <input 
                        type="date" 
                        id="date" 
                        name="date" 
                        value="{{ old('date', \Carbon\Carbon::parse($clock->date)->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <!-- Espaçador -->
                </div>

                <div class="form-group">
                    <label for="clock_in">🕐 Horário de Entrada</label>
                    <input 
                        type="time" 
                        id="clock_in" 
                        name="clock_in" 
                        value="{{ old('clock_in', \Carbon\Carbon::parse($clock->clock_in)->format('H:i')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="clock_out">🕐 Horário de Saída</label>
                    <input 
                        type="time" 
                        id="clock_out" 
                        name="clock_out" 
                        value="{{ old('clock_out', \Carbon\Carbon::parse($clock->clock_out)->format('H:i')) }}"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label for="description">📝 Descrição</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        placeholder="O que você fez nesse período?"
                    >{{ old('description', $clock->description) }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('clocks.index') }}" class="btn btn-cancel">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-save">
                    💾 Salvar Alterações
                </button>
            </div>
        </form>
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
                totalMinutes += 24 * 60; // Adiciona 24h se passou da meia-noite
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

    // Calcula duração ao carregar a página
    calculateDuration();

    // Converte para datetime ao enviar o formulário
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const dateValue = document.getElementById('date').value;
        
        // Converte clock_in para datetime completo (YYYY-MM-DD HH:MM:SS)
        if (clockInInput.value && dateValue) {
            const hiddenIn = document.createElement('input');
            hiddenIn.type = 'hidden';
            hiddenIn.name = 'clock_in';
            hiddenIn.value = `${dateValue} ${clockInInput.value}:00`;
            this.appendChild(hiddenIn);
            clockInInput.removeAttribute('name');
        }

        // Converte clock_out para datetime completo (YYYY-MM-DD HH:MM:SS)
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