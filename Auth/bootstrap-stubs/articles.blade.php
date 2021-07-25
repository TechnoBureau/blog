@extends('layouts.app')

@section('content')
<!-- Example row of columns -->
<div class="container">
    <div class="row pt-4">
        @foreach ($articles as $article)
        <div class="col-md-12 pt-2 pb-2 RecentArticle">
            <div class="card">
                <div class="card-header justify-content-start ArticleHeader">
                <h4>{{ $article->title }}</h4>
                </div>
                <div class="card-body justify-content-start">
                    <div class="ArticleDate secondaryContent">
                        <div class="ArticleMonth heading">
                            {!!$article->created_at->format('M') !!}
                        </div>
                        <div class="ArticleDay">
                            {!!$article->created_at->format('d') !!}
                        </div>
                        <div class="ArticleYear">
                            {!!$article->created_at->format('Y') !!}
                        </div>
                        </div>
                    <div class="postedBy">
                        <span class="posted iconKey">
                            By <a href="/authors/{{ \Str::slug($article->user->name) }}/" class="username" itemprop="author" >{!! $article->user->name !!}</a> at
                            <span class="fst-italic" itemprop="datePublished"> {!!$article->created_at->format('h:i A') !!}</span>
                        </span>
                    </div>
                <div class="ArticleText" itemprop="articleBody">{!! Str::words(strip_tags(Str::words($article->body,100),'<br><b></b>'),50,' ...') !!}</div>
                </div>
                <div class="card-footer justify-content-start ArticleFooter">
                    <div class="float-start categories" itemprop="articleSection">
                        <a href="/{{$article->category->slug}}" class="button">{{$article->category->name}}</a>                        
                    </div>

                    <div class="float-end continue">
                        <a class="iconKey button" href="/{{$article->category->slug}}/{{$article->slug}}.{{$article->id}}/"> Continue reading... </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @if($articles->isEmpty())
        <div class="col-md-12 pt-2 pb-2 RecentArticle">
            <div class="card">
                <div class="card-body justify-content-start text-center fs-4"> No Results found..</div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
