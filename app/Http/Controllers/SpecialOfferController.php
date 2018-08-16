<?php
/**
 * Created by PhpStorm.
 * User: hellison
 * Date: 8/14/18
 * Time: 9:27 AM
 */

namespace App\Http\Controllers;


use App\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{

    public function showAllOffers()
    {
        return response()->json(SpecialOffer::all());
    }


    public function showOneSpecialOffer($id)
    {
        return response()->json(SpecialOffer::find($id));
    }


    public function create(Request $request)
    {

        $this->isValid($request);
        $offer = SpecialOffer::create($request->all());

        return response()->json($offer, 201);
    }

    public function update($id, Request $request)
    {
        $this->isValid($request);
        $offer = SpecialOffer::findOrFail($id);
        $offer->update($request->all());

        return response()->json($offer, 200);
    }

    public function delete($id)
    {
        SpecialOffer::findOrFail($id)->delete();

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
            'percentage_discount' => 'required'
        ]);
    }

}