@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2>{{ $article->name }}</h2>
        <div>{{ \Illuminate\Support\Str::limit($article->body, 200) }}</div>
    @endforeach
@endsection