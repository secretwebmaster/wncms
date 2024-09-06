<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        // info($request->all());
        $tags = Tag::where('type', $request->type)
            ->whereNull('parent_id')
            ->with('children', 'children.children')
            ->orderBy('order_column', 'desc')
            ->get();

        return $tags;
    }

    public function exist(Request $request)
    {
        // info($request->all());
        $tagIds = Tag::whereIn('id', $request->tagIds ?? [])->pluck('id')->toArray();
        return response()->json([
            'status' => 'success',
            'message' => __('word.successfully_fetched_data'),
            'ids' => $tagIds,
        ]);
    }
}
