import './bootstrap';
import 'flowbite';
import Swal from 'sweetalert2';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swal = Swal;

// gsap.fromTo(".loading-screen", {
//   opacity: 1
// },
// {
//   opacity: 0,
//   duration : 2.5, //nnti ganti algo loading
//   delay : 2,
//   onComplete: () => {
//     document.querySelector(".loading-screen").style.display = "none";
//   }
// });

// gsap.fromTo(".loading-text",{
//   y : 50,
//   opacity : 0,
// },{
//   y: 0,
//   opacity : 1,
//   duration : 1.5,
//   delay : .5,
// });
