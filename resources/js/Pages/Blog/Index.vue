<template>
    <div class="flex-col">
        <Nav/>
        <div class="flex flex-grow bg-blue-500 justify-center items-center h-64 lg:px-64">
            <h1 class="text-6xl text-white font-bold border-r-2 px-12">{{ blog.title }}</h1>
            <div class="flex-col px-12">
                <h2 class="text-2xl text-white font-bold">Author</h2>
                <h2 class="text-xl text-white justify-self-start font-bold">Jose</h2>
            </div>
        </div>
        <!--Blog Page-->
        <div  class="flex justify-start items-start px-12 mt-12 md:px-32 lg:px-64">
            <div id="trigger1" class="flex-1">
                <div class="flex items-center">
                    <h2 class="text-gray-500 font-bold pr-2 text-xs">AUG 12, 17</h2>
                    <h2 class="text-gray-500 font-bold pr-2 text-xs"> 12</h2>
                </div>

                <div class="flex-col">

                    <p class="text-2xl">
                        {{ blog.description }}
                    </p>
                    <img
                        class="h-64 object-fill"
                        :src="'/images/blogs/' + blog.image" alt="">

                    <div ref="container" v-html="blog.body"/>
                </div>
            </div>


            <div v-if="!isMobile" id="pin1" class="invisible lg:visible lg:w-1/4 lg:flex-col lg:self-start">
                <p class="text-3xl font-bold">Search</p>
                <div class="border-b-2"></div>

                <div class="py-6">
                    <jet-input type="text" class="mt-1 block w-full rounded-full"/>
                </div>

                <div class="flex-col justify-start">
                    <div class="flex justify-evenly mb-6 border-b-2">
                        <p class="text-lg font-bold">Popular</p>
                        <p class="text-lg font-bold">Recent</p>
                    </div>

                    <div class="flex h-24 mb-2 bg-gray-200 w-full hover:shadow-2xl">
                        <div class="flex-1">Image</div>
                        <div class="flex-1 p-2">
                            <h2 class="text-blue-500 text-sm">AUG 17, 16</h2>
                            <h2 class="text-sm">Some Text</h2>
                        </div>
                    </div>
                    <div class="flex h-24 mb-2 bg-gray-200 w-full hover:shadow-2xl">
                        <div class="flex-1">Image</div>
                        <div class="flex-1 p-2">
                            <h2 class="text-blue-500 text-sm">AUG 17, 16</h2>
                            <h2 class="text-sm">Some Text</h2>
                        </div>
                    </div>
                    <div class="flex h-24 mb-2 bg-gray-200 w-full hover:shadow-2xl">
                        <div class="flex-1">Image</div>
                        <div class="flex-1 p-2">
                            <h2 class="text-blue-500 text-sm">AUG 17, 16</h2>
                            <h2 class="text-sm">Some Text</h2>
                        </div>
                    </div>


                    <div class="py-5">
                        <p class="text-lg font-bold">Tags</p>
                        <div class="border-b-2"></div>
                        <ul class="flex w-64 flex-wrap mt-4">
                            <li v-for="(tag, index) in tags" :key="index" class="border px-2 rounded-lg mr-2 mt-2">{{ tag.tag_type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer bg-gray-800 relative pt-1 border-b-2 border-blue-700">
            <div class="container mx-auto px-6">
                <div class="sm:flex sm:mt-8">
                    <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mb-2">Footer header 1</span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Footer header 2</span>
                            <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500">link 1</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Footer header 3</span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-6">
                <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
                    <div class="sm:w-2/3 text-center py-6">
                        <p class="text-sm text-gray-500 font-bold mb-2">
                            © 2020 by Jose Paulo
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Nav from '@/Components/Nav'
import JetInput from '@/Jetstream/Input'
export default {
  props: ['blog', 'tags'],
  components: {
    AppLayout,
    Nav,
    JetInput
  },
  data() {
    return {
      isMobile: null,
      windowWith: window.innerWidth
    }
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

</style>
