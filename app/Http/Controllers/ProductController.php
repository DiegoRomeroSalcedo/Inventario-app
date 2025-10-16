<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index');
    }

    public function getJsonToProducts(Request $request)
    {
        // dd($request->all());
        $search = $request->input('search.value');
        $data = Product::with(['brand', 'stock', 'updatedBy'])
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('brand', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('name',fn($row) => $row->name)
            ->addColumn('brand', fn($row) => $row->brand ? $row->brand->name : 'Sin marca')
            ->addColumn('stock', fn($row) => $row->stock ? $row->stock->quantity : 0)
            ->addColumn('cost', fn($row) => number_format($row->cost, 2))
            ->addColumn('retencion', fn($row) => $row->retencion ?? 'N/A')
            ->addColumn('flete', fn($row) => $row->flete ?? 'N/A')
            ->addColumn('IVA', fn($row) => $row->IVA ?? 'N/A')
            ->addColumn('cost_with_taxes', fn($row) => number_format($row->cost_with_taxes, 2))
            ->addColumn('utility', fn($row) => $row->utility)
            ->addColumn('price', fn($row) => number_format($row->price, 2))
            ->addColumn('discount', fn($row) => $row->discount)
            ->addColumn('price_with_discount', fn($row) => number_format($row->price_with_discount, 2))
            ->addColumn('rentability', fn($row) => $row->rentability . '%')
            ->addColumn('details', fn($row) => $row->details)
            ->addColumn('updated_by', fn($row) => $row->updated_by->name ?? 'N/A')
            ->addColumn('created_at', fn($row) => $row->created_at->format('d/m/Y H:i'))
            ->addColumn('updated_at', fn($row) => $row->updated_at->format('d/m/Y H:i'))
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('products.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // Limpieza de formato: 12.450,00 → 12450.00
        $fieldsToClean = [
            'cost',
            'retencion',
            'flete',
            'IVA',
            'cost_with_taxes',
            'utility',
            'price',
            'discount',
            'price_with_discount',
            'rentability',
        ];

        foreach ($fieldsToClean as $field) {
            if ($request->filled($field)) {
                $value = str_replace(['.', ','], ['', '.'], $request->$field);
                $request->merge([$field => $value]);
            }
        }

        // dd($request->all());
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'cost'              => 'nullable|numeric',
            'retencion'         => 'nullable|numeric',
            'flete'             => 'nullable|numeric',
            'IVA'               => 'nullable|numeric',
            'cost_with_taxes'   => 'nullable|numeric',
            'utility'           => 'nullable|numeric',
            'price'             => 'nullable|numeric',
            'discount'          => 'nullable|numeric',
            'expiration_date'   => 'nullable|date',
            'price_with_discount' => 'nullable|numeric',
            'rentability'       => 'nullable|numeric',
            'details'           => 'nullable|string',
            'unity_type'         => 'required|string',
            'unit_of_measure'   => 'nullable|string',
            'brand_id'          => 'nullable|exists:brands,id',
            'quantity'          => 'required|integer|min:0',
        ]);

        // dd("Hello");

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        $product = Product::create($validated);

        // Guardamos el stock ingresado
        $product->stock()->create([
            'quantity' => $validated['quantity'],
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        
        return redirect()->route('products.index')->with('success', 'Producto creado');
    }

    public function getDataProduct($id)
    {
        $product = Product::with(['brand', 'stock'])->find($id);

        if ($product) {
            return response()->json([
                'exists' => true,
                'data' => $product,
            ]);
        }

        return response()->json(['exist' => false]);
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
        $data = Product::with('brand', 'stock')->find($id);
        $brands = Brand::all();
        return view('products.edit', compact('data', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $product = Product::with('stock')->findOrFail($id);

        // Limpieza de formato: 12.450,00 → 12450.00
        $fieldsToClean = [
            'cost',
            'retencion',
            'flete',
            'IVA',
            'cost_with_taxes',
            'utility',
            'price',
            'discount',
            'price_with_discount',
            'rentability',
        ];

        foreach ($fieldsToClean as $field) {
            if ($request->filled($field)) {
                $value = $request->$field;

                // Si tiene formato con separador de miles o coma decimal, limpiamos
                if (preg_match('/[.,]/', $value) && !is_numeric($value)) {
                    $value = str_replace(['.', ','], ['', '.'], $value);
                }

                $request->merge([$field => $value]);
            }
        }

        // Validación
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'cost'              => 'nullable|numeric',
            'retencion'         => 'nullable|numeric',
            'flete'             => 'nullable|numeric',
            'IVA'               => 'nullable|numeric',
            'cost_with_taxes'   => 'nullable|numeric',
            'utility'           => 'nullable|numeric',
            'price'             => 'nullable|numeric',
            'discount'          => 'nullable|numeric',
            'expiration_date'   => 'nullable|date',
            'price_with_discount' => 'nullable|numeric',
            'rentability'       => 'nullable|numeric',
            'details'           => 'nullable|string',
            'unity_type'        => 'required|string',
            'unit_of_measure'   => 'nullable|string',
            'brand_id'          => 'nullable|exists:brands,id',
            'quantity'          => 'required|integer|min:0',
        ]);

        // Actualizamos los campos
        $validated['updated_by'] = Auth::id();

        $product->update($validated);

        // Actualizamos el stock
        if ($product->stock) {
            $product->stock->update([
                'quantity' => $validated['quantity'],
                'updated_by' => Auth::id(),
            ]);
        } else {
            // En caso de que no exista el stock (raro pero posible)
            $product->stock()->create([
                'quantity' => $validated['quantity'],
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
