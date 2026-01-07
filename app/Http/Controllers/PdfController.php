<?php
namespace App\Http\Controllers;
use App\Models\Clock;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class PdfController extends Controller
{
    public function generatePersonalPdf(User $user)
    {
        $clocks = Clock::where('user_id', $user->id)->get();
        
        if($clocks->isEmpty()) {
            return back()->with('error', 'Nenhum registro encontrado para gerar o PDF.');
        }
        
        $pdf = Pdf::loadView('pdf.personal-table', [
            'clocks' => $clocks,
            'user' => $user
        ])->setPaper('a4', 'portrait');
        
        return $pdf->stream('relatorio_pessoal_' . $user->name . '.pdf');
    }
}