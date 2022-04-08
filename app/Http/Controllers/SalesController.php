<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\StoreRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $choiceProducts = Product::query()
            ->orderBy('id')
            ->pluck('name', 'id');

        $sales = Sale::query()
            ->orderByDesc('created_at')
            ->paginate();

        return view('coffee_sales')
            ->with('choiceProducts', $choiceProducts)
            ->with('sales', $sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Sales\StoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $sale = new Sale();

        $sale->quantity = $request->get('quantity', 0);
        $sale->unit_cost = $request->get('unit_cost', 0) * 100;
        $sale->product_id = $request->get('product');
        $sale->save();

        return redirect(route('sales.index'))
            ->with('status', 'Record successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
