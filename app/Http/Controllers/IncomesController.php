<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class IncomesController extends Controller
{

    private $income;
    private $timezone = new DateTimeZone('America/Sao_Paulo');

    public function __construct(Incomes $income) {
        $this->income = $income;
    }


    public function index() {
        $incomes = auth('api')->user()->incomes()->paginate('10');

        return response()->json(['data' => $incomes], 200);
    }


    public function store(Request $request) {
        
        $data = $request->all();

        if(!$request->has('date') || !$request->get('date')) {
            $data['date'] = new DateTime(null, $this->timezone);
        } else {
            $data['date'] = new DateTime($data['date'], $this->timezone);
        }

        try {

            $data['user_id'] = auth()->user()->id;
            $income = $this->income->create($data);

            return response()->json(['data' => $income], 201);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function show(string $id) {
        try {

            $income = $this->income->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $income['user_id']) return response()->json(['data' => $income], 200);

            return response()->json(['error' => 'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request, string $id) {

        $data = $request->all();

        try {

            $income = $this->income->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $income['user_id']) {
                $income->update($data);
                return response()->json(['data' => $income], 202);
            }

            return response()->json(['error' =>  'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id) {
        try {

            $income = $this->income->findOrFail($id);
            $user_id = auth('api')->user()->id;

            if($user_id == $income['user_id']) {
                $income->delete();
                return response()->json(['data' => 'deleted'], 202);
            }

            return response()->json(['error' =>  'Unauthorized'], 401);

        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 400);
        }
    }
}
