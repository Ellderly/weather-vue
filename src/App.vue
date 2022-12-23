<template>
  <div class="container">
    <SearchCity
        :weathers="weathers"
        @textProd="textProd"
        @favoritesItem="favoritesItem"
    />
    <Location
        :allWeathers="allWeathers"
        :weathers="weathers"
        @itemWeather="itemWeather"
        @deleteItem="deleteItem"

    />
      <Modal
          v-model:showModal="isActiveModal"
          class="modal"
      >
        <button class="btn-false" @click.prevent="isActiveModal = false">No</button>
        <button class="btn-true" @click.prevent="addThisWeather">Yes</button>
      </Modal>
  </div>
</template>

<script>

import SearchCity from "@/components/Search-City.vue";
import Location from "@/components/Location.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import Modal from "@/components/Modal.vue";

export default {
  components: {Modal, Location, SearchCity},
  setup() {
    const weathers = ref([]);
    const allWeathers = ref([])
    const isActiveModal = ref(false)
    let inActiveWeather = ref();


      const textProd = async (e) => {
      try {
        weathers.value = []
        await axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${e}&days=4&aqi=no&alerts=no`)
            .then(e => weathers.value.push(e.data))
      } catch (e) {
        alert(e + " " + 'you entered the wrong name, try again in another language')
      }
    }

    onMounted(() => {
          // axios.get('https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=London&days=4&aqi=no&alerts=no')
          // .then(e => weathers.value.push(e.data))
         navigator.geolocation.getCurrentPosition(position => {
          const latitude = position.coords.latitude
          const longitude = position.coords.longitude
          axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${latitude},${longitude}&days=4&aqi=no&alerts=no`)
              .then(e => weathers.value.push(e.data))
        })
    })

    const itemWeather = async (item, country) => {
        const countryAndCity = `${item}, ${country}`
      weathers.value = []
      await axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${countryAndCity}&days=4&aqi=no&alerts=no`)
          .then(e => weathers.value.push(e.data))
          .catch(e => console.log(e))
    }

    const deleteItem = (item) => {
      allWeathers.value = allWeathers.value.filter(e => e[0].location.name !== item.location.name)
    }

    const favoritesItem = (item) => {
      inActiveWeather = []
      isActiveModal.value = true
      inActiveWeather = item

    }
    const addThisWeather = () => {
      let arrLocalCity = [];

        for(let i = 0; i < allWeathers.value.length; i++) {
          allWeathers.value[i].forEach(e => arrLocalCity.push(e.location.name))
        }

        if(!allWeathers.value.length || !arrLocalCity.includes(inActiveWeather)){
          allWeathers.value.push(weathers.value)
        }
      isActiveModal.value = false
    }
    return {
      weathers,
      itemWeather,
      deleteItem,
      textProd,
      allWeathers,
      favoritesItem,
      isActiveModal,
      addThisWeather,
    }
  }
}
</script>

<style lang="scss">

*{
  box-sizing: border-box;
  outline: none;

  font-family: Inter, Avenir, Helvetica, Arial, sans-serif;
  font-size: 16px;
  line-height: 24px;
  font-weight: 400;

  font-synthesis: none;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-text-size-adjust: 100%;
}

a {
  font-weight: 500;
  text-decoration: inherit;
}

body {
  margin: 0;
  padding: 0;
}
ul{
  list-style: none;
}

.container{
  display: flex;
  @media(max-width: 1000px){
    flex-direction: column;
  }
}
.modal{
  button{
    border: none;
    background: #afb5b9;
    font-size: 14px;
    padding: 3px 15px;
    cursor: pointer;
    transition: .2s ease-in-out;
    border-radius: 5px;
    &.btn-false:hover{
      background: #bd7777;
      color: #fff;
    }
    &.btn-true:hover{
      background: #77bd87;
      color: #fff;
    }
  }
}
</style>