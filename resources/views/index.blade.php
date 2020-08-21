@extends('layouts.frontend.welcome.master')

@push('CustomJS')

@endpush 

@push('CustomCSS')

@endpush 

@section('content')
    <!-- Welcome 歡迎區塊 -->
    <section class="slide fade-6 kenBurns">
		<div class="content">
			<div class="container">
				<div class="wrap">
					<div class="fix-12-12">
						<div class="fix-3-12">
							<img src="{{ asset('images/ShangDa_text_logo.png') }}" class="wide ae-1 fromCenter" alt="">
						</div>
						<p class="ae-3 mb-4">
							<span class="opacity-8">全苗栗最值得信賴的塑膠工廠</span>
						</p>
						@guest('consumer')
							@guest
								{{-- 客戶沒有登入且管理者也沒登入 --}}
								<a href="{{ route('register') }}" class="button blue gradient crop ae-3" style="text-decoration:none;">加入會員</a>
								<a href="{{ route('consumers.login') }}" class="button indigo gradient crop ae-3" style="text-decoration:none;">立刻登入</a>
							@endguest
						@else
							{{-- 客戶有登入 --}}
							<a href="{{ route('front.consumers.profile', ['id' => Auth::guard('consumer')->id()]) }}" class="button cyan gradient crop ae-3">{{ __('Profile') }}</a>
						@endguest
					</div>
				</div>
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/welcome.jpg)"></div>
    </section>
    
    {{-- <!-- About 關於尚達 -->
    <section class="slide fade-6 kenBurns fromLeft">
		<div class="content">
			<div class="container">
				<div class="wrap">
				
					<div class="fix-12-12">
						<div class="fix-7-12 left toRight">
							<h1 class="ae-1">關於尚達</h1>
							<p class="ae-2">
								<span class="opacity-8">
									自民國XX年（西元XXXX）成立自今，累積了XX年專業製造經驗，加上頂上的生產設備、高品質的進口原料與精益求精的工作態度，製造出價格親民、品質強韌耐用的塑膠袋。<br>信任尚達，天天發達。
								</span>
							</p>
							<a class="button blue gradient crop ae-3">了解更多</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/about.jpg)"></div>
    </section>
	
	<!-- Product 商品 -->
    <section class="slide fade-6 kenBurns">
		<div class="content">
			<div class="container">
				<div class="wrap">
				
					<div class="fix-7-12">
						<h1 class="ae-1">商品瀏覽</h1>
						<ul class="grid grid-85 equal ae-2 fromCenter" data-equal-collapse-width="767">
							<li class="col-6-12 col-tablet-1-2 col-phablet-1-1 margin-bottom-2 ae-3">
								<div class="pad" style="background: #F5FBFE">
									<h3>Moon</h3>
									<div class="price ae-5">
										<span class="currency">$</span>0
									</div>
									<div class="ae-5">
										<h6 class="uppercase bold small opacity-4">No Credit Card Needed</h6>
									</div>
									<div class="margin-top-3 margin-bottom-3 equalElement ae-6">
										<ul class="p tiny">
											<li><strong>25 Free Images</strong></li>
											<li class="opacity-8">Custom Domain</li>
											<li class="opacity-8">24/7 Customer Support</li>
										</ul>
									</div>
									<a href="#" class="button green gradient wide cropSides cropBottom ae-7">Try Free</a>
								</div>
							</li>
							<li class="col-6-12 col-tablet-1-2 col-phablet-1-1 ae-4">
								<div class="pad">
									<h3>Planet</h3>
									<div class="price ae-6">
										<span class="currency">$</span>6
									</div>
									<div class="ae-6">
										<h6 class="uppercase bold small opacity-4">Billed per Month</h6>
									</div>
									<div class="margin-top-3 margin-bottom-3 equalElement ae-7">
										<ul class="p tiny">
											<li><strong>60 Free Images</strong></li>
											<li><strong>Mobile-Optimized</strong></li>
											<li><strong>No Transaction Fees</strong></li>
											<li class="opacity-8">Custom Domain</li>
											<li class="opacity-8">24/7 Customer Support</li>
										</ul>
									</div>
									<a href="#" class="button blue gradient wide cropSides cropBottom ae-8">Purchase</a>
								</div>
							</li>
						</ul>
					</div> 
				
				</div>
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/product.jpg)"></div>
	</section>
	
	<!-- News 最新消息 -->
    <section class="slide fade-6 kenBurns fromRight">
		<div class="content">
			<div class="container">
				<div class="wrap">
				
					<div class="fix-12-12">
						<div class="fix-6-12 left toLeft">
							<h1 class="ae-1">Designers are meant to be loved, not to be understood.</h1>
							<p class="ae-2"><span class="opacity-8">You must forget all your theories, all your ideas before the subject. What part of these is really your own will be expressed in your&nbsp;expression.</span></p>
							<a class="button blue gradient crop ae-3">Get Started</a>
						</div>
					</div>
						
				</div>  
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/img-14.jpg)"></div>
    </section>
    
    <!-- Location 位置 -->
    <section class="slide fade-6 kenBurns">
		<div class="content">
			<div class="container">
				<div class="wrap">
			
					<div class="fix-12-12">
						<ul class="flex left">
							<li class="col-6-12 fromBottomLeft">
								<p class="opacity-6 margin-bottom-2 ae-1">Case study</p>
								<h1 class="ae-2">The Secret of Success</h1>
								<div class="ae-3">
									<p class="opacity-8">No matter how many times your amazing, absolutely brilliant work is rejected by the client, for whatever dopey, arbitrary reason, there is often another amazing, absolutely brilliant solution possible.</p>
								</div>
								<ul class="flex">
									<li class="col-6-12 ae-3">
										<h3 class="margin-top-3">Camera</h3>
										<p class="tiny opacity-6">Scan entire conversations in a chat-like view.</p>
									</li>
									<li class="col-6-12 ae-4">
										<h3 class="margin-top-3">Messages</h3>
										<p class="tiny opacity-6">Quickly swipe messages to your archive or trash.</p>
									</li>
									<li class="col-6-12 ae-5">
										<h3 class="margin-top-3">Music Center</h3>
										<p class="tiny opacity-6">Unforgettable feelings through a quality music.</p>
									</li>
									<li class="col-6-12 ae-6">
										<h3 class="margin-top-3">Channels</h3>
										<p class="tiny opacity-6">Read reviews, compare customer ratings.</p>
									</li>
								</ul>
							</li>
							<li class="col-1-12">&nbsp;</li>
							<li class="col-5-12 bottom">
							<div class="videoThumbnail shadow rounded popupTrigger margin-bottom-3 ae-7" data-popup-id="89-3">
								<img src="{{ asset('images/background/image-89-1.jpg') }}" class="wide" alt="Video Thumbnail"/>
							</div>
							<img src="{{ asset('images/background/image-89-2.jpg') }}" data-action="zoom" class="shadow rounded ae-8" alt="Image"/>
							</li>
						</ul>
					</div>
			
				</div>
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/img-89.jpg)"></div>
    </section>
    
    <!-- Popup Video -->
    <div class="popup autoplay" data-popup-id="89-3">
		<div class="close"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close"></use></svg></div>
		<div class="content">
			<div class="container">
			<div class="wrap">
				<div class="fix-10-12">
				<div class="embedVideo popupContent">
					<iframe src="https://www.youtube.com/embed/g8yBqxTiHSs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				</div>
			</div>
			</div>
		</div>
    </div> --}}
    
    <!-- Contact 聯絡我們 -->
    {{-- <section class="slide fade-6 kenBurns">
		<div class="content">
			<div class="container">
				<div class="wrap">
					<div class="fix-6-12">
						<h1 class="huge ae-1 margin-bottom-2">聯絡我們</h1>
						<p class="hero ae-2 margin-bottom-3">
							<span class="opacity-8">電話：(03) 755 0448</span><br>
							<span class="opacity-8">傳真：(03) XXX XXXX</span><br>
							<span class="opacity-8">信箱：XXXX@gmail.com</span><br>
						</p>
					</div>	
				</div>
			</div>
		</div>
		<div class="background" style="background-image:url(http://localhost/Shangda/public/images/background/img-95.jpg)"></div>
    </section> --}}
@endsection
