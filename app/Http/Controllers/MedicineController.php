<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Medicine::all();

        return view('cms.medicine.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.medicine.partial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'stock' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'expiry_date' => 'required',
            'description' => 'nullable',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add medicine has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Medicine::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Add medicine has success.');
        return redirect()->route('medicines.index');
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
        $data = Medicine::findOrFail($id);

        return view('cms.medicine.partial.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'stock' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'expiry_date' => 'required',
            'description' => 'nullable',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update medicine has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = Medicine::findOrFail($id);

        $data->update([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Update medicine has success.');
        return redirect()->route('medicines.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Medicine::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Delete medicine has success.');
        return redirect()->route('medicines.index');
    }
}
