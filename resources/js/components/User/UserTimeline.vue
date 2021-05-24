<template>
    <div class="container">
        <div v-if="isNot">I am not this user.
            <div v-if="isFollowing">
                <a :href="unfollowRoute" class="btn btn-danger">Unfollow</a>
            </div>
            <div v-else>
                <a :href="followRoute" class="btn btn-success">Follow</a>
            </div>
        </div>
        <div v-else>I AM the user.</div>
        <p>{{ user }}</p>
    </div>
</template>

<script>
    export default {
        props: [
            'followRoute',
            'isFollowing',
            'isNot',
            'unfollowRoute',
            'user',
        ],

        data() {
            return {

            }
        },

        methods: {

        },
    }
</script>