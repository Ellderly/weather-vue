<template>
  <button class="location" >
    <div class="image">
      <img src="@/assets/location.svg" alt="location-image">
    </div>
    <div class="content">
      <p>Current Location</p>
      <h4 v-for="item in defaultCity" :key="item.city">{{item.city}}</h4>
    </div>
  </button>
</template>

<script>
import {ref} from "vue";

export default {
  props: {
    defaultCity:{
      type: Array,
      required: true
    }
  },
  setup(props, context) {

    return {}
  }
}
</script>

<style lang="scss" scoped>
.location{
  display: flex;
  width: max-content;
  align-items: center;
  border-radius: 20px;
  background: rgba(0, 0, 0, 0.2);
  padding: 15px 30px 15px 15px;
  cursor: pointer;
  border: none;
  z-index: 3;
  position: relative;
  .image{
    width: 48px;
    height: 48px;
    img{
      width: 100%;
    }
  }
  .content{
    color: #fff;
    text-align: left;

    p{
      margin: 0;
      font-size: 15px;
    }
    h4{
      margin: 5px;
      font-size: 18px;
    }
  }
}
</style>