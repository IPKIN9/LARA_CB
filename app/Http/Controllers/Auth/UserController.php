<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        // $data = array(
        //     'all' => User::all(),
        // );
        $data = User::where('id', '!=', auth()->id())->get();
        return view('Auth.user')->with('data', $data);
    }

    public function create(LoginRequest $request)
    {
        $date = Carbon::now();
        $data = array(
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => $date,
            'updated_at' => $date,
        );
        try {
            $user = User::create($data);
            $user->assignRole($user->role);
            return back()->with('status', 'Created new data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function edit($id)
    {
        $id_data = Crypt::decrypt($id);
        $data = User::where('id', $id_data)->first();
        return response()->json($data);
    }

    public function update(LoginRequest $request, $id)
    {
        $date = Carbon::now();
        $data = array(
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'updated_at' => $date,
        );

        try {
            User::where('id', $id)->update($data);
            return back()->with('status', 'Updated data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function delete($id)
    { {
            $dataId = Crypt::decrypt($id);
            try {
                User::where('id', $dataId)->delete();
                return response()->json(['code' => '201']);
            } catch (\Throwable $err) {
                return response()->json($err);
            }
        }
    }
}
