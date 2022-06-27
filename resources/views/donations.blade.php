@extends('layouts.main')

@section('content')
<div class="container col-3">
    <form action="{{ route('donations.store') }}" method="post">
        @csrf

        <label for="donator_name">Name</label>
        <input class="form-control" type="text" name="donator_name" id="donator_name">

        <label for="email">email</label>
        <input class="form-control" type="email" name="email" id="email">

        <label for="amount">Amount</label>
        <input class="form-control" type="text" name="amount" id="amount">

        <label for="message">Message</label>
        <input class="form-control" type="text" name="message" id="message">

        <button type="save" class="btn btn-primary mb-2" name="save">Donate</button>

    </form>
</div>


@endsection
