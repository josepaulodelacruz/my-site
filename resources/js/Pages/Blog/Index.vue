<template>
    <div class="blog-container">
        <Nav/>
        <div class="blog-banner-container">

                <img :src="'/images/blogs/' + blog.image" class="h-full w-full object-contain" alt="">

        </div>

    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Nav from '@/Components/Nav'
export default {
  props: ['blog'],
  components: {
    AppLayout,
    Nav
  },
  mounted() {
    console.log(this.blog)
  }
}
</script>

<style scoped>
.blog-container {
    display: flex;
    background-color: #4a5568;
    flex-direction: column;
    width: 100vw;
    height: 100vh;
}

.blog-banner-container {
    display: flex;
    flex-direction: column;
    background-color: darkslateblue;
    height: 300px;
    justify-content: center;
    align-items: center;
}


</style>
