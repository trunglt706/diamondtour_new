@extends('guest.layout')
@section('title', 'Thanh toán')
@section('keywords', '')
@section('description', 'Thanh toán')
@section('image', '')
@section('content')
    <section class="main-content">
        <div class="wrapper home payment">
            <div class="widget_banner widget_banner_style_3">
                <div class="box-content">
                    <a href="/"><img src="/style/images/service/20150106-L1170194 1.png" alt="Image 1"></a>
                    <p class="title">THANH TOÁN</p>
                </div>
            </div>
            <div class="aleart-noti">
                <div class="container">
                    <div class="alert alert--success">
                        <img src="/style/images/icon/Ticket.png" alt="Image" srcset="">
                        <div class="content">
                            <p class="title">Have a coupon?<a href="/"> Click have to enter your code</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-payment">
                <div class="container">
                    <div class="row-grid">
                        <div class="box-left">
                            <h3 class="title">Cart total</h3>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="your-name" class="form-label required ">Firt name </label>
                                        <input type="text" class="form-control" id="your-name" name="your-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="your-surname" class="form-label required ">Last name</label>
                                        <input type="text" class="form-control" id="your-surname" name="your-surname"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="company-name" class="form-label">Company name (optinal)</label>
                                        <input type="text" class="form-control" id="company-name" name="company-name"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="coutry-region" class="form-label required">Coutry / Region</label>
                                        <select class="form-select" aria-label="Default select example" id="coutry-region"
                                            name="coutry-region">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="street-address" class="form-label required">Street address</label>
                                        <input type="text" class="form-control mb-3" id="street-address"
                                            name="street-address" required>
                                        <input type="text" class="form-control" id="street-address" name="street-address"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="town-city" class="form-label required">Town / City</label>
                                        <input type="text" class="form-control" id="town-city" name="town-city" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="country" class="form-label required">Country (optional)</label>
                                        <input type="text" class="form-control" id="country" name="country" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="postcode" class="form-label required">Postcode</label>
                                        <input type="email" class="form-control" id="postcode" name="postcode" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="number-phone" class="form-label required">Phone</label>
                                        <input type="email" class="form-control" id="number-phone" name="number-phone"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="your-email" class="form-label required">Email address</label>
                                        <input type="email" class="form-control" id="your-email" name="your-email"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <h3 class="title mt-5">Cart total</h3>
                                        <label for="your-message" class="form-label">Oreder note (optional)</label>
                                        <textarea class="form-control" id="your-message" name="your-message" rows="5"
                                            placeholder="House munber and street name"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-right">
                            <h3 class="title">Cart total</h3>
                            <div class="header-title row">
                                <div class="col-6">
                                    Product
                                </div>
                                <div class="col-6">
                                    Subtotal
                                </div>
                            </div>
                            <div class="location row">
                                <div class="col-6">
                                    <p class="content">Hotel FT. Manchester</p>
                                    <p class="description">6391 Elgin St. Celina, Delaware 10299</p>
                                </div>
                                <div class="col-6">
                                    <p class="content">$350.00</p>
                                    <p class="description">$350.00 payable in total</p>
                                </div>
                            </div>
                            <div class="type-room row">
                                <div class="col-6">
                                    <p class="content">Room: </p>
                                    <p class="description">Luxury room</p>
                                </div>
                                <div class="col-6">
                                    <p class="content">Service:</p>
                                    <p class="description">$30.00</p>
                                </div>
                            </div>
                            <p class="content">Date :</p>
                            <p class="description"> 22/7/2021 <i class="fa-solid fa-arrow-right-long"></i> 23/7/2021</p>
                            <p class="content">Adults:</p>
                            <p class="description">2</p>
                            <p class="content">Childrens :</p>
                            <p class="description">2</p>
                            <p class="content">Munber of room:</p>
                            <p class="description">2</p>
                            <p class="content">Service :</p>
                            <div class="description">
                                <p>Morning coffee</p>
                                <p>Gym and Spa</p>
                                <p>Serve dinner</p>
                            </div>
                            <p class="content">Quantity :</p>
                            <p class="description">2</p>

                            <div class="total-bill">
                                <div class="row box-bill">
                                    <div class="col-6 box-content-bill">
                                        <div>
                                            <p>Subtotal</p>
                                        </div>
                                        <div>
                                            <p>Total</p>
                                        </div>
                                        <div>
                                            <p>To Pay</p>
                                        </div>
                                        <div>
                                            <p>Remaining</p>
                                        </div>
                                    </div>
                                    <div class="col-6 box-price-bill">
                                        <div>
                                            <p>$450.00</p>
                                        </div>
                                        <div>
                                            <p>$450.00</p>
                                        </div>
                                        <div>
                                            <p>$450.00</p>
                                        </div>
                                        <div>
                                            <p>$450.00</p>
                                            <p class="note">(excludes $0.00 VAT)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-type row">
                                <div class="form-check">
                                    <div class="form-check-content">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Direct bank transfer
                                        </label>
                                    </div>
                                </div>
                                <div class="direct-bank-transfer">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and.</p>
                                </div>
                                <div class="form-check">
                                    <div class="form-check-content">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Paypal <a href="/">What is PayPal?</a>
                                        </label>
                                    </div>
                                    <div class="list-image">
                                        <img src="/style/images/payment/pngaaa 1.png" alt="Image" srcset="">
                                    </div>

                                </div>
                                <div class="form-check">
                                    <div class="form-check-content">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3" checked>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Direct bank transfer
                                        </label>
                                    </div>
                                    <div class="list-image">
                                        <img src="/style/images/payment/image 10.png" alt="Image" srcset="">
                                        <img src="/style/images/payment/image 11.png" alt="Image" srcset="">
                                        <img src="/style/images/payment/image 8.png" alt="Image" srcset="">
                                        <img src="/style/images/payment/image 9.png" alt="Image" srcset="">

                                    </div>

                                </div>
                                <div class="form-policy">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown privacy policy
                                    </p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckIndeterminate">
                                        <label class="form-check-label required" for="flexCheckIndeterminate">
                                            I have read and agree to the website <a href="/">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn mt-5 mb-5">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
