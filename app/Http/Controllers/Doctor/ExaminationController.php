<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->query('sort', 'queue_number');
        $orderBy = $request->query('order', 'asc');

        $queues = \App\Models\Queue::with('patient')
            ->where('queue_date', date('Y-m-d'))
            ->where('status', 'diperiksa')
            ->orderBy($sortBy, $orderBy)
            ->paginate(5)
            ->withQueryString();

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
            'medicines.*.id' => 'nullable|exists:medicines,id',
            'medicines.*.qty' => 'nullable|integer|min:1',
        ]);

        $queue = \App\Models\Queue::findOrFail($queue_id);

        if ($queue->status == 'selesai') {
            return redirect()->route('doctor.index')->with('error', 'Data ini sudah diproses.');
        }

        $record = \App\Models\MedicalRecord::create([
            'queue_id'   => $queue->id,
            'patient_id' => $queue->patient_id,
            'user_id'    => auth()->id(),
            'complaint'  => $request->complaint,
            'diagnosis'  => $request->diagnosis,
            'action'     => $request->action,
        ]);

        if ($request->has('medicines')) {
            foreach ($request->medicines as $item) {
                if (!empty($item['id']) && $item['qty'] > 0) {
                    \App\Models\Prescription::create([
                        'medical_record_id' => $record->id,
                        'medicine_id'       => $item['id'],
                        'quantity'          => $item['qty'],
                        'instruction'       => $item['note'] ?? '-',
                    ]);

                    \App\Models\Medicine::find($item['id'])->decrement('stock', $item['qty']);
                }
            }
        }

        $queue->update(['status' => 'selesai']);

        return redirect()->route('doctor.index')->with('success', 'Pemeriksaan berhasil disimpan!');
    }

    public function history(Request $request)
    {
        $sortBy = $request->query('sort', 'queue_number');
        $orderBy = $request->query('order', 'asc');

        $records = \App\Models\Queue::with('patient')
            ->where('status', 'selesai')
            ->orderBy($sortBy, $orderBy)
            ->paginate(5)
            ->withQueryString();

        return view('doctor.history', compact('records'));
    }

    public function show($id)
    {
        $queue = \App\Models\Queue::with(['patient', 'medicalRecord.prescriptions.medicine'])
            ->findOrFail($id);

        return view('doctor.show', compact('queue'));
    }
}
