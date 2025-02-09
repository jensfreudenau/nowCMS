@props(['text' => '', 'name' =>'', 'id' =>''])
<textarea name="{{$name}}" id="{{$id}}" rows="10" aria-describedby="textHelp" class="mt-0 block w-full px-0.5 border-1 border-gray-200 focus:ring-0 focus:border-black">{{ Str::markdown(old('text', $text ?? '')) }}</textarea>

