<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\museum;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    //

    public function show()
    {
        $museum = museum::all();
        return response()->json([
            'status'=> 200,
            'museum'=>$museum,
        ]);
    }
}
