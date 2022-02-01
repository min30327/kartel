<template>
    <footer class="l-footer">
        <div class="l-footer__wrapper">
            <div class="c-container">
                <div class="l-footer__content">
                    <div class="l-footer__logo">
                        <img src="~/assets/img/kartel-white.svg" alt="The Kartel Produced by NOT4H">
                    </div>
                    <nav class="l-footer__nav">
                        <ul class="l-footer__nav--lists">
                            <li class="l-footer__nav--list"><a href="#concept" v-scroll-to="'#concept'" class="l-footer__nav--link">Concept</a></li>
                            <li class="l-footer__nav--list"><a href="#contents" v-scroll-to="'#contents'" class="l-footer__nav--link">Contents</a></li>
                            <li class="l-footer__nav--list"><a href="#member" v-scroll-to="'#member'" class="l-footer__nav--link">Member</a></li>
                            <li class="l-footer__nav--list"><a href="#price" v-scroll-to="'#price'" class="l-footer__nav--link">Price</a></li>
                        </ul>
                        <a href="https://twitter.com/not_4_h" target="_blank" class="l-footer__twitter"><TwitterIcon /></a>
                        <n-link to="login" class="l-footer__button" data-button-animation><span data-str-animation>Login</span></n-link>
                    </nav>
                </div>
                
            </div>
        </div>
        <div class="l-copyright__wrapper">
            <p class="l-copyright"><small lang="en">Copyright &copy; NOT4H LLC</small></p>
        </div>
    </footer>
</template>

<script>
import ButtonAnimation from '../plugins/ButtonAnimation'
export default {
    async mounted(){
        await this.$nextTick();
        new ButtonAnimation()
    },
}
</script>

<style lang="scss" scoped>
.l-footer{
    .l-footer__wrapper{
        padding: 256px 0;
        background: url(~/assets/img/bg-bootsend.jpg);
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        @media (max-width: 767px) {
            padding: 150px 0;
        }
    }
    .l-footer__content{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        @media (max-width: 1199px) {
            max-width: 840px;
            margin: 0 auto;
        }
        .l-footer__logo{
            max-width: 340px;
            flex:  0 0 340px;
            @media (max-width: 1199px) {

                max-width: 200px;
                flex:  0 0 200px;
            }
            @media (max-width: 767px) {
                max-width: 100%;
                flex:  0 0 100%;
                img{
                    width: 200px;
                    max-width: 100%;
                    margin: 0 auto 20px;
                }
            }
        }
        .l-footer__nav{
            display: flex;
            align-items: center;
            max-width: calc(100% - 360px);
            flex:  0 0 calc(100% - 360px);
            @media (max-width: 1199px) {
                max-width: calc(100% - 200px);
                flex:  0 0 calc(100% - 200px);
            }
            @media (max-width: 767px) {
                flex: 0 0 100%;  
                max-width: 100%; 
                flex-wrap: wrap;
                justify-content: center;   
            }
            .l-footer__nav--lists{
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: flex-end;
                list-style:none;
                padding: 0;
                margin: 0;
                flex: 1 0 auto;
                @media (max-width: 767px) {
                    flex: 0 0 100%;  
                    max-width: 100%; 
                    justify-content: center;   
                }
                .l-footer__nav--list{
                    padding:0 10px;
                }
                .l-footer__nav--link{
                    color: #fff;
                    text-decoration: none;
                    position: relative;
                    font-family: $font-family-en2;
                    &::after{
                        content:"";
                        position: absolute;
                        left: 0;
                        bottom: -2px;
                        width: 100%;
                        height: 1px;
                        background: rgba(#fff,.6);
                        transform: scaleX(0);
                        transition-property: transform;
                        @include easeOutExpo(300ms);
                    }
                    &:hover,&:focus,&:active{
                        &::after{
                            transform: scaleX(1);
                        }
                    }
                }
            }
        }
        .l-footer__twitter{
            max-width: 50px;
            flex: 0 0 50px;
            @media (max-width: 767px) {
                margin-top: 30px;
            }
            .c-icon__twitter{
                fill:#fff;
                width: 20px;
                margin: 0 auto;
            }
        }
        .l-footer__button{
            max-width: 130px;
            flex: 0 0 130px;
            color: #fff;
            border: 3px solid #fff;
            padding: 6px 10px;
            line-height: 130%;
            text-align: center;
            text-decoration: none;
            margin-left: 10px;
            font-family: $font-family-en2;
            
            @media (max-width: 767px) {
                margin-top: 30px;
            }
        }
    }
}
.l-copyright__wrapper{
    background-color: #1b1b1b;
    padding: 35px 40px;
    color: #fff;
    .l-copyright{
        font-family: $font-family-en2;
        font-size: 12px;
        letter-spacing: .5px;
        line-height: 100%;
        text-align: right;
    }
}
</style>
