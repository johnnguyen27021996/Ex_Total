<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use PhpParser\Builder;
use function foo\func;

class FormSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $user_id = $request->input('user_id');
        $phone = $request->input('phone');
        $role_name = $request->input('role_name');

        $users = User::with('phone', 'roles')->where('id', $user_id)
            ->when($phone, function ($query, $phone) {
                $query->orWhereHas('phone', function ($query) use ($phone) {
                   $query->where('number', $phone);
                });
            })
            ->when($role_name, function ($query, $role_name) {
                $query->orWhereHas('roles', function ($query) use ($role_name) {
                    $query->where('name', $role_name);
                });
            })
            ->get();

        return view('search', compact('users'));
    }
}
