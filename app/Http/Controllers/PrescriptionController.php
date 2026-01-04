<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescriptions;
use App\Models\PrescriptionsItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Prescriptions::with('medicalRecord')->get();

        return view('cms.prescription.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor', 'registration'])->whereDoesntHave('prescriptions')->get();

        return view('cms.prescription.partial.create', compact('medicalRecords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'medical_record_id' => 'required',
            'date' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add prescription has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $prescription = Prescriptions::create([
            'medical_record_id' => $request->medical_record_id,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        Alert::success('Success', 'Add prescription has success.');
        return redirect()->route('prescriptions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prescription = Prescriptions::findOrFail($id);

        $datas = PrescriptionsItems::with('medicine')->where('prescription_id', $id)->get();

        return view('cms.prescription.detail', compact(['datas', 'prescription']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor', 'registration'])->get();

        $data = Prescriptions::findOrFail($id);

        return view('cms.prescription.partial.edit', compact(['medicalRecords', 'data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = Validator::make($request->all(), [
            'medical_record_id' => 'required',
            'date' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update prescription has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $prescription = Prescriptions::findOrFail($id);
        $prescription->update([
            'medical_record_id' => $request->medical_record_id,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        Alert::success('Success', 'Update prescription has success.');
        return redirect()->route('prescriptions.index');
    }

    public function status(Request $request, string $id)
    {
        $data = Prescriptions::findOrFail($id);

        $data->update([
            'status' => $request->status,
        ]);

        Alert::success('Success', 'Update status has success.');
        return redirect()->route('prescriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Prescriptions::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Delete prescription has success.');
        return redirect()->route('prescriptions.index');
    }

    public function prescriptionItemCreate(string $id)
    {
        $prescription = Prescriptions::findOrFail($id);
        $medicines = Medicine::all();

        return view('cms.prescription.partial.create-item', compact(['prescription', 'medicines']));
    }

    public function prescriptionItemStore(Request $request, string $id)
    {
        $validation = Validator::make($request->all(), [
            'medicine_id' => 'required',
            'quantity' => 'required',
            'dosage' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add prescription item has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        PrescriptionsItems::create([
            'prescription_id' => $id,
            'medicine_id' => $request->medicine_id,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
        ]);

        Alert::success('Success', 'Add prescription item has success.');
        return redirect()->route('prescriptions.show', $id);
    }

    public function prescriptionItemEdit(Prescriptions $prescription, string $id)
    {
        $data = PrescriptionsItems::findOrFail($id);
        $medicines = Medicine::all();

        return view('cms.prescription.partial.edit-item', compact(['data', 'medicines', 'prescription']));
    }

    public function prescriptionItemUpdate(Request $request, Prescriptions $prescription, string $id)
    {
        $validation = Validator::make($request->all(), [
            'medicine_id' => 'required',
            'quantity' => 'required',
            'dosage' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update prescription item has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = PrescriptionsItems::findOrFail($id);
        $data->update([
            'medicine_id' => $request->medicine_id,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
        ]);

        Alert::success('Success', 'Update prescription item has success.');
        return redirect()->route('prescriptions.show', $prescription->id);
    }

    public function prescriptionItemDestroy(Prescriptions $prescription, string $id)
    {
        $data = PrescriptionsItems::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Delete prescription item has success.');
        return redirect()->route('prescriptions.show', $prescription->id);
    }
}
