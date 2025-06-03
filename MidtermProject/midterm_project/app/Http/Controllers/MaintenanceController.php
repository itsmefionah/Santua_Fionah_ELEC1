<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    public function showMaintenance($asset_id) {
    $asset = DB::select('select * from assets where id = ?', [$asset_id]);
    $asset = $asset[0] ?? null;

    $records = DB::select(
        'SELECT maintenance_records.*, users.name as created_by_name 
         FROM maintenance_records 
         JOIN users ON maintenance_records.created_by = users.id 
         WHERE asset_id = ? 
         ORDER BY maintenance_date DESC',
        [$asset_id]
    );

    return view('maintenance_view', [
        'asset' => $asset,
        'records' => $records
    ]);
}


    public function AddMaintenance($asset_id) {
        $asset = DB::select('select * from assets where id = ?', [$asset_id]);
        $asset = $asset[0] ?? null;

        return view('maintenance_create', ['asset' => $asset]);
    }

    public function insertAssetMaintenance(Request $request, $asset_id) {
        $validated = $request->validate([
            'maintenance_date' => 'required|date',
            'notes' => 'required|string',
            'staff' => 'required|string',
            'status' => 'required|in:serviceable,unserviceable'
        ],[
            'maintenance_date.required' => 'Maintenance date is required.',
            'maintenance_date.date' => 'Please provide a valid date.',
            'notes.required' => 'Notes are required.',
            'staff.required' => 'Staff is required.',
            'status' => 'required|in:serviceable,unserviceable',
            'status.in' => 'Status must be either serviceable or unserviceable.',
        ]);

        $asset = DB::select('select * from assets where id = ?', [$asset_id]);

        DB::insert(
            'insert into maintenance_records (asset_id, maintenance_date, notes, staff, status, created_by, created_at, updated_at) values (?, ?, ?, ?, ?, ?, NOW(), NOW())',
            [ 
                $asset_id,
                Carbon::parse($validated['maintenance_date'])->toDateTimeString(),
                $validated['notes'],
                $validated['staff'],
                $validated['status'],
                auth()->id()
            ]
        );


        return redirect()->route('mindex', ['id' => $asset_id])->with('Success', 'Maintenance record added successfully!');
    }
    
    public function editMaintenance($asset_id, $record_id) {
        $asset = DB::select('select * from assets where id = ?', [$asset_id]);
        $asset = $asset[0] ?? null;

        $record = DB::select('select * from maintenance_records where id = ? and asset_id = ?', [$record_id, $asset_id]);
        $record = $record[0] ?? null;

        return view('maintenance_update', [
            'asset' => $asset,
            'record' => $record
        ]);
    }

    public function updateMaintenance(Request $request, $asset_id, $record_id) {
        $validated = $request->validate([
            'maintenance_date' => 'required|date',
            'notes' => 'required|string',
            'staff' => 'required|string',
            'status' => 'required|in:serviceable,unserviceable'
        ],[
            'maintenance_date.required' => 'Maintenance date is required.',
            'maintenance_date.date' => 'Please provide a valid date.',
            'notes.required' => 'Notes are required.',
            'staff.required' => 'Staff is required.',
            'status.in' => 'Status must be either serviceable or unserviceable.',
        ]);

        $record = DB::select('select * from maintenance_records where id = ? and asset_id = ?', [$record_id, $asset_id]);
        
        DB::update(
            'update maintenance_records set maintenance_date = ?, notes = ?, staff = ?, status =?, updated_at = NOW() where id = ? and asset_id = ?',
            [$validated['maintenance_date'], $validated['notes'], $validated['staff'], $validated['status'], $record_id, $asset_id]
        );

        return redirect()->route('mindex', ['id' => $asset_id])->with('Success', 'Maintenance record updated successfully!');
    }

    public function deleteMaintenance($asset_id, $record_id) {
        $record = DB::select('select * from maintenance_records where id = ? and asset_id = ?', [$record_id, $asset_id]);

        DB::delete('delete from maintenance_records where id = ? and asset_id = ?', [$record_id, $asset_id]);

        return redirect()->route('mindex', ['id' => $asset_id])->with('Success', 'Maintenance record deleted successfully!');
    }

    public function showMaintenanceHistory($id)
    {
        $asset = DB::select('select * from assets where id = ?', [$id]);
        $asset = $asset[0] ?? null;

        $records = DB::select(
            'SELECT maintenance_records.*, users.name as created_by_name
            FROM maintenance_records
            JOIN users ON maintenance_records.created_by = users.id
            WHERE asset_id = ?
            ORDER BY maintenance_date DESC',
            [$id]
        );

        return view('maintenance_history', [
            'asset' => $asset,
            'records' => $records
        ]);
    }

    
}
