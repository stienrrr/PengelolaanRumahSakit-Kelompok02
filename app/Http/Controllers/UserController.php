<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function adminIndex() 
    {
        $datas = User::whereHas('roles', function ($query) {
            $query->whereNotIn('name', ['pasien']);
        })->get();

        return view('cms.user.admin.index', compact('datas'));
    }

    public function patientIndex()
    {
        $datas = User::whereHas('roles', function ($query) {
            $query->where('name', ['pasien']);
        })->get();

        return view('cms.user.patient.index', compact('datas'));
    }

    public function patientCreate()
    {
        return view('cms.user.patient.partial.create');
    }
}
