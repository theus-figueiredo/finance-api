<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{

    private $expenseCategory;

    public function __construct(ExpenseCategory $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
    }

    public function index()
    {
        $expenseCategories = $this->expenseCategory->paginate('10');

        return response()->json(['data' => $expenseCategories], 200);
    }


    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $expenseCategory = $this->expenseCategory->create($data);

            return response()->json(['data' => $expenseCategory], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id)
    {
        try {
            $category = $this->expenseCategory->findOrFail($id);

            return response()->json(['data' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

 
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        try {

            $category = $this->expenseCategory->findOrFail($id);

            $category->update($data);

            return response()->json(['data' => $category], 202);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {

            $category = $this->expenseCategory->findOrFail($id);

            $category->delete();

            return response()->json(['data' => 'deleted'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
