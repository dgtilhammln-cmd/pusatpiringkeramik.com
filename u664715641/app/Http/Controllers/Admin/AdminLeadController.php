<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class AdminLeadController extends Controller
{
    public function index()
    {
        $leads      = Lead::latest()->paginate(25);
        $stats = [
            'total'     => Lead::count(),
            'today'     => Lead::today()->count(),
            'this_month'=> Lead::thisMonth()->count(),
            'new'       => Lead::new()->count(),
        ];
        return view('admin.leads.index', compact('leads', 'stats'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate(['status' => 'required|in:new,contacted,closed']);
        $lead->update(['status' => $request->status]);
        return back()->with('success', 'Status lead diperbarui.');
    }

    public function updateNote(Request $request, Lead $lead)
    {
        $request->validate(['notes' => 'nullable|max:2000']);
        $lead->update(['notes' => $request->notes]);
        return back()->with('success', 'Catatan disimpan.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return back()->with('success', 'Lead dihapus.');
    }
}
