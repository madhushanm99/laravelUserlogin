<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'name'); // Default sort by 'name'
        $sortDirection = $request->query('direction', 'asc'); // Default sort direction

        // Ensure the sort field is one of the allowable columns
        if (!in_array($sortField, ['username', 'name', 'email'])) {
            $sortField = 'name'; // Fallback to default if not allowed
        }

        // Ensure the sort direction is either 'asc' or 'desc'
        $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';

        $users = User::orderBy($sortField, $sortDirection)->paginate(10);

        return view('dashboard', compact('users', 'sortField', 'sortDirection'));
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = false; // Deactivate the user
        $user->save();

        return back()->with('success', 'User deactivated successfully.');
    }
}
