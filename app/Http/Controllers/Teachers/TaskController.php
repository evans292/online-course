<?php

namespace App\Http\Controllers\Teachers;

use Carbon\Carbon;
use App\Models\Assignment;
use App\Models\Schoolclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
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
        if (Gate::denies('manage-courses')) {
            abort(403);
        }

        $datas = Assignment::where('schoolclass_id', $id)->latest()->paginate(5);
        // dd(Carbon::now()->addDay()->format('Y-m-d'));
        // dd(Carbon::now()->format('Y-m-d') === $datas[0]->due->format('Y-m-d'));
        return view('teacher.tasks.index', compact('datas'));
    }
}
