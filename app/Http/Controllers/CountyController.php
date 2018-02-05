<?php

namespace App\Http\Controllers;

use App\County;
use App\State;
use Illuminate\Http\Request;
use App\Validator\CountyValidator;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::all();

        return response()->json(['message' => 'successfully', 'data' => $counties], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = new CountyValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 403);
        }
        $state = State::where(['id' => $request->state_id])->first();
        if (!$state) {
            return response()->json(['message' => 'The state not found'], 404);
        }

        County::create(['name' => $request->name, 'state_id' => $state->id]);

        return response()->json(['message' => 'Created county successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $county = County::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'successfully', 'data' => $county], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = new CountyUpdateValidator($request->all());
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()], 403);
            }
            $county = County::findOrFail($id);

            $county->name = $request->name;
            if ($request->state_id) {
                $state = State::where(['id' => $request->state_id])->first();
                if (!$state) {
                    return response()->json(['message' => 'The country not found'], 400);
                }
                $county->state_id = $state->id;
            }

            $county->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'Update county successfully', 'data' => $county], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $county = County::findOrFail($id);
            $county->delete();
            return response()->json(['message' => 'The county delete successfully'], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
