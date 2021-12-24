<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\FormModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MasukanController extends Controller
{
    public function index()
    {
        $data = FormModel::all();
        return view('cms.dashboard')->with('data', $data);
    }
    public function delete($id)
    {
        $dataId = Crypt::decrypt($id);
        try {
            FormModel::where('id', $dataId)->delete();
            return response()->json(['code' => '201']);
        } catch (\Throwable $err) {
            return response()->json($err);
        }
    }
}
