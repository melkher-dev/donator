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
