<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function showMaintenance($asset_id) {
        $asset = DB::select('select * from assets where id = ?', [$asset_id]);
        $asset = $asset[0] ?? null;

        if (!$asset) {
            return redirect()->route('home')->with('error', 'Asset not found');
        }

        $records = DB::select('select * from maintenance_records where asset_id = ? order by maintenance_date desc', [$asset_id]);

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
            'notes' => 'required|string'
        ]);

        $asset = DB::select('select * from assets where id = ?', [$asset_id]);

        DB::insert(
            'insert into maintenance_records (asset_id, maintenance_date, notes, created_at, updated_at) values (?, ?, ?, NOW(), NOW())',
            [$asset_id, $validated['maintenance_date'], $validated['notes']]
        );

        return redirect()->route('mindex', ['id' => $asset_id])->with('Success', 'Maintenance record added successfully!');
    }
}
