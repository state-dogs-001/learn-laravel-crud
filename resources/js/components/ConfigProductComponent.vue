<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col my-2 my-sm-0">
                <h3>UPDATE PRODUCT</h3>
              </div>
              <div class="col my-2 my-sm-0 text-end">
                <a class="btn btn-light" href="/home">Back to home</a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form @submit.stop.prevent="updateClick">
              <div class="row">
                <div class="col-12 mt-2">
                  <label for="input_1">Product Name</label>
                  <input
                    type="text"
                    id="input_1"
                    v-model="productName"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col-12 mt-2">
                  <div class="row">
                    <div class="col-12">
                      <label for="input_2">Product Image URL</label>
                      <input
                        type="text"
                        id="input_2"
                        v-model="productImg"
                        class="form-control"
                        required
                      />
                    </div>
                    <div class="col-12 mt-2 text-center">
                      <img width="50%" id="imgPreview" />
                    </div>
                  </div>
                </div>
                <div class="col-12 mt-2">
                  <label for="input_3">Product Price</label>
                  <input
                    type="number"
                    id="input_3"
                    v-model="productPrice"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col-12 mt-2">
                  <label for="input_4">Product Description</label>
                  <textarea
                    id="input_4"
                    v-model="productDes"
                    rows="3"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col-12 mt-4 mb-2 text-center">
                  <button
                    type="reset"
                    @click="resetClick"
                    class="btn btn-danger me-2"
                  >
                    Cancel
                  </button>
                  <button class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    id: null,
    product: null,

    productName: null,
    productPrice: null,
    productImg: "",
    productDes: null,
  }),
  created() {
    this.getParamsId();
  },
  mounted() {
    this.getProduct();
  },
  updated() {
    let imgPreview = document.getElementById("imgPreview");
    let imgInput = document.getElementById("input_2");
    imgInput.addEventListener("keyup", () => {
      imgPreview.src = this.productImg;
    });
  },
  methods: {
    getParamsId() {
      const splitPath = window.location.search.split("?id=");
      this.id = splitPath[1];
    },
    getProduct() {
      axios
        .get(`/api/product/show-product/${this.id}`)
        .then((res) => {
          this.product = res.data;
        })
        .then(() => {
          this.productName = this.product.product_name;
          this.productImg = this.product.product_img;
          this.productPrice = this.product.product_price;
          this.productDes = this.product.product_description;

          // image preview
          let imgPreview = document.getElementById("imgPreview");
          imgPreview.src = this.productImg;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    resetClick() {
      let imgPreview = document.getElementById("imgPreview");
      imgPreview.src =
        "https://www.penworthy.com/Image/Getimage?id=C:RepositoriesCommonAbout%20UsSlide1.jpg";
    },
    updateClick() {
      axios
        .patch(`/api/product/update-product/${this.id}`, {
          product_name: this.productName,
          product_price: this.productPrice,
          product_img: this.productImg,
          product_description: this.productDes,
        })
        .then(() => {
          alert("Update successfully");
          window.location.replace("/home");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
