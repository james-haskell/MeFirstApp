<template>
    <div class="col-md-3">
        <div class="container">
            <hr>
            <h3>My Top Ten</h3>
            <!-- Loop and display friends here -->
            <div v-if="!errors && !isEmpty">
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
            <div v-if="formError !== ''">
                <p>{{ formError }}</p>
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
            formError: '',
            groupId: '',
            isEmpty: false,
        }
    },

    methods: {
        loadTopTenList() {
            axios.get('/api/following/' + this.userid + '/topTen')
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
        },

        submit() {
            if (this.groupId === '') {
                this.formError = 'Please enter a group ID.'
            } else if (isNaN(this.groupId) || this.groupId <= 0) {
                this.formError = 'Must be a positive whole number.';
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