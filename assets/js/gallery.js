import Glide from '@glidejs/glide'
import '@glidejs/glide/dist/css/glide.core.min.css'
import '@glidejs/glide/dist/css/glide.theme.min.css'

const glide = document.querySelector('.glide');

if (glide && glide.dataset.count >= 5) {
  new Glide('.glide', {
    type: 'carousel',
    focusAt: 'center',
    perView: 3
  }).mount()
}