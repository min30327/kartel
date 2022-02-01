<template>
    <div data-sidebar v-bind:class="{'-opened' : sidebarOpened }" v-scroll-lock="sidebarOpened">
        <div class="l-sidebar">
            <div class="l-sidebar__wrapper">
                <div class="l-sidebar__heading">
                    <div class="l-sidebar__heading--h">
                        <svg version="1.1" id="kartel-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 688 110" style="enable-background:new 0 0 688 110;" xml:space="preserve">
                            <path class="st0" d="M282.3,85.9h-40l-8,24.2h-23.3l40.9-110h21.7l41,110h-23.2L282.3,85.9z M249.5,64.6h24.9l-11.6-36.7L249.5,64.6 z"/>
                            <path class="st0" d="M366.2,70.7h-18.3v39.8h-22V-0.4H377c22.8,0,36.7,14.9,36.7,35.3c0,19.4-8.6,29.7-20.4,32.5l21.5,43.1h-27.2 L366.2,70.7z M375.3,21.7h-27.4v28.1h27.4c12.7,0,16.4-4.9,16.4-14C391.7,25.9,384.7,21.7,375.3,21.7z"/>
                            <path class="st0" d="M454.8,21.7h-32V0.1h82.9v21.6h-29.8v88.6h-21.1V21.7z"/>
                            <path class="st0" d="M517.6,0.1h75.5v21.6h-53.3v19.5h31v22.2h-31.4v25.4l56,0.2l0.4,21.1h-77.9L517.6,0.1z"/>
                            <path class="st0" d="M611.1,0.1h22.2v88.4H688v21.8h-76.9V0.1z"/>
                            <path class="st0" d="M11.8,61.6L26,1.9h-2.4c-3.1,0-4.8,0.4-7.7,1.5C9.3,6,5.9,9.8,1.6,18.9H0C2.3,13.2,4.9,6.1,5.5,0.4h46.8 c3,0,3.6,0.2,3.6,1.2c0,0.8-0.4,1.6-0.6,2.6c-0.4,1.6-1.8,6.5-4.2,16.5h-1.5c0.3-2.3,0.5-4.1,0.5-5.5c0-8-4.9-13.4-12.3-13.4 c-0.6,0-1.5,0.1-2.4,0.1L20.8,61.6h8.6L29.4,63H3.8l0.4-1.4H11.8z"/>
                            <path class="st0" d="M71.4,0l-7.8,33.2c5.3-7.4,8.7-9.8,13.4-9.8c4.5,0,8.5,4.4,8.5,9.3v1c-0.4,2.7-1.3,7-3,13.1c-1,3.8-2,7-2.9,9.6 c-0.5,1.3-0.7,2.5-0.7,3.5c0,1.3,0.7,2.1,2,2.1c1.6,0,3.3-1.8,5-5.3c0.6-1.3,1.5-3.2,2.8-5.7l1.2,0.4c-0.9,2-1.8,3.9-2.5,5.4 c-2.3,4.6-5.4,7.4-8.5,7.4c-3.1,0-5.5-3-5.5-7c0-1.7,0.6-5.1,1.3-7.5l3.9-12.5c0.8-2.8,1.3-5.4,1.3-7c0-3.3-1.6-5.3-4.2-5.3 c-2.4,0-5,1.7-7.6,4.8c-3.4,4.3-6.3,9.3-7.1,12.5L55.8,63h-6.5L63.6,4L64,2.6c0.1-0.1,0.1-0.3,0.1-0.4c0-0.6-0.6-0.9-1.7-0.9h-5.2 L57.6,0H71.4z"/>
                            <rect y="0" class="st1" width="109.1" height="64.4"/>
                            <path class="st0" d="M163.8,39.3l32.9-39.3h-25.5L131,48.5V0.1h-21.9v24.4c1.5-0.6,3.1-0.9,4.8-0.9c4.5,0,8.5,3.8,8.5,8.2 c0,5.4-4.7,9.3-13.3,11.6v18.2c3.2-1.2,6.5-3.9,10.5-8.3l1,0.9c-3.8,4.5-7.6,7.7-11.4,9.2v46.8h21.7V77.5l17.3-19.4l29.5,52h25.2 L163.8,39.3z"/>
                            <path class="st0" d="M116.6,30.2c0-2.8-1.7-4.7-4.2-4.7c-1.2,0-2.3,0.3-3.3,0.9v14.9c0.7-0.3,1.2-0.5,1.7-0.9 C113.9,38.4,116.6,33.6,116.6,30.2z"/>
                            <path class="st0" d="M11.8,61.6L26,1.9h-2.4c-3.1,0-4.8,0.4-7.7,1.5C9.3,6,5.9,9.8,1.6,18.9H0C2.3,13.2,4.9,6.1,5.5,0.4h46.8 c3,0,3.6,0.2,3.6,1.2c0,0.8-0.4,1.6-0.6,2.6c-0.4,1.6-1.8,6.5-4.2,16.5h-1.5c0.3-2.3,0.5-4.1,0.5-5.5c0-8-4.9-13.4-12.3-13.4 c-0.6,0-1.5,0.1-2.4,0.1L20.8,61.6h8.6L29.4,63H3.8l0.4-1.4H11.8z"/>
                            <path class="st0" d="M71.4,0l-7.8,33.2c5.3-7.4,8.7-9.8,13.4-9.8c4.5,0,8.5,4.4,8.5,9.3v1c-0.4,2.7-1.3,7-3,13.1c-1,3.8-2,7-2.9,9.6 c-0.5,1.3-0.7,2.5-0.7,3.5c0,1.3,0.7,2.1,2,2.1c1.6,0,3.3-1.8,5-5.3c0.6-1.3,1.5-3.2,2.8-5.7l1.2,0.4c-0.9,2-1.8,3.9-2.5,5.4 c-2.3,4.6-5.4,7.4-8.5,7.4c-3.1,0-5.5-3-5.5-7c0-1.7,0.6-5.1,1.3-7.5l3.9-12.5c0.8-2.8,1.3-5.4,1.3-7c0-3.3-1.6-5.3-4.2-5.3 c-2.4,0-5,1.7-7.6,4.8c-3.4,4.3-6.3,9.3-7.1,12.5L55.8,63h-6.5L63.6,4L64,2.6c0.1-0.1,0.1-0.3,0.1-0.4c0-0.6-0.6-0.9-1.7-0.9h-5.2 L57.6,0H71.4z"/>
                            <path class="st0" d="M109.1,61.6c-1.5,0.6-2.9,0.8-4.4,0.8c-3.9,0-6.1-2.8-6.1-7.7c0-2.5,0.4-4.4,1.8-9.8c3.2-0.4,6.1-0.9,8.7-1.6 v-2.1c-1.3,0.5-3.3,1-7.9,2c2.5-9.8,4.8-14.9,7.9-16.9v-1.9c-9.6,3.5-17.2,16.5-17.2,25.3c0,7.8,5.6,14.5,12.2,14.5 c1.7,0,3.4-0.3,5-1V61.6z"/>
                        </svg>

                    </div>
                    
                </div>
                <nav class="l-sidebar__nav">
                    <ul class="l-sidebar__nav--list">
                        <li class="l-sidebar__nav--item">
                            <router-link to="/" class="l-sidebar__nav--link"><span>Dashboard</span></router-link>
                        </li>
                    </ul>
                    <ul class="l-sidebar__nav--list">
                        <li class="l-sidebar__nav--item">
                            <button @click="logout" class="c-button__reset l-sidebar__nav--link"><span>Logout</span></button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import ScrollBooster from "scrollbooster"
export default {
    data (){
        return{
            
        }
    },
    async mounted (){
        
        await this.$nextTick()
        // await new ScrollBooster({
        //     viewport: document.querySelector('.l-sidebar'),
        //     emulateScroll: true, 
        //     scrollMode: 'transform',
        //     direction: 'vertical',
        //     // bounceForce :0.3,
        //     // friction:.01
        // });

    },
    methods : {
        logout(){

            this.$store.commit('sidebar/close')
            const html = document.querySelector("html")
            if(html){
                html.classList.remove("-sidebar-opened")
                html.classList.remove("-sidebar-opened-transition")
            }
            this.$auth.logout()
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
    [data-sidebar]{
        @media (max-width:991px) {
            transform: translateX($sidebar-width);
        }
    }
}
[data-sidebar]{
    position: fixed;
    left: 0;
    top: 0;
    width: $sidebar-width;
    height: 100%;
    background-color: $sidebar-bg;
    color: #fff;
    display: flex;
    z-index: 1000;
    @media (max-width:991px) {
        @include easeInOutExpo(280ms);
        transition-property: transform;
        left: -$sidebar-width;
    }
    .l-sidebar{
        width: $sidebar-width;
        height: 100%;
        display: flex;
        .l-sidebar__wrapper{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .l-sidebar__heading{
            padding: 40px 35px 60px;
            .l-sidebar__heading--h{
                margin: 0;
                padding: 0;
                line-height: 150%;
                
                svg{
                    width: 180px;
                }
            }
        }
        #kartel-logo{

            .st0{fill:#626A76;}
            .st1{fill:none;}
        }
        .l-sidebar__nav{
            display: flex;
            flex-direction: column;
            height: calc(100% - 160px);
            justify-content: space-between;
            .l-sidebar__nav--list{
                width: 100%;
                padding: 0 35px;
                margin: 0;
                list-style: none;
                .l-sidebar__nav--item{
                    position: relative;
                    margin-bottom: 5px;
                    &:hover{
                        .l-sidebar__nav--edit{
                            opacity: 1;
                        }
                    }
                    &:hover,&:active,&:focus{
                        
                        .l-sidebar__nav--link{
                            &::before{
                                opacity: 1;
                                transform: scale(1);
                            }
                        }
                    }
                }
                .l-sidebar__nav--link{
                    color: #fff;
                    text-decoration: none;
                    display: inline-block;
                    padding: 10px 20px;
                    border-radius: 6px;
                    position: relative;
                    overflow: hidden;
                    line-height: 140%;
                    >span{
                        position: relative;
                        z-index: 2;
                    }
                    &::before{
                        content:"";
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        left: 0;
                        top: 0;
                        @include easeOutExpo(280ms);
                        background-color: darken($sidebar-bg,10%);
                        opacity: 0;
                        transform: scale(.8);
                        border-radius: 30px;
                    }
                    
                    &.nuxt-link-active {
                        &::before{
                            opacity: 1;
                            transform: scale(1);
                        }
                    }
                }
                .l-sidebar__nav--edit{
                    position: absolute;
                    right: 0;
                    top:0;
                    width: 40px;
                    height: 100%;
                    line-height: 35px;
                    text-align: center;
                    opacity: 0;
                    @include easeOutExpo(280ms);
                    svg{
                        fill:$gray;
                        display: inline-block;
                        width: 15px;
                        height: 15px;
                        vertical-align: middle;
                        @include easeOutExpo(280ms);
                    }
                    &:hover,&:active,&:focus{
                        svg{
                            fill:#fff;
                        }
                    }
                }
            }
        }
    }
    
}
</style>
