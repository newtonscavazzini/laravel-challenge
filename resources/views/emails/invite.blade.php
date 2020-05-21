@component('mail::message')
# Join {{$event->title}}!

{{$owner}} is inviting you to join the event called '**{{$event->title}}**'

You may create an account if you do not already have one.

@component('mail::button', ['url' => $joinUrl])
Accept Invite
@endcomponent

Thanks.

@endcomponent
