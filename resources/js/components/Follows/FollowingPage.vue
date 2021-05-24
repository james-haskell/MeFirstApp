<template>
    <div v-if="!errors && !isEmpty">
        <div v-for="follow in following" :key="follow.id">
            <a :href="'/users/' + follow.id">{{ follow.name }}</a>
        </div>
    </div>
    <div v-else-if="!errors && isEmpty">
        Not following anyone.
    </div>
    <div v-else>
        Error loading following list.
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
            following: {},
            isEmpty: false,
        }
    },

    methods: {
        loadFollowingData() {
            axios.get('/api/following/' + this.userid + '/all')
            .then(res => { 
                this.following = res.data;
            }).finally(() => {
                if (this.following.length == 0) {
                    this.isEmpty = true;
                }
            }).catch(err => {
                this.errors = true;
                console.log(err);
            });
        }
    },

    mounted() {
        this.loadFollowingData();
    },
}
</script>
