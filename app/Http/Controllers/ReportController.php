<?php

namespace App\Http\Controllers;
use App\Models\ExamScore;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report()
    {
        $subjects = ['toan', 'ngu_van', 'ngoai_ngu', 'vat_li', 'hoa_hoc', 'sinh_hoc', 'lich_su', 'dia_li', 'gdcd'];

        // Phân loại điểm
        $scoreLevels = [];
        foreach ($subjects as $subject) {
            $scoreLevels[$subject] = [
                '>=8' => ExamScore::where($subject, '>=', 8)->count(),
                '6-8' => ExamScore::where($subject, '<', 8)->where($subject, '>=', 6)->count(),
                '4-6' => ExamScore::where($subject, '<', 6)->where($subject, '>=', 4)->count(),
                '<4'  => ExamScore::where($subject, '<', 4)->count(),
            ];
        }

        // Top 10 học sinh nhóm A (toán, lý, hóa)
        $topStudents = ExamScore::select('sbd', 'toan', 'vat_li', 'hoa_hoc')
            ->orderByRaw('(toan + vat_li + hoa_hoc) DESC')
            ->limit(10)
            ->get();

        return view('pages.report', compact('scoreLevels', 'topStudents'));
    }

}
