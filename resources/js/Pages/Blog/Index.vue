<template>
    <blog-layout>
        <template #banner>
            <div id="blog-banner" class="flex flex-grow justify-center items-center h-64 lg:px-64">
                <img src="/images/cover/banner_bg.png" alt="" class="banner">
                <img src="/images/cover/banner_bg.png" alt="" class="banner-left">
                <h1 class="text-6xl text-white font-bold border-r-2 px-12">{{ blog.title }}</h1>
                <div class="flex-col px-12">
                    <h2 class="text-2xl text-white font-bold">Author</h2>
                    <h2 class="text-xl text-white justify-self-start font-bold">Jose</h2>
                </div>
            </div>
        </template>

        <!--Blog Page-->
        <template #content-left>
            <div id="trigger1" class="flex-grow">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <h2 class="text-gray-500 font-bold px-1 pt-0.5 text-xs">{{ convertDate(blog.created_at) }}</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    <h2 class="text-gray-500 font-bold px-1 pt-0.5 text-xs"> 12</h2>
                </div>

                <div class="flex-col">

                    <p class="text-2xl">
                        {{ blog.description }}
                    </p>
                    <img
                        class="h-64 object-fill"
                        :src="'/images/blogs/' + blog.image" alt="">

                    <div ref="container" class="bg-gray-50 shadow p-5 mr-5 rounded-lg my-5" v-html="blog.body"/>

                    <div class="flex items-center">
                        <p class="text-lg font-bold border-r-2 pr-2">Tags</p>
                        <ul class="flex flex-wrap pl-3 items-center">
                            <li v-for="(tag, index) in tags" :key="index" class="border px-4 rounded-lg mr-2 mt-2">{{ tag.tag_type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>
        <template #content-right>
            <div v-if="!isMobile" id="pin1" class="invisible lg:visible lg:w-1/4 lg:flex-col lg:self-start">
                <p class="text-3xl font-bold">Search</p>
                <div class="border-b-2"></div>

                <div class="py-6">
                    <jet-input type="text" class="mt-1 block w-full rounded-full"/>
                </div>

                <div class="flex-col justify-start">
                    <div class="flex justify-evenly mb-6 border-b-2">
                        <!--                        <p class="text-lg font-bold">Popular</p>-->
                        <p class="text-lg font-bold">Recent</p>
                    </div>

                    <inertia-link v-for="blog in nextBlogs" :href="route('blog.view', blog)" :key="blog.id" class="flex h-24 mb-2  w-full hover:shadow-2xl">
                        <!--                        <div class="flex-1">Image</div>-->
                        <img alt="Placeholder" class="flex-1 w-20 object-contain" :src="'/images/blogs/' + blog.image">
                        <div class="flex-1 p-2">
                            <h2 class="text-blue-500 text-sm">{{ convertDate(blog.created_at) }}</h2>
                            <h2 class="text-md">{{ blog.title }}</h2>
                        </div>
                    </inertia-link>

                    <div class="py-5">
                        <p class="text-lg font-bold">Tags</p>
                        <div class="border-b-2"></div>
                        <ul class="flex w-64 flex-wrap mt-4">
                            <li v-for="(tag, index) in tags" :key="index" class="border px-2 rounded-lg mr-2 mt-2">{{ tag.tag_type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>

    </blog-layout>
</template>

<script>
import BlogLayout from "@/Layouts/BlogLayout";
import Nav from '@/Components/Nav'
import JetInput from '@/Jetstream/Input'
import moment from 'moment';
export default {
  props: ['blog', 'tags', 'nextBlogs'],
  components: {
    BlogLayout,
    Nav,
    JetInput
  },
  data() {
    return {
      isMobile: null,
      windowWith: window.innerWidth
    }
  },
  methods: {
      convertDate(date) {
          return moment(date).format("MMM Do YY");
      },
  },
  mounted() {
    if(this.windowWith > 1024) {
      this.isMobile = false
      const scene2 = this.$scrollmagic.scene({
        // ID of element where animation starts
        triggerElement: '#trigger1',

        // {0,0.5,1} - animations starts from {top,center,end} of window
        triggerHook: 0.1,

        // Duration of animation
        duration: this.$refs.container.clientHeight / 2
      })
      // .addIndicators({ name: '2 (duration: 300)' })
        .setPin('#pin1')

      this.$scrollmagic.addScene(scene2)
    } else {
      this.isMobile = true
    }
  }
}
</script>

<style scoped>
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
</style>
