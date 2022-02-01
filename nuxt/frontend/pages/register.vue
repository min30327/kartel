<template>
    <div id="p-register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-register__wrapper">
                        <div class="p-register__content">
                            <loading v-if="processing" />
                            <div class="c-card p-register__card">
                                <form @submit.prevent="_register" v-if="!success">
                                    <div class="p-register__card--body">
                                        
                                        <h2 class="p-register__title">
                                            <svg version="1.1" id="kartel-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 688 110" style="enable-background:new 0 0 688 110;" xml:space="preserve">
                                            <g class="st0">
                                                <path class="st1" d="M282.3,85.9h-40l-8,24.2H211l40.9-110h21.7l41,110h-23.2L282.3,85.9z M249.5,64.6h24.9l-11.6-36.7L249.5,64.6z "/>
                                                <path class="st1" d="M366.2,70.7h-18.3v39.8h-22V-0.4H377c22.8,0,36.7,14.9,36.7,35.3c0,19.4-8.6,29.7-20.4,32.5l21.5,43.1h-27.2 L366.2,70.7z M375.3,21.7h-27.4v28.1h27.4c12.7,0,16.4-4.9,16.4-14C391.7,25.9,384.7,21.7,375.3,21.7z"/>
                                                <path class="st1" d="M454.8,21.7h-32V0.1h82.9v21.6h-29.8v88.6h-21.1V21.7z"/>
                                                <path class="st1" d="M517.6,0.1h75.5v21.6h-53.3v19.5h31v22.2h-31.4v25.4l56,0.2l0.4,21.1h-77.9L517.6,0.1z"/>
                                                <path class="st1" d="M611.1,0.1h22.2v88.4H688v21.8h-76.9V0.1z"/>
                                                <path class="st1" d="M116.6,30.2c0-2.8-1.7-4.7-4.2-4.7c-1.2,0-2.3,0.3-3.3,1v14.8c0.7-0.3,1.2-0.6,1.8-1     C113.9,38.3,116.6,33.6,116.6,30.2z"/> <path class="st1" d="M163.7,39.4l32.9-39.3h-25.5L131,48.5V0.1h-21.9v24.4c1.6-0.6,3.2-0.9,4.8-0.9c4.5,0,8.5,3.8,8.5,8.2     c0,5.4-4.7,9.3-13.3,11.6v18.3c3.2-1.2,6.5-3.9,10.5-8.4l1,0.9c-3.8,4.4-7.6,7.6-11.5,9.1v46.8h21.7V77.5l17.3-19.4l29.4,52.1     h25.2L163.7,39.4z"/>
                                            </g>
                                            <g>
                                                <path class="st2" d="M11.8,61.6L26,1.9h-2.4c-3.1,0-4.8,0.4-7.7,1.5C9.3,6,5.9,9.8,1.6,18.9H0C2.3,13.2,4.9,6.1,5.5,0.4h46.8 c3,0,3.6,0.2,3.6,1.2c0,0.8-0.4,1.6-0.6,2.6c-0.4,1.6-1.8,6.5-4.2,16.5h-1.5c0.3-2.3,0.5-4.1,0.5-5.5c0-8-4.9-13.4-12.3-13.4 c-0.6,0-1.5,0.1-2.4,0.1L20.8,61.6h8.6V63H3.8l0.4-1.4H11.8z"/>
                                                <path class="st2" d="M71.4,0l-7.8,33.2c5.3-7.4,8.7-9.8,13.4-9.8c4.5,0,8.5,4.4,8.5,9.3v1c-0.4,2.7-1.3,7-3,13.1 c-1,3.8-2,7-2.9,9.6c-0.5,1.3-0.7,2.5-0.7,3.5c0,1.3,0.7,2.1,2,2.1c1.6,0,3.3-1.8,5-5.3c0.6-1.3,1.5-3.2,2.8-5.7l1.2,0.4 c-0.9,2-1.8,3.9-2.5,5.4c-2.3,4.6-5.4,7.4-8.5,7.4s-5.5-3-5.5-7c0-1.7,0.6-5.1,1.3-7.5l3.9-12.5c0.8-2.8,1.3-5.4,1.3-7 c0-3.3-1.6-5.3-4.2-5.3c-2.4,0-5,1.7-7.6,4.8C64.7,34,61.8,39,61,42.2L55.8,63h-6.5L63.6,4L64,2.6c0.1-0.1,0.1-0.3,0.1-0.4 c0-0.6-0.6-0.9-1.7-0.9h-5.2L57.6,0H71.4z"/>
                                                <path class="st2" d="M109.1,61.7c-1.5,0.6-2.9,0.8-4.4,0.8c-4,0-6.1-2.8-6.1-7.7c0-2.5,0.4-4.4,1.8-9.8c3.2-0.4,6.1-0.9,8.7-1.6 v-2.1c-1.3,0.5-3.3,1-7.8,2c2.5-9.7,4.8-14.9,7.8-16.8v-2C99.5,28,91.9,41,91.9,49.8c0,7.8,5.6,14.5,12.2,14.5c1.7,0,3.4-0.3,5-1 V61.7z"/>
                                            </g>
                                            </svg>
                                        </h2>
                                        <div class="p-email__error" v-if="unmatch">
                                            <div class="alert alert-danger" role="alert" v-text="message"></div>
                                        </div>


                                        <div class="c-form__row p-login__form--group">
                                            <label class="c-form__label">お名前</label>
                                            <input type="text" class="c-form__control c-auth__input" placeholder="お名前" v-bind:class="{'is-invalid':isInvalid('name')}" v-model="user.name">
                                            <div class="invalid-feedback" v-if="isInvalid('name')" v-text="response.errors.name[0]"></div>
                                        </div>
                                        
                                        <div class="c-form__row p-login__form--group">
                                            <label class="c-form__label">メールアドレス</label>
                                            <input type="text" class="c-form__control c-auth__input" placeholder="example@not4h.jp" v-bind:class="{'is-invalid':isInvalid('email')}" v-model="user.email">
                                            <div class="invalid-feedback" v-if="isInvalid('email')" v-text="response.errors.email[0]"></div>
                                        </div>
                                        <div class="c-form__row p-login__form--group">
                                            <label class="c-form__label">パスワード</label>
                                            <input type="password" placeholder="パスワード" class="c-form__control p-reset__form--control c-auth__input" v-bind:class="{'is-invalid':isInvalid('password')}" name="password" v-model="user.password">
                                            <div class="invalid-feedback" v-if="isInvalid('password')" v-text="response.errors.password[0]"></div>
                                        </div>
                                        <div class="c-form__row p-login__form--group"> 
                                            <label class="c-form__label">パスワード確認用</label>
                                            <input type="password" placeholder="パスワード確認用" class="c-form__control p-reset__form--control c-auth__input" name="password_confirmation" v-model="user.password_confirmation">                                    
                                        </div>
                                        
                                        <div class="p-login__form--group">
                                            <div class="p-login__form--terms">
                                                <n-link to="terms" target="_blank">ご利用規約を確認する</n-link>
                                            </div>
                                            <div class="p-login__form--terms-check">
                                                <label class="c-form-check">
                                                    <input type="checkbox" class="c-form-check__input" v-model="is_agree">
                                                    <span>ご利用規約に同意する</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="c-form__row p-register__form--group p-register__form--submit"> 
                                            <button class="c-button__reset c-button__primary c-button__submit p-register__form--btn" v-bind:disabled="processing || !is_agree"><span>KARTELに申し込む</span></button>
                                        </div>
                                        <div class="p-register__form--supply">メンバーの方はこちらから<n-link to="/login" v-bind:disabled="processing">ログイン</n-link>してください。</div>
                                    </div>
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    layout: 'auth',
    head() {
        return {
            title: "KARTELに申し込む｜"
        }
    },
    data() {
        return {
            processing :false,
            response:{
                status: "",
                data: "",
                message : "",
                errors : {}
            },
            error :false,
            unmatch :false,
            message : "",
            success :false,
            is_agree :false,
            user:{
                name: '',
                subname: '',
                password: '',
                password_confirmation : '',
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
        isInvalid(key){
            if(this.response.errors){
                if(this.response.errors.hasOwnProperty(key)){
                    return true
                }
            }
            return false 
        },
        
        async _register() {
            
            
            try {
                const token = await this.$recaptcha.execute('register')

                const params = new URLSearchParams();
                
                for(let key in this.user){
                    let value = this.user[key]
                    if(value === null){
                        value = ""
                    }
                    params.append(key, value)
                }
                params.append('recaptcha', token)
                this.processing = true
                

                await this.$axios.post("/Users" ,params)
                .then((res)=>{
                    this.response = res.data

                    this.$auth.loginWith('User', { data: this.user })
                    .then(()=>{
                        this.processing = false
                    })
                    this._toast("success",this.response.summary)
                })
                .catch(error => {
                    this.response = error.response.data
                    this._toast("error",this.response.summary)
                })
                .finally( () => {
                    this.processing = false
                })

            } catch (error) {
                console.log('Register error:', error)
            }
            
        },

        _toast(type,message=""){
            
            this.$toast[type](message, {
                position: "top-right"
            })
        }
    }
}
</script>

<style lang="scss"　scoped="true">


#p-register{
    position: relative;
    padding:40px 0 80px;
   
    #kartel-logo{
        margin: 0 auto;
        width: 300px;
        max-width: 100%;
        .st0{enable-background:new    ;}
        .st1{fill:#11254C;}
        .st2{fill:#231815;}
    }
    .p-register__wrapper{
        flex: 1 0 auto;
        position: relative;
        z-index: 1;
        max-width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        @media(min-width: 1200px){
            width: 100%;
            max-width: 1200px;
        }

        

        @media(max-width: 320px){
            width: 100%;
        }
    }
    .p-register__title{
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 20px;
        color: $gray;
    }
    .p-register__content{
        margin-bottom: 60px;
        max-width: 100%;
        margin: 0 auto;
        @media(max-width: 991px){
            margin: 40px auto;
        }
        
    }
    .p-register__card{
        max-width:100%;
        width: 500px;
        background: transparent;
        .p-register__error{
            font-size: 0.8rem;
            position: relative;
            top: -10px;
            color: $danger;
        }
        .p-register__card--body{
            padding: 40px;
            @media(max-width: 575px){
                padding:40px 25px;
            }
            @media(max-width: 320px){
                padding:30px 25px;
            }
        }
        .p-register__form--submit{
            padding-top: 10px;
            text-align: center;
            @media(max-width: 320px){
               padding: 0;
            }
        }
        .p-register__form--btn{
            display: block;
            width: 100%;
            max-width: 100%;
        }
        .p-register__form--supply{
            font-size: 0.8rem;
            text-align: center;
        }
        .p-login__form--terms{
            text-align: center;
            padding: 10px 0 0;
            font-size: 0.9rem;
        }
        .p-login__form--terms-check{
            text-align: center;
            padding: 0 0 10px;
        }
    }
    .p-register__footer{
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