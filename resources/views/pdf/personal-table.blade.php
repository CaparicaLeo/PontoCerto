<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório de Registros - PontoCerto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            background: #ffffff;
        }
        
        .header {
            background: #4f46e5;
            color: white;
            padding: 25px 30px;
            margin-bottom: 20px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo-section {
            flex: 1;
        }
        
        .brand-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .report-title {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .user-info {
            text-align: right;
            background: rgba(255, 255, 255, 0.15);
            padding: 12px 20px;
            border-radius: 8px;
        }
        
        .user-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 3px;
        }
        
        .user-email {
            font-size: 11px;
            opacity: 0.9;
        }
        
        .info-bar {
            background: #f3f4f6;
            padding: 12px 30px;
            margin-bottom: 20px;
            border-left: 4px solid #4f46e5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 13px;
            font-weight: bold;
            color: #4f46e5;
        }
        
        .content {
            padding: 0 30px 30px 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #e5e7eb;
        }
        
        thead {
            background: #f9fafb;
            border-bottom: 2px solid #4f46e5;
        }
        
        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #374151;
            border-bottom: 2px solid #4f46e5;
        }
        
        tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:last-child {
            border-bottom: none;
        }
        
        td {
            padding: 10px;
            font-size: 10px;
            color: #374151;
            vertical-align: middle;
        }
        
        .date-cell {
            font-weight: 600;
            color: #1f2937;
        }
        
        .time-cell {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #4f46e5;
        }
        
        .type-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .type-entrada {
            background: #dcfce7;
            color: #166534;
        }
        
        .type-saida {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .footer {
            margin-top: 30px;
            padding: 15px 30px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            font-size: 9px;
            color: #6b7280;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        @media print {
            .header {
                background: #4f46e5;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            tbody tr:nth-child(even) {
                background-color: #f9fafb;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .type-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="brand-name">PontoCerto</div>
                <div class="report-title">Relatório de Registros de Ponto</div>
            </div>
            <div class="user-info">
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-email">{{ $user->email }}</div>
            </div>
        </div>
    </div>
    
    <div class="info-bar">
        <div class="info-item">
            <span class="info-label">Total de Registros:</span>
            <span class="info-value">{{ count($clocks) }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Data de Geração:</span>
            <span class="info-value">{{ date('d/m/Y H:i') }}</span>
        </div>
    </div>
    
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">Data</th>
                    <th style="width: 12%;">Entrada</th>
                    <th style="width: 12%;">Saída</th>
                    <th style="width: 12%;">Total</th>
                    <th>Descrição</th>
                    <th style="width: 15%;">Registrado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clocks as $clock)
                    @php
                        $totalHours = null;
                        if ($clock->clock_in && $clock->clock_out) {
                            $clockIn = \Carbon\Carbon::parse($clock->clock_in);
                            $clockOut = \Carbon\Carbon::parse($clock->clock_out);
                            $diff = $clockIn->diff($clockOut);
                            $totalHours = sprintf('%02d:%02d:%02d', $diff->h + ($diff->days * 24), $diff->i, $diff->s);
                        }
                    @endphp
                    <tr>
                        <td class="date-cell">
                            {{ \Carbon\Carbon::parse($clock->date)->format('d/m/Y') }}
                        </td>
                        <td class="time-cell">
                            @if($clock->clock_in)
                                {{ \Carbon\Carbon::parse($clock->clock_in)->format('H:i:s') }}
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                        </td>
                        <td class="time-cell">
                            @if($clock->clock_out)
                                {{ \Carbon\Carbon::parse($clock->clock_out)->format('H:i:s') }}
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                        </td>
                        <td class="time-cell" style="color: #059669; font-weight: bold;">
                            {{ $totalHours ?? '-' }}
                        </td>
                        <td>
                            {{ $clock->description ?? '-' }}
                        </td>
                        <td style="font-size: 9px; color: #9ca3af;">
                            {{ \Carbon\Carbon::parse($clock->created_at)->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <div class="footer-content">
            <div>© {{ date('Y') }} PontoCerto - Sistema de Registro de Ponto</div>
            <div>Relatório gerado automaticamente</div>
        </div>
    </div>
</body>
</html>