@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center mt-2">
    <div class="card-group">
        <x-widget
            header="Biggest donation"
            amount="{{ $biggestDonation->amount }}"
            donator="{{ $biggestDonation->donator_name }}"
        ></x-widget>
        <x-widget
            header="Total donations for last month"
            amount="{{ $lastMonth }}"
        ></x-widget>
        <x-widget
            header="Total donations for all time"
            amount="{{ $summ }}"
        ></x-widget>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
</div>

<div class="d-flex justify-content-center mt-2">
    <div class="card col-6">
        <table class="table" style="background-color: rgb(191, 238, 252)">
            <thead>
                <tr>
                    <th class="px-4 py-2">{{ __('Donator_name') }}</th>
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
@endsection

@section('scripts')

{{-- график суммы с js --}}
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var tests ={{ Js::from($chart) }};

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
</script>
@endsection
