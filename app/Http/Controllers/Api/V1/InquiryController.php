<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required|max:200',
            'email' => 'required',
            'contact' => 'required',
            'message' => 'required',
        ]);

        $inquiry = new Inquiry();
        $inquiry->name = $request->name;
        $inquiry->subject = $request->subject;
        $inquiry->email = $request->email;
        $inquiry->contact = $request->contact;
        $inquiry->message = $request->message;
        $inquiry->save();

        return response()->json(['message' => translate('submission successful')], 200);
    }

}
