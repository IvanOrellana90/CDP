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

    <vx-card ref="filterCard" class="user-list-filters mb-8" actionButtons @refresh="resetColFilters" @remove="resetColFilters">
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
        <vs-th sort-key="name">Nombre</vs-th>
        <vs-th sort-key="support.categories">Ayuda</vs-th>
        <vs-th sort-key="popularity">Operación</vs-th>
        <vs-th sort-key="inititive">Iniciativa</vs-th>
        <vs-th sort-key="verified">Estado</vs-th>
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
                <vs-list-item v-if="tr.initiative == '1'" title="Comuna" :subtitle="tr.direction.commune.name" />
                <vs-list-item v-else :title="tr.operation.name" :subtitle="tr.operation.description" />
              </vs-td>

              <vs-td>
                <p class="product-category" v-if="tr.initiative == '0'" >Organización</p>
                <p class="product-category" v-else >Actividad</p>
              </vs-td>

              <vs-td>
                <vs-list-item v-if="tr.verified == 0" class="text-warning" icon="new_releases" subtitle="Incompleto" />
                <vs-list-item v-else class="text-success" icon="verified_user" subtitle="Verificado" />
              </vs-td>

              <!--

              <template class="expand-user" slot="expand">
                <div class="con-expand-users w-full">
                  <div class="con-btns-user flex items-center justify-between">
                    <div class="con-userx flex items-center justify-start">
                      <span>{{ tr.name }}</span>
                    </div>
                    <div class="flex">
                      <vs-button type="border" size="small" icon-pack="feather" icon="icon-phone" class="mr-2"></vs-button>
                      <vs-button type="border" size="small" icon-pack="feather" icon="icon-send" color="success" class="mr-2"></vs-button>
                      <vs-button type="border" size="small" icon-pack="feather" icon="icon-trash" color="danger"></vs-button>
                    </div>
                  </div>
                  <vs-list>
                    <vs-list-item icon-pack="feather" icon="icon-mail" :title="tr.email"></vs-list-item>
                    <vs-list-item icon-pack="feather" icon="icon-globe" :title="tr.website"></vs-list-item>
                  </vs-list>
                </div>
              </template>

              -->

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </div>
</template>

<script>

import vSelect from 'vue-select'

export default {
  data () {
    return {
      selected: [],
      itemsPerPage: 4,
      events: '',
      isMounted: false,

      // Filter Options
      regionFilter: { label: 'All', value: 'all' },
      regionOptions: [],
      communeFilter: { label: 'All', value: 'all' },
      communeOptions: [],
      beneficiarieFilter: { label: 'All', value: 'all' },
      beneficiarieOptions: [],
      supportFilter: { label: 'All', value: 'all' },
      supportOptions: []
    }
  },
  watch: {
    roleFilter (obj) {
      this.setColumnFilter('role', obj.value)
    }
  },
  computed: {
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
      this.supportFilter = this.regionFilter = this.communeFilter = this.beneficiarieFilter = { label: 'All', value: 'all' }

      this.$refs.filterCard.removeRefreshAnimation()
    }
  },
  mounted () {
    this.isMounted = true

    this.$http
      .get('json/data/initiatives')
      .then(response => (this.events = response.data))
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
