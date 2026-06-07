<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorProfile;

class VendorController extends Controller
{
    // SHOW ALL VENDORS
    public function index()
    {
        $vendors = VendorProfile::with('user')->latest()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    // UPDATE VENDOR STATUS
    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $allowed = ['pending', 'approved', 'rejected', 'suspended'];

        if (!in_array($status, $allowed)) {
            return redirect('/admin/vendors')->with('error', 'Invalid vendor status');
        }

        $profile = VendorProfile::findOrFail($id);
        $profile->status = $status;
        $profile->save();

        // Send database notification to the vendor node
        $profile->user->notify(new \App\Notifications\VendorStatusNotification($profile));

        return redirect('/admin/vendors')->with('success', 'Vendor status updated successfully');
    }
}
