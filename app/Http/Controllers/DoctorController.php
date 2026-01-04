<?php

namespace App\Http\Controllers;

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
        $datas = User::whereHas('roles', function ($query) {
            $query->where('name', ['dokter']);
        })->with(['doctorSchedule'])->get();

        return view('cms.doctor.schedule.index', compact('datas'));
    }
}
