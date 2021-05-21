<template>
    <div class="container pr-1">
        <div class="d-flex flex-column align-items-center">
            <hr>
            Sidebar
            <div><a href="/">Home</a></div>
            <div><a href="/posts">Posts</a></div>
            <div>
                <a :href="'/followers/' + this.userid + '/all'">My Followers</a>
                <span v-if="!errors">{{ followerCount }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        "userid",
    ],

    data() {
        return {
            errors: false,
            followerCount: 0,
        }
    },

    methods: {
        getFollowerCount() {
            axios.get('/api/followers/' + this.userid + '/all')
            .then(res => {
                this.followerCount = res.data.length;
            }).catch(err => {
                this.errors = true;
                console.log(err);
            })
        }
    },

    mounted() {
        this.getFollowerCount();
    },
}
</script>