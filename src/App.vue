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
import {onMounted, ref, watch, reactive} from "vue";
import axios from "axios";
import Modal from "@/components/Modal.vue";

export default {
  components: {Modal, Location, SearchCity},
  setup() {
    const weathers = ref([]);
    const allWeathers = ref([])
    const isActiveModal = ref(false)
    let inActiveWeather = ref();
    let currentTime = null;
    const localStorageSities = ref([])
    const setLocalStorageSities = ref([])
    let countryAndCity = null
    let arrLocalCity = []


      const textProd = async (e) => {
        inActiveWeather.value = e
        console.log(inActiveWeather.value)
        console.log(weathers.value)
      try {
        weathers.value = []
        await axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${e}&days=4&aqi=no&alerts=no`)
            .then(e => weathers.value.push(e.data))
        currentTime = weathers.value.map(e => e.location.localtime.split(' ')[1]);
      } catch (e) {
        alert(e + " " + 'you entered the wrong name, try again in another language')
      }
    }

    onMounted(() => {
         navigator.geolocation.getCurrentPosition(position => {
          const latitude = position.coords.latitude
          const longitude = position.coords.longitude
          axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${latitude},${longitude}&days=4&aqi=no&alerts=no`)
              .then(e => weathers.value.push(e.data))
        }, error => {
           axios.get(
               'https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=Kiev&days=4&aqi=no&alerts=no')
               .then(e => weathers.value.push(e.data))
         })
      if(localStorage.getItem('arrLocalCity')){
        arrLocalCity.push(localStorage.getItem('arrLocalCity'));
        arrLocalCity = arrLocalCity.map(e => e.split(','))
        localStorageSities.value.push(localStorage.getItem('localStorageSities'))
        if (localStorageSities.value.find(e => e !== null)){
          localStorageSities.value[0].split(',').forEach(e => {
            if(e.length) {
              setLocalStorageSities.value.push(e)
            }
          })
        }
        const cityPromises = setLocalStorageSities.value.map(city => {
          if (city !== null && city !== "") {
            return axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${city}&days=4&aqi=no&alerts=no`)
                .then(response => response.data)
                .catch(error => console.log(error));
          }
        });
        Promise.all(cityPromises).then(results => {
          allWeathers.value = results;
        });
      }
// придумать решение задачи с localStorage. Обратиться с к chatGPT
    })

    const itemWeather = async (item, country) => {
         countryAndCity = `${item}, ${country}`
      weathers.value = []
      await axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${countryAndCity}&days=4&aqi=no&alerts=no`)
          .then(e => weathers.value.push(e.data))
          .catch(e => console.log(e))
    }

    const deleteItem = (item) => {
      allWeathers.value = allWeathers.value.filter(e => e.location.name !== item.location.name)
      arrLocalCity[0] = arrLocalCity[0].filter(e => e.includes(item.location.name))
      localStorageSities.value = localStorageSities.value[0].split(',')
      localStorageSities.value = localStorageSities.value.filter(e => e !== item.location.name)
      localStorageSities.value = localStorageSities.value.filter(e => console.log(e !== item.location.name))
      console.log(localStorageSities.value)
      localStorage.setItem('localStorageSities', localStorageSities.value)
      localStorage.setItem('arrLocalCity', arrLocalCity)
    }

    const favoritesItem = (item) => {
      inActiveWeather = []
      isActiveModal.value = true
      inActiveWeather = item

    }
    const  addThisWeather =  () => {
        if(!allWeathers.value.length || !arrLocalCity.includes(inActiveWeather)){
          arrLocalCity.push(inActiveWeather)
          localStorage.setItem('arrLocalCity', arrLocalCity)
          axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${inActiveWeather}&days=4&aqi=no&alerts=no`)
              .then(e => allWeathers.value.push(e.data))
              .catch(e => console.log(e))

          localStorageSities.value.push(inActiveWeather)
          localStorage.setItem('localStorageSities', localStorageSities.value)
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
      currentTime,
      localStorageSities,
      setLocalStorageSities,
      arrLocalCity,
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