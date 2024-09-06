@extends('layouts.error')

@section('content')

<div class="d-flex flex-column flex-root" id="kt_app_root">

    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card card-flush py-5">
                <div class="card-body">
                    <h1 class="fw-bolder fs-1 text-gray-900 mb-4">噢! 系统出错了</h1>
                    {{-- <div class="fw-semibold fs-6 text-gray-500 mb-7">{{ $exception->getMessage() }}</div> --}}

                    <div class="mb-0">
                        <a href="{{ route('frontend.pages.home') }}" class="btn btn-sm btn-dark">@lang('word.return_home')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection