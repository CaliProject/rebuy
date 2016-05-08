<div id="hero-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @for($i = 0; $i < count($bannerPosts); $i++)
            <li data-target="#hero-carousel" data-slide-to="{{ $i }}"{{ $i === 0 ? 'class=active' : '' }}></li>
        @endfor
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($bannerPosts as $i => $post)
            <div class="item{{ $i === 0 ? ' active' : '' }}" style="background-image: url('{{ $post->coverImage() }}');">
                <div class="container">
                    <div class="carousel-caption">
                        <a href="{{ $post->link() }}" target="_blank">
                            <h2 class="carousel-title">{{ $post->title }}</h2>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="left carousel-control" href="#hero-carousel" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">上一个</span>
    </a>
    <a class="right carousel-control" href="#hero-carousel" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">下一个</span>
    </a>
</div>