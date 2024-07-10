document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.ProductSlider');

    sliders.forEach(function(slider) {
        const sliderWrapper = slider.querySelector('.SliderWrapper');
        const nextButton = slider.querySelector('.SliderButton.Next');
        const prevButton = slider.querySelector('.SliderButton.Prev');
        const products = slider.querySelectorAll('.Product');
        const productsCount = products.length;
        let slideIndex = 0;

        nextButton.addEventListener('click', function() {
            if(slideIndex < productsCount - 1) {
                slideIndex++;
                updateSliderPosition();
            }
        });

        prevButton.addEventListener('click', function() {
            if(slideIndex > 0) {
                slideIndex--;
                updateSliderPosition();
            }
        });

        function updateSliderPosition() {
            const slideWidth = sliderWrapper.querySelector('.Product').clientWidth;
            const slideMove = slideIndex * slideWidth;
            sliderWrapper.style.transform = `translateX(-${slideMove}px)`;
        }
    });
});