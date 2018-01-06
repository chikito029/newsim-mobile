<?php

namespace App\Http\Controllers;

use App\Course;
use App\Branch;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::with(['branch', 'createdBy'])->get();
        $branches = Branch::all();

        return view('courses.index', compact('courses', 'branches'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|max:191',
            'description' => 'required|max:191',
            'duration' => 'required|min:1',
            'category' => 'required',
            'accredited_by' => 'required',
            'branch_id' => 'required',
        ]);

        Course::create([
            'code' => $request->code,
            'description' => $request->description,
            'duration' => $request->duration,
            'category' => $request->category,
            'accredited_by' => $request->accredited_by,
            'branch_id' => $request->branch_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        $branches = Branch::all();

        return view('courses.edit', compact('course', 'branches'));
    }

    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'code' => 'required|max:191',
            'description' => 'required|max:191',
            'duration' => 'required|min:1',
            'category' => 'required',
            'accredited_by' => 'required',
            'branch_id' => 'required',
        ]);

        $course->update([
            'code' => $request->code,
            'description' => $request->description,
            'duration' => $request->duration,
            'category' => $request->category,
            'accredited_by' => $request->accredited_by,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('courses.index');
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index');
    }
}
