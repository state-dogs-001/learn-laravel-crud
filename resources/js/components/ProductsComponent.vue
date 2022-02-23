<template>
  <div>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <!-- Header -->
            <div class="card-header">
              <div class="row">
                <div class="col my-2 my-sm-0">
                  <h3>SHOW PRODUCTS</h3>
                </div>
                <div class="col text-end">
                  <a class="btn btn-success" href="/product/create"
                    >Add product</a
                  >
                </div>
              </div>
            </div>

            <!-- Body -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-secondary">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Description</th>
                      <th scope="col" colspan="2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in products" :key="product.product_name">
                      <td>{{ product.id }}</td>
                      <td width="150px">
                        <img
                          :src="product.product_img"
                          width="100%"
                          class="img-fluid"
                        />
                      </td>
                      <td>{{ product.product_name }}</td>
                      <td>{{ product.product_price }}</td>
                      <td>{{ product.product_description }}</td>
                      <td>
                        <button
                          @click="deleteClick(product.id)"
                          class="btn btn-danger"
                        >
                          Delete
                        </button>
                      </td>
                      <td>
                        <a
                          class="btn btn-primary"
                          :href="'/product/config/?id=' + product.id"
                          >Config</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    products: null,
  }),
  created() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get("http://localhost/api/product/products")
        .then((res) => {
          this.products = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteClick(id) {
      const response = confirm("Do you want to delete this product?");
      if (response == true) {
        axios
          .delete(`http://localhost/api/product/delete-product/${id}`)
          .then(() => {
            alert("Delete successfully");
            window.location.reload();
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
};
</script>

<style>
.card {
  min-height: 50vh;
}
</style>
