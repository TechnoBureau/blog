<!-- Example row of columns -->
<div class="container"><div class="row">
    @foreach ($articles as $article)
    <div class="col-md-4 order-sm-1">
    <h2>{{ $article->title }}</h2>
    <p>{!! Str::words(strip_tags(Str::words($article->body,100),'<br><b></b>'),50,' ...') !!}... </p>
    </div>
    <div class="col-md-4 order-sm-2">
        <p><a class="btn btn-secondary" href="{{ $article->slug }}" role="button">Read More &raquo;</a></p>
    </div>
    @endforeach
</div></div>