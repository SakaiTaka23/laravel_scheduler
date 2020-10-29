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
        dd($request);
        //リダイレクト
        return view("schedule/create");
    }

    public function edit()
    {
        return view("schedule/create");
    }

    public function update_form()
    {
        return view("schedule/update");
    }

    public function update(Request $request)
    {
        //リダイレクト
        return view("schedule/update");
    }

    public function destroy(Request $request)
    {
        //リダイレクト
        return view("schedule/destroy");
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
