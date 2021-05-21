<template>
    <div v-if="isEmpty(errors)">
        Group ID: {{ groupData.id }}
        Group Name: {{ groupData.groupName }}
        Group Owner: {{ groupData.owner_id }}
        <div v-for="member in groupMembers" :key="member.id">
            <a :href="'/users/' + member.id">{{ member.name }}</a>
        </div>

        <button @click="joinGroup()">Join Group</button>
        <button @click="leaveGroup()">Leave Group</button>
        <div v-if="!isEmpty(errorNotification)">
            <p>{{ errorNotification.message }}</p>
        </div>
    </div>
    <div v-else>
        {{ errors }}
    </div>
</template>

<script>
export default {
    props: [
        'groupId',
        'userId'
    ],
    
    data() {
        return {
            errors: {},
            errorNotification: {
                message: '',
            },
            groupData: {},
            groupMembers: [],
        }
    },

    created() {
        this.getGroupData();
    },

    mounted() {
        
    },

    methods: {
        getGroupData() {
            axios.get('/api/groups/lfg?groupId=' + this.groupId
            ).then(res => {
                if (!res.data.error) {
                    this.groupData = res.data;
                    this.getMemberNames();
                } else {
                    this.errors = res.data.error;
                }
            }).catch(err => {
                console.log(err);
            })
        },

        getMemberNames() {
            for (let i = 0; i < this.groupData.member_ids.length; i++) {
                this.groupMembers.push({
                    id: this.groupData.member_ids[i],
                    name: this.groupData.member_names[i]
                });
            }
        },

        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },

        joinGroup() {
            axios.put('/api/groups/join', {
                userId: this.userId,
                groupId: this.groupId
            }).then(res => {
                window.location.reload();
            }).catch(err => {
                //TODO: add notification alert that user is already joined
                this.errorNotification.message = 'You are already in this group.';
                console.log(err);
            });
        },

        leaveGroup() {
            axios.put('/api/groups/leave', {
                userId: this.userId,
                groupId: this.groupId
            }).then(() => {
                window.location.reload();
            }).catch(err => {
                //TODO: add notification alert that user is not joined
                this.errorNotification.message = 'You are not in this group.';
                console.log(err);
            });
        }
    },
}
</script>