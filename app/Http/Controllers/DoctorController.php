<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    public function doctorList()
    {
        $datas = User::whereHas('roles', function ($query) {
            $query->where('name', ['dokter']);
        })->with(['doctorTitle'])->get();

        return view('cms.doctor.list.index', compact('datas'));
    }

    public function doctorTitleEdit(User $user)
    {
        return view('cms.doctor.list.partial.edit', compact('user'));
    }

    public function doctorTitleUpdate(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'front_title' => 'required|string|max:255',
            'back_title' => 'required|string|max:255',
            'specialist' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update doctor title has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user->doctorTitle()->update([
            'front_title' => $request->front_title,
            'back_title' => $request->back_title,
            'specialist' => $request->specialist
        ]);

        Alert::success('Success', 'Update doctor title has success.');
        return redirect()->route('doctors.list');
    }

    public function doctorSchedule()
    {
        $datas = DoctorSchedule::with(['doctor'])->get();

        return view('cms.doctor.schedule.index', compact('datas'));
    }

    public function doctorScheduleCreate()
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', ['dokter']);
        })->whereDoesntHave('doctorSchedule')->get();

        return view('cms.doctor.schedule.partial.create', compact('doctors'));
    }

    public function doctorScheduleStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'notes' => 'nullable',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add schedule doctor has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        DoctorSchedule::create([
            'user_id' => $request->user_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'notes' => $request->notes
        ]);

        Alert::success('Success', 'Add schedule doctor has success.');
        return redirect()->route('doctors.schedule');
    }

    public function doctorScheduleEdit(DoctorSchedule $schedule)
    {
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', ['dokter']);
        })->get();

        return view('cms.doctor.schedule.partial.edit', compact('schedule', 'doctors'));
    }

    public function doctorScheduleUpdate(Request $request, DoctorSchedule $schedule)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'notes' => 'nullable',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update schedule doctor has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $schedule->update([
            'user_id' => $request->user_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'notes' => $request->notes
        ]);

        Alert::success('Success', 'Update schedule doctor has success.');
        return redirect()->route('doctors.schedule');
    }

    public function doctorScheduleDelete(DoctorSchedule $schedule)
    {
        $schedule->delete();
        Alert::success('Success', 'Delete schedule doctor has success.');
        return redirect()->route('doctors.schedule');
    }
}
