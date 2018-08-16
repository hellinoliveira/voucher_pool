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
use Illuminate\Http\Response;

class VoucherPoolController extends Controller
{

    /**
     * Retrieve all vouchers
     * @return Response
     */
    public function showAllVouchers()
    {
        return response()->json(VoucherPool::with('recipient')::all());
    }

    /**
     * Retrieve all vouchers By Recipient Id.
     * @param  Request $request
     * @return Response
     */
    public function showAllVouchersByEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $recipient = Recipient::where('email', $request->input('email'))->first();
        if ($recipient === null) {
            return response()->json(['error' => 'Recipient not found!'], 400);
        } else {
            $vouchers = VoucherPool::where('recipient_id', $recipient->id)->with('specialoffer')->get();
            return response()->json([
                'data' => [
                    'recipient' => $recipient,
                    'vouchers' => $vouchers
                ]
            ]);
        }
    }


    /**
     * Retrieve a voucher By Id.
     * @param  int $id
     * @return Response
     */
    public function showOneVoucher($id)
    {
        return response()->json(VoucherPool::find($id));
    }


    /**
     * Create a new voucher
     * @param  Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $this->isValid($request);
        $voucher = VoucherPool::create($request->all());

        return response()->json($voucher, 201);
    }

    public function update($id, Request $request)
    {
        $this->isValid($request);
        $voucher = VoucherPool::findOrFail($id);
        $voucher->update($request->all());

        return response()->json($voucher, 200);
    }

    public function delete($id)
    {
        VoucherPool::findOrFail($id)->delete();

        return response('Deleted Successfully', 200);
//        return response()->json(null, 204);
    }

    /**
     * Check if the request has valid parameters
     * @param Request $request
     */
    private function isValid(Request $request)
    {
        $this->validate($request, [
            'expires_at' => 'required|datetime',
        ]);
    }


}