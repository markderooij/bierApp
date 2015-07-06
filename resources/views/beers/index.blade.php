@extends('app')

@section('content')
<h2>Beers</h2>

    @if ( !count($beers) )
        You have no beers 
    @else
        <ul>
            @foreach( $beers['data'] as $beer )
                    <li>{{ $beer['id'] }} {{ $beer['name'] }} </li>
            @endforeach
        </ul>
        <pre> {{print_r($beers['data'])}} </pre>
    @endif

@endsection