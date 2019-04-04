<template>
    <div>
        <Navbar/>
        <transition name="page">
            <router-view></router-view>
        </transition>
    </div>
</template>

<style>
    .remove-link-default {
        margin-right: 15px;
        color: #fff;
        text-decoration: none;
    }

    .remove-link-default:hover {
        color: orangered;
        text-decoration: none;
    }

    .page-enter-active {
        animation: coming 0.5s;
        animation-delay: .5s;
        opacity: 0;
    }

    .page-leave-active {
        animation: going 0.5s;
    }

@keyframes going {
  from {
    transform: scale(1);
    opacity: 1;
}
    to {
        transform: scale(0);
        opacity: 0;
    }
}

@keyframes coming {
    from  {
        transform: scale(0);
        opacity: 0;
    }

    to {
    transform: scale(1);
    opacity: 1;
  }
}
</style>
