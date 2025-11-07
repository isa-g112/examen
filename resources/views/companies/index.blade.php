
@extends('layout')
@section('content')
<h1>Companies</h1>
<table>
@foreach($companies as $company)
<tr><td>{{ $company->company_name }}</td></tr>
@endforeach
</table>
@endsection
