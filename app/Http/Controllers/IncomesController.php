<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use Illuminate\Http\Request;

class IncomesController extends Controller
{

    private $income;


    public function __construct(Incomes $income) {
        $this->income = $income;
    }


    public function index() {
        $incomes = $this->income->paginate('10');

        return response()->json(['data' => $incomes], 200);
    }


    public function store(Request $request) {
        
        $data = $request->all();

        try {

            $income = $this->income->create($data);

            return response()->json(['data' => $income], 201);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $income = $this->income->findOrFail($id);

            return response()->json(['data' => $income], 200);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request, string $id) {

        $data = $request->all();

        try {

            $income = $this->income->findOrFail($id);
            $income->update($data);

            return response()->json(['data' => $income], 202);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $income = $this->income->findOrFail($id);
            $income->delete();

            return response()->json(['data' => 'deleted'], 202);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
