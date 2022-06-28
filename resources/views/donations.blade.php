@extends('layouts.main')

@section('content')
<div class="container col-3">
    <form action="{{ route('donations.store') }}" method="post">
        @csrf

        <label for="donator_name">Name</label>
        <input class="form-control @error('donator_name') is-invalid @enderror" type="text" name="donator_name" id="donator_name" value="{{ old('donator_name') }}">
        @error('donator_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="email">Email</label>
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="amount">Amount</label>
        <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" value="{{ old('amount') }}">
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="message">Message</label>
        <input class="form-control" type="text" name="message" id="message" value="{{ old('message') }}">

        <button type="save" class="btn btn-primary mt-2" name="save">Donate</button>

    </form>
</div>


@endsection
