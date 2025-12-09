import './bootstrap';
import 'flowbite';
import Swal from 'sweetalert2';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swal = Swal;

$(window).on("load", function() {
    // document.querySelector("body").style.visibility = "hidden";
    gsap.fromTo(
        ".loading-screen",
        { opacity: 1 },
        {
            opacity: 0,
            duration: 2, 
            delay: 1.5,
            onComplete: () => {
                document.querySelector(".loading-screen").style.display = "none";
                // document.querySelector("body").style.visibility = "visible";
            },
        }
    );
});

gsap.fromTo(
    ".loading-text",
    { y: 50, opacity: 0 },
    {
        y: 0,
        opacity: 1,
        duration: 1.5,
        delay: 0.5,
    }
);
gsap.fromTo(
    ".loading-text2",
    { y: 50, opacity: 0 },
    {
        y: 0,
        opacity: 1,
        duration: 1.5,
        delay: 0.5,
    }
);




