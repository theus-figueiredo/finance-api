<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    private $expense;

    public function __construct(Expenses $expense) {
        $this->expense = $expense;
    }


    public function index() {
        $expenses = auth('api')->user()->expenses()->paginate('10');
        return response()->json(['data' => $expenses], 200);
    }


    public function store(Request $request) {

        $data = $request->all();

        try {

            $data['user_id'] = auth('api')->user()->id;
            $expense = $this->expense->create($data);

            return response()->json(['data' => $expense], 201);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $user_id = auth('api')->user()->id;
            $expense = $this->expense->findOrFail($id);

            if($user_id == $expense['user_id']) return response()->json(['data' => $expense], 200);

            return response()->json(['data' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }

 
    public function update(Request $request, string $id) {
    
        $data = $request->all();

        try {

            $expense = $this->expense->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $expense['user_id']) {
                $expense->update($data);
                return response()->json(['data' => $expense], 202);
            }

            return response()->json(['data' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $expense = $this->expense->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $expense['user_id']) {
                $expense->delete();
                return response()->json(['data' => 'deleted'], 202);
            }

            return response()->json(['data' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
