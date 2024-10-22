<?php

namespace Modules\User\Http\Controllers;

use Modules\User\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Upload\Entities\Upload;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        return $dataTable->render('user::users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('access_user_management'), 403);

        // Check if the 'Manager' role exists
        $role = Role::where('name', 'Manager')->first();
        $managers = $role ? $role->users : collect(); // Return an empty collection if no 'Manager' role found

        return view('user::users.create', compact('managers'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'role' => 'required',
            'is_active' => 'required|in:1,2',
            'manager_id' => 'nullable|exists:users,id', // Validate manager_id
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'manager_id' => $request->manager_id, // Save selected manager
        ]);

        $user->assignRole($request->role);

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            if ($tempFile) {
                $user->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection('avatars');

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast("User Created & Assigned '$request->role' Role!", 'success');

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        // Check if the 'Manager' role exists
        $role = Role::where('name', 'Manager')->first();
        $managers = $role ? $role->users : collect(); // Return an empty collection if no 'Manager' role found

        return view('user::users.edit', compact('user', 'managers'));
    }

    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required',
            'is_active' => 'required|in:1,2',
            'manager_id' => 'nullable|exists:users,id', // Validate manager_id
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active,
            'manager_id' => $request->manager_id, // Update manager
        ]);

        $user->syncRoles($request->role);

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            if ($user->getFirstMedia('avatars')) {
                $user->getFirstMedia('avatars')->delete();
            }

            if ($tempFile) {
                $user->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection('avatars');

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast("User Updated & Assigned '$request->role' Role!", 'info');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('access_user_management'), 403);

        $user->delete();

        toast('User Deleted!', 'warning');

        return redirect()->route('users.index');
    }
}
