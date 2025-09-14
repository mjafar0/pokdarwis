@extends('layouts.bookingLayout')
@section('title', 'Booking - Checkout')

@section('banner')
  <!-- ***Inner Banner html start form here*** -->
  <x-banner2 :pokdarwis="$pokdarwis ?? ($paket->pokdarwis ?? null)" />
  <!-- ***Inner Banner html end here*** -->
@endsection

@section('main')
<main id="content" class="site-main">
  <section class="booking-inner-page">
    <div class="booking-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 right-sidebar">
            <div class="booking-form-wrap">
              <form method="get" action="#">
                <div class="booking-content">
                  <div class="form-title">
                    <span>1</span>
                    <h3>Your Details</h3>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>First name*</label>
                        <input type="text" class="form-control" name="firstname_booking">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Last name*</label>
                        <input type="text" class="form-control" name="lastname_booking">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email*</label>
                        <input type="email" class="form-control" name="email_booking">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Confirm Email*</label>
                        <input type="email" class="form-control" name="email_booking_confirm">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone*</label>
                        <input type="text" class="form-control" name="phone_booking">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="booking-content">
                  <div class="form-title">
                    <span>2</span>
                    <h3>Payment Information</h3>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Name on card*</label>
                        <input type="text" class="form-control" name="card_name">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row align-items-center">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Card number*</label>
                            <input type="text" id="card_number" name="card_number" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <img src="{{ asset('assets/images/cards.png') }}" alt="Cards">
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Expiration date*</label>
                            <div class="row">
                              <div class="col-md-6">
                                <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="MM">
                              </div>
                              <div class="col-md-6">
                                <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="Year">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Security code*</label>
                            <div class="row">
                              <div class="col-4">
                                <div class="form-group">
                                  <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
                                </div>
                              </div>
                              <div class="col-8">
                                <img src="{{ asset('assets/images/icon_ccv.gif') }}" alt="ccv">
                                <small>Last 3 digits</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="info-content">
                    <h4>Or checkout with Paypal</h4>
                    <p>Lorem ipsum dolor sit amet, vim id accusata sensibus…</p>
                    <a href="#">
                      <img src="{{ asset('assets/images/paypal_bt.png') }}" alt="PayPal">
                    </a>
                  </div>
                </div>

                <div class="booking-content">
                  <div class="form-title">
                    <span>3</span>
                    <h3>Billing Address</h3>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Country*</label>
                        <select name="country" id="country" class="form-control">
                          <option value="" selected>Select your country</option>
                          <option value="Europe">Europe</option>
                          <option value="United states">United states</option>
                          <option value="Asia">Asia</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Street line 1*</label>
                        <input type="text" name="street_1" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Street line 2</label>
                        <input type="text" name="street_2" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label>City*</label>
                        <input type="text" name="city_booking" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>State*</label>
                        <input type="text" name="state_booking" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="form-group">
                        <label>Postal code*</label>
                        <input type="text" name="postal_code" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Additional Information</label>
                        <textarea rows="6" class="form-control" placeholder="Notes about your order…"></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-policy">
                  <h3>Cancellation policy</h3>
                  <div class="form-group">
                    <label class="checkbox-list">
                      <input type="checkbox" name="agree">
                      <span class="custom-checkbox"></span>
                      I accept terms and conditions and general policy.
                    </label>
                  </div>
                  <button type="submit" class="round-btn">Submit Now</button>
                </div>

              </form>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="price-table-summary">
              <h4 class="bg-title">Summary</h4>
              <table>
                <tbody>
                  <tr><td><strong>Packages cost</strong></td><td class="text-right">$500</td></tr>
                  <tr><td><strong>Dedicated tour guide</strong></td><td class="text-right">$60</td></tr>
                  <tr><td><strong>Insurance</strong></td><td class="text-right">$40</td></tr>
                  <tr><td><strong>tax</strong></td><td class="text-right">13%</td></tr>
                  <tr class="total"><td><strong>Total cost</strong></td><td class="text-right"><strong>$580</strong></td></tr>
                </tbody>
              </table>
            </div>

            <div class="widget-bg widget-support-wrap">
              <div class="icon"><i class="fas fa-phone-volume"></i></div>
              <div class="support-content">
                <h5>HELP AND SUPPORT</h5>
                <a href="tel:+5512398700" class="phone">+55 123 987 00</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection