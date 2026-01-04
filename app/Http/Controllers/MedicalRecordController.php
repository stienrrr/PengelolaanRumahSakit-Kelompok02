<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = MedicalRecord::with(['patient', 'doctor', 'registration'])->get();

        return view('cms.medical_record.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registrations = Registration::with(['patient', 'doctorSchedule'])->get();

        return view('cms.medical_record.partial.create', compact('registrations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'registration_id' => 'required',
            'date' => 'required',
            'complaint' => 'required',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'blood_pressure' => 'required',
            'weight' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add medical record has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $registration = Registration::findOrFail($request->registration_id);

        MedicalRecord::create([
            'registration_id' => $request->registration_id,
            'patient_id' => $registration->patient->id,
            'doctor_id' => $registration->doctorSchedule->doctor->id,
            'date' => $request->date,
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
        ]);

        Alert::success('Success', 'Add medical record has successfully.');
        return redirect()->route('medicalrecords.index');
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
        $data = MedicalRecord::findOrFail($id);

        $registrations = Registration::with(['patient', 'doctorSchedule'])->get();

        return view('cms.medical_record.partial.edit', compact(['data', 'registrations']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = Validator::make($request->all(), [
            'registration_id' => 'required',
            'date' => 'required',
            'complaint' => 'required',
            'diagnosis' => 'required',
            'treatment' => 'required',
            'blood_pressure' => 'required',
            'weight' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update medical record has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $registration = Registration::findOrFail($request->registration_id);

        $data = MedicalRecord::findOrFail($id);

        $data->update([
            'registration_id' => $request->registration_id,
            'patient_id' => $registration->patient->id,
            'doctor_id' => $registration->doctorSchedule->doctor->id,
            'date' => $request->date,
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
        ]);

        Alert::success('Success', 'Update medical record has successfully.');
        return redirect()->route('medicalrecords.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = MedicalRecord::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Delete medical record has success.');
        return redirect()->route('medicalrecords.index');
    }
}
