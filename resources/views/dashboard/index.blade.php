@extends('layout')

@section('title', 'OW Calendar | Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="card mt-3">

        <div class="card-header d-flex justify-content-between">
            <span class="align-self-center">Upcoming events</span>
            <div>
                <a href="/events" class="btn btn-secondary btn-sm">All events</a>
                <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row" style="padding: 0 16px 0">
                @foreach ($calendar as $day)
                    <div class="col-sm-6 col-md-4 p-0">
                        <div class="card h-100 rounded-0">
                            <div class="card-body">
                                <h5 class="card-title">{{ $day['date'] }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    @if (count($day['events']) > 0)
                                        {{count($day['events'])}} {{ str_plural('event', count($day['events'])) }} for this day
                                    @else
                                        No events for this day
                                    @endif
                                </h6>
                                @if (count($day['events']) > 0)
                                    <div class="card">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($day['events'] as $event)
                                                <li class="list-group-item">
                                                    <a href="/events/{{$event->id}}">{{ $event->title }}</a><br>
                                                    <small class="text-muted ">{{ $event->description }}</small><br>
                                                    <small class="text-muted" title="Participants">
                                                        <i class="fa fa-users"></i> {{ count($event->participants) }}
                                                    </small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
