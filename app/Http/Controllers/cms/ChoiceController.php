<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\ChoiceModel;
use App\Models\DetailModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ChoiceController extends Controller
{
    public function index()
    {
        $data = ChoiceModel::all();
        return view('cms.choice')->with('data', $data);
    }

    public function create(Request $request)
    {
        $date = Carbon::now();
        $data1 = array(
            'content' => $request->content,
            'created_at' => $date,
            'updated_at' => $date,
        );

        try {
            $result = ChoiceModel::create($data1);
            foreach ($request->detailContent as $d) {
                $data2 = array(
                    'choice_id' => $result->id,
                    'content' => $d,
                    'created_at' => $date,
                    'updated_at' => $date,
                );
                DetailModel::create($data2);
            }
            return back()->with('status', 'Created new data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function getChoice($id)
    {
        $id_data = Crypt::decrypt($id);
        $data = array(
            'choice' => ChoiceModel::where('id', $id_data)->first(),
            'detail' => DetailModel::where('choice_id', $id_data)->get()
        );
        return view('cms.choiceEdit')->with('data', $data);
    }

    public function updateChoice(Request $request, $id)
    {
        $date = Carbon::now();
        $id_data = Crypt::decrypt($id);

        $data = array(
            'content' => $request->content,
            'updated_at' => $date,
        );

        try {
            ChoiceModel::where('id', $id_data)->update($data);
            foreach ($request->detail_id as $d => $v) {
                $id_detail = Crypt::decrypt($request->detail_id[$d]);
                $data2 = array(
                    'content' => $request->detail_content[$d],
                    'updated_at' => $date,
                );
                DetailModel::where('id', $id_detail)->update($data2);
            }
            return back()->with('status', 'Updated data success');
        } catch (\Throwable $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function deleteDetail($id)
    {
        $id_data = Crypt::decrypt($id);
        DetailModel::where('id', $id_data)->delete();
        return response()->json(['code' => '200']);
    }

    public function delete($id)
    {
        $id_data = Crypt::decrypt($id);
        DetailModel::where('choice_id', $id_data)->delete();
        ChoiceModel::where('id', $id_data)->delete();
    }
}
