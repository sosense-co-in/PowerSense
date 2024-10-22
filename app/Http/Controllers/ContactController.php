<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Account; // Make sure to import the Account model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ContactStoreRequest;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $isManager = $this->isManager($user);

        if ($isManager) {
            $contacts = Contact::with(['account'])->orderBy('created_at', 'desc')->get();
        } else {
            $contacts = Contact::with(['account'])->where('created_by', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::all(); // Fetch all accounts for the dropdown
        return view('contact.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $contact = Contact::create($request->all() + ['created_by' => $user->id]);

        return redirect('/contact')->with('flash_message', 'New contact has been created...!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $contact = Contact::with(['account'])->where('id', $id)->firstOrFail();

        if ($user->id != $contact->created_by && !$this->isManager($user)) {
            return abort(403, 'Permission denied | You are not the owner.');
        }

        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $contact = Contact::findOrFail($id);

        if ($user->id != $contact->created_by && !$this->isManager($user)) {
            return abort(403, 'Permission denied | You are not the owner.');
        }

        $accounts = Account::all(); // Fetch all accounts for the dropdown
        return view('contact.edit', compact('contact', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactStoreRequest $request, $id)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $contact = Contact::findOrFail($id);

        if ($user->id != $contact->created_by && !$this->isManager($user)) {
            return abort(403, 'Permission denied | You are not the owner.');
        }

        $contact->update($request->all() + ['updated_by' => $user->id]);
        return redirect('/contact')->with('msg', 'Contact has been updated...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $contact = Contact::findOrFail($id);

            if ($user->id != $contact->created_by && !$this->isManager($user)) {
                return abort(403, 'Permission denied | You are not the owner.');
            }

            $contact->delete();
            DB::commit();

            return redirect('/contact')->with('msg', 'Contact has been deleted...!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('msg', 'Something went wrong!');
        }
    }

    /**
     * Check if the user is a manager.
     *
     * @param  \Illuminate\Foundation\Auth\User $user
     * @return bool
     */
    public function isManager($user)
    {
        return $user->hasAnyRole(['Admin']);
    }
}
