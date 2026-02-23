<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $queues = \App\Models\Queue::with('patient')
            ->where('queue_date', $today)
            ->orderBy('queue_number', 'asc')
            ->get();

        $patients = \App\Models\Patient::orderBy('name', 'asc')->get();

        return view('admin.queues.index', compact('queues', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
        ]);

        $today = date('Y-m-d');

        $exists = \App\Models\Queue::where('patient_id', $request->patient_id)
            ->where('queue_date', $today)
            ->first();

        if ($exists) {
            return back()->with('error', 'Pasien ini sudah memiliki nomor antrian hari ini!');
        }

        $lastQueue = \App\Models\Queue::where('queue_date', $today)->max('queue_number') ?? 0;

        \App\Models\Queue::create([
            'patient_id' => $request->patient_id,
            'queue_number' => $lastQueue + 1,
            'queue_date' => $today,
            'status' => 'menunggu'
        ]);

        return redirect()->route('admin.queues.index')->with('success', 'Nomor antrian berhasil diambil!');
    }

    public function call(\App\Models\Queue $queue)
    {
        $queue->update(['status' => 'diperiksa']);

        return back()->with('success', 'Pasien nomor ' . $queue->queue_number . ' dipanggil!');
    }
}
