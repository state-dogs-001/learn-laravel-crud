<template>
  <div class="welcome-page">
    <div class="container">
      <!-- Carousel -->
      <div
        id="carouselExampleControls"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="https://cdn.pixabay.com/photo/2016/12/09/11/33/smartphone-1894723_960_720.jpg"
              class="d-block w-100"
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://cdn.pixabay.com/photo/2015/05/31/15/07/coffee-792113_960_720.jpg"
              class="d-block w-100"
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://cdn.pixabay.com/photo/2017/10/12/22/17/business-2846221_960_720.jpg"
              class="d-block w-100"
            />
          </div>
        </div>
        <!-- Previous page btn -->
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleControls"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <!-- Next page btn -->
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleControls"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Card show some product -->
      <div class="card mt-5 mb-3">
        <!-- Card header -->
        <div class="card-header">Welcome to my class laravel CRUD</div>
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-sm-12 my-3 d-flex justify-content-center" v-for="product in someProducts" :key="product.id">
              <div class="card" style="width: 18rem; border: none">
                <img :src="product.product_img" class="card-img-top" style="width: 50%" />
                <div class="card-body">
                  <h5 class="card-title">{{ product.product_name }}</h5>
                  <p class="card-text">
                    {{ product.product_description }}
                  </p>
                  <a href="/home" class="btn btn-primary">Go CRUD</a>
                </div>
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
    // Get some products
    someProducts: null,
  }),
  created() {
    // Use getSomeProducts function when created page
    this.getSomeProducts();
  },
  methods: {
    // Get some products function
    getSomeProducts() {
      axios
        .get("/api/product/some-products")
        .then((res) => {
          this.someProducts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
.welcome-page .container {
  max-width: 55rem;
}
.carousel-item img {
  max-height: 20rem;
}
</style>