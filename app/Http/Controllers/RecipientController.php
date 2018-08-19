<?php
/**
 * Created by PhpStorm.
 * User: hellison
 * Date: 8/14/18
 * Time: 9:27 AM
 */

namespace App\Http\Controllers;

use App\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllRecipients()
    {
        return response()->json(Recipient::all());
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneRecipient($id)
    {
        return response()->json(Recipient::find($id));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->isValid($request);

        $recipient = Recipient::create($request->all());

        return response()->json($recipient, 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->isValid($request);
        $recipient = Recipient::findOrFail($id);
        $recipient->update($request->all());

        return response()->json($recipient, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
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