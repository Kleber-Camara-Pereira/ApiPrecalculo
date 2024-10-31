<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Http\Requests\UserDetailRequest;

class UserDetailController extends Controller
{
    public function store(UserDetailRequest $request){
        
        $details = UserDetail::create([
            'position' => $request->position,
            'enrollment' => $request->enrollment,
            'bithdate' => $request->bithdate,
        ]);

        return $details;
        
    }

    public function update(UserDetailRequest $request, $id){
        $details = UserDetail::find($id);
        $details->update($request->all());
        return $details;
    }
}
