<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Assignment;
use Illuminate\Support\Str;
use App\Models\Subjectmatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AssignmentRequest;

class AdminAssignmentController extends Controller
{
    //
    public function create()
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $subjects = Subjectmatter::get();
        return view('admin.tasks.assignment.create', compact('subjects'));
    }

    public function store(AssignmentRequest $request)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $attachment = $request->file('path');
        $attach = null;
        if ($attachment !== null) {
            $attach = $attachment->storeAs("assignment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
        }

        $assignment = Assignment::create([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'admin_id' => Auth::user()->admins[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'attachment' => 'public/' . $attach,
            'point' => $request->point,
            'due' => $request->due,
        ]);
        return redirect()->back()->with('success', 'lol');
    }

    public function show($idKelas, $id)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $assignment = Assignment::findOrFail($id);

        return view('admin.tasks.assignment.show', compact('assignment', 'idKelas'));
    }

    public function edit($classId, $id)
    {
        if (Gate::denies('manage-users')) {
            abort(403);
        }

        $point = [null => 'Ungraded', '100' => '100', '10' => '10'];

        $ass = Assignment::findOrFail($id);
        return view('admin.tasks.assignment.edit', compact('ass', 'classId', 'point'));
    }

    public function update(AssignmentRequest $request, $id)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        $title_slug = Str::slug(request('title'));
        $datetime = new DateTime();

        $ass = Assignment::findOrFail($id);

        $attachment = $request->file('path');
        $attach = null;
        if ($attachment !== null) {
            Storage::disk('local')->delete($ass->attachment);
            $attach = $attachment->storeAs("assignment", "{$title_slug}-{$datetime->format('Y-m-d-s')}.{$attachment->extension()}");
            $attach = 'public/' . $attach;
        } else {
            $attach = $ass->attachment;
        }

        $ass->update([
            'schoolclass_id' => $request->classId,
            'subjectmatter_id' => $request->subject,
            'admin_id' => Auth::user()->admins[0]->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'attachment' => $attach,
            'point' => $request->point,
            'due' => $request->due,
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    public function destroy($id)
    {
        //
        if (Gate::denies('manage-users')) {
            abort(403);
        }
        
        $ass = Assignment::findOrFail($id);
        $ass->delete();
        Storage::disk('local')->delete($ass->attachment);
        return redirect()->back()->with('success', 'lol');
    }
}
