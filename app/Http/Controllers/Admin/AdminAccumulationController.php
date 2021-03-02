<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assignment;
use App\Models\Accumulation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminAccumulationController extends Controller
{
    //
    public function index($idkelas, $idAss)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        
        $assignment = Assignment::findOrFail($idAss);
        $ass = Accumulation::where('assignment_id', $idAss)->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.tasks.accumulation.index', compact('assignment', 'ass', 'idkelas'));
    }

    public function show($idkelas, $idAss, $idStudent, $idAcc)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $assignment = Assignment::findOrFail($idAss);
        $ass = Accumulation::where('assignment_id', $idAss)->orderBy('created_at', 'desc')->paginate(5);
        $data = Accumulation::where('student_id', $idStudent)->where('id', $idAcc)->get();

        return view('admin.tasks.accumulation.show', compact('assignment', 'ass', 'idkelas', 'data'));
    }

    public function download($classId, $assId, $studentId, $idAcc)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $data = Accumulation::where('student_id', $studentId)->where('id', $idAcc)->get();
        try {
            return Storage::disk('local')->download($data[0]->attachment);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }
    }

    public function updatePoint(Request $request, $classId, $assId, $studentId)
    {
        $request->validate([
            'point' => 'required'
        ]);

        Accumulation::where('student_id', $studentId)->update([
            'point' => $request->point,
        ]);

        return redirect()->back()->with('success', 'lol');
    }
}
