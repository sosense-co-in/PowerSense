<?php

namespace App\Http\Controllers;

use App\Models\AmcContract;
use App\Models\Account;
use App\Models\ContractItems;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AmcContractController extends Controller
{
    /**
     * Display a listing of the AMC contracts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access the contracts.');
        }

        $isManager = $this->isManager($user);

        if ($isManager) {
            $contracts = AmcContract::with(['account', 'owner'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $contracts = AmcContract::where('created_by', $user->id)
                ->with(['account', 'owner'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new AMC contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        // Fetch the latest AMC contract created by the user
        $contract = AmcContract::where('created_by', $user->id)
            ->latest()
            ->first();
        $lastRefNo = $contract->ref_no ?? '0000'; // Ensure lastRefNo is a string

        // Generate new reference number
        $newRefNo = str_pad(substr($lastRefNo, -4) + 1, 4, '0', STR_PAD_LEFT);
        $fname = $user->first_name;
        $term = strtoupper(substr($fname, 0, 3));

        // Special case for 'Poonam'
        if ($fname == 'Poonam') {
            $term = 'PNM';
        }

        $date = Carbon::now();
        $refNo = 'PV/' . $term . '/' . strtoupper($date->format('M')) . '/' . $date->format('Y') . '-' . ($date->format('y') + 1) . '/' . $newRefNo;

        // Fetch all accounts
        $accounts = Account::all(); // Fetch all accounts

        return view('contracts.create', compact('refNo', 'accounts')); // Pass both refNo and accounts to the view
    }

    /**
     * Store a newly created AMC contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required',
            'product_items.*' => 'required',
            'cost_per_unit.*' => 'required|numeric',
            'quantity.*' => 'required|numeric',
            'total_cost.*' => 'required|numeric',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        $contract = new AmcContract();
        $contract->ref_no = $request->ref_no;
        $contract->type = $request->type == 'comp' ? 'Comprehensive' : 'Non Comprehensive';
        $contract->location = $request->location;
        $contract->account_id = $request->account_id;
        $contract->terms_conditions = $request->terms_cond;
        $contract->own_auth_sign_name = $request->own_auth_sign_name;
        $contract->own_auth_sign_desn = $request->own_auth_sign_desn;
        $contract->own_auth_sign_mobile = $request->own_auth_sign_mobile;
        $contract->cust_auth_sign_name = $request->cust_auth_sign_name;
        $contract->cust_auth_sign_desn = $request->cust_auth_sign_desn;
        $contract->taxes = $request->taxes;
        $contract->payment = $request->payment;
        $contract->validity = $request->validity;
        $contract->contract_start = $request->contract_start;
        $contract->contract_end = $request->contract_end;
        $contract->status = 'In Review';
        $contract->created_by = $user->id;
        $contract->save();

        for ($i = 0; $i < count($request->product_items); $i++) {
            if ($request->product_items[$i] != null) {
                $product = new ContractItems();
                $product->contract_id = $contract->id;
                $product->product_desc = $request->product_items[$i];
                $product->hsn = $request->hsn[$i];
                $product->rating = $request->rating[$i];
                $product->sr_no = $request->sr_no[$i];
                $product->rate = $request->cost_per_unit[$i];
                $product->qty = $request->quantity[$i];
                $product->amount = $request->total_cost[$i];
                $product->save();
            }
        }

        DB::commit();
        return redirect()->route('amc-contracts.index')->with('msg', 'New AMC Contract created successfully.');
    }

    /**
     * Display the specified AMC contract.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = AmcContract::with(['account', 'owner', 'modified_by', 'items'])
            ->where('id', $id)
            ->firstOrFail();
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified AMC contract.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = AmcContract::with(['account', 'items'])
            ->where('id', $id)
            ->firstOrFail();
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified AMC contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_items.*' => 'nullable',
            'cost_per_unit.*' => 'nullable|numeric',
            'quantity.*' => 'nullable|numeric',
            'total_cost.*' => 'nullable|numeric',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        $contract = AmcContract::with('items')->where('id', $id)->firstOrFail();
        $contract->ref_no = $request->ref_no;
        $contract->type = $request->type == 'comp' ? 'Comprehensive' : 'Non Comprehensive';
        $contract->location = $request->location;
        $contract->account_id = $request->account_id;
        $contract->terms_conditions = $request->terms_cond;
        $contract->own_auth_sign_name = $request->own_auth_sign_name;
        $contract->own_auth_sign_desn = $request->own_auth_sign_desn;
        $contract->own_auth_sign_mobile = $request->own_auth_sign_mobile;
        $contract->cust_auth_sign_name = $request->cust_auth_sign_name;
        $contract->cust_auth_sign_desn = $request->cust_auth_sign_desn;
        $contract->taxes = $request->taxes;
        $contract->payment = $request->payment;
        $contract->validity = $request->validity;
        $contract->contract_start = $request->contract_start;
        $contract->contract_end = $request->contract_end;
        $contract->status = 'In Review';
        $contract->updated_by = $user->id;
        $contract->save();

        // Deleting existing items and creating new ones
        foreach ($contract->items as $value) {
            $value->delete();
        }

        for ($i = 0; $i < count($request->product_items); $i++) {
            if ($request->product_items[$i] != null) {
                $product = new ContractItems();
                $product->contract_id = $contract->id;
                $product->product_desc = $request->product_items[$i];
                $product->hsn = $request->hsn[$i];
                $product->rating = $request->rating[$i];
                $product->sr_no = $request->sr_no[$i];
                $product->rate = $request->cost_per_unit[$i];
                $product->qty = $request->quantity[$i];
                $product->amount = $request->total_cost[$i];
                $product->save();
            }
        }

        DB::commit();
        return redirect()->route('amc-contracts.index')->with('msg', 'AMC Contract updated successfully.');
    }

    /**
     * Remove the specified AMC contract from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = AmcContract::findOrFail($id);
        $contract->delete();

        return redirect()->route('amc-contracts.index')->with('msg', 'Deleted Successfully...');
    }

    /**
     * Download the specified AMC contract as a PDF.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $contract = AmcContract::with(['account', 'owner', 'modified_by', 'items'])
            ->where('id', $id)
            ->firstOrFail();

        $pdf = PDF::loadView('contracts.download', compact('contract'));

        return $pdf->download('AMC_Contract_' . $contract->ref_no . '.pdf');
    }

    /**
     * Change the status of the AMC contract.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $contract = AmcContract::findOrFail($id);
        $contract->status = $request->status;
        $contract->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    /**
     * Delete a specific contract item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteContractItem($id)
    {
        $item = ContractItems::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }

    /**
     * Check if the current user is a manager.
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
