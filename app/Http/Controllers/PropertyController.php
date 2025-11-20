<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Create Property
    public function saveProperty(Request $request)
    {       
        $request->validate([
            'title'=>'required|string',
            'address'=>'required|string',
            'city'=>'required',
            'county'=>'required',
            'price'=>'required|double',
            'bedrooms'=>'required|string',
            'bathrooms'=>'required|string',
            'sq_meters'=>'required|double',
            'type' => 'required|string',
            'status'=>'required|string',
            'user_id'=>'required|integer|exists:users,id',
        ]);

            $property = new Property();
            $property->title = $request->title;
            $property->address = $request->address;
            $property->city = $request->city;
            $property->county = $request->county;
            $property->price = $request->price;
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->sq_meters = $request->sq_meters;
            $property->type = $request->type;
            $property->status = $request->status;
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
    public function fetchAllProperty()
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
    public function fetchProperty($id)
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
    public function updateProperty($id, Request $request)
    {
        try {
            $property = Property::findOrFail($id);           

            $request->validate([
                'title'=>'required|string',
                'address'=>'required|string',
                'city'=>'required',
                'county'=>'required',
                'price'=>'required|double',
                'bedrooms'=>'required|string',
                'bathrooms'=>'required|string',
                'sq_meters'=>'required|double',
                'type' => 'required|string',
                'status'=>'required|string',
                'user_id'=>'required|integer|exists:users,id'
            ]);

            $property->title = $request->title;
            $property->address = $request->address;
            $property->city = $request->city;
            $property->county = $request->county;
            $property->price = $request->price;
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->sq_meters = $request->sq_meters;
            $property->type = $request->type;
            $property->status = $request->status;
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
    public function deleteProperty($id)
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
