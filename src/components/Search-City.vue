<template>
  <div class="searchBlock">
    <div class="header">
      <div class="logo">
        WeatherEll
      </div>
      <div class="location-wrapper">
        <LocationChange :weathers="weathers" @favoritesItem="favoritesItem"/>
      </div>
    </div>
    <main class="main">
      <h1>Weather</h1>
      <div class="line"></div>
      <form  @submit.prevent="textProd"  class="form">
          <div class="wrapperInputSearch">
            <input type="text" name="search" v-model="searchLocationInput" class="searchLocationInput" :maxlength="20" id="searchLocation" placeholder="Enter city" required>
<!--            <label for="searchLocation"><img src="@/assets/search.svg" alt="search-image"></label>-->
          </div>
          <button @click.prevent="textProd" class="searchLocationBtn"></button>
      </form>
    </main>
  </div>
</template>

<script>

import LocationChange from "@/components/Location-Change.vue";
import {ref} from "vue";
export default {
  components: {LocationChange},

  props: {
    weathers:{
      type: Array,
      required: true
    },
  },
  setup(props, context) {
    const searchLocationInput = ref('')

    const textProd = () => {
      context.emit('textProd', searchLocationInput.value)
      searchLocationInput.value = ''
    }

    const favoritesItem = (item) => {
      context.emit('favoritesItem', item)
    }

    return {searchLocationInput, textProd, favoritesItem}
  }
}
</script>

<style lang="scss" scoped>

.searchBlock {
  max-width: 55%;
  width: 100%;
  height: 100vh;
  padding: 50px;
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
  background:
      linear-gradient(rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.9)),
      url('@/assets/bg-image.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;

  .header{
    display: flex;
    justify-content: space-between;
    .logo{
      color: #fff;
      font-weight: 500;
      font-size: 25px;
    }
    @media(max-width: 568px){
      flex-direction: column;
      align-items: center;
      gap: 25px
    }
  }
  .main{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    h1{
      color: #fff;
      margin: 0;
      text-align: center;
      font-size: 30px;
      font-weight: 500;
      cursor: default;
    }
    .line{
      height: 7px;
      width: 150px;
      background: #fff;
      border-radius: 100px;
      margin: 20px auto;
    }
    .form{
      display: flex;
      gap: 15px;
      align-items: center;
    .wrapperInputSearch{
      position: relative;
      width: 400px;
      .searchLocationInput{
        padding: 15px 50px 15px 20px;
        border-radius: 7px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.3);
        border: none;
        color: #fff;
        font-size: 14px;
        &::placeholder{
          color: #fff;
        }
      }
      label{
        position: absolute;
        top: 13px;
        right: 15px;
        cursor: pointer;
        img{
          width: 30px;
        }
      }
    }
      .searchLocationBtn{
        width: 35px;
        height: 35px;
        border: none;
        background-color: rgba(0, 0, 0, 0);
        background-image: url("@/assets/search.svg");
        background-repeat: no-repeat;
        background-position: center;
        cursor: pointer;
      }
      @media (max-width: 568px) {
        width: 85%;
        .wrapperInputSearch{
          width: 100%;
        }
      }
    }
  }
  @media(max-width: 1000px){
    max-width: 100%;
    border-top-right-radius: 0;
    border-bottom-right-radius: 20px;
    border-bottom-left-radius: 20px;
  }
}

</style>