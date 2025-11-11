<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::latest()->paginate(50);
        $websites = wn('website')->getList();
        return view('backend.records.index',[
            'records' => $records,
            'websites' => $websites,
            'types' => Record::TYPES,
            'orders' => Record::ORDERS,
        ]);
    }

    public function bulk_delete(Request $request)
    {
        info($request->all());

        Record::whereIn('id', $request->model_ids)->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('word.successfully_deleted'),
        ]);
    }

}
