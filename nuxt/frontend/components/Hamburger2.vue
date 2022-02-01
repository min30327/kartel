<template>
    <div>
        <button data-hamburger @click="_drawerToggle" class="c-button__reset" aria-haspopup="true" aria-expanded="false" aria-label="メニューを開閉する" v-scroll-lock="drawerOpened">
            <span class="l-hamburger__bar" aria-hidden="true"></span>
        </button>
        <div id="l-overlay" @click="_drawerClose"></div>
    </div>
</template>

<script>
 import anime from 'animejs'
export default {
    name: 'Hamburger',
    methods: {
        _drawerToggle(){
            const html = document.querySelector("html")
            const root = document.documentElement;
            if(html){
                html.classList.toggle("-drawer-opened")
            }
            if(this.drawerOpened){
                this.$store.commit('drawer/close')
                anime({
                    targets : "[data-drawer]",
                    translateX : [0,300],
                    easing:"easeInExpo",
                    duration: 500
                })
            }else{
                this.$store.commit('drawer/open')
                anime({
                    targets : "[data-drawer]",
                    translateX : [300,0],
                    easing:"easeOutExpo",
                    duration: 500
                })
            }
        },
        _drawerClose(){
            const html = document.querySelector("html")
            if(html){
                html.classList.remove("-drawer-opened")
            }
            this.$store.commit('drawer/close')
            anime({
                targets : "[data-drawer]",
                translateX : [0,300],
                easing:"easeInExpo",
                duration: 500
            })
        }
    },
    computed: {
        drawerOpened(){
            return this.$store.state.drawer.opened
        },
    }
}
</script>

<style lang="scss" scoped>

    html.-drawer-opened{
        [data-hamburger]{
            @media (max-width:991px) {
                .l-hamburger__bar{
                    width: 0;
                    transition-delay:0s;

                    &::before{
                        transform: rotate(45deg);
                        background: #fff;
                    }
                    &::after{
                        transform: rotate(-45deg);
                        background: #fff;
                    }
                }
            }
        }

        #l-overlay{
            opacity: 1;
            pointer-events: all;    
        }
    }
    [data-hamburger]{
        position: fixed;
        right:0;
        top: 0;
        width: 60px;
        height: 60px;
        z-index: 10001;
        text-align: center;
        display: none;
        @media (max-width:991px) {
            display: block;
            @include easeInOutExpo(260ms);
            transition-property: transform;
        }
        
        .l-hamburger__bar{
            position: absolute;
            left: 50%;
            top: 50%;
            width: 22px;
            height: 1.6px;
            margin-top: -0.8px;
            margin-left: -11px;
            background:$base-color;
            will-change: auto;
            border-radius: 1px;
            @include easeInOutExpo(600ms);
            transition-delay:.5s;
            transition-property: transform,width;
            &::before{
                content:"";
                position: absolute;
                left: 0;
                top: 0;
                width: 22px;
                height: 1.6px;
                background:$base-color;
                transform: translateY(-7px);
                border-radius: 1px;
                @include easeInOutExpo(400ms);
                transition-property: transform;
            }
            &::after{
                content:"";
                position: absolute;
                left: 0;
                top: 0;
                width: 22px;
                height: 1.6px;
                background:$base-color;
                transform: translateY(7px);
                border-radius: 1px;
                @include easeInOutExpo(400ms);
                transition-property: transform;
            }
        }
    }
    #l-overlay{
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 100;
        background: rgba(0,0,0,.5);
        pointer-events: none;
        display: none;
        @media (max-width:991px) {
            display: block;
            opacity: 0;
            @include easeOutExpo(800ms);
            transition-property: opacity;
        }
        
    }

</style>
