<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $assets = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->leftJoin('maintenance_records as m', 'a.id', '=', 'm.asset_id')
            ->select(
                'a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge',
                'l.name as location_name',
                DB::raw('count(m.id) as maintenance_count')
            )
            ->groupBy('a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge', 'l.name')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('a.name', 'like', "%$search%")
                    ->orWhere('a.description', 'like', "%$search%")
                    ->orWhere('a.in_charge', 'like', "%$search%")
                    ->orWhere('l.name', 'like', "%$search%")
                    ->orWhere('a.status', 'like', "%$search%");
                });
            })
            ->get();

        return view('assets_search', [
            'assets' => $assets,
            'search' => $search,
        ]);
    }

    public function index(Request $request)
    {
        
        $query = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->leftJoin('maintenance_records as m', 'a.id', '=', 'm.asset_id')
            ->select(
                'a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge',
                'l.name as location_name',
                DB::raw('count(m.id) as maintenance_count')
            )
            ->groupBy('a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge', 'l.name');

        $assets = $query->paginate(5);

        $groupedAssets = DB::table('assets as a')
        ->join('locations as l', 'a.location_id', '=', 'l.id')
        ->select(
            'a.location_id',
            'l.name as location_name',
            DB::raw('COUNT(a.id) as asset_count'),
            DB::raw('MAX(a.created_at) as latest_asset_created') 
        )
        ->groupBy('a.location_id', 'l.name')
        ->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $offset = ($currentPage - 1) * $perPage;
        $paginatedGroupedAssets = new LengthAwarePaginator(
            $groupedAssets->slice($offset, $perPage)->values(),
            $groupedAssets->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('assets_view', [
            'assets'=> $assets,
            'assetsByLocation'=> $paginatedGroupedAssets
        ]);
    }

    public function details($location_id)
    {
        $location = DB::table('locations')->where('id', $location_id)->first();
    
        $assets = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->select(
                DB::raw('MIN(a.id) as id'),
                'a.name',
                'a.in_charge',
                DB::raw('COUNT(a.id) as asset_count'),
                DB::raw('MIN(a.created_at) as created_at'),
                DB::raw('MIN(a.description) as description'),
                DB::raw('MIN(a.status) as status'),
                'l.name as location_name'
            )
            ->where('a.location_id', $location_id)
            ->groupBy('a.name', 'a.in_charge', 'l.name')
            ->get();
    
        return view('assets_details', [
            'assets' => $assets,
            'locationName' => $location->name ?? 'Unknown Location',
        ]);
    }
    
    public function assignedAssets(Request $request){
        $query = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->leftJoin('maintenance_records as m', 'a.id', '=', 'm.asset_id')
            ->select(
                'a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge',
                'l.name as location_name',
                DB::raw('count(m.id) as maintenance_count')
            )
            ->groupBy('a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge', 'l.name');
    
        $assets = $query->get();
    
        return view('assets_assigned', [
            'assets' => $assets,
            'in_charge' => $request->input('in_charge') 
        ]);
    }
    

    public function assignedToPerson($name)
    {
        $assets = DB::table('assets as a')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->leftJoin('maintenance_records as m', 'a.id', '=', 'm.asset_id')
            ->select(
                'a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge',
                'l.name as location_name',
                DB::raw('count(m.id) as maintenance_count')
            )
            ->where('a.in_charge', $name)
            ->groupBy('a.id', 'a.created_at', 'a.name', 'a.description', 'a.status', 'a.location_id', 'a.in_charge', 'l.name')
            ->get();
    
        return view('assets_assigned', [
            'assets' => $assets,
            'person' => $name, 
        ]);
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
            'in_charge' => 'required|string|max:255',
            'status' => 'required|string|in:in_use,under_maintenance,broken'
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

        DB::insert('insert into assets (name, description, location_id, status, in_charge, created_at, updated_at) 
            values (?, ?, ?, ?, ?, NOW(), NOW())', 
            [
                $validated['name'],
                $validated['description'],
                $location_id,
                $validated['status'],
                $validated['in_charge']
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
            'in_charge' => 'required|string|max:255',
            'status' => 'required|string|in:in_use,under_maintenance,broken'
        ]);

        $asset = DB::select('select * from assets where id = ?', [$id]);
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

        DB::update('update assets set name = ?, description = ?, location_id = ?, status = ?, in_charge = ?, updated_at = NOW() where id = ?', [
            $validated['name'],
            $validated['description'],
            $location_id,
            $validated['status'],
            $validated['in_charge'],
            $id
        ]);

        $otherAsset = DB::select('select count(*) as count from assets where location_id = ?', [$prevLocation]);
        if ($otherAsset[0]->count == 0) {
            DB::delete('delete from locations where id = ?', [$prevLocation]);
        }

        return redirect()->route('assignedToPerson', ['name' => $validated['in_charge']])
        ->with('Success', 'Asset updated successfully!');
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
