(window.webpackJsonp=window.webpackJsonp||[]).push([[16,8],{400:function(e,t,r){var content=r(402);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(33).default)("8b8bb2f8",content,!0,{sourceMap:!1})},401:function(e,t,r){"use strict";r(400)},402:function(e,t,r){var o=r(32)(!1);o.push([e.i,".c-public__loading--wrapper{position:absolute;left:0;top:0;width:100%;height:100%;z-index:10}.c-public__loading{position:absolute;left:50%;top:50%;margin-left:-10px;margin-top:-10px;width:20px;height:20px;z-index:11}.c-public__loading i{font-size:1.2rem;color:#0dcaf0;-webkit-animation:loadingSpinner .5s cubic-bezier(.19,1,.22,1) 0s infinite;animation:loadingSpinner .5s cubic-bezier(.19,1,.22,1) 0s infinite}@-webkit-keyframes loadingSpinner{to{transform:rotate(1turn)}}@keyframes loadingSpinner{to{transform:rotate(1turn)}}",""]),e.exports=o},403:function(e,t,r){"use strict";r.r(t);r(401);var o=r(7),component=Object(o.a)({},(function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)}),[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"c-public__loading--wrapper"},[t("div",{staticClass:"c-public__loading"},[t("i",{staticClass:"fad fa-spinner-third"})])])}],!1,null,null,null);t.default=component.exports},417:function(e,t,r){var content=r(435);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(33).default)("47f124c0",content,!0,{sourceMap:!1})},434:function(e,t,r){"use strict";r(417)},435:function(e,t,r){var o=r(32)(!1);o.push([e.i,".c-section[data-v-0d6f3910]{margin-bottom:30px}.p-profile__header[data-v-0d6f3910]{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:flex-end}.p-profile__header .p-profile__header--button[data-v-0d6f3910]{width:150px;margin-bottom:20px}.c-profile__ovice[data-v-0d6f3910]{border-top:1px solid #eee;padding-top:50px;margin-top:20px}@media (max-width:767px){.c-profile__ovice[data-v-0d6f3910]{padding-top:30px;margin-top:10px}}.c-profile[data-v-0d6f3910]{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center}.c-profile .c-profile__content[data-v-0d6f3910]{display:flex;flex-wrap:wrap;width:100%;margin-bottom:30px}.c-profile .notice[data-v-0d6f3910]{margin:0;padding:5px 0 0;color:#898ba3;font-size:13px;line-height:1.3}.c-profile .c-profile__heading[data-v-0d6f3910]{margin:0;padding:0;font-size:.9rem;color:#898ba3;flex:0 0 200px;max-width:200px;font-weight:700}@media (max-width:767px){.c-profile .c-profile__heading[data-v-0d6f3910]{display:block;max-width:100%;flex:0 0 100%;margin-right:20px}}.c-profile .c-profile__body[data-v-0d6f3910]{flex:0 0 calc(100% - 200px);max-width:calc(100% - 200px)}@media (max-width:767px){.c-profile .c-profile__body[data-v-0d6f3910]{flex:0 0 100%;max-width:100%}}",""]),e.exports=o},481:function(e,t,r){"use strict";r.r(t);var o=r(2),n=(r(8),r(13),r(17),r(253),r(25),r(15),{middleware:["auth"],layout:"admin",head:function(){return{title:"Profile｜"}},data:function(){return{processing:!1,response:{status:"",data:"",message:"",errors:{}},error:!1,status:"",userData:{name:"",ovice_email:""},guild_id:"699581643001954325"}},mounted:function(){var e=this;return Object(o.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.$axios.get("Stripe/status").then(e.setStatus),t.next=3,e.$nextTick();case 3:e.userData=JSON.parse(JSON.stringify(e.$auth.user));case 4:case"end":return t.stop()}}),t)})))()},methods:{isInvalid:function(e){return!(!this.response.errors||!this.response.errors.hasOwnProperty(e))},setStatus:function(e){this.status=e.data.status,this.details=e.data.details},_save:function(){var e=this;this.processing=!0;var t="/Users/edit/"+this.$auth.user.id,r=new URLSearchParams;r.append("id",this.userData.id),r.append("name",this.userData.name),r.append("email",this.userData.email),r.append("ovice_email",this.userData.ovice_email),this.$axios.post(t,r).then((function(t){e.response=t.data,e.setStatus,e.processing=!1,e.$auth.fetchUser(),e._toast("success","プロフィールを更新しました。")})).catch((function(t){e.response=t.response.data,e.processing=!1,e._toast("error","プロフィールを更新できませんでした。")}))},_toast:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"";this.$toast[e](t,{position:"top-right"})}},computed:{isSubscribed:function(){return"subscribed"===this.status||"cancelled"===this.status},isCancelled:function(){return"cancelled"===this.status}}}),c=(r(434),r(7)),component=Object(c.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{attrs:{id:"p-profile"}},[r("div",{staticClass:"c-page__container"},[r("div",{staticClass:"p-profile__header"},[r("h1",{staticClass:"p-profile__header--title c-title"},[e._v("Profile")]),e._v(" "),r("button",{staticClass:"p-profile__header--button c-button__reset c-button__primary",attrs:{disabled:e.processing},on:{click:function(t){return e._save()}}},[e._v("保存する")])]),e._v(" "),r("section",{staticClass:"c-section"},[r("div",{staticClass:"c-card__shadow"},[r("div",{staticClass:"c-card"},[r("div",{staticClass:"c-card__body"},[e.processing?r("Loading"):e._e(),e._v(" "),r("div",{staticClass:"c-profile"},[r("div",{staticClass:"c-profile__content"},[r("label",{staticClass:"c-profile__heading",attrs:{for:"user_name"}},[e._v("お名前")]),e._v(" "),r("div",{staticClass:"c-profile__body"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.userData.name,expression:"userData.name"}],staticClass:"c-form__control",class:{"is-invalid":e.isInvalid("name")},attrs:{type:"text",id:"user_name",placeholder:"お名前"},domProps:{value:e.userData.name},on:{input:function(t){t.target.composing||e.$set(e.userData,"name",t.target.value)}}}),e._v(" "),e.isInvalid("name")?r("div",{staticClass:"invalid-feedback",domProps:{textContent:e._s(e.response.errors.name[0])}}):e._e()])])]),e._v(" "),r("div",{staticClass:"c-profile"},[r("div",{staticClass:"c-profile__content"},[r("h4",{staticClass:"c-profile__heading"},[e._v("パスワード")]),e._v(" "),r("div",{staticClass:"c-profile__body"},[r("n-link",{staticClass:"c-button__secondary",attrs:{to:"/password/forgot",disabled:e.processing}},[e._v("パスワードを変更する")])],1)])]),e._v(" "),r("div",{staticClass:"c-profile c-profile__ovice"},[r("div",{staticClass:"c-profile__content"},[r("label",{staticClass:"c-profile__heading",attrs:{for:"ovice_email"}},[e._v("oVice メールアドレス")]),e._v(" "),r("div",{staticClass:"c-profile__body"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.userData.ovice_email,expression:"userData.ovice_email"}],staticClass:"c-form__control",class:{"is-invalid":e.isInvalid("ovice_email")},attrs:{type:"text",id:"ovice_email",placeholder:"oVice ホワイトリスト メールアドレス"},domProps:{value:e.userData.ovice_email},on:{input:function(t){t.target.composing||e.$set(e.userData,"ovice_email",t.target.value)}}}),e._v(" "),e.isInvalid("ovice_email")?r("div",{staticClass:"invalid-feedback",domProps:{textContent:e._s(e.response.errors.ovice_email[0])}}):e._e(),e._v(" "),e._m(0)])])]),e._v(" "),r("div",{staticClass:"c-profile"},[r("div",{staticClass:"c-profile__content"},[r("label",{staticClass:"c-profile__heading",attrs:{for:"ovice_email"}},[e._v("oVice ホワイトリスト")]),e._v(" "),r("div",{staticClass:"c-profile__body"},[e.$auth.user.ovice_registered?r("div",[e._v("登録済み")]):e._e(),e._v(" "),e.$auth.user.ovice_registered?e._e():r("div",[e._v("未登録")]),e._v(" "),e.$auth.user.ovice_registered?e._e():r("p",{staticClass:"notice"},[r("small",[e._v("※登録されるまでしばらくお待ち下さい。")])])])])])],1)])])])])])}),[function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("p",{staticClass:"notice"},[r("small",[e._v("※KARTELログイン時のメールアドレスは変更されません。")])])}],!1,null,"0d6f3910",null);t.default=component.exports;installComponents(component,{Loading:r(403).default})}}]);