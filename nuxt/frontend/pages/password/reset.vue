<template>
    <div id="p-reset">
        <div class="p-reset__wrapper">
            <div class="p-reset__content">
                <div class="c-card__shadow">
                    <div class="c-card p-reset__card">
                        <loading v-if="processing" />
                        <form @submit.prevent="_reset" v-if="!success">
                            <div class="p-reset__card--body">
                                <h3 class="p-reset__title">パスワードのリセット</h3>
                                <div class="p-email__error" v-if="error">
                                    <div class="alert alert-danger" role="alert">
                                        リセットに失敗しました。<br>
                                        もう一度 <n-link to="/password/forgot">こちら</n-link> から試してみてください。
                                    </div>
                                </div>
                                <div class="p-email__error" v-if="unmatch">
                                    <div class="alert alert-danger" role="alert" v-text="message"></div>
                                </div>
                                <div class="c-form__row p-reset__form--group"> 
                                    <input type="text" placeholder="メールアドレス" class="c-form__control p-reset__form--control c-admin__input" name="email" v-model="email">
                                </div>
                                <div class="c-form__row p-reset__form--group"> 
                                    <input type="password" placeholder="パスワード" class="c-form__control p-reset__form--control c-auth__input" name="password" v-model="password">
                                </div>
                                <div class="c-form__row p-reset__form--group"> 
                                    <input type="password" placeholder="パスワード確認用" class="c-form__control p-reset__form--control c-auth__input" name="password_confirmation" v-model="password_confirmation">
                                </div>
                                <div class="c-form__row p-reset__form--group p-reset__form--submit"> 
                                    <button class="c-button__reset c-button__primary c-button__block c-button__submit"><span>パスワードのリセット</span></button>
                                </div>
                                <div class="p-reset__form--supply"><n-link to="/login">ログイン画面へ戻る</n-link></div>
                            </div>
                        </form>
                        <div v-if="success">
                            <div class="p-reset__card--body">
                                <div class="alert alert-success" role="alert">
                                    パスワードを変更しました。
                                </div>
                                <div class="form-group p-reset__form--group"> 
                                    <div class="p-reset__form--return"><n-link to="/login" class="btn btn-primary btn-block c-auth__button">ログイン画面へ戻る</n-link></div>
                                </div>
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
            title: "パスワードのリセット｜"
        }
    },
    data() {
        return {
            processing :false,
            response: {
                status:"",
                message :""
            },
            error :false,
            unmatch :false,
            message : "",
            success :false,
            email: "",
            password: '',
            password_confirmation : ''
        }
    },
    mounted (){
        if(this.$auth.loggedIn){
            this.email = this.$auth.user.email
        }
    },
    methods: {
        async _reset() {
            this.error = false
            this.unmatch = false
            this.success = false
            if(this.validate()){
                this.unmatch = true
                return false;
            }
            try {
                this.processing = true
                const params = new URLSearchParams();
                params.append('email',this.email)
                params.append('password',this.password)
                params.append('password_confirmation',this.password_confirmation)
                params.append('token',this.$route.query.key )
                await this.$axios.post("/Users/password/reset/" + this.$route.query.key ,params)
                .then((res)=>{
                    this.response = res.data
                    if( res.data.status == "success" ){
                        this.success = true
                    }else{
                        this.error = true
                    }
                    this.processing = false
                })
            } catch (err) {
                console.log(err)
                this.processing = false
            }
        },
        validate(){
            if(this.email == ""){
                this.message = "メールアドレスが空です。"
                return true;
            }
            if(this.password == "" || this.password_confirmation == ""){
                this.message = "値が空です。"
                return true;
            }
            if(this.password != this.password_confirmation){
                this.message = "パスワードが一致しませんでした。"
                return true;
            }
            ;
            if( !new RegExp(/^[a-z\d]{6,9999}$/i).test(this.password) ){
                this.message = "パスワードは6文字以上で入力してください。"
                return true;
            }
            return false
        }
    }
}
</script>

<style lang="scss"　scoped="true">


#p-reset{
    position: relative;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    padding:220px 0 100px;
    @media (max-width:991px) {
        padding:120px 0 100px;
    }
    // &:before{
    //     content:"";
    //     position: fixed;
    //     left: 0;
    //     top: 0;
    //     width: 100%;
    //     height: 100%;
    //     background: url("~@/assets/image/login-bg.jpg");
    //     background-size: cover;
    //     background-position: center center;
    //     background-repeat: no-repeat;
    //     z-index: 0;
    // }
    .p-reset__wrapper{
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

        @media(max-width: 320px){
            width: 100%;
        }
    }
    .p-reset__title{
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 20px;
        color: $gray;
    }
    .p-reset__content{
        margin-bottom: 60px;
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        @media(max-width: 991px){
            margin: 40px auto;
        }
        
    }
    .p-reset__card{
        position: relative;
        .p-reset__error{
            font-size: 0.8rem;
            position: relative;
            top: -10px;
            color: $danger;
        }
        .p-reset__card--body{
            padding: 40px;
            @media(max-width: 575px){
                padding:40px 25px;
            }
            @media(max-width: 320px){
                padding:30px 25px;
            }
        }
        .p-reset__form--submit{
            padding-top: 10px;
            @media(max-width: 320px){
               padding: 0;
            }
        }
        .p-reset__form--supply{
            font-size: 0.8rem;
            text-align: center;
        }
        .alert.alert-success{
            text-align: center;
        }
        .p-reset__form--return{
            padding: 30px 0 10px;
            text-align: center;
            font-size: 12px;
            line-height: 1.4;
        }
    }
    .p-reset__footer{
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