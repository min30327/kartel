import Vue from 'vue'
import Toast from "vue-toastification"


Vue.use(Toast,{
    icon: false,
    containerClassName: "not4h-toastification",
    transition: "toast",
    transitionDuration : 400,
})