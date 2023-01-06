<template>
  <div v-if="weathers.length">
    <h2>Today</h2>
    <div class="card-wrapper" v-for="item in weathers" :key="item">
      <div class="card">
        <div class="card__left-content">
          <div class="card__temp">Max {{item.forecast.forecastday[0].day.maxtemp_c}}<sup>o</sup></div>
          <div class="card__temp">Min {{item.forecast.forecastday[0].day.mintemp_c}}<sup>o</sup></div>
          <div class="card__date">{{item.forecast.forecastday[0].date}}</div>
        </div>
        <div class="card__right-content">
          <ul>
            <li>rainfall: {{item.forecast.forecastday[0].day.daily_chance_of_rain}}%</li>
            <li>snowfall: {{item.forecast.forecastday[0].day.daily_chance_of_snow}}%</li>
            <li>wind-speed: {{item.forecast.forecastday[0].day.maxwind_kph}}</li>
            <li>city: {{item.location.name}}</li>
          </ul>
        </div>
      </div>
       <div class="more__weather">
         <div class="other-card daily">
           <h2>Daily</h2>
           <div class="wrapper">
             <div class="other-card-block">
               <div class="card__temp">Max {{item.forecast.forecastday[1].day.maxtemp_c}}<sup>o</sup></div>
               <div class="card__temp">Min {{item.forecast.forecastday[1].day.mintemp_c}}<sup>o</sup></div>
               <div class="card__date">{{item.forecast.forecastday[1].date}}</div>
             </div>
             <div class="other-card-block">
               <div class="card__temp">Max {{item.forecast.forecastday[2].day.maxtemp_c}}<sup>o</sup></div>
               <div class="card__temp">Min {{item.forecast.forecastday[2].day.mintemp_c}}<sup>o</sup></div>
               <div class="card__date">{{item.forecast.forecastday[2].date}}</div>
             </div>
           </div>
         </div>
         <Hourly :weathers="weathers"></Hourly>
       </div>
    </div>
  </div>
</template>

<script>
import Hourly from "@/components/Hourly.vue"

export default {
  components: {Hourly},
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
<style lang="scss" >
h2{
  font-size: 40px;
  margin: 30px 0 0;
}
.card{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  border-radius: 10px;
  box-shadow: 0 0 50px rgba(145, 145, 145, 0.4);
  margin: 30px 0 0 0;
  max-width: 80%;
  padding: 25px;
  .card__left-content{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-right: 1px solid gray;
    margin-right: 5px;
    .card__temp{
      font-size: 20px;
      font-weight: 600;
    }
    .card__weather{
      font-size: 40px;
      margin: 25px 0 15px;
    }
  }
  .card__right-content{
    ul{
      padding: 0;
      margin: 0;
    }
  }
  @media (max-width: 568px) {
    max-width: 365px;
    width: auto;
  }
  @media(max-width: 400px){
    padding: 15px;
    .card__left-content{
      .card__temp{
        font-size: 15px;
      }
      .card__date{
        font-size: 12px;
      }
    }
    .card__right-content ul li{
      font-size: 12px;
    }
  }
}
.other-card{
  margin: 35px 0 0 0;
  h2{
    margin: 0 0 30px 0 ;
  }
  .wrapper{
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    .other-card-block{
      background: none;
      cursor: default;
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 50px rgba(145, 145, 145, 0.4);
      margin:0 0 0 0;
      padding: 20px;
      width: max-content;
      flex: 0 0 auto;
      .card__temp{
        font-size: 20px;
        font-weight: 600;
      }
      .card__date{
        margin-top: 15px;
      }
    }
  }
  @media (max-width: 400px) {
    .wrapper{
      justify-content: center;
      .other-card-block{
        margin: 20px 0 0 0;
      }
    }
  }
}
</style>