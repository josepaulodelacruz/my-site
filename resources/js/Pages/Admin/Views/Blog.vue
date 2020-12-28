<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </template>
        <!-- Blog Section -->
        <div class="mx-auto py-8 justify-between h-56 px-10 lg:px-0 lg:flex ">
            <div class="flex bg-white justify-between shadow mr-5 rounded-lg w-full">
                <div class="flex p-6">
                    <h2 class="text-3xl">
                        Blogs
                    </h2>

                </div>
                <div class="flex flex-col items-center rounded-br-lg rounded-tr-lg justify-center flex-grow bg-blue-500">
                    <h2 class="text-white text-2xl">
                        Total Blogs:
                    </h2>
                    <h2 class="text-white text-2xl">
                        {{ blogs.length }}
                    </h2>
                </div>

            </div>
            <div class="bg-white shadow mr-5 rounded-lg w-full ">
                test
            </div>
            <div class="bg-white shadow rounded-lg w-full ">
                test
            </div>
        </div>


        <div class="grid grid-cols-1">
            <div class="inline-block px-10 lg:flex lg:px-0">
                <jet-input placeholder="Search Blog" type="text" class="mt-1 block w-full" ref="current_password" autocomplete="current-password" />
                <button class="float-right m-1 bg-blue-500 rounded-lg p-3 text-white font-bold">
                    Search
                </button>
            </div>

            <div class="flex w-full px-10 mt-3 mb-2 justify-between lg:px-0">
                <h2 class="text-3xl font-bold shadow-text-3xl text-color-black">Blog Posts</h2>
                <div class="flex justify-around">
                    <inertia-link :href="route('admin.blog.new')" class="float-right m-1 bg-green-500 rounded-lg p-1 text-white font-bold">
                        Add Blog
                    </inertia-link>
                    <button class="float-right m-1 bg-red-500 rounded-lg p-1 text-white font-bold">
                        Delete Blog
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap px-10 w-full justify-center mb-5 lg:justify-start lg:px-0">
                <BlogCard v-for="blog in blogs" :key="blog.id" :blog="blog"/>
            </div>

        </div>
        <!-- End of Blog Section-->

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetInput from '@/Jetstream/Input'
import BlogCard from '@/Components/BlocCard'
export default {
  props: ['blogs'],
  components: {
    AdminLayout,
    JetInput,
    BlogCard
  }
}

</script>
