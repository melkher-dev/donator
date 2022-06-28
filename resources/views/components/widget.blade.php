@props([
    'header',
    'amount',
    'donator' => null
])

<div class="m-2">
    <div class="card" style="background-color: coral">
        <div class="card-body">
            {{ $header }}:
            <br>
            <h3>{{ $amount }} карбованцiв</h3>

            @if ($donator)
                <h3>by: {{ $donator }}</h3>
            @endif
        </div>
    </div>
</div>
