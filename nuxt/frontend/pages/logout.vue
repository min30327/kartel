<template>
    <div></div>
</template>

<script>
export default {
    middleware: ['auth'],
    
    async mounted (){
        await this.$nextTick()
        this.$auth.logout()
    },
    methods: {
        
    }
}
</script>
