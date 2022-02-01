<template>
    <button data-hamburger @click="_sideToggle" class="c-button__reset" aria-haspopup="true" aria-expanded="false" aria-label="メニューを開閉する">
        <span class="l-hamburger__bar" aria-hidden="true"></span>
    </button>
</template>

<script>
export default {
    name: 'Hamburger',
    methods: {
        _sideToggle(){
            const html = document.querySelector("html")
            const root = document.documentElement;
            if(html){
                html.classList.toggle("-sidebar-opened")
            }
            if(this.sidebarOpened){
                this.$store.commit('sidebar/close')
                root.style.setProperty('--scroll',window.scrollY )
                html.classList.add("-sidebar-opened-transition")
            }else{
                this.$store.commit('sidebar/open')
                setTimeout(() => { 
                    html.classList.remove("-sidebar-opened-transition")
                }, 400);       
            }
        },
        _sideClose(){
            const html = document.querySelector("html")
            if(html){
                html.classList.remove("-sidebar-opened")
            }
            this.$store.commit('sidebar/close')
            setTimeout(() => { 
                html.classList.remove("-sidebar-opened-transition")
            }, 400);
        }
    },
    computed: {
        sidebarOpened(){
            return this.$store.state.sidebar.opened
        },
    }
}
</script>

<style lang="scss" scoped>

    html.-sidebar-opened{
        [data-hamburger]{
            @media (max-width:991px) {
                transform: translateX($sidebar-width);
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
    }
    [data-hamburger]{
        position: fixed;
        left:0;
        top: 0;
        width: 50px;
        height: 50px;
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
    

</style>
