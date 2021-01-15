<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>
        <div class="mx-auto py-8 justify-between h-56 px-10 lg:px-0 lg:flex ">
            <div class="flex bg-white justify-between shadow mr-5 rounded-lg w-full">
                <div class="flex p-6">
                    <h2 class="text-3xl">
                        Blogs
                    </h2>

                </div>
                <div class="flex flex-col items-center rounded-br-lg rounded-tr-lg justify-center flex-grow bg-blue-500">
                    <h2 class="text-white text-2xl">
                        test
                    </h2>
                    <h2 class="text-white text-2xl">
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
                <jet-input placeholder="Search Projects" type="text" class="mt-1 block w-full" ref="current_password" autocomplete="current-password" />
                <button class="float-right m-1 bg-blue-500 rounded-lg p-3 text-white font-bold">
                    Search
                </button>
            </div>

            <div class="flex justify-end py-6">
                <inertia-link :href="route('admin.projects.new')" class="p-4 bg-blue-500 rounded-lg font-bold text-white">Add Projects</inertia-link>
            </div>

            <table class="bg-white mt-5 rounded-lg p-6 shadow-lg table-auto w-full">
                <thead class="border">
                    <tr>
                        <th class="border text-left px-2">No.</th>
                        <th class="border text-left p-4">Name</th>
                        <th class="border text-left p-4">Created At</th>
                        <th class="border text-left p-4">Github Repo</th>
                        <th class="border text-left p-4">URL</th>
                        <th class="border text-left p-4">Images</th>
                        <th class="border text-left p-4">Tags</th>
                        <th class="border text-left p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr @clicl="viewProject" v-for="(project, index) in projects">
                        <td class="border text-left px-2">{{ index + 1 }}</td>
                        <td class="border text-left px-2">{{ project.title }}</td>
                        <td class="border text-left px-2 text-xs">{{ convertDate(project.created_at) }}</td>
                        <td class="border text-left px-2">{{ project.repository }}</td>
                        <td class="border text-left px-2">{{ project.website }}</td>
                        <td class="border text-left px-2" @click="navToImages(project)">
                            Images

                        </td>
                        <td class="border text-left px-2">
                            <div class="flex flex-wrap justify-center py-1">
                                <span v-for="(tag, index) in project.tags" class="bg-blue-400 text-xs text-white rounded-lg p-1 m-1">{{ tag.tag_type }}</span>
                            </div>
                        </td>
                        <td class="flex border text-left px-2">
                            <button @click="deleteProject(project)" class="bg-red-500 rounded-lg m-1 p-2 text-white text-xs font-bold">
                                Delete
                            </button>
                            <inertia-link :href="route('admin.projects.update', project)" class="bg-teal-500 rounded-lg m-1 p-2 text-white text-xs font-bold">
                                Update
                            </inertia-link>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetInput from '@/Jetstream/Input'
import moment from "moment";
export default {
    props: [
        'projects',
    ],
    components: {
      AdminLayout,
      JetInput,
    },
    mounted() {
      console.log(this.projects);
    },
    methods: {
         viewProject() {

         },
         deleteProject(project) {
             project._method = "DELETE"
             this.$inertia.post(`/admin/projects/${project.id}/delete`, project)
         },
         convertDate(date) {
            return moment(date).format('MMMM Do YYYY')
        },
        navToImages(project) {
           this.$inertia.visit(route('admin.images', project));
        }
    },
}

</script>
