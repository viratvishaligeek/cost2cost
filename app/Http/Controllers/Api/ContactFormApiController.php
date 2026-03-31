<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactFormApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:1,1')->only('formSubmit');
    }

    public function formSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ], 422);
        }
        try {
            $data = $validator->validated();
            $data['tenant_id'] = $request->tenant_id;
            $contactForm = ContactForm::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'Contact form submitted successfully',
                'data' => $contactForm
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
