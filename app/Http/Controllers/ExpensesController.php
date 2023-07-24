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
        $expenses = $this->expense->paginate('10');

        return response()->json(['data' => $expenses], 200);
    }


    public function store(Request $request) {

        $data = $request->all();

        try {

            $expense = $this->expense->create($data);

            return response()->json(['data' => $expense], 201);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $expense = $this->expense->findOrFail($id);

            return response()->json(['data' => $expense], 200);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }

 
    public function update(Request $request, string $id) {
        $data = $request->all();

        try {

            $expense = $this->expense->findOrFail($id);
            $expense->update($data);

            return response()->json(['data' => $expense], 202);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $expense = $this->expense->findOrFail($id);
            $expense->delete();

            return response()->json(['data' => 'deleted'], 202);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
