<template>
    <div class="container">
        <div class="d-flex flex-column align-items-center  card">
            Sidebar
            <div><a href="/">Home</a></div>
            <div><a :href="'/users/' + this.userid">My Profile</a></div>
            <div><a href="#">Settings</a></div>
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
        
    }, 
}
</script>