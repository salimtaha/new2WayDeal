<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ReplayContactMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $contacts = Contact::orderByDesc('id')->when($request->search, function ($query) use ($request) {
            $query->where('email', 'LIKE', '%' . $request->search . '%')->where('status', 'pending');
            $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->where('status', 'pending');

        })->where('status', 'pending')->latest()->paginate(10);
        return view('admin.pages.contacts.index', compact('contacts'));
    }

    public function old(Request $request)
    {
        $contacts = Contact::orderByDesc('id')->when($request->search, function ($query) use ($request) {
            $query->where('email', 'LIKE', '%' . $request->search . '%')->where('status', 'completed');
            $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->where('status', 'completed');

        })->where('status', 'completed')->latest()->paginate(10);
        return view('admin.pages.contacts.old', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.pages.contacts.show' , compact('contact'));
    }

    public function replay(Contact $contact)
    {
        return view('admin.pages.contacts.repaly', compact('contact'));
    }
    public function sendReplay(Request $request)
    {

        Mail::to($request->email)->send(new ReplayContactMail($request));
        $contact = Contact::findOrFail($request->id);
        $contact->update([
            'status' => 'completed',
        ]);

        session()->flash('success', 'تم ارسال الرد بنجاح');
        return redirect()->route('admin.contacts.index');
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        session()->flash('success', 'تم الحذف  بنجاح');
        return redirect()->route('admin.contacts.index');
    }
    public function deleteSelected(Request $request)
    {
        try {
            foreach ($request->contacts as $id) {
                $contact = Contact::findOrFail($id);
                $contact->delete();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        session()->flash('success', 'تم حذف  عمليات التواصل المحدده');
        return redirect()->back();
    }
}
