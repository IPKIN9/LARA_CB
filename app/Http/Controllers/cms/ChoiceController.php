<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\ChoiceModel;
use App\Models\DetailModel;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    public function index()
    {
        $data = ChoiceModel::all();
        return view('cms.choice')->with('data', $data);
    }
}
