<x-layout-front title="Início">

@include('frontend.header')

<!--============= Featured Auction Section Starts Here =============-->
<section class="featured-auction-section padding-bottom mt--240 mt-lg--440 pos-rel">
    <div class="container">
        <div class="section-header cl-white mw-100 left-style">
            <h3 class="title">Dê um lance nesses leilões em destaque!</h3>
        </div>
        <div class="row justify-content-center mb-30-none">
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="auction-item-2">
                    <div class="auction-thumb">
                        <a href="./product-details.php"><img src="./assets/images/auction/car/auction-1.jpg" alt="car"></a>
                        <a href="#0" class="rating"><i class="far fa-star"></i></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h6 class="title">
                            <a href="#0">2018 Hyundai Sonata</a>
                        </h6>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter26"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="auction-item-2">
                    <div class="auction-thumb">
                        <a href="./product-details.php"><img src="./assets/images/auction/car/auction-2.jpg" alt="car"></a>
                        <a href="#0" class="rating"><i class="far fa-star"></i></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h6 class="title">
                            <a href="#0">2018 Nissan Versa, S</a>
                        </h6>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter27"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="auction-item-2">
                    <div class="auction-thumb">
                        <a href="./product-details.php"><img src="./assets/images/auction/car/auction-3.jpg" alt="car"></a>
                        <a href="#0" class="rating"><i class="far fa-star"></i></a>
                        <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                    </div>
                    <div class="auction-content">
                        <h6 class="title">
                            <a href="#0">2018 Honda Accord, Sport</a>
                        </h6>
                        <div class="bid-area">
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-auction"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Current Bid</div>
                                    <div class="amount">$876.00</div>
                                </div>
                            </div>
                            <div class="bid-amount">
                                <div class="icon">
                                    <i class="flaticon-money"></i>
                                </div>
                                <div class="amount-content">
                                    <div class="current">Buy Now</div>
                                    <div class="amount">$5,00.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="countdown-area">
                            <div class="countdown">
                                <div id="bid_counter28"></div>
                            </div>
                            <span class="total-bids">30 Bids</span>
                        </div>
                        <div class="text-center">
                            <a href="#0" class="custom-button">Submit a bid</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============= Featured Auction Section Ends Here =============-->
@include('frontend.footer')

</x-layout-front>
