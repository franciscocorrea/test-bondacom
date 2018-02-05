<?php

namespace App\Http\Controllers;

use App\County;
use App\State;
use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return response()->json(['message' => 'successfully', 'data' => $cities], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ['name' => $request->name, 'zip_code' => $request->zip_code];
        if ($request->state_id) {
            $state = State::where(['id' => $request->state_id])->first();
            if (!$state) {
                return response()->json(['message' => 'The state not found'], 404);
            }

            $data = $array = array_collapse([$data, ['state_id' => $state->id]]);
        }

        if ($request->county_id) {
            $county = County::where(['id' => $request->county_id])->first();

            if (!$county) {
                return response()->json(['message' => 'The county not found'], 404);
            }

            $data = $array = array_collapse([$data, ['county_id' => $county->id]]);
        }

        $city = City::where(['zip_code' => $request->zip_code])->first();

        if ($city) {
            return response()->json(['message' => 'The city is already exist'], 500);
        }

        City::create($data);

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
            $city = City::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'successfully', 'data' => $city], 200);
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
            $city = City::findOrFail($id);

            $city->name = $request->name;
            $city->zip_code = $request->zip_code;

            if ($request->state_id) {
                $state = State::where(['id' => $request->state_id])->first();
                if (!$state) {
                    return response()->json(['message' => 'The state not found'], 404);
                }

                $city->state_id = $state->id;
            }
            if ($request->county_id) {
                $county = County::where(['id' => $request->county_id])->first();

                if (!$county) {
                    return response()->json(['message' => 'The county not found'], 404);
                }

                $city->county_id = $county->id;
            }

            $city->save();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }


        return response()->json(['message' => 'Updated city successfully', 'data' => $city], 201);
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
            $county = City::findOrFail($id);
            $county->delete();
            return response()->json(['message' => 'The city delete successfully'], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
