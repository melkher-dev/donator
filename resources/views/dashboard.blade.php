@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center mt-2">
    <div class="card-group">
        <x-widget header="Biggest donation" amount="{{ $biggestDonation->amount }}"
            donator="{{ $biggestDonation->donator_name }}"></x-widget>
        <x-widget header="Total donations for last month" amount="{{ $lastMonth }}"></x-widget>
        <x-widget header="Total donations for all time" amount="{{ $summ }}"></x-widget>
    </div>
</div>

<div class="d-flex justify-content-center mt-2">
    <form action="{{ route('charts.date') }}" method="post" id="dateForm">
        @csrf

        <div class="row">
            <div class="col">
                <label for="startDate">Start</label>
                <input id="startDate" name="startDate" class="form-control" type="date" />
            </div>

            <div class="col">
                <label for="endDate">End</label>
                <input id="endDate" name="endDate" class="form-control" type="date" />
            </div>

            <div class="col mt-3">
                <button id="search" type="search" name="search" class="btn btn-primary mt-2">Search</button>
            </div>
        </div>
    </form>
</div>

<div class="d-flex justify-content-center">
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
</div>


<div class="d-flex justify-content-center mt-2">
    <div class="card col-10">
        <div class="form-group">
            <input type="text" class="form-control pull-right" id="search1" placeholder="Search in table">
        </div>
        <table id="mytable" class="table table-sort table-arrows" style="background-color: rgb(191, 238, 252)">
            <thead>
                <tr>
                    <th id="dName" class="px-4 py-2">{{ __('Donator_name') }}</th>
                    <th class="px-4 py-2">{{ __('Email') }}</th>
                    <th class="px-4 py-2">{{ __('Amount') }}</th>
                    <th class="px-4 py-2">{{ __('Message') }}</th>
                    <th class="px-4 py-2">{{ __('Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td class="border px-4 py-2">{{ $donation->donator_name }}</td>
                    <td class="border px-4 py-2">{{ $donation->email }}</td>
                    <td class="border px-4 py-2">{{ $donation->amount }}</td>
                    <td class="border px-4 py-2">{{ $donation->message }}</td>
                    <td class="border px-4 py-2">{{ $donation->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $donations->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <form action="{{ route('donations.store') }}" method="post">
                        @csrf

                        <label for="donator_name">Name</label>
                        <input class="form-control @error('donator_name') is-invalid @enderror" type="text"
                            name="donator_name" id="donator_name" value="{{ old('donator_name') }}">
                        @error('donator_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                            id="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="amount">Amount</label>
                        <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount"
                            id="amount" value="{{ old('amount') }}">
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="message">Message</label>
                        <input class="form-control" type="text" name="message" id="message"
                            value="{{ old('message') }}">

                        <button type="save" class="btn btn-primary mt-2" name="save">Donate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
{{-- график суммы с js --}}
<script src="{{ asset('/js/table-sort.js') }}"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var searchUrl = {{ Js::from(route("search1")) }}

    function drawChart(tests = {{ Js::from($chart) }}) {
        var kek = [
            ['Date', 'Amount'],
            ...tests
        ];

        var data = google.visualization.arrayToDataTable(kek);


        var options = {
            title: 'Donation Statistics',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }

    $(document).ready(function () {
        $("#dateForm").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(),
                success: function(tests)
                {
                    drawChart(tests);
                },
                error: function (tests) {
                    console.log('This is Pomilka.');
                    console.log(tests);
                },
            });
        });

        $("#search1").keyup(function(e) {
            e.preventDefault();

            console.log($(this).val());

            // var form = $(this);
            // var actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: searchUrl,
                data: {
                    "_token": "{{ csrf_token() }}",
                    search: $(this).val()
                },
                success: function(data)
                {
                    $( "#mytable" ).replaceWith( data );
                },
                error: function () {
                    console.log('This is Pomilka.');
                    console.log();
                },
            });
        });
    });


</script>
@endsection
