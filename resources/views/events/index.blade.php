@extends('layout')

@section('title', 'OW Calendar | All Events')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Events</li>
@endsection

@section('content')
<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <span class="align-self-center">All Events</span>
        <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
    </div>

    <div class="card-body">

        @include('subviews.list_events',
                ['events' => $events, 'emptyMessage' => 'There are no events to show.'])

        <div class="d-flex mt-4">
            <div class="mx-auto">
                {{ $events->links("pagination::bootstrap-4") }}
            </div>
        </div>

    </div>
</div>
@endsection
