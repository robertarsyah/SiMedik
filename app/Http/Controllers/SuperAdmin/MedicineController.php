<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->query('sort', 'name');
        $orderBy = $request->query('order', 'asc');

        $medicines = \App\Models\Medicine::orderBy($sortBy, $orderBy)
            ->paginate(5)
            ->withQueryString();

        return view('super_admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('super_admin.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        Medicine::create($request->all());
        return redirect()->route('superadmin.medicines.index')->with('success', 'Obat berhasil ditambah!');
    }

    public function edit(Medicine $medicine)
    {
        return view('super_admin.medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        $medicine->update($request->all());
        return redirect()->route('superadmin.medicines.index')->with('success', 'Data obat diperbarui!');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('superadmin.medicines.index')->with('success', 'Obat berhasil dihapus!');
    }
}
