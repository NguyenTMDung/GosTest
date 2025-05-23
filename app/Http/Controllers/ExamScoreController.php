<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamScore;

class ExamScoreController extends Controller
{
    public function showForm()
    {
        return view('pages.checkScore'); 
    }

    public function check(Request $request)
    {
        // Validate trường sbd là bắt buộc và phải là số
        $request->validate([
            'sbd' => 'required|numeric',
        ]);

        // Tìm điểm theo sbd
        $score = ExamScore::where('sbd', $request->sbd)->first();

        if (!$score) {
            return back()->with('error', 'No score found for this registration number.')->withInput();
        }

        return view('pages.checkScore', compact('score'));
    }
}
