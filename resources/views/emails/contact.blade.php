@component('mail::message')

    <p><b>From:</b> {!! $data->name !!}, {!! $data->email !!}</p>
    <p style="white-space: pre-line">{!! $data->message !!}</p>


@endcomponent
