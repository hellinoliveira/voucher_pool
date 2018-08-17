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
use Carbon\Carbon;
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
        return response()->json(VoucherPool::all());
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
     * Validates a voucher based on a given email and code and returns its status if it cant be used
     * or use it and return the percentage of discount.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateVoucherCode(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $voucher = VoucherPool::where('code',
            $request->input('code'))->with('recipients')->with('specialoffer')->first();
        if (null === $voucher) {
            return response()->json(['error' => 'Voucher not found'], 400);
        } else {
            if ($voucher->recipients->email === $request->input('email')) {
                if ($voucher->used) {
                    return response()->json(['error' => 'Voucher already used!'], 400);
                } else {
                    if ($voucher->expires_at < new Carbon()) {
                        return response()->json(['error' => 'Voucher expired!'], 400);
                    } else {
                        $voucher->used = true;
                        $voucher->used_at = new Carbon();
                        $voucher->update();

                        return response()->json(['percentage_discount' => $voucher->specialoffer->percentage_discount],
                            201);
                    }
                }
            } else {
                return response()->json(['error' => 'Invalid email address!'], 400);
            }
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

    /**
     * Update a voucher
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->isValid($request);
        $voucher = VoucherPool::findOrFail($id);
        $voucher->update($request->all());

        return response()->json($voucher, 200);
    }

    /**
     * Delete a voucher
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
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