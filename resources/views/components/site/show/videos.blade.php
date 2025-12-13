@props([
    'videos' => 'videos',
])

<div>
    <div class="row">
        @foreach ($videos as $video)
            @php
                $videoId = getYouTubeVideoId($video->link);
                $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
            @endphp

            <div class="col-6 col-xl-4">
                <div class="video-block">
                    <iframe width="100%" height="270" src="{{ $embedUrl ?? '' }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>

                    <div class="video-text">
                        <h6>{{ $video->file_name }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
