<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->get();
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Pasien berhasil didaftarkan!');
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:patients,nik,' . $patient->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
