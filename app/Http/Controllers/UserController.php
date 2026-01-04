<?php

namespace App\Http\Controllers;

use App\Models\DoctorTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function adminIndex()
    {
        $datas = User::whereHas('roles', function ($query) {
            $query->whereNotIn('name', ['pasien']);
        })->get();

        return view('cms.user.admin.index', compact('datas'));
    }

    public function adminCreate()
    {
        $roles = Role::whereNotIn('name', ['pasien'])->get();

        return view('cms.user.admin.partial.create', compact('roles'));
    }

    public function adminStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add user admin has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        if ($request->role == 'dokter') {
            DoctorTitle::create([
                'user_id' => $user->id,
            ]);
        }

        Alert::success('Success', 'Add user admin has success.');
        return redirect()->route('users.admin');
    }

    public function adminEdit(User $user)
    {
        $roles = Role::whereNotIn('name', ['pasien'])->get();

        return view('cms.user.admin.partial.edit', compact('user', 'roles'));
    }

    public function adminUpdate(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update user admin has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->role);

        if ($request->role == 'dokter') {
            DoctorTitle::create([
                'user_id' => $user->id,
            ]);
        }

        Alert::success('Success', 'Update user admin has success.');
        return redirect()->route('users.admin');
    }

    public function adminDestroy(User $user)
    {
        $user->delete();

        Alert::success('Success', 'Delete user admin has success.');
        return redirect()->route('users.admin');
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

    public function patientStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Add user patient has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('pasien');

        Alert::success('Success', 'Add user patient has success.');
        return redirect()->route('users.patient');
    }

    public function patientEdit(User $user)
    {
        return view('cms.user.patient.partial.edit', compact('user'));
    }

    public function patientUpdate(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Update user patient has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        Alert::success('Success', 'Update user patient has success.');
        return redirect()->route('users.patient');
    }

    public function patientDestroy(User $user)
    {
        $user->delete();
        Alert::success('Success', 'Delete user patient has success.');
        return redirect()->route('users.patient');
    }
}
