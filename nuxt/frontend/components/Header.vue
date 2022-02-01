<template>
    <header id="l-header">
        <div class="l-header__logo">
            <h1><img src="~/assets/img/logo-header.svg" alt="NOT4H"></h1>
        </div>
        <nav class="l-header__nav" data-drawer>
            <h4 class="l-header__nav--haeding">NOT4H LLC</h4>
            <ul class="l-header__nav--lists">
                <li class="l-header__nav--list"><a href="#concept" v-scroll-to="{ el: '#concept',onDone: _drawerClose}" class="l-header__nav--link">Concept</a></li>
                <li class="l-header__nav--list"><a href="#contents" v-scroll-to="{ el: '#contents',onDone: _drawerClose}" class="l-header__nav--link">Contents</a></li>
                <li class="l-header__nav--list"><a href="#member" v-scroll-to="{ el: '#member',onDone: _drawerClose}" class="l-header__nav--link">Member</a></li>
                <li class="l-header__nav--list"><a href="#price" v-scroll-to="{ el: '#price',onDone: _drawerClose}" class="l-header__nav--link">Price</a></li>
            </ul>
            <n-link to="login" class="l-header__nav--login" @click="_drawerClose">Login</n-link>
        </nav>
    </header>
</template>

<script>
 import anime from 'animejs'
export default {
    methods: {
        _drawerClose(){
            const html = document.querySelector("html")
            if(html){
                html.classList.remove("-drawer-opened")
            }
            this.$store.commit('drawer/close')
            anime({
                targets : "[data-drawer]",
                translateX : [0,300],
                easing:"easeInOutExpo",
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

#l-header{
    .l-header__logo{
        position: fixed;
        left:10%;
        top: 40px;
        width: 120px;
        z-index: 100;
        mix-blend-mode: exclusion;
        @media (max-width:991px) {
            left: 20px;
            top: 20px;
            width: 90px;
        }
        h1{
            padding: 0;
            margin: 0;
        }
    }
    .l-header__nav{
        position: fixed;
        right:0;
        top: 0;
        width: 200px;
        z-index: 102;
        background-color: #d63e4a;
        padding:40px 40px 30px;
        font-family: $font-family-en2;
        color: #fff;

        @media (min-width: 992px) {
            transform: translateX(0) !important;

        }
        @media (max-width: 991px) {
            width: 300px;
            height: 100%;
            padding-top: 80px;
            transform: translateX($drawer-width);
        }
        .l-header__nav--haeding{
            font-weight: normal;
            font-size: 16px;
            line-height: 1.5;
            padding: 0;
            margin:0 0 10px;
            @media (max-width: 991px) {
                font-size: 24px;
            }
        }
        .l-header__nav--lists{
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .l-header__nav--list{
            margin-bottom: 0;
            line-height: 1.4;
            @media (max-width: 991px) {
                padding:10px 0;
            }
        }
        .l-header__nav--link{
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            @media (max-width: 991px) {
                font-size: 18px;
                letter-spacing: .4px;
                display: block;
            }
        }
        .l-header__nav--login{
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            position: relative;
            padding-left: 15px;
            
            @media (max-width: 991px) {
                padding:10px 0;
                padding-left: 15px;
                font-size: 18px;
                letter-spacing: .4px;
                display: block;
            }
            &::before{
                content:"";
                position: absolute;
                left: 0;
                top: 6px;
                width: 8px;
                height: 8px;
                border-radius: 8px;
                background: #fff;
                @media (max-width: 991px) {
                    top: 20px;
                }
            }
        }
    }
}
</style>
