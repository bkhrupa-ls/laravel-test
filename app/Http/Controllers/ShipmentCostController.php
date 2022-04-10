<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentCost\StoreRequest;
use App\Models\ShipmentCost;

class ShipmentCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $shipmentCosts = ShipmentCost::query()
            ->orderByDesc('created_at')
            ->withCount('sales')
            ->paginate();

        return view('shipping_partners')
            ->with('shipmentCosts', $shipmentCosts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShipmentCost\StoreRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $shipmentCost = new ShipmentCost();

        $shipmentCost->cost = $request->get('cost', 0) * 100;

        $shipmentCost->save();

        return redirect(route('shipment-cost.index'))
            ->with('status', 'Record successfully created!');
    }
}
