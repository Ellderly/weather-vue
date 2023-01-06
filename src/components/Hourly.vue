<template>
  <div class="hourly">
    <h2>Hourly</h2>
    <div class="wrapper" v-for="item in weathers" :key="item">
     <div class="block">
       <div class="time">00:00</div>
       <img :src='item.forecast.forecastday[0].hour[0].condition.icon' alt="image">
       {{item.forecast.forecastday[0].hour[0].temp_c}}
     </div>
      <div class="block">
        <div class="time">01:00</div>
        <img :src='item.forecast.forecastday[0].hour[1].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[1].temp_c}}
      </div>
      <div class="block">
        <div class="time">02:00</div>
        <img :src='item.forecast.forecastday[0].hour[2].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[2].temp_c}}
      </div>
      <div class="block">
        <div class="time">03:00</div>
        <img :src='item.forecast.forecastday[0].hour[3].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[3].temp_c}}
      </div>
      <div class="block">
        <div class="time">04:00</div>
        <img :src='item.forecast.forecastday[0].hour[4].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[4].temp_c}}
      </div>
      <div class="block">
        <div class="time">05:00</div>
        <img :src='item.forecast.forecastday[0].hour[5].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[5].temp_c}}
      </div>
      <div class="block">
        <div class="time">06:00</div>
        <img :src='item.forecast.forecastday[0].hour[6].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[6].temp_c}}
      </div>
      <div class="block">
        <div class="time">07:00</div>
        <img :src='item.forecast.forecastday[0].hour[7].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[7].temp_c}}
      </div>
      <div class="block">
        <div class="time">08:00</div>
        <img :src='item.forecast.forecastday[0].hour[8].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[8].temp_c}}
      </div>
      <div class="block">
        <div class="time">09:00</div>
        <img :src='item.forecast.forecastday[0].hour[9].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[9].temp_c}}
      </div>
      <div class="block">
        <div class="time">10:00</div>
        <img :src='item.forecast.forecastday[0].hour[10].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[10].temp_c}}
      </div>
      <div class="block">
        <div class="time">11:00</div>
        <img :src='item.forecast.forecastday[0].hour[11].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[11].temp_c}}
      </div>
      <div class="block">
        <div class="time">12:00</div>
        <img :src='item.forecast.forecastday[0].hour[12].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[12].temp_c}}
      </div>
      <div class="block">
        <div class="time">13:00</div>
        <img :src='item.forecast.forecastday[0].hour[13].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[13].temp_c}}
      </div>
      <div class="block">
        <div class="time">14:00</div>
        <img :src='item.forecast.forecastday[0].hour[14].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[14].temp_c}}
      </div>
      <div class="block">
        <div class="time">15:00</div>
        <img :src='item.forecast.forecastday[0].hour[15].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[15].temp_c}}
      </div>
      <div class="block">
        <div class="time">16:00</div>
        <img :src='item.forecast.forecastday[0].hour[16].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[16].temp_c}}
      </div>
      <div class="block">
        <div class="time">17:00</div>
        <img :src='item.forecast.forecastday[0].hour[17].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[17].temp_c}}
      </div>
      <div class="block">
        <div class="time">18:00</div>
        <img :src='item.forecast.forecastday[0].hour[18].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[18].temp_c}}
      </div>
      <div class="block">
        <div class="time">19:00</div>
        <img :src='item.forecast.forecastday[0].hour[19].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[19].temp_c}}
      </div>
      <div class="block">
        <div class="time">20:00</div>
        <img :src='item.forecast.forecastday[0].hour[20].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[20].temp_c}}
      </div>
      <div class="block">
        <div class="time">21:00</div>
        <img :src='item.forecast.forecastday[0].hour[21].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[21].temp_c}}
      </div>
      <div class="block">
        <div class="time">22:00</div>
        <img :src='item.forecast.forecastday[0].hour[22].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[22].temp_c}}
      </div>
      <div class="block">
        <div class="time">23:00</div>
        <img :src='item.forecast.forecastday[0].hour[23].condition.icon' alt="image">
        {{item.forecast.forecastday[0].hour[23].temp_c}}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    weathers: {
      type: Array,
      required: true
    }
  },
  setup() {

    return {}
  }
}
</script>

<style lang="scss" scoped>
.wrapper{
  display: flex;
  margin-top: 20px;
  gap: 20px;
  flex-wrap: nowrap;
  overflow: scroll;
  .block{
    display: flex;
    flex-direction: column;
    align-items: center;
    img{
      width: 35px;
      height: 35px;
    }
  }
}
</style>