<footer id="colophon" class="site-footer footer-primary">
  <div class="top-footer">
    <div class="container">
      <div class="upper-footer">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <aside class="widget widget_text">
              <div class="footer-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/site-logo.png') }}" alt="Footer Logo"></a>
              </div>
              <div class="textwidget widget-text">
                Urna ratione ante harum provident, eleifend, vulputate molestiae proin fringilla, praesentium magna conubia at perferendis, pretium, aenean aut ultrices.
              </div>
            </aside>
          </div>

          <div class="col-lg-3 col-sm-6">
            <aside class="widget widget_latest_post widget-post-thumb">
              <h3 class="widget-title">RECENT POST</h3>
              <ul>
                <li>
                  <figure class="post-thumb">
                    <a href="#"><img src="{{ asset('assets/images/img21.jpg') }}" alt=""></a>
                  </figure>
                  <div class="post-content">
                    <h6><a href="#">BEST JOURNEY TO PEACEFUL PLACES</a></h6>
                    <div class="entry-meta">
                      <span class="posted-on"><a href="#">February 17, 2022</a></span>
                    </div>
                  </div>
                </li>
                <li>
                  <figure class="post-thumb">
                    <a href="#"><img src="{{ asset('assets/images/img22.jpg') }}" alt=""></a>
                  </figure>
                  <div class="post-content">
                    <h6><a href="#">TRAVEL WITH FRIENDS IS BEST</a></h6>
                    <div class="entry-meta">
                      <span class="posted-on"><a href="#">February 17, 2022</a></span>
                    </div>
                  </div>
                </li>
              </ul>
            </aside>
          </div>

          <div class="col-lg-3 col-sm-6">
            <aside class="widget widget_text">
              <h3 class="widget-title">CONTACT US</h3>
              <div class="textwidget widget-text">
                <p>Feel free to contact and<br/> reach us !!</p>
                <ul>
                  <li><a href="tel:+01988256203"><i class="icon icon-phone1" aria-hidden="true"></i> +01(988) 256 203</a></li>
                  <li><a href="mailto:info@domain.com"><i class="icon icon-envelope1" aria-hidden="true"></i> info@domain.com</a></li>
                  <li><i class="icon icon-map-marker1" aria-hidden="true"></i> 3146 Koontz, California</li>
                </ul>
              </div>
            </aside>
          </div>

          <div class="col-lg-3 col-sm-6">
            <aside class="widget">
              <h3 class="widget-title">Gallery</h3>
              <div class="gallery gallery-colum-3">
                @for ($i = 21; $i <= 26; $i++)
                  <figure class="gallery-item">
                    <a href="{{ asset("assets/images/img$i.jpg") }}" data-fancybox="gallery-1">
                      <img src="{{ asset("assets/images/img$i.jpg") }}" alt="">
                    </a>
                  </figure>
                @endfor
              </div>
            </aside>
          </div>
        </div>
      </div>

      <div class="lower-footer">
        <div class="row align-items-center">
          
            <div class="social-icon">
              <ul>
                <li><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="https://www.twitter.com/"  target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="https://www.youtube.com/"  target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://www.linkedin.com/"  target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
            <div class="footer-menu">
              <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Term & Condition</a></li>
                <li><a href="#">FAQ</a></li>
              </ul>
            </div>
        </div>
      </div>

    </div>
  </div>

  <div class="bottom-footer">
    <div class="container">
      <div class="copy-right text-center">Copyright &copy; 2022 Traveler. All rights reserved.</div>
    </div>
  </div>
</footer>
