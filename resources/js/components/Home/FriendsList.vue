<template>
    <div class="col-md-3">
        <div class="container">
            <hr>
            <h3>Following</h3>
            <!-- Loop and display friends here -->
            <div v-if="!errors">
                <div v-for="follow in following" :key="follow.id">
                    <a :href="'/users/' + follow.id">{{ follow.name }}</a>
                </div>
            </div>
            <div v-else>
                Error loading following list.
            </div>
            <hr>
            <h3>My Groups</h3>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            following: {},
            errors: false,
        }
    },

    methods: {
        loadFollowingList() {
            axios.get('/api/following/1/all')
            .then(res => { 
                this.following = res.data;
            }).catch(err => {
                this.errors = true;
                console.log(err);
            });
        }
    },

    mounted() {
        this.loadFollowingList();
    }
}
</script>