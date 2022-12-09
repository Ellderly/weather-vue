<template>
  <div>
    <h2>Today</h2>
    <div class="card-wrapper" v-for="item in defaultCity" :key="item">
      <div class="card">
        <div class="card__left-content">
          <div class="card__temp">Max {{item.daily.temperature_2m_max[0]}}<sup>o</sup></div>
          <div class="card__temp">Min {{item.daily.temperature_2m_min[0]}}<sup>o</sup></div>
          <div class="card__date">{{item.daily.time[0]}}</div>
        </div>
        <div class="card__right-content">
          <ul>
            <li>latitude: {{item.latitude}}</li>
            <li>longitude {{item.longitude}}</li>
            <li>elevation: {{item.elevation}}</li>
            <li>city: {{item.city}}</li>
          </ul>
        </div>
      </div>
            <div class="other-card">
              <h2>Daily</h2>
              <div class="wrapper">
                <div class="other-card-block">
                    <div class="card__temp">Max {{item.daily.temperature_2m_max[1]}}<sup>o</sup></div>
                    <div class="card__temp">Min {{item.daily.temperature_2m_min[1]}}<sup>o</sup></div>
                    <div class="card__date">{{item.daily.time[1]}}</div>
                </div>
                <div class="other-card-block">
                    <div class="card__temp">Max {{item.daily.temperature_2m_max[2]}}<sup>o</sup></div>
                    <div class="card__temp">Min {{item.daily.temperature_2m_min[2]}}<sup>o</sup></div>
                    <div class="card__date">{{item.daily.time[2]}}</div>
                </div>
              </div>
              </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    defaultCity: {
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
h2{
  font-size: 45px;
  margin: 30px 0 0;
}
.card{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  border-radius: 10px;
  box-shadow: 0 0 50px rgba(145, 145, 145, 0.4);
  margin: 60px 0 0 0;
  max-width: 80%;
  padding: 30px;
  .card__left-content{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-right: 1px solid gray;
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
}
.other-card{
  margin: 50px 0 0 0;
  h2{
    margin: 0 0 30px 0 ;
  }
  .wrapper{
    display: flex;
    gap: 25px;
    .other-card-block{
      background: none;
      cursor: default;
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 50px rgba(145, 145, 145, 0.4);
      margin: 60px 0 0 0;
      padding: 20px;
      width: max-content;
      .card__temp{
        font-size: 20px;
        font-weight: 600;
      }
      .card__date{
        margin-top: 15px;
      }
    }
  }
}
</style>