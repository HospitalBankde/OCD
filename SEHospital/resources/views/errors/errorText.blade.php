/**
* Created by PhpStorm.
* User: AunN
* Date: 11/1/15 AD
* Time: 12:00 AM
*/


@extends('layout.default')

@section('title')
    <title>Error</title>
@endsection

@section('content')
	<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
                @if(isset($text))
                	{{$text}}
                @else
                	Error.
                @end
    </div>
@end


@stop