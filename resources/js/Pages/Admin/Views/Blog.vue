<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </template>
        <!-- Blog Section -->
        <div class="mx-auto py-8 justify-between h-56 px-10 lg:px-0 lg:flex ">
            <div class="bg-white shadow mr-5 rounded-lg w-full">
                test
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
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
                <BlogCard/>
            </div>

        </div>
        <!-- End of Blog Section-->

    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import BlogCard from '@/Components/BlocCard'
export default {
  components: {
    AdminLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    BlogCard
  }
}

</script>
