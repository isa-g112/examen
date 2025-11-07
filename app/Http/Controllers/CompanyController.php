<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create() {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request) {
        Company::create($request->validated());
        return redirect()->route('companies.index')->with('success', 'Company created');
    }

    public function show(Company $company) {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    public function update(StoreCompanyRequest $request, Company $company) {
        $company->update($request->validated());
        return redirect()->route('companies.index')->with('success', 'Company updated');
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted');
    }
}
