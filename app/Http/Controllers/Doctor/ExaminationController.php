<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        $queues = \App\Models\Queue::with('patient')
            ->where('queue_date', date('Y-m-d'))
            ->where('status', 'diperiksa')
            ->get();

        return view('doctor.index', compact('queues'));
    }

    public function create($queue_id)
    {
        $queue = \App\Models\Queue::with('patient')->findOrFail($queue_id);
        return view('doctor.examine', compact('queue'));
    }

    public function store(Request $request, $queue_id)
    {
        $request->validate([
            'complaint' => 'required',
            'diagnosis' => 'required',
            'action' => 'required',
        ]);

        $queue = \App\Models\Queue::findOrFail($queue_id);

        if ($queue->status == 'selesai') {
            return redirect()->route('doctor.index')->with('error', 'Gagal! Rekam medis untuk antrian ini sudah pernah disimpan sebelumnya.');
        }

        $record = \App\Models\MedicalRecord::create([
            'patient_id' => $queue->patient_id,
            'user_id' => auth()->id(),
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'action' => $request->action,
        ]);

        if ($request->has('medicines')) {
            foreach ($request->medicines as $item) {
                if ($item['id']) {
                    \App\Models\Prescription::create([
                        'medical_record_id' => $record->id,
                        'medicine_id' => $item['id'],
                        'quantity' => $item['qty'],
                        'instruction' => $item['note'],
                    ]);

                    $medicine = \App\Models\Medicine::find($item['id']);
                    $medicine->decrement('stock', $item['qty']);
                }
            }
        }

        $queue->update(['status' => 'selesai']);

        return redirect()->route('doctor.index')->with('success', 'Pemeriksaan dan Resep berhasil disimpan!');
    }

    public function history()
    {
        $history = \App\Models\MedicalRecord::with(['patient', 'prescriptions'])
            ->latest()
            ->get();

        return view('doctor.history', compact('history'));
    }
}
