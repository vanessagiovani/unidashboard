@extends('layouts.sidebar')
@section('content')
<div class="container">
    <embed src="../storage/files/{{$file->name}}" type="application/pdf" width="1000px" height="1000px" style="margin: auto;">
</div>

@endsection