@extends('frontend.theme.default.layouts.app')

@section('content')

    {{-- Pages --}}
    <h2>@lang('word.page_list')</h2>
    <div class="table-container">
        <table>
            <thead>
                <th>@lang('word.name')</th>
                <th>@lang('word.slug')</th>
                <th>@lang('word.url')</th>
            </thead>
            <tbody>
                <tr>
                    <td>@lang('word.home')</td>
                    <td>home</td>
                    <td><a href="{{ route('frontend.pages.home') }}">{{ route('frontend.pages.home') }}</a></td>
                </tr>
                <tr>
                    <td>@lang('word.blog')</td>
                    <td>blog</td>
                    <td><a href="{{ route('frontend.pages.blog') }}">{{ route('frontend.pages.blog') }}</a></td>
                </tr>
                <tr>
                    <td>@lang('word.maintenance')</td>
                    <td>maintenance</td>
                    <td><a href="{{ route('frontend.pages.single', ['slug' => 'maintenance']) }}">{{ route('frontend.pages.single', ['slug' => 'maintenance']) }}</a></td>
                </tr>
                @foreach(wncms()->page()->getList() as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td><a href="{{ route('frontend.pages.single', ['slug' => $page->slug ]) }}">{{ route('frontend.pages.single', ['slug' => $page->slug ]) }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Posts --}}
    <h2>@lang('word.post_list')</h2>
    <div class="table-container">
        <table>
            <thead>
                <th>@lang('word.id')</th>
                <th>@lang('word.thumbnail')</th>
                <th>@lang('word.title')</th>
                <th>@lang('word.category')</th>
                <th>@lang('word.tag')</th>
            </thead>
            <tbody>
                @foreach($wncms->post()->getList(pageSize:10) as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img class="post-thumbnail" src="{{ $post->thumbnail }}" alt=""></td>
                        <td><a href="{{ $post->singleUrl }}">{{ $post->title }}</a></td>
                        <td>
                            @foreach($post->postCategories as $postCategory)
                            @if($loop->index != 0),@endif
                            <span><a href="{{ route('frontend.posts.category', ['tagName' => $postCategory->name]) }}">{{ $postCategory->name }}</a></span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($post->postTags as $postTag)
                            @if($loop->index != 0),@endif
                            <span><a href="{{ route('frontend.posts.tag', ['tagName' => $postTag->name]) }}">{{ $postTag->name }}</a></span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $wncms->post()->getList(pageSize:10)->links() !!}

    {{-- Tags --}}
    <h2>@lang('word.tag')</h2>
    <div class="tabs">
        @foreach($wncms->tag()->getTypes() as $type)
            <button class="tab-link @if($loop->index == 0) active @endif" onclick="openTab(event, '{{ $type }}')">@lang('word.' . $type)</button>
        @endforeach
    </div>
    
    @foreach($wncms->tag()->getTypes() as $type)
        <div id="{{ $type }}" class="tab-content @if($loop->index == 0) active @endif">
            <div class="table-container">
                <table>
                    <thead>
                        <th>@lang('word.id')</th>
                        <th>@lang('word.name')</th>
                    </thead>
                    <tbody>
                        @foreach($wncms->tag()->getList(tagType:$type,pageSize:10) as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td><a href="#">{{ $tag->name }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    {{-- Thenme options --}}
    <h2>@lang('word.theme_options')</h2>
    <div class="table-container">
        <table>
            <thead>
                <th>@lang('word.key')</th>
                <th>@lang('word.value')</th>
            </thead>
            <tbody>
                @foreach($website->get_options() as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('foot_js')
    <script>
        function openTab(event, tabId) {
            // Get all elements with class="tab-content" and hide them
            var tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });

            // Get all elements with class="tab-link" and remove the class "active"
            var tabLinks = document.querySelectorAll('.tab-link');
            tabLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Show the current tab content and add "active" class to the clicked tab
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
@endpush