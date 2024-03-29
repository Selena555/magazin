<ul>
    @foreach ($categories as $category)
        {{--        <li>{{ $category->name }}</li>--}}
        @dd($categories)
        {{--        <ul>--}}
        {{--            @foreach ($category->childrenCategories as $childCategory)--}}
        {{--                @include('child_category', ['child_category' => $childCategory])--}}
        {{--            @endforeach--}}
        {{--        </ul>--}}
    @endforeach
</ul>
