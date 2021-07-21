@extends('layouts.app')

@section('content')
<!-- Example row of columns -->
<div class="container">
    <div class="row pt-8">
        @foreach ($articles as $article)
        <div class="col-md-12 pt-2 pb-2">
            <div class="card">
                <div class="card-header justify-content-start">
                <h4>{{ $article->title }}</h4>
                </div>
                <div class="card-body justify-content-start">
                    <div class="postedBy">
                        <span class="posted iconKey">
                            <a href="/authors/{{ \Str::slug($article->user->name) }}/" class="username" itemprop="author" >{!! $article->user->name !!}</a> at
                            <a href="/{{$article->category->slug}}/{{$article->slug}}/article{{$article->id}}.html" itemprop="datePublished"> {!!$article->created_at->format('h:i A') !!}</a>
                        </span>
                    </div>
                <p>{!! Str::words(strip_tags(Str::words($article->body,100),'<br><b></b>'),50,' ...') !!}</p>
                </div>
                <div class="card-footer justify-content-start">
                    <div class="float-left categories" itemprop="articleSection">
                        <a href="/{{$article->category->slug}}" class="button">{{$article->category->name}}</a>                        
                    </div>

                    <div class="float-right continue">
                        <a class="iconKey button ajax-link" href="/{{$article->category->slug}}/{{$article->slug}}/article{{$article->id}}.html"> Continue reading... </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
