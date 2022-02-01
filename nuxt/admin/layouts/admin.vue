<template>
    <div id="l-admin">
        <Side />
        <Hamburger />
        <div data-page>
            <Nuxt />
        </div>
        <div data-overlay @click="_sideClose"></div>
    </div>
</template>


<script>
export default {
    methods: {
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
    },
    mounted() {
        this.$adobeFonts(document)
    },
}
</script>

<style lang="scss" scoped>
#l-admin{
    width: 100%;
    overflow-x:hidden ;
}
html.-sidebar-opened{
    [data-page]{
        @media (max-width:991px) {
            transform: translateX($sidebar-width);
        }
    }
    [data-overlay]{
        @media (max-width:991px) {
            pointer-events: all;
            opacity: 1; 
            transform: translateX($sidebar-width); 
        }
    }
}
[data-page]{
    padding-top: 40px;
    padding-bottom: 60px;
    position: relative;
    padding-left: $sidebar-width;
    @media (max-width:991px) {
        padding-left: 0;
        @include easeInOutExpo(320ms);
        transition-property: transform;
    }
}
[data-overlay]{
    display: none;
    @media (max-width:991px) {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000;
        opacity: 0;
        pointer-events: none;
        background: rgba(#000, .7);
        @include easeInOutExpo(280ms);
        transition-property: opacity, transform;
    }
}
</style>