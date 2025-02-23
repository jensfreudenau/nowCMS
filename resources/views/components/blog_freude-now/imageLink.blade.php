<a
    class="my-image-links"
    title="{{$content->header}}"
    data-overlay="#ffffff"
    data-maxwidth="1400px"
    data-gall="{{$content->category?->name}}"
    href="{{asset('storage/')}}/{{$media->getPathRelativeToRoot()}}">
    <img class="md:p-2" src="{{asset('storage/')}}/{{$media->getPathRelativeToRoot()}}" alt="{{$media->meta}}" />
</a>
