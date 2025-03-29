<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->leftJoin('maintenance_records as m', 'a.id', '=', 'm.asset_id')
            ->select(
                'a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id',
                'l.name as location_name',
                DB::raw('count(m.id) as maintenance_count')
            )
            ->groupBy('a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'l.name');
        
        //SEARCH 
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('a.name', 'LIKE', "%{$search}%")
                ->orWhere('a.description', 'LIKE', "%{$search}%")
                ->orWhere('l.name', 'LIKE', "%{$search}%")
                ->orWhere('a.status', 'LIKE', "%{$search}%");
            });
        }

        //PAGINATION
        $assets = $query->paginate(5);

        return view('assets_view', ['assets' => $assets]);
    }


    public function insertForm()
    {
        $locations = DB::select('select * from locations');
        return view('assets_create', ['locations' => $locations]);
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location_name' => 'required|string|max:255',
            'status' => 'required|string|in:in_use,under_maintenance'
        ], [
            'name.required' => 'Asset name is required.',
            'name.max' => 'Asset name must not exceed 255 characters.',
            'description.required' => 'Asset description is required.',
            'location_name.required' => 'Asset location is required.',
            'location_name.max' => 'Location name must not exceed 255 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
        ]);

        
        $location = DB::select('select id from locations where name = ?', [$validated['location_name']]);
        if (empty($location)) {
            DB::insert('insert into locations (name, created_at, updated_at) values (?, NOW(), NOW())', [
                $validated['location_name']
            ]);
            $location_id = DB::getPdo()->lastInsertId();
        } else {
            $location_id = $location[0]->id;
        }

    
        DB::insert('insert into assets (name, description, location_id, status, created_at, updated_at) 
            values (?, ?, ?, ?, NOW(), NOW())', 
            [
                $validated['name'],
                $validated['description'],
                $location_id,
                $validated['status']
            ]
        );

        return redirect()->route('home')->with('Success', 'Asset added successfully!');
    }


    public function showEdit($id)
    {
        $asset = DB::select('
            select a.*, l.name as location_name
            from assets a
            join locations l ON a.location_id = l.id
            where a.id = ?', [$id]);
            $asset = $asset[0] ?? null;

        $locations = DB::select('select * from locations');

        return view('assets_update', ['asset' => $asset, 'locations' => $locations]);
    }

    public function edit(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location_name' => 'required|string|max:255',
            'status' => 'required|string|in:in_use,under_maintenance'
        ], [
            'name.required' => 'Asset name is required.',
            'name.max' => 'Asset name must not exceed 255 characters.',
            'description.required' => 'Asset description is required.',
            'location_name.required' => 'Asset location is required.',
            'location_name.max' => 'Location name must not exceed 255 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
        ]);

        $asset=DB::select('select * from assets where id = ?', [$id]);
        $asset = $asset[0];
        $prevLocation = $asset->location_id;
    
        $location = DB::select('select * from locations where name = ?', [$validated['location_name']]);
        $location = $location[0] ?? null;
    
        if (!$location) {
            DB::insert('insert into locations (name, created_at, updated_at) values (?, NOW(), NOW())', [
                $validated['location_name']
            ]);
            $location_id = DB::getPdo()->lastInsertId();
        } else {
            $location_id = $location->id;
        }
    
        DB::update('update assets set name = ?, description = ?, location_id = ?, status = ?, updated_at = NOW() where id = ?', [
            $validated['name'],
            $validated['description'],
            $location_id,
            $validated['status'],
            $id
        ]);

        $otherAsset=DB::select('select count(*) as count from assets where location_id = ?', [$prevLocation]);
        if($otherAsset[0]->count==0){
            DB::delete('delete from locations where id = ?', [$prevLocation]);
        }
    
        return redirect()->route('home')->with('Success', 'Asset updated successfully!');
    }
    

    public function delete($id)
    {
        $asset = DB::select('select * from assets where id = ?', [$id]);
        $asset = $asset[0]??null;

        $location_id = $asset->location_id;

        $otherAssets = DB::select('
            select count(*) as count from assets where location_id = ? and id != ?', 
            [$location_id, $id]
        );
        $otherAssets = $otherAssets[0] ?? null;

        if ($otherAssets->count == 0) {
            DB::delete('delete from locations where id = ?', [$location_id]);
        }
        DB::delete('delete from maintenance_records where asset_id = ?', [$id]);
        DB::delete('delete from assets where id = ?', [$id]);

        return redirect()->route('home')->with('Success', 'Asset deleted successfully!');
    }
}
