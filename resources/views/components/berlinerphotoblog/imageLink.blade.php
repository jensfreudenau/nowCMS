<a
    class="my-image-links"
    title="{{$content->header}}"
    data-overlay="#ffffff"
    data-maxwidth="1400px"
    data-gall="{{$gallery}}"
    href="{{asset('storage/')}}/{{$media->getPathRelativeToRoot()}}">
    <img class="{{$class}}" src="{{asset('storage/')}}/{{$media->getPathRelativeToRoot($square)}}" alt="{{$media->headline}}" />
</a>

