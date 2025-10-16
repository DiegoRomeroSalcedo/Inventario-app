<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('invoices.index');
    }

    public function getJsonToInvoices(Request $request)
    {
        $search = $request->input('search.value');
        $data = Invoice::with('client', 'createdBy')
            ->when($search, function($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('client', function($q) use ($search) {
                        $q->where('customer_name', 'like', "%{$search}");
                    });
            })
            ->orderBy('id', 'desc');
        
        // dd($request->all($data));
        return DataTables::of($data)
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('total_sale', fn($row) => $row->total_sale)
            ->addColumn('total_discount', fn($row) => $row->total_discount)
            ->addColumn('received_amount', fn($row) => $row->received_amount)
            ->addColumn('change_amount', fn($row) => $row->change_amount)
            ->addColumn('payment_method', fn($row) => $row->payment_method)
            ->addColumn('client_name', fn($row) => $row->client->customer_name)
            ->addColumn('user_id', fn($row) => $row->createdBy->name)
            ->addColumn('created_at', fn($row) => $row->created_at->format('d/m/Y H:i'))
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        DB::beginTransaction(); // 🔒 Seguridad: rollback si algo falla

        try {
            // 1️⃣ Crear o obtener cliente
            $client = null;

            // Si viene un client_id, lo usamos directamente
            if (!empty($request->client_id)) {
                $client = Client::find($request->client_id);
            } else {
                // Si no existe client_id, buscamos por identificación
                $client = Client::firstOrCreate(
                    ['identification' => $request->customer['identification']],
                    [
                        'customer_name' => $request->customer['name'],
                        'phone' => $request->customer['phone'] ?? null,
                        'email' => $request->customer['email'] ?? null,
                        'address' => $request->customer['address'] ?? null,
                        'created_by' => Auth::id(), // o el id del usuario activo
                    ]
                );
            }

            // 2️⃣ Crear la factura
            $invoice = Invoice::create([
                // 'subtotal'          => $request->subtotal,
                'total_sale'        => $request->total_sale,
                // 'total_base'        => $request->total_base,
                // 'total_iva'         => $request->total_iva,
                'total_discount'    => $request->total_discount,
                'received_amount'   => $request->received_amount,
                'change_amount'     => $request->change_amount,
                'payment_method'    => $request->payment_method,
                'client_id'         => $client ? $client->id : null,
                'user_id'           => Auth::id(), // Usuario logueado
            ]);

            // 3️⃣ Registrar los productos vendidos (detalle)
            foreach ($request->items as $item) {
                Sale::create([
                    'invoice_id'         => $invoice->id,
                    'product_id'         => $item['id'],
                    'quantity'           => $item['quantity'] ?? 1,
                    'unity_price'        => $item['price'],
                    'price_with_discount'=> $item['price'],
                    'sale_amount'        => $item['subtotal'] ?? ($item['price'] * ($item['quantity'] ?? 1)),
                    'discount'           => $item['discount'] ?? 0,
                    'created_by'         => Auth::id(),
                ]);
            }

            DB::commit(); // 💾 Confirmamos todo

            return response()->json([
                'message' => 'Factura registrada correctamente',
                'sale_id' => $invoice->id,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); // 🚫 Deshacemos si algo falla
            return response()->json([
                'error' => 'Error al registrar la venta',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Invoice::with('sales.product', 'client')->find($id);
        // echo "<pre>";
        // print_r($data->toArray());
        // echo "</pre>";
        // dd("Para aqui");
        return view('invoices.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        echo "Hola";
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
