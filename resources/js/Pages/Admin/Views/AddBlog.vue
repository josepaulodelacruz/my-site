<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isUpdate ? 'Update' : 'Add'}} Blog
            </h2>
        </template>

        <div class="grid grid-cols-1 pt-6">
            <jet-form-section enctype="multipart/form-data">
                <template #title>
                    {{ isUpdate ? 'Update' : 'Add'}} Blog
                </template>
                <template #description>
                    Write any topics you want to discuss, share or explained.
                </template>
                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Blog Title"/>
                        <jet-input v-model="form.title" :value="form.title" id="title" type="text" class="mt-1 block w-full" />
                        <jet-input-error
                            :message="form.error('title')"
                        />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="Description" value="Blog Description" />
                        <jet-input v-model="form.description" id="description" type="text" class="mt-1 block w-full"/>
                        <jet-input-error :message="form.error('description')"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="Description" value="Tags" />
                        <select @change="handleChange" class="bg-gray-200 p-4 rounded-lg shadow">
                            <option v-for="(tag, index) in options"
                                    :key="index"
                                    :data-tag="tag.type"
                                    :value="tag.type">
                                {{ tag.type }}
                            </option>
                        </select>

                        <div class="flex w-3/4 py-4 ">
                            <ul class="flex flex-wrap items-center">
                                <li v-for="tag in selectedTags" class="flex mr-1 shadow mt-2 py-1 px-3 bg-blue-500 text-black rounded-full">
                                    <p class="text-white">
                                        {{ tag }}
                                    </p>
                                    <p @click="deleteTag(tag)" class="text-white pl-2 text-left text-sm">
                                        x
                                    </p>
                                </li>

                            </ul>
                        </div>

                    </div>

                </template>
                <template #actions>
                    <jet-action-message class="mr-3">
                        Saved.
                    </jet-action-message>

                    <button v-if="isUpdate" @click="updateBlog(blog)" class="bg-gray-500 p-2 rounded-lg text-white font-bold">
                        Update
                    </button>
                    <button v-else @click="submitBlog" class="bg-gray-500 p-2 rounded-lg text-white font-bold">
                        Add
                    </button>

                </template>
            </jet-form-section>

            <div class="lg:flex">
                <div class="flex-col flex-grow">
                    <jet-input-error :message="form.error('coverPhoto')"/>
                    <h2>Add Blog Cover Photo</h2>
                    <div v-if="!form.coverPhoto && !photo" class="flex justify-center items-center bg-white h-56 rounded-lg shadow">
                        <button class="bg-gray-200 h-24 w-24 flex items-center justify-center  rounded-full">
                            +
                        </button>
                    </div>
                    <input v-if="!form.coverPhoto" type="file" accept="image/*" id="file-input" @change="uploadPic($event)" class="bg-gray-200 h-24 w-24 flex items-center justify-center  rounded-full">
                    <img v-if="form.coverPhoto" :src="'/images/blogs/' + form.coverPhoto " alt="">
                    <img v-if="!form.coverPhoto" class="h-56 object-fill" :src="uploadedImage" alt="">
                    <img v-else class="h-56 object-fill" :src="uploadedImage" alt="">

                </div>

                <div class="flex-col lg:ml-6 flex-grow">
                    <h2>Body</h2>
                    <div class="w-full bg-white rounded-lg">
                        <VueTrix v-model="form.body"/>
                    </div>
                    <jet-input-error :message="form.error('body')"/>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import VueTrix from 'vue-trix'

export default {
  props: ['isUpdate', 'blog', 'tags'],
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    AdminLayout,
    VueTrix
  },
  data() {
    return {
      uploadedImage: null,
      photo: null,
      selectedTags: [],
      options: [],
      form: this.$inertia.form({
        'title': null,
        'description': null,
        'body': null,
        'coverPhoto': null,
        'tags': null,
      }, {
        bag: 'blogForm'
      })
    }
  },
  mounted() {

  },
  created() {
    if(this.isUpdate) {
      this.options = [{type: 'None'}]
      this.form.title = this.blog.title
      this.form.description = this.blog.description
      this.form.body = this.blog.body
      this.form.coverPhoto = this.blog.image
      this.tags.map((a) => {
          this.selectedTags.push(a.tag_type);
      });
    } else {
      this.options = [{type: 'None'}, ...this.tags];

    }
  },
  methods: {
    handleChange(e) {
        if('None' !== e.target.options[e.target.options.selectedIndex].dataset.tag) {
            this.selectedTags.push(e.target.options[e.target.options.selectedIndex].dataset.tag)
            this.options = this.options.filter(el => el.type != e.target.options[e.target.options.selectedIndex].dataset.tag)
        }
        // if(e.target.options.selectedIndex > -0) {
            // this.selectedTags.push(e.target.options[e.target.options.selectedIndex].dataset.tag)
            // this.options = this.options.filter(el => el.type != e.target.options[e.target.options.selectedIndex].dataset.tag)
        // }
    },
    deleteTag(tag) {
        this.selectedTags = this.selectedTags.filter(el => el != tag)
        this.options.push({type: tag})
    },
    submitBlog() {
        this.form.coverPhoto = this.photo
        this.form.tags = this.selectedTags;
        this.form.post(route("admin.blog.add"), {
          preserveScroll: true,
        });
    },
    updateBlog(blog) {
      blog._method = "PUT"
      blog.title = this.form.title
      blog.description = this.form.description
      blog.body = this.form.body
      blog.coverPhoto = blog.image
      this.$inertia.put(`/admin/blog/${blog.id}/update`, blog);
      // this.form.id = this.blog.id
      // this.form.put(`/admin/blog/${blog.id}/update`);
      // this.form.put(`/admin/blog/${blog.id}/update`);
    },
    uploadPic(event) {
      // Reference to the DOM input element
      var input = event.target;
      this.photo = input.files[0]
      this.form.coverPhoto = null
      // Ensure that you have a file before attempting to read it
      if (input.files && input.files[0]) {
        // create a new FileReader to read this image and convert to base64 format
        var reader = new FileReader();
        // Define a callback function to run, when FileReader finishes its job
        reader.onload = (e) => {
          // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
          // Read image as base64 and set to imageData
          this.uploadedImage = e.target.result;
        }
        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(input.files[0]);

      }
    },
  },

}
</script>
