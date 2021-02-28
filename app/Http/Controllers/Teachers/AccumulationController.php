<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accumulation;

class AccumulationController extends Controller
{
    //
    public function index($idkelas, $idAss)
    {
        $assignment = Assignment::findOrFail($idAss);
        $ass = Accumulation::where('assignment_id', $idAss)->orderBy('created_at', 'desc')->paginate(5);

        return view('teacher.tasks.accumulation.index', compact('assignment', 'ass', 'idkelas'));
    }

    public function show($idkelas, $idAss, $id)
    {
        $assignment = Assignment::findOrFail($idAss);
        $ass = Accumulation::where('assignment_id', $idAss)->orderBy('created_at', 'desc')->paginate(5);
        $data = Accumulation::where('student_id', $id)->get();
        
        return view('teacher.tasks.accumulation.show', compact('assignment', 'ass', 'idkelas', 'data'));
    }
}
