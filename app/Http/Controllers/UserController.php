<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserDetailController;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserDetailRequest;


class UserController extends Controller
{
    protected $userDetails;
    public function __construct(UserDetailController $userDetails){
        $this->userDetails = $userDetails;
    }

    public function index(){
        $users = User::with('details')->paginate(15);
        return response()->json($users, 200);
    }

    public function store(UserRequest $request){
        $userDetailData = [
            'position' => $request->position,
            'enrollment' => $request->enrollment,
            'bithdate' => $request->bithdate,
        ];

        $detailsRequest = new UserDetailRequest($userDetailData);
        
        $details = $this->userDetails->store($detailsRequest);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_detail_id' => $details->id
        ]);

        $details->user_id = $user->id;
        $details->save();

        return response()->json(['message' => 'User created successfully.'], 201);
        
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update($request->all());

        if($user->details){
            $user->details->update($request->all());
        }
        return response()->json(['message' => 'User updated successfully.', 'user' => $user], 200);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }

    public function show($id){
        $user = User::with('details')->find($id);
        return response()->json($user, 200);
    }
}
