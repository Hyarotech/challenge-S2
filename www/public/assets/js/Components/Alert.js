import Component from "/assets/js/Component.js";

class Alert extends Component {
    constructor(type = 'alert', message = 'Message non défini', timeToDisappear = 2500) {
        super();
        this.typeObject = {
            alert: {
                class: '',
                svg: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`
            },
            success: {
                class: 'alert-success',
                svg: '<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
            },
            error: {
                class: 'alert-error',
                svg: '<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
            },
            warning:{
                class: 'alert-warning',
                svg: '<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>'
            },
            info:{
                class: 'alert-info',
                svg: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
            }
        };
        
        this.message = message;
        this.type = type;
        this.timeToDisappear = timeToDisappear;
    }

    createElement() {
        this.removeElement();
        // Create the main alert div
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${this.typeObject[this.type].class} justify-start w-auto h-auto m-2 self-end fixed top-[60px] z-[52] right-0` + this.getClassString();
        
        const button = new DOMParser().parseFromString(
           `<button class="ml-2">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>`,
            'text/html'
        ).documentElement;

        button.addEventListener('click', () => {
            this.removeElement();
        });
  
        // Create the SVG element
        const svgElement = new DOMParser().parseFromString(
            this.typeObject[this.type].svg, 
            'image/svg+xml'
        ).documentElement;

        // Create the span for the message
        const messageSpan = document.createElement('span');
        messageSpan.textContent = `${this.message}`;

        // Append the elements
        alertDiv.appendChild(svgElement);
        alertDiv.appendChild(messageSpan);
        alertDiv.appendChild(button);
        this.element = alertDiv;

        console.log(this.element);
    }

    render(insideElement, isPrepend = true) {
        super.render(insideElement, isPrepend);
        setTimeout(() => {
            this.removeElement();
        }, this.timeToDisappear);
    }

    setType(type) {
        this.type = type;
    }

    setMessage(message) {
        this.message = message;
    }

    setTimeToDisappear(time) {
        this.timeToDisappear = time;
    }
}

export default Alert;
