<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inquiries;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'inquiry'=>'required|max:1000',
            'user_id' => 'required|integer|exists:users,id',
            'property_id' => 'required|integer|exists:restaurants,id'
        ]);

        $inquiries = new Inquiries();
        $inquiries->inquiry = $request->inquiry;
        $inquiries->user_id = $request->user_id;
        $inquiries->property_id = $request->property_id;

        try{
            $inquiries->save();
            return response()->json([
                'Inquiries'=>$inquiries
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error'=> 'Failed to save inquiry',
                'message'=>$exception->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $inquiries = Inquiries::join('users', 'inquiries.user_id', '=', 'users.id')
                ->select('inquiries.*', 'users.name as user_name')
                ->get();
            if ($inquiries) {
                return response()->json([
                    'Inquiries' => $inquiries
                ], 200);
            } else {
                return "No inquiries were found.";
            }
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch inquiries',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inquiry'=>'required|max:1000',
            'user_id' => 'required|integer|exists:users,id',
            'property_id' => 'required|integer|exists:restaurants,id'
        ]);

        $inquiries = Inquiries::findOrFail($id);
        $inquiries->inquiry = $request->inquiry;
        $inquiries->user_id = $request->user_id;
        $inquiries->property_id = $request->property_id;

        try {
            $inquiries->save();
            return response()->json([
                'restauarant' => $inquiries,
            ], 200);
        }
        catch (\Exception $exception) {
            return response()->json([
                'Error' => "Failed to update inquiry",
                'message'=>$exception->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $inquiries = Inquiries::findOrFail($id);
        if ($inquiries) {
            try {
                $inquiries->delete();
                return response()->json([
                    'Inquiry deleted successsfully!'
                ], 200);
            }
            catch (\Exception $exception) {
                return response()->json([
                    'error' => $exception->getMessage(),
                    'message' => 'Failed to delete inquiry'
                ], 500);
            }
        }
        else {
            return "Inquiry was not found";
        }
    }
}
