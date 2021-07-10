<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\RegisterTenantRequest;
use App\Models\Tenant;

class RegistredTenantController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterTenantRequest $request)
    {
        $tenant = Tenant::create($request->validated());

        $tenant->createDomain(['domain' => $request->domain]);

        return redirect(tenant_route($tenant->domains()->first()->domain, 'tenant.login'));
    }
}
