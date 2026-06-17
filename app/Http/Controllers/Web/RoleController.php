<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'message' => 'Data role berhasil diambil',
            'data' => $roles
        ]);
    }
}