<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedules = Schedule::get();
        return view('schedules.index', compact('schedules'));
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = Schedule::create([
            'course_name' => $request->course_name,
            'start_date' => $this->toDBDateString($request->start_date),
            'end_date' => $this->toDBDateString($request->end_date),
            'start_time' => $this->toDBTimeString($request->start_time),
            'end_time' => $this->toDBTimeString($request->end_time),
            'branch_id' => auth()->user()->branch_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('schedules.index');
    }

    public function show(Schedule $schedule)
    {
        return $schedule;
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule->update([
            'course_name' => $request->course_name,
            'start_date' => $this->toDBDateString($request->start_date),
            'end_date' => $this->toDBDateString($request->end_date),
            'start_time' => $this->toDBTimeString($request->start_time),
            'end_time' => $this->toDBTimeString($request->end_time),
        ]);

        return redirect()->route('schedules.index');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function toDBTimeString($time)
    {
        return \Carbon\Carbon::createFromFormat('g:i A', $time)->toTimeString();
    }

    public function toDBDateString($date)
    {
        return \Carbon\Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    }
}
