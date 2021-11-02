<template>
    <div class="container">
        <div class="d-flex flex-column align-items-center card">
            <!-- Top Ten List -->
            <h3 class="mt-2">My Top Ten</h3>
            <div v-if="!errors && !(following.length === 0)">
                <div class="d-flex flex-column justify-content-center align-items-center" v-for="follow in following" :key="follow.id">
                    <a :href="'/users/' + follow.id">{{ follow.name }}</a>
                </div>
                <a :href="'/following/' + this.userid + '/all'">See everyone you follow...</a>
            </div>
            <div v-else-if="!errors && following.length === 0">
                Not following anyone.
            </div>
            <div v-else>
                Error loading Top Ten list.
            </div>

            <!-- My Followers -->
            <div>
                <a :href="'/followers/' + this.userid + '/all'">My Followers</a>:
                <span v-if="!errors">{{ followerCount }}</span>
            </div>

            <hr class="w-75">

            <!-- My Groups -->
            <h3>My Groups</h3> 
            <button @click="showAddForm">Add Group</button>
            <form class="d-flex flex-row align-items-center" @submit.prevent="submit()">
                    <input 
                        class="w-50 m-2"
                        type="text"
                        name="groupId"
                        v-model="groupId"
                        placeholder="Group ID">
                    <button class="m-2" type="submit">Look for Group</button>
            </form>
            <span v-if="!isEmpty(formError)">{{ formError.message }}</span>
            <div v-if="!errors && !(myGroups.length === 0)">
                <div class="d-flex flex-column align-items-center" v-for="group in myGroups" :key="group.id">
                    <a :href="'/groups/' + group.id">{{ group.groupName }}</a>
                </div>
            </div>
            <div v-else-if="!errors && myGroups.length === 0">
                Not in any groups.
            </div>
            <div v-else>
                Error loading My Groups.
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
            followerCount: 0,
            following: {},
            formError: {
                message: '',
            },
            groupId: '',
            myGroups: {},
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
        },

        checkIfGroupExists() {
            axios.get('/api/groups/lfg?groupId=' + this.groupId
            ).then(res => {
                if (!res.data.error) {
                    window.location.href = '/groups/' + this.groupId;  
                } else {
                    this.formError.message = res.data.error;
                }
            }).catch(err => {
                console.log(err);
            })
        },

        initialize() {
            this.loadTopTenList();
            this.loadMyGroups();
            this.getFollowerCount();
        },

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

        loadMyGroups() {
            axios.get('/api/groups/mygroups/' + this.userid
            ).then(res => { 
                this.myGroups = res.data
                console.log(this.myGroups);
            }).catch(err => {
                this.errors = true;
                console.log(err);
            });
        },

        showAddForm() {
            if (this.userid) {
                window.location = '/groups/add?id=' + this.userid;
            }
        },

        submit() {
            if (this.groupId === '') {
                this.formError.message = 'Please enter a group ID.';
            } else if (isNaN(this.groupId) || this.groupId <= 0) {
                this.formError.message = 'Invalid Group ID.';
            } else {
                this.checkIfGroupExists();
            }
        },
    },

    mounted() {
        this.initialize();
    }
}
</script>