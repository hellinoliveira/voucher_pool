<?php
/**
 * Created by PhpStorm.
 * User: hellison
 * Date: 8/14/18
 * Time: 9:27 AM
 */

namespace App\Http\Controllers;


use App\Recipient;
use App\VoucherPool;
use Illuminate\Http\Request;

class RecipientController extends Controller
{

    public function showAllRecipients()
    {
        return response()->json(Recipient::all());
    }


    public function showOneRecipient($id)
    {
        return response()->json(Recipient::find($id));
    }


    public function create(Request $request)
    {
        $this->isValid($request);

        $recipient = Recipient::create($request->all());

        return response()->json($recipient, 201);
    }

    public function update($id, Request $request)
    {
        $this->isValid($request);
        $recipient = Recipient::findOrFail($id);
        $recipient->update($request->all());

        return response()->json($recipient, 200);
    }

    public function delete($id)
    {
        Recipient::findOrFail($id)->delete();

        return response('Deleted Successfully', 200);
    }


    /**
     * Check if the request has valid parameters
     * @param Request $request
     */
    private function isValid(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:recipient'
        ]);
    }

}