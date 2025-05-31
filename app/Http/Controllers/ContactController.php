<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);

        $todayCount = Contact::whereDate('created_at', Carbon::today())->count();
        $yesterdayCount = Contact::whereDate('created_at', Carbon::yesterday())->count();
        $dayBeforeYesterdayCount = Contact::whereDate('created_at', Carbon::today()->subDays(2))->count();

        return view('contacts.index', compact('contacts', 'todayCount', 'yesterdayCount', 'dayBeforeYesterdayCount'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|digits:10',
            'message' => 'required|string|max:500',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $validated['image'] = $imageName;
        }

        Contact::create($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'required|digits:10',
            'message' => 'required|string|max:500',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($contact->image && file_exists(public_path('uploads/' . $contact->image))) {
                unlink(public_path('uploads/' . $contact->image));
            }
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $validated['image'] = $imageName;
        }

        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function delete(Contact $contact)
    {
        if ($contact->image && file_exists(public_path('uploads/' . $contact->image))) {
            unlink(public_path('uploads/' . $contact->image));
        }
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function export()
    {
        $date = Carbon::now()->format('Ymd');
        $fileName = "contacts_{$date}.csv";

        return Excel::download(new ContactsExport, $fileName);
    }

}
