<?php

namespace App\Http\Controllers;

use App\Models\DetailReturn;
use App\Models\SaleReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('returns.index');
    }

    public function getJsonToSalesReturn(Request $request)
    {
        $search = $request->input('search.value');
        $data = DetailReturn::with(['saleReturn', 'sale', 'product'])
            ->when($search, function($query,$search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('saleReturn', function($q) use ($search) {
                        $q->where('invoice_id', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('sale_return_id', fn($row) => $row->sale_return_id)
            ->addColumn('invoice_id', fn($row) => $row->saleReturn->invoice_id)
            ->addColumn('sale_id', fn($row) => $row->sale_id)
            ->addColumn('product_name', fn($row) => $row->product->name)
            ->addColumn('quantity', fn($row) => $row->quantity)
            ->addColumn('unit_price', fn($row) => $row->unit_price)
            ->addColumn('total', fn($row) => $row->total)
            ->addColumn('observation', fn($row) => $row->saleReturn->reason)
            ->addColumn('created_by', fn($row) => $row->saleReturn->createdBy->name)
            ->addColumn('created_at', fn($row) =>
                Carbon::parse($row->updated_at)->translatedFormat('d F Y - h:i A')
            )
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('returns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
        DB::beginTransaction();
        $total_return = array_reduce(
            $request->devoluciones,
            fn($carry, $item) => $carry + ($item['unit_price'] * $item['cantidad']),
            0
        );

        try {
            $validated = $request->validate([
                'invoice_id' => 'required|exists:invoices,id',
                'reason' => 'required|string|max:255',
                'devoluciones' => 'required|array|min:1',
                'devoluciones.*.sale_id' => 'required|exists:sales,id',
                'devoluciones.*.product_id' => 'required|exists:products,id',
                'devoluciones.*.cantidad' => 'required|integer|min:1',
                'devoluciones.*.unit_price' => 'required|numeric|min:0',
            ]);

            // 🔍 Validar si ya existe devolución con el mismo invoice_id
            $existe = SaleReturn::where('invoice_id', $validated['invoice_id'])->exists();

            if ($existe) {
                return response()->json([
                    'error' => 'Ya existe una devolución registrada para esta factura.',
                ], 422);
            }

            $validated['total_return'] = $total_return;
            $validated['created_by'] = Auth::id();
            $validated['updated_by'] = Auth::id();

            $saleReturn = SaleReturn::create($validated);

            foreach ($request->devoluciones as $item) {
                DetailReturn::create([
                    'sale_return_id'        => $saleReturn->id,
                    'sale_id'               => $item['sale_id'],
                    'product_id'            => $item['product_id'],
                    'unit_price'            => $item['unit_price'],
                    'quantity'              => $item['cantidad'],
                    'total'                 => $item['unit_price'] * $item['cantidad'],
                    'observation'           => 'N/A',
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Devolución Registrada correctamente',
                'sale_return_id' => $saleReturn->id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al registrar la devolucion',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleReturn $saleReturn)
    {
        //
    }
}
