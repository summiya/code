<template>
	<div>
	    <h1>Share Wishlist</h1>
        <div class="alert alert-danger" v-if="error">Wishlist Already Shared with this User</div>
        <div class="alert alert-success" v-if="success">Wishlist Shared Successfully!</div>
        <div v-if="loading">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <b>Wishlist Name: </b> {{wishlist.name}}
            </div>
            <div class="form-group">
                <label for="users" style="vertical-align: top">Share with User: </label>
                <select id="users" v-model="wishlist.selectedUser">
                    <option v-for="user in wishlist.users" :value="user">{{user.name}}</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <router-link class="btn btn-default" :to="{ name: 'wishlists' }">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            success: false,
            wishlist: {
                name: '',
                selectedUser: null,
                users: null
            },
            error: null
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            // Get Wishlist
            axios.get('/wishlists/' + this.$route.params.id)
                .then(response => {
                    this.loading = false;
                    this.wishlist.name = response.data.name,
                    this.wishlist.id = this.$route.params.id,
                    this.wishlist.user_id = this.$auth.user().id
                })
                .catch(error => {
                	this.error = error
                })

            // Get all users
            axios.get('/users')
                .then(response => {
                    this.loading = false;
                    this.wishlist.users = response.data.users
                })
                .catch(error => {
                    this.error = error
                })
        },
        onSubmit(e) {
          axios.post('/share_wishlist/' + this.$route.params.id, this.wishlist)
                .then(response => {
                    this.success = true
                })
                .catch(error => {
                    this.error = error
                })  
        }

    }
}
</script>