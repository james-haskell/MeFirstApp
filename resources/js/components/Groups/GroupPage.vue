<template>
    <div v-if="!errors">
        Group ID: {{ groupData.id }}
        Group Name: {{ groupData.groupName }}
        Group Owner: {{ groupData.owner_id }}
        <div v-for="member in groupMembers" :key="member.id">
            <a :href="'/users/' + member.id">{{ member.name }}</a>
        </div>

        <button @click="joinGroup()">Join Group</button>
        <button @click="leaveGroup()">Leave Group</button>
    </div>
    <div v-else>
        No group exists with ID of {{ groupId }}
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
            errors: false,
            groupData: {},
            groupMembers: [],
        }
    },

    methods: {
        getGroupData() {
            axios.get('/api/groups/lfg?groupId=' + this.groupId
            ).then(res => {
                if (!res.data.error) {
                    this.groupData = res.data;
                    this.getMemberNames();
                } else {
                    this.errors = true;
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

        joinGroup() {
            axios.put('/api/groups/' + this.groupData.id + '/join', {
                userId: this.userId
            }).then(res => {
                window.location.reload();
            }).catch(err => {
                //TODO: add notification alert that user is already joined
                console.log(err);
            });
        },

        leaveGroup() {
            axios.put('/api/groups/' + this.groupData.id + '/leave', {
                userId: this.userId
            }
            ).then(() => {
                window.location.reload();
            }).catch(err => {
                //TODO: add notification alert that user is not joined
                console.log(err);
            });
        }
    },

    mounted() {
        this.getGroupData();
    }
}
</script>