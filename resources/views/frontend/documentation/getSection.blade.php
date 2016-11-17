@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @include('frontend.documentation.include._sidebar')
        <div class="col-sm-9 col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ol class="breadcrumb">
                        <li><a href="#">Phoenix</a></li>
                        <li><a href="{{route('documentation.index')}}">Documentation</a></li>
                        <li>{{$section->category->name}}</li>
                        <li class="active">{{$section->name}}</li>
                    </ol>
                    <h2>{{$section->category->name}} - {{$section->name}}</h2>
                    <h3>Pages</h3>
                    <ol>
                        @if($section->pages->count() > 0)
                        @foreach($section->pages as $page)
                        <li><a href="{{route('documentation.section.page.get',[$section->id, $page->id])}}">{{$page->name}}</a> </li>
                        @endforeach
                        @else
                            <p>There are currently no pages for this section.</p>
                        @endif
                    </ol>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
