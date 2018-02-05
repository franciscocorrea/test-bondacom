<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use Illuminate\Http\Request;
use App\Validator\StateValidator;
use App\Validator\StateUpdateValidator;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();

        return response()->json(['message' => 'successfully', 'data' => $states], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = new StateValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 403);
        }
        $country = Country::where(['acronym' => $request->acronym_country])->first();
        if (!$country) {
            return response()->json(['message' => 'The country not found'], 400);
        }

        State::create(['name' => $request->name, 'country_id' => $country->id]);

        return response()->json(['message' => 'Created state successfully'], 201);
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
            $state = State::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'successfully', 'data' => $state], 200);

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
            $validator = new StateUpdateValidator($request->all());
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()], 403);
            }
            $state = State::findOrFail($id);

            $state->name = $request->name;
            if ($request->acronym_country) {
                $country = Country::where(['acronym' => $request->acronym_country])->first();
                if (!$country) {
                    return response()->json(['message' => 'The country not found'], 404);
                }
                $state->country_id = $country->country_id;
            }

            $state->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'successfully', 'data' => $country], 200);
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
            $state = State::findOrFail($id);
            $state->delete();
            return response()->json(['message' => 'The country delete successfully'], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
