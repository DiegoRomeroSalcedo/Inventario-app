<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Sale;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index');
    }

    public function getJsonToSales(Request $request)
    {
    
        $search = $request->input('search.value');
        $data = Sale::with(['product', 'createdBy', 'updatedBy'])
            ->when($search, function($query, $search) {
                $query->where('invoice_id', 'like', "%{$search}%")
                    ->orWhereHas('product', function($q) use ($search) {
                        $q->where('product_id', 'like', "%{$search}%");
                    })
                    ->orWhereHas('createdBy', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%"); // usuario que creó
                    })
                    ->orWhereHas('updatedBy', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%"); // usuario que actualizó
                    });
            })
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('invoice_id', fn($row) => $row->invoice_id)
            ->addColumn('product_name', fn($row) => $row->product->name)
            ->addColumn('quantity', fn($row) => (int) $row->quantity)
            ->addColumn('unity_price', fn($row) => number_format($row->unity_price))
            ->addColumn('price_with_discount', fn($row) => number_format($row->price_with_discount))
            ->addColumn('discount', fn($row) => $row->discount ?? 'N/A')
            ->addColumn('sale_amount', fn($row) => number_format($row->sale_amount))
            ->addColumn('created_by', fn($row) => $row->createdBy->name)
            ->addColumn('updated_by', fn($row) => $row->updatedBy->name ?? 'N/A')
            ->addColumn('created_at', fn($row) => $row->created_at->format('d/m/Y H:i'))
            ->addColumn('updated_at', fn($row) => $row->updated_at->format('d/m/Y H:i'))
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data = Sale::with('')
        // return view('sales.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
