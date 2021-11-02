<template>
    <div class="container">
        <!-- Include follow buttons and don't show personal features if not the current user -->
        <div v-if="isNot">I am not this user.
            <div v-if="isFollowing">
                <a :href="unfollowRoute" class="btn btn-danger">Unfollow</a>
            </div>
            <div v-else>
                <a :href="followRoute" class="btn btn-success">Follow</a>
            </div>
        </div>
        <div v-else>
            <div>
                <img class="ml-2" style="height: 55px; width: 55px;" src="">
                {{ user.name }}
            </div>
        </div>
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