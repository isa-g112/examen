@extends('layouts.app')

@section('content')
<h2>Company: {{ $company->company_name }}</h2>
<ul class="list-group">
  <li class="list-group-item"><strong>ID:</strong> {{ $company->idcompany }}</li>
  <li class="list-group-item"><strong>Legal Rep:</strong> {{ $company->legal_representative_name }} {{ $company->legal_representative_lastname }}</li>
  <li class="list-group-item"><strong>Email:</strong> {{ $company->legal_representative_email }}</li>
  <li class="list-group-item"><strong>User:</strong> {{ optional($company->user)->name }}</li>
</ul>
<a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
