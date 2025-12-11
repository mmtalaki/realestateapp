<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Create Property
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string|max:2000',
            'address'=>'required|string',
            'city'=>'required|string',
            'county'=>'required|string',
            'price'=>'required|double',
            'bedrooms'=>'required|string',
            'bathrooms'=>'required|string',
            'sq_meters'=>'required|double',
            'offer_type' => 'required|string',
            'property_type' => 'required|string',
            'status'=>'required|string',
            'year_built' =>'required|double',
            'latitude' =>'required|double',
            'longitude' =>'required|double',
            'user_id'=>'required|integer|exists:users,id'
        ]);

        $property = new Property();
        $property->title = $request->title;
        $property->description = $request->description;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->county = $request->county;
        $property->price = $request->price;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->sq_meters = $request->sq_meters;
        $property->offer_type = $request->offer_type;
        $property->property_type = $request->property_type;
        $property->status = $request->status;
        $property->year_built = $request->year_built;
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->user_id = $request->user_id;

        try {
            $property->save();
            return response()->json($property);

        }
        catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a property.",
                "Message" => $error->getMessage()
            ], 500);
        }
    }

    // Fetch all Property
    public function index()
    {
        try {
            $property = Property::all();
            return response()->json($property);

        }
        catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch all property.",
                "Message" => $error->getMessage()
            ], 500);
        }
    }

    // Fetch a specific Property
    public function show($id)
    {
        try {
            $property = Property::findOrFail($id);
            return response()->json($property);

        }
        catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch property.",
                "Message" => $error->getMessage()
            ], 500);
        }
    }

    // Update Property
    public function update($id, Request $request)
    {
        try {
            $property = Property::findOrFail($id);

            $request->validate([
                'title'=>'required|string',
                'description'=>'required|string|max:2000',
                'address'=>'required|string',
                'city'=>'required|string',
                'county'=>'required|string',
                'price'=>'required|double',
                'bedrooms'=>'required|double',
                'bathrooms'=>'required|double',
                'sq_meters'=>'required|double',
                'offer_type' => 'required|string',
                'property_type' => 'required|string',
                'status'=>'required|string',
                'year_built' =>'required|double',
                'latitude' =>'required|double',
                'longitude' =>'required|double',
                'user_id'=>'required|integer|exists:users,id'
            ]);

            $property->title = $request->title;
            $property->description = $request->description;
            $property->address = $request->address;
            $property->city = $request->city;
            $property->county = $request->county;
            $property->price = $request->price;
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->sq_meters = $request->sq_meters;
            $property->offer_type = $request->offer_type;
            $property->property_type = $request->property_type;
            $property->status = $request->status;
            $property->year_built = $request->year_built;
            $property->latitude = $request->latitude;
            $property->longitude = $request->longitude;
            $property->user_id = $request->user_id;
            $property->save();

            return response()->json($property);

        }
        catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to update property.",
                "Message" => $error->getMessage()
            ], 500);
        }
    }

    // Delete Property
    public function delete($id)
    {
        try {
            $property = Property::findOrFail($id);
            $property->delete();

            return response()->json("Property Deleted Successfully");

        }
        catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to delete property.",
                "Message" => $error->getMessage()
            ], 500);
        }
    }
}
