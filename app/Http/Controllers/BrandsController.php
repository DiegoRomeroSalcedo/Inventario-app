<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('brands.index');
    }

    public function getJsonToIndex(Request $request) {
        $search = $request->input('search.value');
        $data = Brand::with(['updatedBy'])
            ->when($search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc');

        // dd($query->toSql(), $query->getBindings());

        return DataTables::eloquent($data)
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('name', fn($row) => $row->name)
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
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Brand::create($validated);
        
        return redirect()->route('brands.index')->with('success', 'Marca creada');
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
        // $data = Brand::findOrFail($id);
        // return view('brands.edit', compact('data'));
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
