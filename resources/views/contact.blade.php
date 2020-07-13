@extends('layout')
@section('title', 'Contact Us')


@section('content')

    <h3> Contact Us </h3>



    <div class="row mt-5">
        <div class="col-md-6">

            <h5 class="mt-5"><i class="fas fa-map-marker-alt text-danger"></i> Address</h5>
            <p>{{$settings[1]->value}}</p>

            <h5 class="mt-5"><i class="fas fa-envelope text-success"></i> E-Mail</h5>
            <a href="mailto:{{$settings[2]->value}}">{{$settings[2]->value}}</a>

            <h5 class="mt-5"><i class="fas fa-phone-alt text-primary"></i> Phone Number</h5>
            <a href="tel:{{$settings[3]->value}}">{{$settings[3]->value}}</a>

            <h5 class="mt-5"><i class="far fa-clock"></i> Opening hours</h5>
            <p class="pre-line-text">{{$settings[11]->value}}</p>
        </div>
        <div class="col-md-6">
        <form action="{{url('send_mail')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Name*</label>
              <input type="text" name="name" id="name" class="form-control shadow-sm" required>
            </div>

            <div class="form-group">
                <label for="email">E-Mail*</label>
                <input type="email" name="email" id="email" class="form-control shadow-sm" required>
            </div>

            <div class="form-group">
                <label for="message">Message*</label>
                <textarea name="message" id="message" class="form-control shadow-sm" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-danger w-100 shadow-sm">SUBMIT</button>

        </form>
        @if($errors->any())
              <p class="text-danger text-center mt-2">
                  Error: {{ implode('', $errors->all(':message')) }}
              </p>
              @endif
        </div>
    </div>
    
@endsection

@section('script')
@if ($message = Session::get('error'))

<script>

    Swal.fire('{{$message}}', '', 'error');

</script>



@endif



@if ($message = Session::get('success'))

<script>

    Swal.fire('{{$message}}', '', 'success');

</script>



@endif

<script>$('form').submit(function(e) {Swal.fire({title: '',text: 'Sending...',allowEscapeKey: false,allowOutsideClick: false});Swal.showLoading();});</script>
@endsection
