<x-guest-layout>

    <h2>LISTA</h2>
    @if ($elementos->count())
        @foreach ($elementos as $item)
            {{ $item }}
            <hr>
        @endforeach
    @else
        <div>
            <p>No hay elementos</p>
        </div>
    @endif

</x-guest-layout>
