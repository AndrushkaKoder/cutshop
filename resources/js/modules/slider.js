import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

const swiper = new Swiper('.swiper-vendors', {
	direction: 'horizontal',
	loop: true,
	slidesPerView: 6,
	height: 300
	// autoplay: true,
});
