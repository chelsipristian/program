<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Student; // Ganti model ke Student
use Illuminate\Support\Facades\View;

class PdfStudentController extends Controller
{
    public function generatePdf()
    {
        $students = Student::all(); // Ambil semua data student

        // Render view ke dalam HTML
        $html = View::make('pdf.student', compact('students'))->render();

        // Buat objek Dompdf
        $pdf = new Dompdf();

        // Memasukkan HTML ke dalam Dompdf
        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Menghasilkan dan mengunduh PDF dengan nama tertentu
        return $pdf->stream('laporan-student.pdf');
    }
}
