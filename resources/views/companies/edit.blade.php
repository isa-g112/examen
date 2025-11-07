@extends('layouts.app')

@section('content')
<h2>Edit Company</h2>
<form action="{{ route('companies.update', $company) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label class="form-label">Company Name</label>
    <input name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}">
    @error('company_name')<div class="text-danger">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Legal Representative Name</label>
    <input name="legal_representative_name" class="form-control" value="{{ old('legal_representative_name', $company->legal_representative_name) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Legal Representative Lastname</label>
    <input name="legal_representative_lastname" class="form-control" value="{{ old('legal_representative_lastname', $company->legal_representative_lastname) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Legal Representative Email</label>
    <input name="legal_representative_email" class="form-control" value="{{ old('legal_representative_email', $company->legal_representative_email) }}">
  </div>
  <div class="mb-3">
    <label class="form-label">User (owner)</label>
    <select name="users_iduser" class="form-control">
      <option value="">-- none --</option>
      @foreach($users as $user)
        <option value="{{ $user->iduser }}" @selected(old('users_iduser', $company->users_iduser) == $user->iduser)>{{ $user->name }} ({{ $user->email }})</option>
      @endforeach
    </select>
  </div>

  <button class="btn btn-primary">Update</button>
</form>
@endsection
