import './bootstrap';
import axios from 'axios';
import { Modal } from 'bootstrap';

export const HTTP = axios.create({
    withCredentials: true,
    baseURL: "http://localhost:8000/api",
    headers: {
        'X-CSRF-TOKEN': document.querySelector<HTMLFormElement>('#csrf').value
    }
});

// @ts-ignore
import.meta.glob([
    '../images/**',
    '../fonts/**',
]);

// Navbar
window.onscroll = (_ : Event) => {
    let nav = document.querySelector<HTMLDivElement>('nav');

    let navbarHeight = nav.offsetHeight * 2.5;
    let rangeFromTopToClientTop = document.querySelector<HTMLDivElement>("body").getBoundingClientRect().top * -1;
    nav.style.backgroundColor = `rgba(255, 255, 255, ${
        rangeFromTopToClientTop / navbarHeight
    })`;
}

// Loading Modal
export const loadingModal = new Modal(document.querySelector('#loading-modal'), { backdrop: "static", keyboard: false });
