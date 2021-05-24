require('./bootstrap');

window.Vue = require('vue').default;

//Global Components


// Home Components (Timeline, FriendsList, etc...)
Vue.component('home-sidebar', require('./components/Home/Sidebar.vue').default);
Vue.component('home-timeline', require('./components/Home/Timeline.vue').default);
Vue.component('friends-posts', require('./components/Home/FriendsPosts.vue').default);
Vue.component('topten-list', require('./components/Home/TopTenList.vue').default);

Vue.component('followers-page', require('./components/Follows/FollowersPage.vue').default);
Vue.component('following-page', require('./components/Follows/FollowingPage.vue').default);

Vue.component('add-group-form', require('./components/Groups/AddGroupForm.vue').default);
Vue.component('group-page', require('./components/Groups/GroupPage.vue').default);

//User Profile Components
Vue.component('user-timeline', require('./components/User/UserTimeline.vue').default);

// Vue Events
let Event = new Vue();
window.Event = Event;

// App
const app = new Vue({
    el: '#app',
});
