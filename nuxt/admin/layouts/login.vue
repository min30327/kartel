<template>
  <div id="page" class="l-auth__page">
    <Nuxt />
    <AuthFooter />
  </div>
</template>

<script>
export default {
    
    async mounted (){
        this.$adobeFonts(document)
    }
}
</script>

<style lang="scss">
#page{
    &.l-auth__page{
        padding-left: 0;
        padding-top: 0;
    }
}
</style>
