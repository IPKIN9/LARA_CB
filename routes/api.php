<?php

use App\Models\BotRoutingModel;
use App\Models\DetailModel;
use App\Models\FormModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/first_message', function () {
    try {
        $routing = BotRoutingModel::where('type_route', 'first')->with('detail', 'message', 'next_message')->first();
        $button = DetailModel::where('choice_id', $routing->next_response)->get();
        $count = $routing->count();
        return response()->json([
            'count' => $count,
            'route' => $routing,
            'next' => $button
        ]);
    } catch (\Throwable $err) {
        return response()->json($err);
    }
});

Route::get('/next/{id}', function ($id) {
    try {
        $routing = BotRoutingModel::where('button_click', $id)->with('detail', 'message', 'next_message')->first();
        $button = DetailModel::where('choice_id', $routing->next_response)->get();
        $count = $routing->count();
        return response()->json([
            'count' => $count,
            'route' => $routing,
            'next' => $button
        ]);
    } catch (\Throwable $err) {
        return response()->json($err);
    }
});

Route::post('/form', function (Request $request) {
    $date = Carbon::now();
    $data = array(
        'nim' => $request->nim,
        'nama' => $request->nama,
        'kls' => $request->kls,
        'jurusan' => $request->jurusan,
        'masukan' => $request->masukan,
        'created_at' => $date,
        'updated_at' => $date,
    );
    try {
        FormModel::create($data);
        return response()->json(['code' => '201']);
    } catch (\Throwable $err) {
        return response()->json(['code' => 500, $err]);
    }
});
