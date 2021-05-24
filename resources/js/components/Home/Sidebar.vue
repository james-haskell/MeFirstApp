<template>
    <div class="container card">
        <div class="d-flex flex-column align-items-center">
            Sidebar
            <div><a href="/">Home</a></div>
            <div><a href="/posts">Posts</a></div>
            <div class="d-flex flex-column align-items-center">
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

    created() {
        this.getFollowerCount();
    },

    mounted() {
        
    },

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
}
</script>

<style scoped>
    .card {
        padding: 5px;
    }
</style>