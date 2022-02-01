<template>
    <div id="p-login">
        <div class="p-login__wrapper">
            <h1 class="p-login__logo">
                <svg version="1.1" id="kartel.svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 688 110" style="enable-background:new 0 0 688 110;" xml:space="preserve">
                    <path fill="#ffffff" d="M282.3,85.9h-40l-8,24.2h-23.3l40.9-110h21.7l41,110h-23.2L282.3,85.9z M249.5,64.6h24.9l-11.6-36.7L249.5,64.6 z"/>
                    <path fill="#ffffff" d="M366.2,70.7h-18.3v39.8h-22V-0.4H377c22.8,0,36.7,14.9,36.7,35.3c0,19.4-8.6,29.7-20.4,32.5l21.5,43.1h-27.2 L366.2,70.7z M375.3,21.7h-27.4v28.1h27.4c12.7,0,16.4-4.9,16.4-14C391.7,25.9,384.7,21.7,375.3,21.7z"/>
                    <path fill="#ffffff" d="M454.8,21.7h-32V0.1h82.9v21.6h-29.8v88.6h-21.1V21.7z"/>
                    <path fill="#ffffff" d="M517.6,0.1h75.5v21.6h-53.3v19.5h31v22.2h-31.4v25.4l56,0.2l0.4,21.1h-77.9L517.6,0.1z"/>
                    <path fill="#ffffff" d="M611.1,0.1h22.2v88.4H688v21.8h-76.9V0.1z"/>
                    <path fill="#ffffff" d="M11.8,61.6L26,1.9h-2.4c-3.1,0-4.8,0.4-7.7,1.5C9.3,6,5.9,9.8,1.6,18.9H0C2.3,13.2,4.9,6.1,5.5,0.4h46.8 c3,0,3.6,0.2,3.6,1.2c0,0.8-0.4,1.6-0.6,2.6c-0.4,1.6-1.8,6.5-4.2,16.5h-1.5c0.3-2.3,0.5-4.1,0.5-5.5c0-8-4.9-13.4-12.3-13.4 c-0.6,0-1.5,0.1-2.4,0.1L20.8,61.6h8.6L29.4,63H3.8l0.4-1.4H11.8z"/>
                    <path fill="#ffffff" d="M71.4,0l-7.8,33.2c5.3-7.4,8.7-9.8,13.4-9.8c4.5,0,8.5,4.4,8.5,9.3v1c-0.4,2.7-1.3,7-3,13.1c-1,3.8-2,7-2.9,9.6 c-0.5,1.3-0.7,2.5-0.7,3.5c0,1.3,0.7,2.1,2,2.1c1.6,0,3.3-1.8,5-5.3c0.6-1.3,1.5-3.2,2.8-5.7l1.2,0.4c-0.9,2-1.8,3.9-2.5,5.4 c-2.3,4.6-5.4,7.4-8.5,7.4c-3.1,0-5.5-3-5.5-7c0-1.7,0.6-5.1,1.3-7.5l3.9-12.5c0.8-2.8,1.3-5.4,1.3-7c0-3.3-1.6-5.3-4.2-5.3 c-2.4,0-5,1.7-7.6,4.8c-3.4,4.3-6.3,9.3-7.1,12.5L55.8,63h-6.5L63.6,4L64,2.6c0.1-0.1,0.1-0.3,0.1-0.4c0-0.6-0.6-0.9-1.7-0.9h-5.2 L57.6,0H71.4z"/>
                    <rect fill="none" y="0" class="st1" width="109.1" height="64.4"/>
                    <path fill="#ffffff" d="M163.8,39.3l32.9-39.3h-25.5L131,48.5V0.1h-21.9v24.4c1.5-0.6,3.1-0.9,4.8-0.9c4.5,0,8.5,3.8,8.5,8.2 c0,5.4-4.7,9.3-13.3,11.6v18.2c3.2-1.2,6.5-3.9,10.5-8.3l1,0.9c-3.8,4.5-7.6,7.7-11.4,9.2v46.8h21.7V77.5l17.3-19.4l29.5,52h25.2 L163.8,39.3z"/>
                    <path fill="#ffffff" d="M116.6,30.2c0-2.8-1.7-4.7-4.2-4.7c-1.2,0-2.3,0.3-3.3,0.9v14.9c0.7-0.3,1.2-0.5,1.7-0.9 C113.9,38.4,116.6,33.6,116.6,30.2z"/>
                    <path fill="#ffffff" d="M11.8,61.6L26,1.9h-2.4c-3.1,0-4.8,0.4-7.7,1.5C9.3,6,5.9,9.8,1.6,18.9H0C2.3,13.2,4.9,6.1,5.5,0.4h46.8 c3,0,3.6,0.2,3.6,1.2c0,0.8-0.4,1.6-0.6,2.6c-0.4,1.6-1.8,6.5-4.2,16.5h-1.5c0.3-2.3,0.5-4.1,0.5-5.5c0-8-4.9-13.4-12.3-13.4 c-0.6,0-1.5,0.1-2.4,0.1L20.8,61.6h8.6L29.4,63H3.8l0.4-1.4H11.8z"/>
                    <path fill="#ffffff" d="M71.4,0l-7.8,33.2c5.3-7.4,8.7-9.8,13.4-9.8c4.5,0,8.5,4.4,8.5,9.3v1c-0.4,2.7-1.3,7-3,13.1c-1,3.8-2,7-2.9,9.6 c-0.5,1.3-0.7,2.5-0.7,3.5c0,1.3,0.7,2.1,2,2.1c1.6,0,3.3-1.8,5-5.3c0.6-1.3,1.5-3.2,2.8-5.7l1.2,0.4c-0.9,2-1.8,3.9-2.5,5.4 c-2.3,4.6-5.4,7.4-8.5,7.4c-3.1,0-5.5-3-5.5-7c0-1.7,0.6-5.1,1.3-7.5l3.9-12.5c0.8-2.8,1.3-5.4,1.3-7c0-3.3-1.6-5.3-4.2-5.3 c-2.4,0-5,1.7-7.6,4.8c-3.4,4.3-6.3,9.3-7.1,12.5L55.8,63h-6.5L63.6,4L64,2.6c0.1-0.1,0.1-0.3,0.1-0.4c0-0.6-0.6-0.9-1.7-0.9h-5.2 L57.6,0H71.4z"/>
                    <path fill="#ffffff" d="M109.1,61.6c-1.5,0.6-2.9,0.8-4.4,0.8c-3.9,0-6.1-2.8-6.1-7.7c0-2.5,0.4-4.4,1.8-9.8c3.2-0.4,6.1-0.9,8.7-1.6 v-2.1c-1.3,0.5-3.3,1-7.9,2c2.5-9.8,4.8-14.9,7.9-16.9v-1.9c-9.6,3.5-17.2,16.5-17.2,25.3c0,7.8,5.6,14.5,12.2,14.5 c1.7,0,3.4-0.3,5-1V61.6z"/>
                </svg>

            </h1>
            <div class="p-login__content">
                <div class="p-login__card">
                    <form @submit.prevent="login">
                        <div class="p-login__card--body">
                            <Loading v-if="processing" />
                            <div class="p-login__error" v-if="auth.error">メールアドレスまたはパスワードが違います。</div>
                            <div class="c-form__row p-login__form--group"> 
                                <input type="text" placeholder="メールアドレス" name="email" class="c-form__control p-login__form--control" v-model="auth.email">
                            </div>
                            <div class="c-form__row p-login__form--group"> 
                                <input type="password" placeholder="パスワード" name="password" class="c-form__control p-login__form--control" v-model="auth.password">
                            </div>
                            <div class="c-form__row p-login__form--group p-login__form--submit"> 
                                <button class="c-button__reset c-button__primary c-button__block c-button__submit" v-bind:disabled="processing"><span>ログイン</span></button>
                            </div>
                            <!-- <div class="p-login__form--supply">パスワードを忘れた方は<n-link to="/password/forgot" v-bind:disabled="processing">こちら</n-link></div> -->
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    middleware: ['auth'],
    layout: 'login',
    head() {
        return {
            title: "ログイン｜"
        }
    },
    data() {
        return {
            processing :false,
            auth: {
                email : '',
                password : '',
                error :false
            }
        }
    },
    beforeDestroy() {
        this.$recaptcha.destroy()
    },
    async mounted (){
        try {
            await this.$recaptcha.init()
        } catch (e) {
            console.error(e);
        }
    },
    methods: {
        async login() {
            this.auth.error = false
            this.processing = true
            try {
                const token = await this.$recaptcha.execute('login')
                try {
                    this.auth.recaptcha = token
                    await this.$auth.loginWith('Admin', { data: this.auth })
                    .then(()=>{
                        this.processing = false
                    })
                } catch (err) {
                    console.log(err)
                    this.auth.error = true
                    this.processing = false
                }
            } catch (error) {
                console.log('Login error:', error)
            }
        
        } 
    }
}
</script>

<style lang="scss" scoped="true">

#p-login{
    position: relative;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    padding:32vh 0 calc(26vh - 60px);
    @media (max-width:991px) {
        padding:80px 0 80px;
    }
    #kartel-logo{
        .st0{enable-background:new    ;}
        .st1{fill:#11254C;}
        .st2{fill:#231815;}
    }
    .p-login__wrapper{
        flex: 1 0 auto;
        position: relative;
        z-index: 1;
        width: 95%;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding-left: 25px;
        padding-right: 25px;
        @media(min-width: 1200px){
            width: 100%;
            max-width: 1200px;
        }

        @media(max-width: 991px){
            display: block;
        }
        @media(max-width: 575px){
            padding-left: 0;
            padding-right: 0;
        }

        @media(max-width: 320px){
            width: 100%;
        }
    }
    .p-login__logo{
        padding: 0;
        margin: 0;
        font-size: 0;
        line-height: 100%;
        flex: 1 0 auto;
        padding-left: 15px;
        padding-right: 15px;
        svg{
            width: 300px;
            margin: 0 auto;
            @media (max-width: 991px){
                width: 240px;
            }
            @media (max-width: 374px){
                width: 200px;
            }
        }
    }
    .p-login__content{
        position: relative;
        flex: 1 0 auto;
    }
    .p-login__card{
        width: 420px;
        max-width: 100%;
        margin: 0 auto;
        .p-login__error{
            font-size: 0.8rem;
            line-height: 140%;
            position: relative;
            top: -10px;
            color: $danger;
        }
        .p-login__card--body{
            padding: 40px 25px 0;
            
        }
       
        .p-login__form--submit{
            padding-top: 10px;
            @media(max-width: 320px){
               padding: 0;
            }
        }
        .p-login__form--register{
            margin-top: 15px;
            text-align: center;
        }
        .p-login__form--supply{
            font-size: 0.8rem;
            text-align: center;
            color: $gray ;
        }
    }
    .p-login__footer{
        flex: 0 0 90px;
        position: relative;
        z-index: 1;
        width: 100%;
        background: #fff;
        line-height: 90px;
        text-align: center;
        padding-left: 25px;
        padding-right: 25px;
        svg{
            position: relative;
            top: -3px;
            height: 29px !important;
        }
    }
}
</style>