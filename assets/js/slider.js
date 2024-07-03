const header = document.getElementById('header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) { // Adjust the scroll value as needed
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});




var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});



var swiper = new Swiper(".mycategory", {
  slidesPerView: 5,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});
var swiper = new Swiper(".mylisting", {
  slidesPerView: 4,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});



document.addEventListener('DOMContentLoaded', function () {
  const slider = document.getElementById('slider-range');
  const amount = document.getElementById('amount');
  let min = 0;
  let max = 100000;
  let values = [0, 100000];

  const updateAmount = () => {
    amount.value = `$${values[0]} - $${values[1]}`;
  };

  const createSlider = () => {
    slider.innerHTML = '';
    const track = document.createElement('div');
    track.className = 'range-track';
    track.style.left = `${((values[0] - min) / (max - min)) * 100}%`;
    track.style.width = `${((values[1] - values[0]) / (max - min)) * 100}%`;
    slider.appendChild(track);

    values.forEach((value, index) => {
      const handle = document.createElement('div');
      handle.className = 'range-handle';
      handle.style.left = `${((value - min) / (max - min)) * 100}%`;
      handle.draggable = true;

      handle.addEventListener('dragstart', function (e) {
        e.dataTransfer.setDragImage(document.createElement('div'), 0, 0);
      });

      handle.addEventListener('drag', function (e) {
        if (e.clientX === 0) return; 
        const rect = slider.getBoundingClientRect();
        let newValue = Math.round(((e.clientX - rect.left) / rect.width) * (max - min) + min);
        newValue = Math.max(min, Math.min(max, newValue));
        values[index] = newValue;

        if (index === 0 && values[0] > values[1]) values[0] = values[1];
        if (index === 1 && values[1] < values[0]) values[1] = values[0];

        createSlider();
        updateAmount();
      });

      slider.appendChild(handle);
    });
  };

  createSlider();
  updateAmount();
});
