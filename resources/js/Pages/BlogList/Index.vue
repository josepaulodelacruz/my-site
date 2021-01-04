<template>
    <blog-layout>
        <template #banner>
            <div id="blog-banner" class="flex flex-grow justify-center h-64 items-center lg:px-64">
                <img src="/images/cover/banner_bg.png" alt="" class="banner">
                <img src="/images/cover/banner_bg.png" alt="" class="banner-left">
                <h1 class="text-6xl text-white font-bold border-r-2 px-12">Blogs</h1>
                <div class="flex-col px-12">
                    <h2 class="text-2xl text-white font-bold">Author</h2>
                    <h2 class="text-xl text-white justify-self-start font-bold">Jose</h2>
                </div>
            </div>
        </template>

        <template #content-left>
            <div id="trigger1" class="flex-1">
                <div v-for="blog in blogs" :key="blog.id" class="flex-col mb-10 shadow-lg">

                    <img :src="'images/blogs/' + blog.image" alt="" class="object-cover h-64 w-full">

                    <div class="p-10">
                        <span class="text-gray-500 font-bold py-3">By: Jose</span>
                        <h2 class="font-bold text-lg py-3">{{ blog.title }}</h2>
                        <p>{{ blog.description }}</p>

                        <ul class="flex w-1/2 flex-wrap mt-4">
                            <li v-for="(t, index) in blog.tags" :key="index" class="border px-2 rounded-lg mr-2 mt-2">{{ t.tag_type }}</li>
                        </ul>

                        <div class="flex pt-4 items-center">
                            <inertia-link :href="route('blog.view', blog)" class="read-more pr-2">Read More</inertia-link>
                            <svg class="read-more" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                </div>

            </div>
        </template>

        <template #content-right>
            <div class="flex-col w-64 pl-10 hidden lg:block">
                <input type="text" class="p-2 rounded-lg shadow" placeholder="Search">

                <h2 class="font-bold border-b-2 w-3/4 pt-10">Categories</h2>
                <div>
                    <ul>
                        <li v-for="tag in tags" v-if="tag.related.length > 0"  :key="tag.id" class="flex justify-between py-1">
                            <inertia-link :href="'#'" class="text-lg font-bold">
                                {{ tag.type }}
                            </inertia-link>

                            <p>({{ tag.related.length }})</p>
                        </li>
                    </ul>


                </div>
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
    props: [
        'blogs',
        'tags',
    ],
    data() {
        return {
            isMobile: null,
            windowWith: window.innerWidth
        }
    },
    mounted() {
        if(this.windowWith > 1024) {
            this.isMobile = false
        } else {
            this.isMobile = true
        }
    }
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
    /*-webkit-clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);*/
    /*clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);*/
}
.banner {
    position: absolute;
    right: 0;
    top: 0;
    z-index: 1;
    height: 16rem;
}

.banner-left {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 10;
    height: 16rem;
    -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    z-index: 1;
}

.read-more::after {
    content: " ";
    display: block;
    width: 0;
    height: 2px;
    background: #5e2ced;
    transition: width 300ms;

}

.read-more:hover {
    color: #5e2ced;
}

.read-more:hover::after {
    width: 100%;
}

</style>
