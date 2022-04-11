<div class="news--ticker">
    <div class="container">
        <div class="title">
            <h2>Breaking News</h2>
            {{-- <span>(Update 12 minutes ago)</span> --}}
        </div>

        <div class="news-updates--list" data-marquee="true">
            <ul class="nav">
                @foreach ($breakingnews as $item)
                    <li>
                        <h2><a href="{{route('post-detail', $item->id)}}">{{$item->title}}.</a></h2>
                    </li>                    
                @endforeach                
            </ul>
        </div>
    </div>
</div>