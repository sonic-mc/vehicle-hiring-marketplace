<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackAlert;



class VehicleController extends Controller
{

    public function notifySlack()
    {
        Notification::route('slack', config('services.slack.webhook_url'))
            ->notify(new SlackAlert('🔥 Action required! Something happened.'));

        return response()->json(['message' => 'Slack notification sent']);
    }

      public function index()
    {
        $vehicles = Vehicle::latest()->get(); // Or paginate if needed
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'purpose' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imagePaths[] = $img->store('vehicle_images', 'public');
            }
        }

        $vehicle = new Vehicle($validated);
        $vehicle->user_id = auth()->id(); // assuming only logged-in users can post
        $vehicle->images = json_encode($imagePaths);
        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle posted!');
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }
    public function edit(string $id)
    {
        //
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
