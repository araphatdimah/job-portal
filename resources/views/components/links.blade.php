@props(['active'=>'false'])
<a {{$attributes}} class="{{$active ? 'bg-gray-600 text-orange-300':'font-semibold text-gray-300 hover:bg-gray-700 hover:text-blue'}} bg-gray-800 rounded-md px-1 py-2 text-base font-medium}}"
aria-content = "{{$active ? 'page' : 'false'}}">
    {{$slot}}
</a>
