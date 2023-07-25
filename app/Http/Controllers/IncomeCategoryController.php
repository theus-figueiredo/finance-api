<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{

    private $incomeCategory;

    public function __construct(IncomeCategory $incomeCategory) {
        $this->incomeCategory = $incomeCategory;
    }

    public function index() {
        $categories = auth('api')->user()->incomeCategory()->paginate('10');
        return response()->json(['data' => $categories], 200);
    }


    public function store(Request $request) {
        $data = $request->all();

        try {

            $data['user_id'] = auth('api')->user()->id;
            $category = $this->incomeCategory->create($data);

            return response()->json(['data' => $category], 201);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $category = $this->incomeCategory->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $category['user_id']) return response()->json(['data' => $category], 200);

            return response()->json(['data' => 'Unauthorized'], 401);
        
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request, string $id) {
        
        $data = $request->all();

        try {

            $category = $this->incomeCategory->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $category['user_id']) {
                $category->update($data);
                return response()->json(['data' => $category], 202);
            }
            
            return response()->json(['data' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $category = $this->incomeCategory->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $category['user_id']) {
                $category->delete();
                return response()->json(['data' => 'deleted'], 200);
            }

            return response()->json(['data' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
