<template>
    <div id="p-admin">
        <div class="c-page__container">
            
            <div class="p-admin__score-board--wrapper">
                <div class="p-admin__score-board">
                    <div class="p-admin__score--item">
                        <h4 class="p-admin__score--item-label">現在会員数</h4>
                        <div class="p-admin__score--item-count" v-text="count.member"></div>
                    </div>
                    <div class="p-admin__score--item">
                        <h4 class="p-admin__score--item-label">oVice登録済み</h4>
                        <div class="p-admin__score--item-count" v-text="count.ovice_registered"></div>
                    </div>
                    <div class="p-admin__score--item">
                        <h4 class="p-admin__score--item-label">oVice未登録</h4>
                        <div class="p-admin__score--item-count" v-text="count.ovice_unregistered"></div>
                    </div>
                    <div class="p-admin__score--item">
                        <h4 class="p-admin__score--item-label">解約</h4>
                        <div class="p-admin__score--item-count" v-text="count.withdrawal"></div>
                    </div>
                </div>
            </div>

            <div class="p-admin__lists">
                <table class="c-table c-table__striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>お名前</th>
                            <th>メールアドレス</th>
                            <th>oViceメールアドレス</th>
                            <th>ホワイトリスト</th>
                            <th>ホワイトリスト登録</th>
                            <th>ステータス</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user,index) in users.data">
                            <td v-text="user.id"></td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                            <td v-text="user.ovice_email"></td>
                            <td>
                                <span v-if="user.ovice_registered">登録済み</span>
                                <span v-if="!user.ovice_registered">未登録</span>
                            </td>
                            <td>
                                <button v-if="user.ovice_registered" @click="ovice_unregister(user,index)" class="c-button__small c-button__reset c-button__secondary">登録を解除する</button>
                                <button v-if="!user.ovice_registered" @click="ovice_register(user,index)" v-bind:disabled="user.status != 'subscribed'" class="c-button__small c-button__reset c-button__primary">登録済みにする</button>
                            </td>
                            <td>
                                <span v-if="user.status == ''">非会員</span>
                                <span v-if="user.status == 'subscribed'">会員</span>
                                <span v-if="user.status == 'cancelled'">退会</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="c-admin__pagination">
                <pagination :data="users" @pagination-change-page="fetch"></pagination>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    middleware: ['auth'],
    layout: 'admin',
    head() {
        return {
            title: "Dashboard｜"
        }
    },

    async asyncData(app) {
        
        const params = new URLSearchParams(window.location.search)


        const count = await app.$axios.$get( '/Users/counts')


        const users = await app.$axios.$get( '/Users' ,{
            params : params
        })

        //this.postsでアクセス可能になる
        return {
            users : users.data,
            count: count.data,
        }
    },
    data() {
        return {
            processing :true,
            users:[],
            count:{
                "member" :0,
                "ovice_registered" :0,
                "ovice_unregistered" :0,
                "withdrawal" :0,
            },
            paginate:{},
        }
    },
    async mounted (){

        
    
    },
    methods: {
        ovice_register(user,index){
            this.processing = true
            this.$axios.get( '/Users/ovice_register/' + user.id )
            .then(response => {
                user.ovice_registered = 1;
                this.get_count()
                this._toast("success","登録済みにしました。")
			})
            .catch(error => {
                this._toast("error","登録済みにできませんでした。")
			})
            .finally( () => {
                this.processing = false
            })
        },
        ovice_unregister(user,index){
            this.processing = true
            this.$axios.get( '/Users/ovice_unregister/' + user.id )
            .then(response => {
                user.ovice_registered = "";
                this.get_count()
                this._toast("success","登録を解除しました。")
			})
            .catch(error => {
                this._toast("error","登録を解除できませんでした。")
			})
            .finally( () => {
                this.processing = false
            })
        },
        get_count(){
            this.$axios.$get( '/Users/counts' )
            .then(response => {
                this.count = response.data
			})
        },
        async fetch(page = 1){
            this.processing = true
            const params = new URLSearchParams(window.location.search)
            await this.$axios.get( '/Users?page=' + page ,{
                params : params
            })
            .then(response => {
                this.users = response.data.data;
			})
            .finally( () => {
                this.processing = false
            })
        },
        _toast(type,message=""){
            
            this.$toast[type](message, {
                position: "top-right"
            })
        },
    
    }
}
</script>

<style lang="scss" scoped="true">
#p-admin{
    .p-admin__score-board--wrapper{

        padding:20px 40px;
        border-radius: 12px;
        background: #1F252E;
        margin-bottom: 30px;
        @media(max-width: 767px){
            padding: 20px;
        }
    }
    .p-admin__score-board{
        display: flex;
        flex-wrap: wrap;
        margin-left: -30px;
        margin-right: -30px;

        @media(max-width: 767px){
            margin-left: -20px;
            margin-right: -20px;
        }
        .p-admin__score--item{
            margin: 0 30px;
            @media(max-width: 767px){
                margin: 0 20px;
            }
        }
        .p-admin__score--item-label{
            color: #C4C4C4;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.4;
            @media(max-width: 767px){
                font-size: 12px;
            }
        }
        .p-admin__score--item-count{
            font-size: 70px;
            line-height: 70px;
            margin-bottom: 20px;
            @media(max-width: 767px){
                font-size: 40px;
                line-height: 40px;
                margin-bottom: 10px;
            }
    
        }
    }
    .p-admin__lists{
        overflow-x: auto;
        background-color: #1F252E;
        border-radius: 6px;
        padding:10px 0 ;
        
    }
    .c-table{
        width: 100%;
        border-collapse: collapse;
        thead tr th{
            font-size: 12px;
            color: #C4C4C4;
            text-align: left;
            padding: 5px 15px;
            white-space: nowrap;
        }
        tbody tr td{
            font-size: 14px;
            color: #C4C4C4;
            padding: 8px 15px;
            white-space: nowrap;
        }
        tbody tr:nth-child(odd) td{
            background: #0D1A24;
        }
        
    }
}
</style>