<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    // 🔒 Protected (Admin view)
    public function index()
    {
        $leads = Lead::latest()->get();
        return view('dashboard.pages.user.lead', compact('leads'));
    }

    // 🌍 Public (Form Submit)
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }


    // 🔒 Protected (Admin delete)
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return back()->with('success', 'Lead deleted successfully!');
    }
}
