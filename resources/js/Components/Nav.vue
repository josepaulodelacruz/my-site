<template>
  <nav class="bg-white w-full sm:inline-block  shadow p-6 lg:px-32 lg:inline-flex lg:justify-between ">
      <ul class="flex justify-between">
          <li>
              test
          </li>
          <div class="block lg:hidden">
              <button @click="isOpen = !isOpen" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 ">
                  <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
              </button>
          </div>
      </ul>
      <transition
          name="expand"
          @enter="enter"
          @after-enter="afterEnter"
          @leave="leave">
        <ul v-show="isOpen" class="lg:inline-flex">
            <li class="border-b-2 mb-1 lg:mx-3 lg:px-4 ">
                Home
            </li>
            <li class="border-b-2 mb-1 lg:mx-3 lg:px-4">
                Blog
            </li>
            <li class="border-b-2 mb-1 lg:mx-3 lg:px-4">
                Shop
            </li>
            <li class="border-b-2 mb-1 lg:mx-3 lg:px-4">
                Login
            </li>
        </ul>
      </transition>
  </nav>
</template>

<script>
export default {
  name: 'Nav',
  data(){
    return {
      isOpen: true
    }
  },
  mounted() {
    window.addEventListener('resize', () => {
      if(window.innerWidth > 1024) {
        this.isOpen = true
      } else {
        this.isOpen = false
      }
    })
  },
  methods: {
    enter (el) {
      el.style.height = 'auto';
      const height = getComputedStyle(el).height;
      el.style.height = 0;
      getComputedStyle(el);
      setTimeout(() => {
        el.style.height = height;
      });
    },
    afterEnter (el) {
      el.style.height = 'auto';
    },
    leave (el) {
      el.style.height = getComputedStyle(el).height;
      getComputedStyle(el);
      setTimeout(() => {
        el.style.height = 0;
      });
    }
  }

}
</script>

<style>
    .expand-enter-active, .expand-leave-active {
        transition: height .3s ease-in-out;
        overflow: hidden;
    }
</style>
