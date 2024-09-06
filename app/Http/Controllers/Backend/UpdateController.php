<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdateController extends Controller
{
    public $colors = [
        'add' => 'success',
        'fix' => 'primary',
        'improve' => 'info',
        'remove' => 'danger',
    ];

    public function index()
    {
        $result = $this->getUpdateData();
        // dd($result);
        return view('backend.admin.update', [
            'page_title' => __('word.system_update'),
            'colors' => $this->colors,
            'result' => $result,
        ]);
    }

    public function getUpdateData()
    {
        try{
            $coreResponse = Http::post("https://core.wncms.cc/api/v1/update/check", [
                'current_version' => gss('version'),
                'domain' => request()->url(),
            ]);
            
            return json_decode($coreResponse->body(), true);
 
        }catch(\Exception $e){
            logger()->error($e);
            return [];
            // dd('update fail, please contact customer support');
        }
    }

}
