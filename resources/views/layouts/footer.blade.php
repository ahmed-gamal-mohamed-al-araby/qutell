
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Logo -->
                <div class="footer-logo">
                    <img src="{{asset('image/logo.png')}}" alt="Logo">
                </div>
                <!-- App Store Badges -->
                <div class="pra_footer">
                    <p>Where you can embark on a transformative journey through the scared text of islam </p>
                </div>
                <div class="footer-appstore">
                    <img src="{{asset('image/google_play.png')}}" alt="Google Play Badge">
                    <img src="{{asset('image/app_store.png')}}" alt="App Store Badge">
                </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                   <div class="col-md-4">
                       <p class="pra_custom">Navigate</p>
                       <ul class="footer-links">

                           <li><a href="#">Home</a></li>
                           <li><a href="#">About Us</a></li>
                           <li><a href="#">Reciters</a></li>
                           <li><a href="#">Blog</a></li>
                           <li><a href="#">Contact</a></li>
                       </ul>
                   </div>
                   <div class="col-md-4">
                       <p class="pra_custom">Popular Links</p>
                       <!--  -->
                       <ul class="footer-links">
                           <li><a href="#">Link 1</a></li>
                           <li><a href="#">Link 2</a></li>
                           <li><a href="#">Link 3</a></li>
                           <li><a href="#">Link 4</a></li>
                           <li><a href="#">Link 5</a></li>
                       </ul>
                   </div>
                   <div class="col-md-4">
                       <p class="pra_custom">Company</p>
                       <!--  -->
                       <ul class="footer-links">
                           <li><a href="#">FAQ</a></li>
                           <li><a href="#">Press</a></li>
                           <li><a href="#">Cookie Preferences</a></li>
                       </ul>
                   </div>
               </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <!-- Copyright Information -->
                <p>&copy; {{\Carbon\Carbon::now()->format('Y')}} Islamic . All Rights Reserved.</p>
            </div>
            <div class="col-md-6">
                <!-- Social Media Links -->
{{--                <ul class="footer-social-icons">--}}
{{--                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>--}}
{{--                </ul>--}}
            </div>
        </div>
    </div>
</footer>
