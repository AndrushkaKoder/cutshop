@if($vendors)
	<section class="mt-20 overflow-hidden">

		@include('components.section.title', ['title' => 'Бренды'])

		<div class="swiper-vendors">
			<div class="swiper-wrapper">
				@foreach($vendors as $vendor)
					<div class="swiper-slide">
						<a href="/catalog/?vendor={{ $vendor->title }}" class="">
							<div class="w-100 flex justify-center">
								<img src="{{ $vendor->getCover() ?? noImage() }}"
								     class="object-cover w-full h-full"
								     alt="{{ $vendor->title }}">
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</section>
@endif


