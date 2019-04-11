<template>
	<div>
        <div class="row">
            <div class="col-md-10">
    	       <h1>"{{ wishlistName }}" Items</h1>
            </div>
            <div class="col-md-2">
                <router-link class="btn btn-primary" style="margin-top: 20px; float: right" :to="{ name: 'wishlist_items.add', params: { id: wishlistId } }">Add New</router-link>
            </div>
        </div>
        <div class="alert alert-success" v-if="success">Item Deleted Successfully!</div>
        <div v-if="!loading"> Loading ... </div>
        <div v-if="wishlistItems.length > 0 && loading">
    	    <table class="table table-bordered">
    	    	<thead>
    	    		<tr>
    	    			<th>Name</th>
    	    			<th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>URL</th>
    	    			<th>Actions</th>
    	    		</tr>            
    	    		<tr  v-if="wishlistItems.length > 0" v-for="item in wishlistItems">
    	    			<td>{{ item.name }}</td>
                        <td>{{ item.description.substr(0, 50) + '...' }}</td>
                        <td>{{ item.price }}</td>
                        <td><img :src="item.image" width="100" /></td>
                        <td>{{ item.url }}</td>
    	    			<td>
                            <router-link :to="{ name: 'wishlist_items.edit', params: { item: item.id, id: wishlistId } }">Edit</router-link> |
                            <a href="#" @click.prevent="deleteWishlist(item.id)">Delete</a>
                        </td>
    	    		</tr>
    	    	</thead>
    	    </table>
        </div>
        <div class="alert alert-info" v-else>
            No Items exist
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            wishlistName: null,
            wishlistId: null,
            wishlistItems: [],
            error: null,
            success: false
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            // Get Wishlist Name
            axios.get('/wishlists/' + this.$route.params.id)
                .then(response => {
                    this.wishlistName = response.data.name
                    this.wishlistId = response.data.id
                })
                .catch(error => {
                    this.error = error
                })
            // Get Wishlist Items
            axios.get('/wishlist_items/' + this.$route.params.id)
                .then(response => {
                    this.wishlistItems = response.data
                })
                .catch(error => {
                	this.error = error
                })
        },
        deleteWishlist(id) {
            if (confirm('Are you sure you want to delete this Wishlist?')) {
            axios.delete('wishlist_items/' + id)
            .then((response) => {
                console.log(response);
              if (response.status == 204) {
                this.success = true
                const indexToDelete = this.wishlistItems.findIndex(row => row.id == id)
                if (indexToDelete !== -1) {
                  this.wishlistItems.splice(indexToDelete, 1)
                }
              }
            })
            .catch((error) => {
              this.error = error
            })
          }
        }
    }
}
</script>