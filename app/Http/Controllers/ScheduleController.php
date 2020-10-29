<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view("schedule/index", compact('schedules'));
    }

    public function create(Request $request)
    {
        $schedule = new Schedule();
        $schedule->place = $request['place'];
        $schedule->content = $request['content'];
        $schedule->begin = $request['begin'];
        $schedule->end = $request['end'];
        $schedule->save();

        return redirect()->route("schedule.index");
    }

    public function update(Request $request ,$schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id',$schedule_id)->first();
        $schedule->fill($request->all())->save();
        return redirect()->route("schedule.index");
    }

    public function edit($schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id', $schedule_id)->first();
        return view("schedule/update", compact('schedule'));
    }

    public function destroy($schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id', $schedule_id);
        $schedule->delete();
        return redirect()->route("schedule.index");
    }

    public function month(Request $request)
    {
        return view("schedule/month");
    }

    public function week(Request $request)
    {
        return view("schedule/week");
    }
}
