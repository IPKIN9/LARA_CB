<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\MessageModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    public function index()
    {
        $data = MessageModel::all();
        return view('cms.message')->with('data', $data);
    }

    public function create(MessageRequest $request)
    {
        $date = Carbon::now();
        $data = array(
            'content' => nl2br($request->content),
            'type_message' => $request->type_message,
            'created_at' => $date,
            'updated_at' => $date,
        );
        try {
            MessageModel::create($data);
            return back()->with('status', 'Created new data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function edit($id)
    {
        $id_data = Crypt::decrypt($id);
        $data = MessageModel::where('id', $id_data)->first();
        return response()->json($data);
    }

    public function update(MessageRequest $request, $id)
    {
        $date = Carbon::now();
        $data = array(
            'content' => nl2br($request->content),
            'type_message' => $request->type_message,
            'updated_at' => $date,
        );

        try {
            MessageModel::where('id', $id)->update($data);
            return back()->with('status', 'Updated data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function delete($id)
    {
        $id_data = Crypt::decrypt($id);
        try {
            MessageModel::where('id', $id_data)->delete();
            return response()->json(['code' => '200']);
        } catch (\Throwable $err) {
            return response()->json(['code' => '500']);
        }
    }
}
