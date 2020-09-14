<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">

    <vx-card ref="filterCard" class="user-list-filters mb-8">
      <div class="vx-row">
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Tipo de ayuda</label>
          <v-select :reduce="label => label.key" :options="supportOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="supportFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Región</label>
          <v-select :reduce="label => label.key" :options="regionOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="regionFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Comuna</label>
          <v-select :reduce="label => label.key" :options="updateCommuneOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="communeFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Beneficiario</label>
          <v-select :reduce="label => label.key" :options="beneficiarieOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="beneficiarieFilter" class="mb-4 md:mb-0" />
        </div>
      </div>
    </vx-card>

    <vs-table ref="table" v-model="selected" pagination :max-items="itemsPerPage" search :data="events">

      <template slot="thead">
        <vs-th sort-key="name">Nombre de la Organización</vs-th>
        <vs-th sort-key="support.categories">Tipo de Ayuda</vs-th>
        <vs-th sort-key="description">Descripción</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.name }}</p>
              </vs-td>

              <vs-td>
                <div class="demo-aligment" :data="value" :key="index" v-for="(value, index) in tr.support.categories">
                  <vs-chip :color="getPopularityColor(value.pivot.category_id % 10)">
                    <span>{{ value.name }}</span>
                  </vs-chip>
                </div>
              </vs-td>

              <vs-td>
                <p class="product-category">{{ tr.support.description }}</p>
              </vs-td>

              <!-- Descripción de EVENTO -->

              <template v-if="tr.initiative == 1" class="expand-user" slot="expand">

                <div class="con-expand-users w-full">
                  <div class="con-btns-user flex items-center justify-between">
                      <div class="con-userx flex items-center justify-start">
                          <h4>{{ tr.name }}</h4>
                      </div>
                      <div class="flex">
                          <a v-if="tr.contact.web" :href="'http://' + tr.contact.web" class="mr-2">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-chrome"></vs-button>
                          </a>
                          <a v-if="tr.contact.facebook" :href="'http://facebook.com/'+tr.contact.facebook" class="mr-2">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-facebook"></vs-button>
                          </a>
                          <a v-if="tr.contact.instagram" :href="'http://instagram.com/'+tr.contact.instagram" class="mr-2">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-instagram"></vs-button>
                          </a>    
                          <a v-if="tr.contact.twitter" :href="'http://twitter.com/'+tr.contact.twitter">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-twitter"></vs-button>
                          </a>
                      </div>
                  </div>

                  <!-- Descripción -->
                  <div v-if="tr.support.description" class="user-bio mt-5">
                      <h6>Descripción:</h6>
                      <p>{{ tr.support.description }}</p>
                      <vs-divider color="primary" />
                  </div>
                  
                  <!-- Beneficiarios -->
                  <div class="user-bio mt-5">
                      <h6>Beneficiarios:</h6>
                      <p :data="value" :key="index" v-for="(value, index) in tr.support.beneficiaries" >{{ value.name  }}</p>
                      <vs-divider color="primary" />
                  </div>

                  <!-- Direccion -->
                  <div v-if="tr.direction.number" class="mt-5">
                      <h6>Dirección:</h6>
                      <p>{{ tr.direction.street + ' ' + tr.direction.number + ', ' + tr.direction.commune.name + ', ' + tr.direction.region.name}}</p>
                  </div>
                  <div v-else-if="tr.direction.street" class="mt-5">
                      <h6>Dirección:</h6>
                      <p>{{ tr.direction.street + ', ' + tr.direction.commune.name + ', ' + tr.direction.region.name}}</p>
                  </div>
                  <div v-else class="mt-5">
                      <h6>Dirección:</h6>
                      <p>{{ tr.direction.commune.name + ', ' + tr.direction.region.name}}</p>
                  </div>
                  <div v-if="tr.direction.district" class="mt-3">
                      <h6>Distrito:</h6>
                      <p>{{ tr.direction.district }}</p>
                  </div>
                  <div v-if="tr.direction.detail" class="mt-3">
                      <h6>Detalle</h6>
                      <p>{{ tr.direction.detail }}</p>
                  </div>
                  <vs-divider color="primary" />

                  <!-- Calendario 
                  <div id="simple-calendar-app">
                    <div class="no-scroll-content">
                      <calendar-view
                        ref="calendar"
                        displayPeriodUom="week"
                        :show-date="showDate"
                        :eventTop="windowWidth <= 400 ? '2rem' : '3rem'"
                        eventBorderHeight="0px"
                        eventContentHeight="1.65rem"
                        class="theme-default"/>
                    </div>
                  </div> -->
                  
                  <!-- Contacto -->
                  <div v-if="tr.contact.email" class="mt-5">
                      <h6>Correo:</h6>
                      <p>{{ tr.contact.email }}</p>
                  </div>
                  <div v-if="tr.contact.web" class="mt-3">
                      <h6>Sitio web:</h6>
                      <p>{{ tr.contact.web }}</p>
                  </div>
                  <div v-if="tr.contact.phone" class="mt-3">
                      <h6>Teléfono:</h6>
                      <p>{{ tr.contact.phone }}</p>
                  </div>
                  <div v-if="tr.contact.twitter" class="mt-3">
                      <h6>Twitter:</h6>
                      <p>{{ tr.contact.twitter }}</p>
                  </div>
                  <div v-if="tr.contact.instagram" class="mt-3">
                      <h6>Instagram:</h6>
                      <p>{{ tr.contact.instagram }}</p>
                  </div>
                  <div v-if="tr.contact.facebook" class="mt-3">
                      <h6>Facebook:</h6>
                      <p>{{ tr.contact.facebook }}</p>
                  </div>
                </div>

              </template>

              <!-- Descripción de ORGANIZACION -->

              <template v-if="tr.initiative == 0" class="expand-user" slot="expand">

                <div class="con-expand-users w-full">
                  <div class="con-btns-user flex items-center justify-between">
                      <div class="con-userx flex items-center justify-start">
                          <h5>{{ tr.name }}</h5>
                      </div>
                      <div class="flex">
                          <a v-if="tr.contact.facebook" :href="'http://facebook.com/'+tr.contact.facebook" class="mr-2">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-facebook"></vs-button>
                          </a>
                          <a v-if="tr.contact.instagram" :href="'http://istagram.com/'+tr.contact.instagram" class="mr-2">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-instagram"></vs-button>
                          </a>    
                          <a v-if="tr.contact.twitter" :href="'http://twitter.com/'+tr.contact.twitter">
                            <vs-button type="border" size="small" icon-pack="feather" icon="icon-twitter"></vs-button>
                          </a>
                      </div>
                  </div>

                  <!-- Descripción -->
                    <div v-if="tr.support.description" class="user-bio mt-5">
                        <h6>Descripción:</h6>
                        <p>{{ tr.support.description }}</p>
                    </div>

                  <!-- Beneficiarios -->
                    <div class="user-bio mt-5">
                        <h6>Beneficiarios:</h6>
                        <p :data="value" :key="index" v-for="(value, index) in tr.support.beneficiaries" >{{ value.name  }}</p>
                        <vs-divider color="primary" />
                    </div>

                  <!-- Area de accion -->
                    <div v-if="tr.operation.id == 9" class="mt-5">
                        <h6>Área de acción: <strong>Nacional</strong></h6>
                    </div>
                    <div v-if="tr.operation.id == 10" class="mt-5">
                        <h6>Área de acción: <strong>Regional</strong></h6>
                        <p :data="value" :key="index" v-for="(value, index) in tr.area.regions" >{{ value.name  }}</p>
                    </div>
                    <div v-if="tr.operation.id ==11" class="mt-5">
                        <h6>Área de acción: <strong>Comunal</strong></h6>
                        <p :data="value" :key="index" v-for="(value, index) in tr.area.communes" >{{ value.name  }}</p>
                    </div>
                    <div v-if="tr.area.detail" class="mt-3">
                        <h6>Detalle</h6>
                        <p>{{ tr.area.detail }}</p>
                    </div>
                    <vs-divider color="primary" />

                    <!-- Contacto -->
                    <div v-if="tr.contact.email" class="mt-5">
                        <h6>Correo:</h6>
                        <p>{{ tr.contact.email }}</p>
                    </div>
                    <div v-if="tr.contact.web" class="mt-5">
                        <h6>Sitio web:</h6>
                        <p>{{ tr.contact.web }}</p>
                    </div>
                    <div v-if="tr.contact.phone" class="mt-5">
                        <h6>Teléfono:</h6>
                        <p>{{ tr.contact.phone }}</p>
                    </div>
                    <div v-if="tr.contact.twitter" class="mt-5">
                        <h6>Twitter:</h6>
                        <p>{{ tr.contact.twitter }}</p>
                    </div>
                    <div v-if="tr.contact.instagram" class="mt-5">
                        <h6>Instagram:</h6>
                        <p>{{ tr.contact.instagram }}</p>
                    </div>
                    <div v-if="tr.contact.facebook" class="mt-5">
                        <h6>Facebook:</h6>
                        <p>{{ tr.contact.facebook }}</p>
                    </div>
                </div>

              </template>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
  
</template>

<script>

import vSelect from 'vue-select'
import { CalendarView, CalendarViewHeader } from 'vue-simple-calendar'

export default {
  data () {
    return {
      selected: [],
      itemsPerPage: 5,
      events: [],
      eventDataComplet: [],
      isMounted: false,

      // Calendar

      showDate: new Date(),
      calendarView: 'week',

      // Filter Options
      regionFilter: { label: 'Regiones', value: '' },
      regionOptions: [],
      communeFilter: { label: 'Comunas', value: '' },
      communeOptions: [],
      beneficiarieFilter: { label: 'Beneficiarios', value: '' },
      beneficiarieOptions: [],
      supportFilter: { label: 'Ayuda', value: '' },
      supportOptions: []
    }
  },
  watch: {
    supportFilter (obj) {
      this.setColumnFilter('support', obj)
    },
    regionFilter (obj) {
      this.setColumnFilter('region', obj)
    },
    communeFilter (obj) {
      this.setColumnFilter('commune', obj)
    },
    beneficiarieFilter (obj) {
      this.setColumnFilter('beneficiary', obj)
    }
  },
  computed: {
    windowWidth () {
      return this.$store.state.windowWidth
    },
    currentPage () {
      if (this.isMounted) {
        return this.$refs.table.currentx
      }
      return 0
    },
    products () {
      return []
    },
    queriedItems () {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    },
    updateCommuneOptions () {
      const options = this.communeOptions
      return options.filter(opt => opt.region_id === this.regionFilter)
    },
  },
  methods: {
    getPopularityColor (num) {
      if (num > 8)  return 'success'
      if (num > 6)  return 'primary'
      if (num > 4) return 'warning'
      if (num > 2)  return 'danger'
      return 'primary'
    },
    toggleDataSidebar (val = false) {
      this.addNewDataSidebar = val
    },
    resetColFilters () {
      // Reset Filter Options
      this.supportFilter = this.regionFilter = this.communeFilter = this.beneficiarieFilter = { label: 'All', value: '' }

      this.$refs.filterCard.removeRefreshAnimation()
    },
    async setColumnFilter (column, val) {

      this.events = this.eventDataComplet

      if(this.communeFilter.value != '') {

        await this.$http
        .get('json/data/initiatives', {
          params: {
              region: this.regionFilter,
              commune: this.communeFilter,
          }
          }).then(response => (this.events = response.data))
        .catch(error => console.log(error))

      } else if(this.regionFilter.value != '') {

        await this.$http
        .get('json/data/initiatives', {
          params: {
              region: this.regionFilter,
          }
          }).then(response => (this.events = response.data))
        .catch(error => console.log(error))
        
      }

      if(this.beneficiarieFilter.value != '') {
        this.setBeneficiarieFilter(this.beneficiarieFilter)
      }

      if(this.supportFilter.value != '') {
        this.setSupportFilter(this.supportFilter)
      }
    },
    setSupportFilter(obj) {
      var results = []
      this.events.forEach(event => {
        event.support.categories.forEach(category => {
          if(category.pivot.category_id === obj) {
            results.push(event)
          } 
        })
      })
      this.events = results
    },
    setBeneficiarieFilter(obj) {
      var results = []
      this.events.forEach(event => {
        event.support.beneficiaries.forEach(beneficiary => {
          if(beneficiary.id === obj) {
            results.push(event)
          } 
        })
      })
      console.log(results)
      this.events = results
    }
  },
  mounted () {
    this.isMounted = true

    this.$http
      .get('forms/data/getSupport')
      .then(response => (this.supportOptions = response.data))
      .catch(error => console.log(error)) 

    this.$http
      .get('forms/data/getBeneficiaries')
      .then(response => (this.beneficiarieOptions = response.data))
      .catch(error => console.log(error)) 

    this.$http
      .get('json/data/initiatives')
      .then(response => {
        this.events = response.data
        this.eventDataComplet = response.data})
      .catch(error => console.log(error))

    this.$http
      .get('region')
      .then(response => (this.regionOptions = response.data))
      .catch(error => console.log(error))

    this.$http
      .get('commune')
      .then(response => (this.communeOptions = response.data))
      .catch(error => console.log(error))
  },
  components: {
    CalendarView,
    vSelect
  }
}
</script>

<style lang="scss">
#data-list-list-view {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }

  .vs-con-table {

    /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
    @media (max-width: 689px) {
      .vs-table--search {
        margin-left: 0;
        max-width: unset;
        width: 100%;

        .vs-table--search-input {
          width: 100%;
        }
      }
    }

    @media (max-width: 461px) {
      .items-per-page-handler {
        display: none;
      }
    }

    @media (max-width: 341px) {
      .data-list-btn-container {
        width: 100%;

        .dd-actions,
        .btn-add-new {
          width: 100%;
          margin-right: 0 !important;
        }
      }
    }

    .product-name {
      max-width: 23rem;
    }

    .vs-table--header {
      display: flex;
      flex-wrap: wrap;
      margin-left: 1.5rem;
      margin-right: 1.5rem;
      > span {
        display: flex;
        flex-grow: 1;
      }

      .vs-table--search{
        padding-top: 0;

        .vs-table--search-input {
          padding: 0.9rem 2.5rem;
          font-size: 1rem;

          &+i {
            left: 1rem;
          }

          &:focus+i {
            left: 1rem;
          }
        }
      }
    }

    .vs-table {
      border-collapse: separate;
      border-spacing: 0 1.3rem;
      padding: 0 1rem;

      tr{
          box-shadow: 0 4px 20px 0 rgba(0,0,0,.05);
          td{
            padding: 20px;
            &:first-child{
              border-top-left-radius: .5rem;
              border-bottom-left-radius: .5rem;
            }
            &:last-child{
              border-top-right-radius: .5rem;
              border-bottom-right-radius: .5rem;
            }
          }
          td.td-check{
            padding: 20px !important;
          }
      }
    }

    .vs-table--thead{
      th {
        padding-top: 0;
        padding-bottom: 0;

        .vs-table-text{
          text-transform: uppercase;
          font-weight: 600;
        }
      }
      th.td-check{
        padding: 0 15px !important;
      }
      tr{
        background: none;
        box-shadow: none;
      }
    }

    .vs-table--pagination {
      justify-content: center;
    }
    
  }
}
</style>
