<template>
    <div class="my-4">
        <div class="">
            <p v-if="!posts.length">No Posts</p>
            <div class="card media border px-2 my-4" v-for="post in posts" :key="post.id">
                <img class="mr-3">
                <div class="media-body">
                    <div class="mt-3">
                        <a :href="post.user.profileLink">{{ post.user.name }}</a> | {{ post.createdDate }}
                        <p>{{ post.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        }
    },
    methods: {
        loadPostFromUsers() {
            axios.get('/posts').then((response => {
                this.posts = response.data;
            }));
        }
    },
    mounted() {

        this.loadPostFromUsers();

        Event.$on('added_post', (post) => {
            this.posts.unshift(post);
        });
    }
}
</script>