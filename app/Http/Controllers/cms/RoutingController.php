<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoutingRequest;
use App\Models\ChoiceModel;
use App\Models\DetailModel;
use App\Models\MessageModel;
use App\Models\BotRoutingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RoutingController extends Controller
{
    public function index()
    {
        $data = array(
            'routing' => BotRoutingModel::with('detail', 'message', 'next_message')->get(),
            'detail' => DetailModel::all(),
            'message' => MessageModel::all(),
            'choice' => ChoiceModel::all(),
        );
        return view('cms.routing')->with('data', $data);
    }

    public function create(RoutingRequest $request)
    {
        $date = Carbon::now();
        $data = array(
            'type_route' => $request->type_route,
            'button_click' => $request->button_click,
            'message_response' => $request->message_response,
            'next_response' => $request->next_response,
            'created_at' => $date,
            'updated_at' => $date
        );
        try {
            BotRoutingModel::create($data);
            return back()->with('status', 'Created new data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function delete($id)
    {
        $dataId = Crypt::decrypt($id);
        try {
            BotRoutingModel::where('id', $dataId)->delete();
            return response()->json(['code' => '201']);
        } catch (\Throwable $err) {
            return response()->json($err);
        }
    }
}
