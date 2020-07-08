@extends('layout')

@section('title', 'OW Calendar | All Events')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Events</li>
@endsection

@section('content')
<div class="card mt-3">

    <div class="card-header d-flex justify-content-between">
        <span class="align-self-center">All Events for <span id="header-month">...</span> <span id="header-year"></span> </span>
        <a href="/events/create" class="btn btn-primary btn-sm">New event</a>
    </div>

    <div id="content-body" class="card-body">

        <div class="row events-navigation align-items-center">
            <div class="col-12 col-md-6 text-center text-md-left mb-2 mb-md-0">
                <select id="select_month" class="form-control w-auto d-inline btn-sm" name="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select id="select_year" class="form-control w-auto d-inline btn-sm" name="year">
                    @for($y = date('Y')-30; $y <= date('Y')+30; $y++)
                        <option value="{{ $y }}" @if($y == date('Y')) selected @endif>{{ $y }}</option>
                    @endfor
                </select>
                <button id="btn-specific-month" class="btn btn-secondary btn-sm">Go</button>
            </div>

            <div class="col-12 col-md-6 text-center text-md-right">
                <button id="btn-current-month" class="btn btn-secondary btn-sm" title="Current Month">
                    <i class="fa fa-calendar"></i>
                </button>
                <button id="btn-previous-month" class="btn btn-secondary btn-sm btn-change-month"><i class="fa fa-arrow-left"></i> <span id="txt-previous-month"></span></button>
                <button disabled class="btn btn-sm"><span id="current-month"></span></button>
                <button id="btn-next-month" class="btn btn-secondary btn-sm btn-change-month"><span id="txt-next-month"></span> <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>

        <div id="loading" class="text-center p-5">
            <i class="fa fa-spinner fa-spin" style="font-size: 3rem"></i>
        </div>

        <div id="events_list" class="row"></div>
    </div>
</div>

<div class="day-card col-sm-6 col-md-4 p-0">
    <div class="card h-100 rounded-0">
        <div class="card-body">
            <h5 class="day-card-title card-title">Title</h5>
            <h6 class="day-card-subtitle card-subtitle mb-2 text-muted">Subtitle</h6>
            <div class="day-card-events card">
                <ul class="day-card-events-ul list-group list-group-flush"></ul>
            </div>
        </div>
    </div>
</div>
<a href="#" class="event-card list-group-item list-group-item-action list-group-item-primary event-item">Event</a>

@endsection

@section('scripts')
<script src="{{ URL::asset('js/events-list.js') }}"></script>
<script>
    function loadCurrentMonth() {
        loadMonth('{{ $month }}', '{{ $year }}');
    }

    loadCurrentMonth();
    document.querySelector('#btn-current-month').addEventListener('click', loadCurrentMonth, false);
</script>
@endsection