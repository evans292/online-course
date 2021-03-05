<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminTaskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $assignment = Assignment::where('schoolclass_id', $id)->latest()->paginate(5);
        $quiz = Quiz::where('schoolclass_id', $id)->latest()->paginate(5);
        // dd($datas[0]->accumulations->where('point', '===', null));
        return view('admin.tasks.index', compact('assignment', 'quiz'));
    }
}
