import './bootstrap';
import 'flowbite';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.defaults({
    markers : true
});

// Parallax effect for the quote
gsap.to(".quote", {
  y: 700, 
  scrollTrigger: {
    trigger: ".bg", 
    start: "15% top", 
    end: "bottom top", 
    scrub: 3,
  }
});

// Parallax effect for the doge image
gsap.to(".doge", {
  y: 500, 
  scrollTrigger: {
    trigger: ".bg", 
    start: "20% top",
    end: "bottom top",
    scrub: 3, 
  }
});

gsap.to(".bg_hz", {
  y: 200, 
  scrollTrigger: {
    trigger: ".bg", 
    start: "10% top",
    end: "bottom top",
    scrub: 0.01 
  }
});
gsap.to(".bg_vert", {
  y: 100, 
  scrollTrigger: {
    trigger: ".bg", 
    start: "10% top",
    end: "bottom top",
    scrub: 0.01 
  }
});
