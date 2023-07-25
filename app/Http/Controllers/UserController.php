<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index() {
        $users = $this->user->paginate('10');

        return response()->json(['data' => $users], 200);
    }


    public function store(Request $request) {
        $data = $request->all();

        if(!$request->has('password') || !$request->get('password')) {
            return response()->json(['error' => 'User requires a passoword'], 400);
        }

        try {
            $data['password'] = bcrypt($data['password']);

            $user = $this->user->create($data);

            return response()->json(['data' => $user], 201);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $user_id = auth('api')->user()->id;
            $user = $this->user->findOrFail($id);

            if ($user_id == $user['id']) return response()->json(['data' => $user], 200);

            return response()->json(['data' => 'Unauthorized'], 401);

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    public function update(Request $request, string $id) {
        $data = $request->all();

        if($request->has('password') || $request->get('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        try {

            $user_id = auth('api')->user()->id;
            $user = $this->user->findOrFail($id);

            if($user_id == $user['id']) {
                $user->update($data);
                return response()->json(['data' => $user], 202);
            }

            return response()->json(['data' => 'Unauthorized'], 401);
            
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $user_id = auth('api')->user()->id;
            $user = $this->user->findOrFail($id);

            if ($user_id == $user['id']) {
                $user->delete();
                return response()->json(['data' => 'deleted'], 200);
            }

            return response()->json(['data' => 'Unauthorized'], 401);            

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
