
import anime from 'animejs';

export default class{

	constructor(){
        this.init()
    }
    init (){
        const strs = document.querySelectorAll("[data-str-animation]")
        if(strs.length > 0){
            strs.forEach((el)=>{
                let pr_str = el.textContent.split("");
                let str = "";
                pr_str.map( s => {
                    str += "<span class='js-str__animation'>" + s  + "</span>";
                })
                
                el.innerHTML = str;
            })
        }

        const buttons = document.querySelectorAll("[data-button-animation]")
        if(buttons.length > 0){
            buttons.forEach( (button,i) => {
                
                button.addEventListener("mouseenter",()=>{
                    const t = button.querySelectorAll('.js-str__animation')
                    anime({
                        targets :t,
                        translateY: [0,"-100%"],
                        easing: "easeInExpo",
                        delay: function(el, i) {
                            return (i * 20);
                        },
                        duration:400,
                        complete(){
                            anime({
                                targets :t,
                                translateY: ["100%",0],
                                easing: "easeOutQuart",
                                delay: function(el, i) {
                                    return (i * 20);
                                },
                                duration:400,
                            })
                        }
                    })
                })
                
            })
            
       }
    }
}