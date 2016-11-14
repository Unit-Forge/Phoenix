@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row">
            <sidebar></sidebar>
            <div class="col-sm-9 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Documentation</h1>
                        <p>All units are built with knowledge and training.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
