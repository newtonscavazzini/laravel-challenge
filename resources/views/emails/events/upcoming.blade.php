@component('mail::message')
# Your upcoming events

@foreach($events as $event)
- {{$event->title}}
@endforeach

@endcomponent
