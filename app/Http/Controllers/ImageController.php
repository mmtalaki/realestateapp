<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'property_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'property_id' => 'required|integer|exists:restaurants,id'
        ]);

        $image = new Image();
        $image->property_id = $request->property_id;
        
        if($request->hasFile('property_image')){
            $fileName = $request->file('property_image')->store('images');
        } else{
            $fileName = null;
        }
        $image->property_image = $fileName;

        try{
            $image->save();
            return response()->json([
                'Image'=>$image
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error'=> 'Failed to save image',
                'message'=>$exception->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $image = Image::join('property', 'image.property_id', '=', 'property.id')
                ->select('image.*', 'property.title as property_title')
                ->get();
            if ($image) {
                return response()->json([
                    'Image' => $image
                ], 200);
            } else {
                return "No image was found.";
            }
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch image',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'property_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'property_id' => 'required|integer|exists:restaurants,id'
        ]);

        $image = Image::findOrFail($id);
        $image->property_id = $request->property_id;

        try {
            $image->save();
            return response()->json([
                'restauarant' => $image,
            ], 200);
        }
        catch (\Exception $exception) {
            return response()->json([
                'Error' => "Failed to update image",
                'message'=>$exception->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);
        if ($image) {
            try {
                $image->delete();
                return response()->json([
                    'Image Deleted Successsfully!'
                ], 200);
            } 
            catch (\Exception $exception) {
                return response()->json([
                    'error' => $exception->getMessage(),
                    'message' => 'Failed to delete image'
                ], 500);
            }
        } 
        else {
            return "Image was not found";
        }
    }
}
