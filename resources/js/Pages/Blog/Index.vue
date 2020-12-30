<template>
    <div class="flex-col">
        <Nav/>
        <div class="flex bg-blue-500 justify-center items-center h-64 px-64">
            <h1 class="text-6xl text-white font-bold border-r-2 px-12">{{ blog.title }}</h1>
            <div class="flex-col px-12">
                <h2 class="text-2xl text-white font-bold">Author</h2>
                <h2 class="text-xl text-white justify-self-start font-bold">Jose</h2>
            </div>
        </div>
        <!--Blog Page-->
        <div id="trigger1" class="flex justify-start mt-12 items-start px-64">
          <div class="flex-1">
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

          <div id="pin1" class="flex-col self-start">
              <p class="text-3xl font-bold">Search</p>
              <div class="border-b-2"></div>

              <div class="py-6">
                  <jet-input type="text" class="mt-1 block w-full rounded-full"/>
              </div>

              <div class="flex-col">
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
                          <li class="border px-2 rounded-lg mr-2 mt-2">Networking</li>
                          <li class="border px-2 rounded-lg mr-2 mt-2">Coding</li>
                          <li class="border px-2 rounded-lg mr-2 mt-2">Gaming</li>
                          <li class="border px-2 rounded-lg mr-2 mt-2">Shops</li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>

        
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Nav from '@/Components/Nav'
import JetInput from '@/Jetstream/Input'
export default {
  props: ['blog'],
  components: {
    AppLayout,
    Nav,
    JetInput
  },
  mounted() {
        const scene2 = this.$scrollmagic.scene({
        // ID of element where animation starts
        triggerElement: '#trigger1',

        // {0,0.5,1} - animations starts from {top,center,end} of window
        triggerHook: 0.1,

        // Duration of animation
        duration: 300
    })
    .addIndicators({ name: '2 (duration: 300)' })
    .setPin('#pin1')

    this.$scrollmagic.addScene(scene2)

  }
}
</script>

<style scoped>

</style>
