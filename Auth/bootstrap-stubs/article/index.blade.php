@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-2">
        <div class="col-md-12 pt-2 pb-2 RecentArticle">
            <div class="card">
                @if($article)
                <div class="card-header justify-content-start ArticleHeader"> 
                    <h4 >{{ $article->title }}</h4>
                </div>
                <div class="card-body justify-content-start">                    
                    <div class="postedBy">
                        <span class="posted iconKey">
                            By <a href="/authors/{{ \Str::slug($article->user->name) }}/" class="username" itemprop="author" >{!! $article->user->name !!}</a> at
                            <span class="fst-italic" itemprop="datePublished"> {!!$article->created_at->format('d-M-Y h:i A') !!}</span>
                        </span>
                    </div>
                    <div class="ArticleText" itemprop="articleBody">{!! $article->body !!}</div>
                </div>
                <div class="card-footer justify-content-start ArticleFooter">
                    <div class="float-start categories" itemprop="articleSection">
                        <a href="/{{$article->category->slug}}" class="button">{{$article->category->name}}</a>                        
                    </div>

                    <div class="float-end continue">
                        
                    </div>
                </div>
                @else
                <div class="card-body justify-content-start text-center fs-4"> No Results found..</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
