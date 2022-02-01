<template>
    <div id="p-profile">
        <div class="c-page__container">
            <div class="p-profile__header">
                <h1 class="p-profile__header--title c-title">Profile</h1>
                <button class="p-profile__header--button c-button__reset c-button__primary" @click="_save()" v-bind:disabled="processing">保存する</button>
            </div>
            <section class="c-section" >
                <div class="c-card__shadow">
                    <div class="c-card">
                        <div class="c-card__body">
                            <Loading v-if="processing" />
                            <div class="c-profile">
                                <div class="c-profile__content">
                                    <label class="c-profile__heading" for="user_name">お名前</label>
                                    <div class="c-profile__body">
                                        <input type="text" class="c-form__control" id="user_name" placeholder="お名前" v-bind:class="{'is-invalid':isInvalid('name')}" v-model="userData.name">
                                        <div class="invalid-feedback" v-if="isInvalid('name')" v-text="response.errors.name[0]"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-profile">
                                <div class="c-profile__content">
                                    <h4 class="c-profile__heading">パスワード</h4>
                                    <div class="c-profile__body">
                                        <n-link to="/password/forgot" class="c-button__secondary" v-bind:disabled="processing">パスワードを変更する</n-link>
                                    </div>
                                </div>
                            </div>

                            <div class="c-profile c-profile__ovice">
                                <div class="c-profile__content">
                                    <label class="c-profile__heading" for="ovice_email">oVice メールアドレス</label>
                                    <div class="c-profile__body">
                                        <input type="text" class="c-form__control" id="ovice_email" placeholder="oVice ホワイトリスト メールアドレス" v-bind:class="{'is-invalid':isInvalid('ovice_email')}"  v-model="userData.ovice_email">
                                         <div class="invalid-feedback" v-if="isInvalid('ovice_email')" v-text="response.errors.ovice_email[0]"></div>
                                        <p class="notice"><small>※KARTELログイン時のメールアドレスは変更されません。</small></p>
                                    </div>
                                </div>
                            </div>

                            <div class="c-profile">
                                <div class="c-profile__content">
                                    <label class="c-profile__heading" for="ovice_email">oVice ホワイトリスト</label>
                                    <div class="c-profile__body">
                                        <div v-if="$auth.user.ovice_registered">登録済み</div>
                                        <div v-if="!$auth.user.ovice_registered">未登録</div>
                                        <p class="notice" v-if="!$auth.user.ovice_registered"><small>※登録されるまでしばらくお待ち下さい。</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
        </div>
    </div>
</template>

<script>
export default {
    middleware: ['auth'],
    layout: 'admin',
    head() {
        return {
            title: "Profile｜"
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
            status: '',
            userData: {
                name: "",
                ovice_email: ""
            },
            guild_id  : process.env.GUILD_ID
        }
    },
    async mounted (){

        
        this.$axios.get('Stripe/status')
        .then(this.setStatus);

        await this.$nextTick()
        this.userData = JSON.parse(JSON.stringify(this.$auth.user))
        
        
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
        
        setStatus(response) {
            this.status = response.data.status;
            this.details = response.data.details;

        },
        _save() {

            this.processing = true
            const url = '/Users/edit/' + this.$auth.user.id;
            const params = new URLSearchParams()
            
            params.append('id', this.userData.id);
            params.append('name', this.userData.name);
            params.append('email', this.userData.email);
            params.append('ovice_email', this.userData.ovice_email);

            this.$axios.post(url,params)
            .then((response) => {
                this.response = response.data
                this.setStatus
                this.processing = false
                this.$auth.fetchUser()
                this._toast("success","プロフィールを更新しました。")
            })

            .catch(error => {
                this.response = error.response.data
                this.processing = false
                this._toast("error","プロフィールを更新できませんでした。")
            })
        },
        _toast(type,message=""){
            
            this.$toast[type](message, {
                position: "top-right"
            })
        }
    },
    computed: {
        
        isSubscribed() {
            return (this.status === 'subscribed' || this.status === 'cancelled');
        },
        isCancelled() {
            return (this.status === 'cancelled');
        }
    },
}
</script>

<style lang="scss" scoped="true">
.c-section{
    margin-bottom: 30px;
}
.p-profile__header{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-end;
    .p-profile__header--button{
        width: 150px;
        margin-bottom: 20px;
    }
}

.c-profile__ovice{
    border-top: 1px solid #eee;
    padding-top: 50px;
    margin-top: 20px;
    @media(max-width: 767px){
        padding-top: 30px;
        margin-top: 10px;
    }
}
.c-profile{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    
    .c-profile__content{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin-bottom: 30px;
    }
    .notice{
        margin: 0;
        padding: 5px 0 0;
        color: $gray;
        font-size: 13px;
        line-height: 1.3;
    }
    .c-profile__heading{
        margin: 0;
        padding: 0;
        font-size: .9rem;
        color: $gray;
        flex: 0 0 200px;
        max-width: 200px;
        font-weight: bold;
        @media (max-width: 767px) {
            display: block;
            max-width: 100%;
            flex: 0 0  100%;
            margin-right: 20px;
        }
    }
    .c-profile__body{
        flex: 0 0 calc(100% - 200px);
        max-width: calc(100% - 200px);
        
        @media (max-width: 767px) {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
}
</style>