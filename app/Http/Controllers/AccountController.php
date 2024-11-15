<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountStoreRequest;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
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

        // Fetch all accounts
        $accounts = Account::orderBy('created_at', 'desc')->get();

        return view('account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $account = Account::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'fax_no' => $request->fax_no,
            'email' => $request->email,
            'website' => $request->website,
            'type' => $request->type,
            'industry' => $request->industry,
            'no_of_emp' => $request->employees,
            'sales_turnover' => $request->sales_turnover,
            'desc' => $request->desc,
            'ship_addr' => $request->ship_addr,
            'ship_city' => $request->ship_city,
            'ship_state' => $request->ship_state,
            'ship_country' => $request->ship_country,
            'ship_zip' => $request->ship_zip,
            'bill_addr' => $request->bill_addr,
            'bill_city' => $request->bill_city,
            'bill_state' => $request->bill_state,
            'bill_country' => $request->bill_country,
            'bill_zip' => $request->bill_zip,
            'created_by' => $user->id,
        ]);

        return redirect('/account')->with('flash_message', 'New account has been created successfully!');
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
        $account = Account::with(['contacts.calls', 'owner', 'modifiedBy'])
            ->where('id', $id)
            ->firstOrFail();

        // Check permissions
        if (isset($account->owner) && $user->id != $account->owner['id'] && !$this->isManager($user)) {
            return abort(403, 'Permission denied | You are not the owner.');
        }

        return view('account.show', compact('account'));
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
        $account = Account::with('owner')->where('id', $id)->firstOrFail();

        // Check permissions
        if (isset($account->owner) && $user->id != $account->owner['id'] && !$this->isManager($user)) {
            return abort(403, 'Permission denied | You are not the owner.');
        }

        return view('account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountStoreRequest $request, $id)
    {
        $user = Auth::user();
        $account = Account::findOrFail($id);

        $account->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'fax_no' => $request->fax_no,
            'email' => $request->email,
            'website' => $request->website,
            'type' => $request->type,
            'industry' => $request->industry,
            'no_of_emp' => $request->employees,
            'sales_turnover' => $request->sales_turnover,
            'desc' => $request->desc,
            'ship_addr' => $request->ship_addr,
            'ship_city' => $request->ship_city,
            'ship_state' => $request->ship_state,
            'ship_country' => $request->ship_country,
            'ship_zip' => $request->ship_zip,
            'bill_addr' => $request->bill_addr,
            'bill_city' => $request->bill_city,
            'bill_state' => $request->bill_state,
            'bill_country' => $request->bill_country,
            'bill_zip' => $request->bill_zip,
            'updated_by' => $user->id,
        ]);

        return redirect('/account')->with('msg', 'Account has been updated successfully!');
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
            $account = Account::with('owner')->where('id', $id)->firstOrFail();

            // Check permissions
            if ($user->id != $account->owner['id'] && !$this->isManager($user)) {
                return abort(403, 'Permission denied | You are not the owner.');
            }

            $account->delete();
            DB::commit();

            return redirect('/account')->with('msg', 'Account has been deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('msg', 'Something went wrong!');
        }
    }

    /**
     * Check if the user is a manager.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function isManager($user)
    {
        // Check if the user is null before calling hasAnyRole
        if ($user && $user->hasAnyRole(['Admin'])) {
            return true;
        }

        return false;
    }
}
