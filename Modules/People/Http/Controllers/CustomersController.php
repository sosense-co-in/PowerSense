<?php

namespace Modules\People\Http\Controllers;

use Modules\People\DataTables\CustomersDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Customer;
use App\Models\User; // Import User model
use App\Models\Account;
use Spatie\Permission\Models\Role; // Import Role model
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function index(CustomersDataTable $dataTable)
    {
        abort_if(Gate::denies('access_customers'), 403);

        return $dataTable->render('people::customers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_customers'), 403);

        $accounts = Account::all(); // Fetch all accounts
        return view('people::customers.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create_customers'), 403);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|max:255',
            'customer_email' => 'required|email|max:255|unique:users,email', // Ensure email is unique
            'password' => 'required|min:8|confirmed', // For User creation
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        // Create the customer record
        $customer = Customer::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
        ]);

        // Create a corresponding user
        $user = User::create([
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
        ]);

        // Assign the "Customer" role
        $customerRole = Role::where('name', 'Customer')->first();
        if ($customerRole) {
            $user->assignRole($customerRole);
        } else {
            return back()->withErrors(['role' => 'Customer role not found!']);
        }

        toast('Customer and User Created!', 'success');

        return redirect()->route('customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('show_customers'), 403);

        return view('people::customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('edit_customers'), 403);

        return view('people::customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        abort_if(Gate::denies('update_customers'), 403);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'is_active' => 'required|in:1,2',
        ]);

        $customer->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'is_active' => $request->is_active,
        ]);

        toast('Customer Updated!', 'info');

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('delete_customers'), 403);

        $customer->delete();

        toast('Customer Deleted!', 'warning');

        return redirect()->route('customers.index');
    }
}
