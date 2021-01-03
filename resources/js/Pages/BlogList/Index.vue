<template>
    <blog-layout>
        <template #banner>
            <div id="blog-banner" class="flex flex-grow justify-center h-64 items-center lg:px-64">
                <img src="/images/cover/banner_bg.png" alt="" class="banner">
<!--                <img src="/images/cover/bg-home.png" alt="" class="banner1">-->
                <h1 class="text-6xl text-white font-bold border-r-2 px-12">Blogs</h1>
                <div class="flex-col px-12">
                    <h2 class="text-2xl text-white font-bold">Author</h2>
                    <h2 class="text-xl text-white justify-self-start font-bold">Jose</h2>
                </div>
            </div>
        </template>

        <template #content-left>
            <div id="trigger1" class="flex-1 bg-blue-400">
                test

            </div>
        </template>

        <template #content-right>
            <div class="">
                test

            </div>

        </template>

    </blog-layout>
</template>

<script>
import BlogLayout from "@/Layouts/BlogLayout";
import Nav from "@/Components/Nav";
export default {
    components: {
        Nav,
        BlogLayout
    },
}
</script>

<style scoped>
#trigger1 {
}

#blog-banner {
    /*background-image: -moz-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);*/
    /*background-image: -webkit-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);*/
    /*background-image: -ms-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);*/
    background-image: -moz-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);
    background: -moz-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);
    background: -webkit-linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);
    background: linear-gradient(180deg, #5e2ced 0%, #a485fd 100%);
    transform-origin: bottom right;
    z-index: 1;
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);
    clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);
}
.banner {
    position: absolute;
    right: 0; top: 0;
    z-index: 10;
    height: 40vh;
}

</style>
