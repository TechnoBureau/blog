<!-- Example row of columns -->
<div class="container"><div class="row">
    @foreach ($articles as $article)
    <div class="col-md-4 order-sm-1">
    <h2>{{ $article->title }}</h2>
    <div class="section">
    <p>{!! Str::words(Str::words(strip_tags($article->body,'<br><b><p><h1><h2><h3>'),100),70,' ...') !!}... </p>
    </div>
    </div>
    <div class="col-md-4 order-sm-2">
        <p><a class="btn btn-secondary" href="/{{$article->category->slug}}/{{$article->slug}}.{{$article->id}}/" role="button">Read More &raquo;</a></p>
    </div>
    @endforeach
</div></div>