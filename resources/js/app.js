import './bootstrap';
import 'flowbite';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.defaults({
    // markers : true
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
  y: 200, 
  scrollTrigger: {
    trigger: ".bg", 
    start: "10% top",
    end: "bottom top",
    scrub: 0.01 
  }
});


const containerscrollx = document.querySelector('.containerscrollx')
const sections = gsap.utils.toArray('.containerscrollx section')


let scrollTween = gsap.to(sections, {
  xPercent: -100 * (sections.length - 1),
  ease : "none",
  scrollTrigger : {
    trigger : containerscrollx,
    pin: true,
    scrub : 1,
    end : "+=3000",
    snap : {
      snapTo: 1 / (sections.length - 1), 
      duration: 0.5, 
      ease: "power1.inOut" 
    }
  }
});

const text = gsap.utils.toArray(".about h2, .about h3, .about p, .about img");
// console.log(text);

gsap.from(text, {
  y: -120,
  opacity : 0,
  duration : 2,
  ease : "elastic",
  stagger : 0.1,
  scrollTrigger : {
    trigger : ".about",
    start : "top 70%",
    end : "right top",
    toggleActions : "play none replay reset",
    onEnter: () => console.log("Entered viewport"),
    onLeaveBack: () => console.log("leaveback viewport"),
    onEnterBack: () => console.log("enter Back viewport"),
  }
})

// back to vertical scrolling
gsap.from(".container-listDoge", {
  opacity: 0,
  y: 100,
  duration: 1,
  scrollTrigger: {
    markers: true,

    trigger: ".containerscrollx", // Vertical section trigger
    start: "top center", // Start when it enters the center of the viewport
    end: "bottom top", // End after the section scrolls out
    scrub: true,
  }
}); 