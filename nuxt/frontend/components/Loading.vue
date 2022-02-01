<template>
    <div class="c-public__loading--wrapper">
        <div class="c-public__loading"><i class="fad fa-spinner-third"></i></div>
    </div>
</template>

<style lang="scss">
    .c-public__loading--wrapper{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
    .c-public__loading{
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -10px;
        margin-top: -10px;
        width: 20px;
        height: 20px;
        z-index: 11;
        i{
            font-size: 1.2rem;
            color: #0dcaf0;
            animation: loadingSpinner .5s cubic-bezier(0.190, 1.000, 0.220, 1.000) 0s infinite;
        }
    }
    @keyframes loadingSpinner {
        100% {
            transform: rotate(360deg);
        }
    }
</style>

