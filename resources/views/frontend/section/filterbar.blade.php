<div class="posts--filter-bar">
    <div class="container">
        <ul class="nav" style="width: 100%">
            <li style="width: 25%">
                <a href="{{ route('featured') }}">
                    <i class="fa fa-star-o"></i>
                    <h5>Featured News</h5>
                </a>
            </li>
            <li style="width: 25%">
                <a href="{{ route('popular') }}">
                    <i class="fa fa-heart-o"></i>
                    <h5>Popular</h5>
                </a>
            </li>
            <li style="width: 25%">
                <a href="{{ route('hotnews') }}">
                    <i class="fa fa-fire"></i>
                    <h5>Hot News</h5>
                </a>
            </li>
            <li style="width: 25%">
                <a href="{{route('trending')}}">
                    <i class="fa fa-flash"></i>
                    <h5>Trending News</h5>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <i class="fa fa-eye"></i>
                    <span>Most Watched</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>

@php
    use App\Models\Program;
    $program = Program::whereStatus('active')->get();
    // dd($program);
@endphp

<style>
    .owl-carousel .item {
      height: 10rem;
      background: #4DC7A0;
      padding: 1rem;
    }
    .owl-carousel .item h4 {
      color: #FFF;
      font-weight: 400;
      margin-top: 0rem;
     }
     .centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
<script>
    jQuery(document).ready(function($) {
    $('.owl-carousel').owlCarousel({
        items:1,
        dots: true,
        nav: false,
        animateOut: 'fadeOutLeft',
        animateIn: 'fadeInRight',
        autoplay:true,
        loop:true,
        onTranslated: animateSlide,
        onTranslate: removeAnimation
    });

    function removeAnimation() {
        var item = $(".owl-item .layer");
        item.removeClass(item.children().data('animate'));
    }

    function animateSlide() {
        var item = $(".owl-item.active .layer");
        item.addClass(item.children().data('animate'));
    }
});
</script>

<div class="row">
    <div class="container">
        <div class="owl-carousel owl-theme">
            @forelse ($program as $key=>$item)
            <div class="slide-item-{{$key+1}}">
                <div class="layer">
                    <div data-animate="animated fadeInLeft">
                        <a href="{{route('participant-form',$item->id)}}">
                            <img style="max-height: 120px; width:100%" src="{{asset('upload/program/Thumb-lg-'.$item->image)}}" alt="The Last of us">
                        </a>
                        {{-- <div style="text-decoration-color: black" class="centered">{{$item->title}}</div> --}}

                    </div>
                </div>
                
            </div>
                
            @empty
                
            @endforelse
    
        </div>
        
    </div>
</div>