<template>
    <div class="col-md-3">
        <div class="container">
            <div v-if="!errors && !isEmpty">
                    <div v-for="follow in followers" :key="follow.id">
                        <a :href="'/users/' + follow.id">{{ follow.name }}</a>
                    </div>
                </div>
                <div v-else-if="!errors && isEmpty">
                    No followers.
                </div>
                <div v-else>
                    Error loading followers.
                </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'userid',
    ],

    data() {
        return {
            errors: false,
            followers: {},
            isEmpty: false,
        }
    },

    methods: {
        loadFollowersData() {
            axios.get('/api/followers/' + this.userid + '/all')
            .then(res => { 
                this.followers = res.data;
            }).finally(() => {
                if (this.followers.length == 0) {
                    this.isEmpty = true;
                }
            }).catch(err => {
                this.errors = true;
                console.log(err);
            });
        }
    },

    mounted() {
        this.loadFollowersData();
    },
}
</script>
