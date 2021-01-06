<template>
    <nav
        class="w-full sm:inline-block py-6 z-10 lg:inline-flex"
        :class="[scrollPosition > 0 ? 'bg-white shadow fixed' : 'bg-opacity absolute']">
        <!--      :class="mobile ? [scrollPosition > 0 ? 'bg-white shadow fixed' : 'bg-opacity absolute'] : ['bg-white fixed shadow']">-->
        <div class="lg:flex items-center justify-between flex-grow max-w-6xl mx-auto px-12 lg:px-32">
            <ul class="flex w-full items-center justify-between">
                <li 
                    class="font-bold text-3x1"
                    :class="scrollPosition > 0 ? 'text-black': 'text-white'">
                    Blogs
                </li>
                <div class="block lg:hidden">
                    <button @click="isOpen = !isOpen"
                            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 ">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
            </ul>
            <transition
                name="expand"
                @enter="enter"
                @after-enter="afterEnter"
                @leave="leave">
                <ul v-show="isOpen" class="lg:inline-flex items-center">
                    <li>
                        <a 
                        :class="scrollPosition > 0 ? 'text-black': 'text-white'" 
                        class="my-1 text-sm  font-medium hover:text-indigo-500 md:mx-4 md:my-0" href="#">Home</a></li>
                    <li>
                        <a 
                        :class="scrollPosition > 0 ? 'text-black': 'text-white'" 
                        class="my-1 text-sm font-medium hover:text-indigo-500 md:mx-4 md:my-0" href="#">Shop</a></li>
                    <li>
                        <a   
                        :class="scrollPosition > 0 ? 'text-black': 'text-white'" 
                        class="my-1 text-sm  font-medium hover:text-indigo-500 md:mx-4 md:my-0" href="#">Contact</a></li>
                    <li>
                        <a 
                        :class="scrollPosition > 0 ? 'text-black': 'text-white'" 
                        class="my-1 text-sm font-medium hover:text-indigo-500 md:mx-4 md:my-0" href="#">About</a></li>
                </ul>
            </transition>
        </div>
    </nav>
</template>

<script>
export default {
  name: 'Nav',
  data(){
    return {
      isOpen: true,
      scrollPosition: null,
      mobile: null,
    }
  },
  mounted() {
    window.addEventListener('resize', () => {
      if(window.innerWidth > 1024) {
        this.isOpen = true
        this.mobile = true;
      } else {
        this.isOpen = false
        this.mobile = false;
      }
    })
    window.addEventListener('scroll', this.updateScroll);
  },
  methods: {
    updateScroll() {
      this.scrollPosition = window.scrollY
    },
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
