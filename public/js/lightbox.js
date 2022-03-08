import {enableBodyScroll, disableBodyScroll} from './body-scroll-lock.js'
/**
 * @property {HTMLElement} element
 * @property {String[]} images chemin des images de la lightbox
 * @property {String} url image actuellement affiché
 */
 class Lightbox {
    static init(){
        const links = Array.from(document.querySelectorAll('a[href$=".jpeg"], a[href$=".jpg"]'))
        const galerie = links.map(link => link.getAttribute('href'))
        const totalImage = galerie.length
        links.forEach(link => link.addEventListener('click', e => {
            e.preventDefault()
            let pos = galerie.findIndex(image =>  image == e.currentTarget.getAttribute('href'))
            let position = (pos + 1) +'/'+ totalImage
            new Lightbox(e.currentTarget.getAttribute('href'), galerie, position)
        }))
        console.log('hello');
    }
   
    /**
     * @param {string} url URL de l'image
     * @param {string[]} images chemin des images de la lightbox
     */
    constructor(url, images, position){
        this.element = this.buildDom(url)
        this.images = images
        this.loadImage(url, position)
        this.onKeyUp = this.onKeyUp.bind(this)
        document.getElementById("conteneur").appendChild(this.element)
        disableBodyScroll(this.element)
        document.addEventListener('keyup', this.onKeyUp)
    }

    /**
     * @param {string} url URL de l'image
     * @param {number} position position de l'image
     */
    loadImage(url, position){
        this.url = null
        const image = new Image()
        const container = this.element.querySelector('.lightbox__container')
        const loader = document.createElement('div')
        const numero = document.createElement('div')
        numero.classList.add('numeroPhoto')
        loader.classList.add('lightbox__loader')
        container.innerHTML = ''
        container.appendChild(loader)
        numero.innerHTML = position 
        image.onload = () => {
            container.removeChild(loader)
            container.appendChild(image)
            container.appendChild(numero)
            this.position = position
            this.url = url
        }
        image.src = url
    }

    /**
     * Ferme la lightbox
     * @param {KeyboardEvent} e 
     */
    onKeyUp (e) {
        if(e.key == 'Escape'){
            this.close(e)
        }else if(e.key == 'ArrowLeft'){
            this.prev(e)
        }else if(e.key == 'ArrowRight'){
            this.next(e)
        }
    }
    /**
     * Ferme la lightbox
     * @param {MouseEvent|KeyboardEvent} e 
     */
    close(e){
        e.preventDefault
        this.element.classList.add('fadeOut')
        enableBodyScroll(this.element)
        window.setTimeout(() => {
            this.element.parentElement.removeChild(this.element)
        }, 500)
       document.removeEventListener('keyup', this.onKeyUp) 
    }
    
    /**
     * Photos suivantes
     * @param {MouseEvent|KeyboardEvent} e 
     */
     next (e) {
        e.preventDefault
        let total = this.images.length
        let i = this.images.findIndex(image =>  image == this.url)
        if(i == total -1){
            i = -1
        }
        this.loadImage(this.images[i + 1], ((i + 1) + 1 + '/' + total))
    }
    /**
     * Photos précédentes
     * @param {MouseEvent|KeyboardEvent} e 
     */
    prev(e){
        e.preventDefault
        let total = this.images.length
        let i = this.images.findIndex(image =>  image == this.url)
        if(i == 0){
            i = total
        }
        this.loadImage(this.images[i - 1], ((i + 1) - 1 + '/' + total))
    }

    /**
     * @param {string} url URL de l'image
     * @return {HTMLElement}
     */
    buildDom(url){
        const dom = document.createElement('div')
        dom.classList.add('lightbox')
        dom.innerHTML = 
        `<button class="lightbox__close fa-lg"><i class="fas fa-times"></i></button>
        <button class="lightbox__next"><i class="fas fa-chevron-right fa-lg"></i></button>
        <button class="lightbox__prev fa-lg"><i class="fas fa-chevron-left"></i></button>
        <div class="lightbox__container"></div>`
        dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this))
        dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this))
        dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this))
        return dom
    }
    

}
Lightbox.init()
