<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Registration::all();

        return view('cms.registration.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schedules = DoctorSchedule::all();

        return view('cms.registration.partial.create', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'doctor_schedule_id' => 'required',
            'complaint_initial' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Registration has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $patientId = auth()->user()->id;
        $dateNow = Carbon::now()->format('Y-m-d');

        $lastQueue = Registration::where('doctor_schedule_id', $request->doctor_schedule_id)
            ->where('registration_date', $dateNow)
            ->lockForUpdate()
            ->max('queue_number');

        $newQueueNumber = $lastQueue ? $lastQueue + 1 : 1;

        $regCode = 'REG-' . Carbon::now()->format('Ymd') . '-' . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

        Registration::create([
            'registration_code' => $regCode,
            'patient_id' => $patientId,
            'doctor_schedule_id' => $request->doctor_schedule_id,
            'registration_date' => $dateNow,
            'queue_number' => $newQueueNumber,
            'complaint_initial' => $request->complaint_initial,
            'status' => 'pending',
        ]);

        Alert::success('Success', 'Registration has been created successfully.');
        return redirect()->route('registrations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Registration::findOrFail($id);
        $schedules = DoctorSchedule::all();

        return view('cms.registration.partial.edit', compact(['data', 'schedules']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_schedule_id' => 'required',
            'complaint_initial' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Fail', 'Update registration has failed. Check your input data.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Registration::findOrFail($id);

        $data->update([
            'doctor_schedule_id' => $request->doctor_schedule_id,
            'complaint_initial' => $request->complaint_initial,
        ]);

        Alert::success('Success', 'Update registration has success.');
        return redirect()->route('registrations.index');
    }

    public function status(Request $request, string $id)
    {
        $data = Registration::findOrFail($id);

        $data->update([
            'status' => $request->status,
        ]);

        Alert::success('Success', 'Update status has success.');
        return redirect()->route('registrations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
