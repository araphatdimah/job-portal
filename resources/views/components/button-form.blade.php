
<button {{$attributes ->merge(['class' => 'rounded-md py-2 text-sm font-semibold text-green-500 shadow-sm hover:bg-gray-700 hover:text-white rounded-md px-2 py-2 text-base font-medium focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600', 'type' => 'submit'])}}>
    {{$slot}}
</button>