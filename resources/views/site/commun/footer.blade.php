
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-12 footer-contact">
                    <h3>J.L. Prado</h3>
                    <p>
                        Erasmo Castellanos 874 - 102<br> Zona Rio Tijuana,<br> BC, México<br><br>
                        <strong>Phone:</strong> +1 800 8888 0513<br>
                        <strong>Phone:</strong> +52 664 634 1153<br>
                        <strong>Email:</strong> info@jlpradosc.com<br>
                    </p>
                </div>
                <div class="col-lg-5 col-md-12 d-flex flex-column">
                    <h4>@lang('site/home.Coordinators')</h4>
                    <div class="d-md-flex justify-content-md-around">
                        @foreach($coordinatorFooter as $coordinator)
                        <div class="col-6 d">
                            <p>
                                <strong>{{ $coordinator->name }}</strong><br> 
                                {{ $coordinator->cellphone }} <br>
                                {{ $coordinator->email }}<br>
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>J.L. Prado</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="#">Gabriel Llanes</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            {{-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> --}}
            <a href="https://www.facebook.com/CentroQJLP/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/aslimmerme_bariatric/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
            {{-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
        </div>
    </div>
</footer>

