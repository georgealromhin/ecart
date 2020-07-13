<!-- Footer -->
<footer class="page-footer text-light pt-4" style="margin-top: 500px;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mx-auto">

        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">{{$settings[0]->value}}</h5>
        <p>{{$settings[18]->value}}</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Information</h5>

        <ul class="list-unstyled">
            <a href="{{url('about')}}" class="text-light">About Us</a>
          </li>
          <li>
            <a href="{{url('privacy_policy')}}" class="text-light">Privacy Policy</a>
          </li>
          <li>
            <a href="{{url('terms_conditions')}}" class="text-light">Terms & Conditions</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Customer Service</h5>

        <ul class="list-unstyled">
          <li>
            <a href="{{url('contact')}}" class="text-light">Contact Us</a>
          </li>
          <li>
            <a href="{{url('delivery_information')}}" class="text-light">Delivery Information</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">


    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <hr>

  <!-- Social buttons -->
  <ul class="list-unstyled list-inline text-center">
         <!-- Facebook -->
         @if ($settings[4]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 fb-btn" href="{{$settings[4]->value}}" target="_blank">
             <i class="fab fa-facebook-square fa-2x"></i>
           </a>
         </li>
         @endif
   
         <!-- instagram -->
         @if ($settings[5]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 instagram-btn" href="{{$settings[5]->value}}" target="_blank">
             <i class="fab fa-instagram fa-2x"></i>
           </a>
         </li>
         @endif
         <!-- Twitter -->
         @if ($settings[6]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 twitter-btn" href="{{$settings[6]->value}}" target="_blank">
             <i class="fab fa-twitter fa-2x"></i>
           </a>
         </li>
         @endif
         <!-- YouTube -->
         @if ($settings[7]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 youtube-btn" href="{{$settings[7]->value}}" target="_blank">
            <i class="fab fa-youtube fa-2x"></i>
           </a>
         </li>
         @endif

         <!-- VK -->
         @if ($settings[8]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 vk-btn" href="{{$settings[8]->value}}" target="_blank">
            <i class="fab fa-vk fa-2x"></i>
           </a>
         </li>
         @endif

         <!-- VK -->
         @if ($settings[9]->value != null)
         <li class="list-inline-item">
           <a class="btn-floating mx-1 vk-btn" href="https://telegram.me/{{$settings[9]->value}}" target="_blank">
            <i class="fab fa-telegram fa-2x"></i>
           </a>
         </li>
         @endif
      <!-- WhatsApp  -->
      @if ($settings[10]->value != null)
      <li class="list-inline-item">
        <a class="btn-floating mx-1 whatsapp-btn" href="whatsapp://send?abid={{$settings[10]->value}}&text=Hello" target="_blank">
        <i class="fab fa-whatsapp fa-2x"></i>
        </a>
      </li>
      @endif
  </ul>
  <!-- Social buttons -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© {{date('Y')}} Copyright:
    <a href="{{url('/')}}"> {{$settings[0]->value}} </a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->