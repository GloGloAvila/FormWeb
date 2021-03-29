<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Exports\ReporteMensualExport;
use App\Models\Periodo;
use App\Models\Reporte;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Periodo  $periodo
     */
    public function exportReporteMensualExcel(Periodo  $periodo)
    {
        return Excel::download(new ReporteMensualExport($periodo), 'reporteMensual.xlsx');
    }

    public function ImportPersonas(Request $request){
        Excel::import(new PersonasImport, $request->file('file'));
    
        return redirect()->route('/');
    }

}
