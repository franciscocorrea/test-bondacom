<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Validators\CountryValidator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return response()->json(['message' => 'successfully', 'data' => $countries], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = new CountryValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 403);
        }
        $country = Country::where(['acronym' => $request->acronym])->first();
        if ($country) {
            return response()->json(['message' => 'Resource is exist'], 500);
        }
        Country::create($request->all());

        return response()->json(['message' => 'Created country successfully'], 201);
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
            $country = Country::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json(['message' => 'successfully', 'data' => $country], 200);
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

            $validator = new CountryUpdateValidator($request->all());
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()], 403);
            }

            $country = Country::findOrFail($id);

            $country->name = $request->name;
            $country->acronym = $request->acronym;
            $country->save();
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
            $country = Country::findOrFail($id);
            $country->delete();
            return response()->json(['message' => 'The country delete successfully'], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
