<template>
    <div id="p-email">
        <div class="p-email__wrapper">
            <div class="p-email__content">
                <div class="c-card__shadow">
                    <div class="c-card p-email__card">
                        <loading v-if="processing" />
                        <form @submit.prevent="_sendmail" v-if="!success">
                            <div class="p-email__card--body">
                                <h3 class="p-email__title">パスワードの再発行</h3>
                                <div class="p-email__error" v-if="error">
                                    <div class="alert alert-danger" role="alert" v-text="response.message"></div>
                                </div>
                                <div class="p-email__error" v-if="empty">
                                    <div class="alert alert-danger" role="alert">
                                        メールアドレスが空です。
                                    </div>
                                </div>
                                <div class="c-form__row p-login__form--group"> 
                                    <input type="text" placeholder="メールアドレス" name="email" class="c-form__control p-login__form--control" v-model="email">
                                </div>
                                <div class="form-group p-email__form--group p-email__form--submit"> 
                                    <button class="c-button__reset c-button__primary c-button__block c-button__submit"><span>メールを送信する</span></button>
                                </div>
                                <div class="p-email__form--supply"><n-link to="/login">ログイン画面へ戻る</n-link></div>
                            </div>
                        </form>
                        <div v-if="success">
                            
                            <div class="p-email__card--body">
                                <div class="alert alert-success" role="alert">
                                    メールを送信しました。
                                </div>
                                <div class="form-group p-email__form--group p-email__form--submit"> 
                                    <div class="p-email__form--supply"><n-link to="/login" class="btn btn-primary btn-block c-auth__button">ログイン画面へ戻る</n-link></div>
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
            title: "パスワード再発行用メールの送信｜"
        }
    },
    data() {
        return {
            processing :false,
            response: {
                status:"",
                message :""
            },
            empty: false,
            error : false,
            success: false,
            email : ''
        }
    },
    mounted (){
    },
    methods: {
        async _sendmail() {
            try {
                this.error = false
                this.success = false
                this.empty = false
                if(this.email == ""){
                    this.empty = true
                    return false;
                }
                this.processing = true
                const params = new URLSearchParams();
                params.append('email',this.email)
                await this.$axios.post("/Users/password/email",params)
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
                this.error = true
                this.processing = false
            }
        }
    }
}
</script>

<style lang="scss">


#p-email{
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
    .p-email__wrapper{
        flex: 1 0 auto;
        position: relative;
        z-index: 1;
        width: 95%;
        max-width: 100%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
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
    .p-email__title{
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 20px;
        color: $gray;
    }
    .p-email__content{
        margin-bottom: 60px;
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        @media(max-width: 991px){
            margin: 40px auto;
        }
        
    }
    .p-email__card{
        position: relative;
        .p-email__error{
            font-size: 0.8rem;
            position: relative;
            top: -10px;
            color: $danger;
        }
        .p-email__card--body{
            padding: 40px;
            @media(max-width: 575px){
                padding:40px 25px;
            }
            @media(max-width: 320px){
                padding:30px 25px;
            }
        }
        .p-email__form--submit{
            padding-top: 10px;
            @media(max-width: 320px){
               padding: 0;
            }
        }
        .p-email__form--supply{
            margin-top: 15px;
            font-size: 0.8rem;
            text-align: center;
        }
        .alert-success{
            text-align: center;
        }
        .p-reset__form--return{
            text-align: center;
        }
    }
    .p-email__footer{
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