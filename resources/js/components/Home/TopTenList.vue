<template>
    <div class="col-md-3">
        <div class="container">
            <hr>
            <h3>My Top Ten</h3>
            <!-- Loop and display friends here -->
            <div v-if="!errors && !(following.length === 0)">
                <div v-for="follow in following" :key="follow.id">
                    <a :href="'/users/' + follow.id">{{ follow.name }}</a>
                </div>
                <a :href="'/following/' + this.userid + '/all'">See everyone you follow...</a>
            </div>
            <div v-else-if="!errors && isEmpty">
                Not following anyone.
            </div>
            <div v-else>
                Error loading Top Ten list.
            </div>
            <hr>
            <h3>My Groups</h3> 
            <a :href="'/groups/' + this.userid + '/add'">Add Group</a>
            <form @submit.prevent="submit()">
                <input 
                    type="text"
                    name="groupId"
                    v-model="groupId"
                    placeholder="Group ID">
                    <button type="submit">Look for Group</button>
            </form>
            <div v-if="!isEmpty(formError)">
                <p>{{ formError.message }}</p>
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
            following: {},
            formError: {
                message: '',
            },
            groupId: '',
        }
    },

    methods: {
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },

        loadTopTenList() {
            axios.get('/api/following/' + this.userid + '/topTen')
            .then(res => { 
                this.following = res.data;
            }).catch(err => {
                this.errors = true;
                console.log(err);
            });
        },

        submit() {
            if (this.groupId === '') {
                this.formError.message = 'Please enter a group ID.';
            } else if (isNaN(this.groupId) || this.groupId <= 0) {
                this.formError.message = 'Invalid Group ID.';
            } else {
                window.location.href = '/groups/' + this.groupId;
            }
        },
    },

    mounted() {
        this.loadTopTenList();
    }
}
</script>