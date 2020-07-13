@component('mail::message')

<p>Order №{!! $data->order_number !!} on the site {!! url('/') !!}. the Total cost of the order is <b>{!! $data->total !!} {!! config('app.currency') !!}</b></p>

<p><b>Contact Details:</b></p>

<p><b>Name:</b> {!! $data->customer->name !!}</p>
<p><b>Email:</b> {!! $data->customer->email !!}</p>
<p><b>Phone:</b> {!! $data->customer->phone !!}</p>


<p><b>Order Type:</b> {!! $data->order_type !!}</p>
<p><b>Delivery Address:</b> {!! $data->delivery_address !!}</p>
<p><b>Comments:</b> {!! $data->comments !!}</p>


<strong>Order Details</strong>
<table>
    @foreach ($data->order_details as $item)
        <tr>
            <td><img src="{!! url($item->products->image) !!}" alt="img" style="object-fit: cover;width: 50px;height: 50px;border-radius: 25px;"> </td>
            <td>{!! $item->products->name !!}</td>
            <td>{!! $item->products->price !!} {!! config('app.currency') !!}</td>
            <td>x{!! $item->qty !!}</td>
            <td>{!! $item->qty * $item->products->price !!} {!! config('app.currency') !!}</td>
        </tr>
        
    @endforeach

</table>

<br>
This message is sent automatically by the system, please do not respond to it<br>

{!! config('app.name') !!}
@endcomponent
