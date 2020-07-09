<!-- =========================================================================================
    File Name: FormWizard.vue
    Description: Form Wizard (third-party) - Imports page portions
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="extra-component-form-wizard-demo">

        <vx-card title="Toda ayuda es importante">

            <p>Nuestro deseo es entregar información de <strong>calidad</strong>, por eso te pedímos que <strong>revises</strong> la información antes de ingresarla</p>

            <div class="mt-5">
                <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Ingresar" ref="wizard">

                    <!-- tab 1 content -->
                    <tab-content title="Actividad" class="mb-5" icon="feather icon-calendar" :before-change="validateStep1">
                        <form data-vv-scope="step-1">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input label="Nombre de la actividad" v-model="eventName" class="w-full" name="event_name" v-validate="'required'" />
                                    <small class="text-danger">{{ errors.first('step-1.event_name') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Tipo de actividad</label>
                                    <v-select :reduce="label => label.key" :options="eventTypeOptions" v-model="eventType" class="w-full select-large" name="event_type" v-validate="'required'" ></v-select>
                                    <small class="text-danger">{{ errors.first('step-1.event_type') }}</small>
                                </div>
                            </div>
                            <transition name="fade">
                                <div v-if="eventType === '2'">
                                    <div class="vs-component vs-divider mt-10">
                                        <span class="vs-divider-border after vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                        <span class="vs-divider--text vs-divider-text-primary vs-divider-background-default" style="background: transparent;">
                                            <i class="vs-icon notranslate icon-scale icon-divider notranslate vs-divider--icon feather icon-calendar null"></i>
                                        </span>
                                        <span class="vs-divider-border before vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <label class="vs-input--label">A qué hora comienza?</label>
                                            <flat-pickr :config="configdateTimePicker" v-model="dateStart" placeholder="Date Time" class="w-full select-large" name="date_start" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-1.date_start') }}</small>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <label class="vs-input--label">A qué hora termina?</label>
                                            <flat-pickr :config="configdateTimePicker" v-model="dateEnd" placeholder="Date Time" class="w-full select-large" name="date_end" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-1.date_end') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                            <transition name="fade">
                                <div v-if="eventType === '1'">
                                    <div class="vs-component vs-divider mt-10">
                                        <span class="vs-divider-border after vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                        <span class="vs-divider--text vs-divider-text-primary vs-divider-background-default" style="background: transparent;">
                                            <i class="vs-icon notranslate icon-scale icon-divider notranslate vs-divider--icon feather icon-calendar null"></i>
                                        </span>
                                        <span class="vs-divider-border before vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                    </div>
                                    <div class="vx-row">
                                      <div class="vx-col md:w-1/2 w-full mt-5">
                                          <label class="vs-input--label">Días de la semana</label>
                                          <v-select multiple :closeOnSelect="false" :options="daysEventOptions" v-model="daysEvent" class="w-full select-large" name="days_event" v-validate="'required'" ></v-select>
                                          <small class="text-danger">{{ errors.first('step-1.days_event') }}</small>
                                      </div>
                                    </div>
                                    <transition name="fade">
                                        <div v-if="daysEvent.length > 0">
                                            <div class="vx-row">
                                                <div class="vs-component vs-divider mt-10">
                                                    <span class="vs-divider-border after vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                                    <span class="vs-divider--text vs-divider-text-primary vs-divider-background-default" style="background: transparent;">
                                                        <i class="vs-icon notranslate icon-scale icon-divider notranslate vs-divider--icon feather icon-clock null"></i>
                                                    </span>
                                                    <span class="vs-divider-border before vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                                </div>
                                                <div v-for=" item in daysEvent" v-bind:key="item" class="vx-col md:w-1/2 w-full mt-5">
                                                    <label class="vs-input--label">Horarios día {{ item.label }}</label>
                                                    <v-select multiple :closeOnSelect="false" :options="arrayHours" v-model="eventHour[item.key]" class="w-full select-large" name="hour_event" v-validate="'required'" ></v-select>
                                                    <small class="text-danger">{{ errors.first('step-1.hour_event') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </transition>
                        </form>
                    </tab-content>

                    <!-- tab 2 content -->
                    <tab-content title="Dirección" class="mb-5" icon="feather icon-map" :before-change="validateStep2">
                        <form data-vv-scope="step-2">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Región</label>
                                    <v-select :reduce="label => label.key" :options="regionesOptions" v-model="eventDirectionRegion" class="w-full select-large" name="event_region" v-validate="'required'" ></v-select>
                                    <small class="text-danger">{{ errors.first('step-2.event_region') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Comuna</label>
                                    <v-select :reduce="label => label.key" :options="updateAddressCommune" v-model="eventDirectionCommune" class="w-full select-large" name="event_commune" v-validate="'required'" ></v-select>
                                    <small class="text-danger">{{ errors.first('step-2.event_commune') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Calle</label>
                                    <vue-simple-suggest class="w-full select-large" name="event_street" v-validate="'required'"
                                      v-model="eventDirectionStreet"
                                      :list="callesOptions"
                                      :filter-by-query="true"
                                      :min-length="3"
                                      :loading="true">
                                    </vue-simple-suggest>
                                    <small class="text-danger">{{ errors.first('step-2.event_street') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input type="number" label="Número"  v-model="eventDirectionNumber" class="w-full" name="event_number" v-validate="'required|numeric'" />
                                    <small class="text-danger">{{ errors.first('step-2.event_number') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Detalle</label>
                                    <vs-textarea label="Anota aquí otras indicaciones o referencias, sobre todo si el lugar es difícil de encontrar" v-model="eventDirectionDetail" />
                                </div>
                            </div>
                        </form>
                    </tab-content>

                    <!-- tab 3 content -->
                    <tab-content title="Contacto" class="mb-5" icon="feather icon-mail" :before-change="validateStep3">
                        <form data-vv-scope="step-3">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input icon-pack="feather" icon="icon-smartphone" label="Teléfono de la actividad u organización" v-model="contactPhone" class="w-full" />
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input icon-pack="feather" icon="icon-mail" label="Email" v-model="contactEmail" class="w-full" />
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input @focus="contactWebDetail = true" @blur="contactWebDetail = false" icon-pack="feather" icon="icon-chrome" label="Sitio web" v-model="contactWeb" class="w-full" />
                                    <small v-if="contactWebDetail" class="text-primary">Si puedes, ingresa la URL del sitio.</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input @focus="contactFacebookDetail = true" @blur="contactFacebookDetail = false" icon-pack="feather" icon="icon-facebook" label="Facebook" v-model="contactFacebook" class="w-full" />
                                    <small v-if="contactFacebookDetail" class="text-primary">Ingresa el link o el nombre de la cuenta.</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input @focus="contactInstagramDetail = true" @blur="contactInstagramDetail = false" icon-pack="feather" icon="icon-instagram" label="Instagram" v-model="contactInstagram" class="w-full" />
                                    <small v-if="contactInstagramDetail" class="text-primary">Ingresa el link o el nombre de la cuenta.</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input @focus="contactTwitterDetail = true" @blur="contactTwitterDetail = false" icon-pack="feather" icon="icon-twitter" label="Twitter" v-model="contactTwitter" class="w-full" />
                                    <small v-if="contactTwitterDetail" class="text-primary">Ingresa el link o el nombre de la cuenta.</small>
                                </div>
                            </div>
                        </form>
                    </tab-content>

                    <!-- tab 4 content -->
                    <tab-content title="Ayuda o servicio" class="mb-5" icon="feather icon-info" :before-change="validateStep4">
                        <form data-vv-scope="step-4">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Tipo de ayuda o servicio</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="supportTypeOptions" v-model="supportType" class="w-full select-large" name="support_type" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-4.support_type') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Beneficiarios</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="supportBeneficiariesOptions" v-model="supportBeneficiaries" class="w-full select-large" name="support_beneficiaries" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-4.support_beneficiaries') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input @focus="supportBeneficiariesNumberDetail = true" @blur="supportBeneficiariesNumberDetail = false" type="number" label="Nº de beneficiarios"  v-model="supportBeneficiariesNumber" class="w-full" />
                                <small v-if="supportBeneficiariesNumberDetail" class="text-primary">¿Aproximadamente a cuántas personas ayuda? (por ejemplo ¿cuántas raciones diarias entrega la olla común o comedor solidario?)</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full md:mt-8">
                                    <div class="demo-alignment">
                                        <span>¿Necesita o recibe donaciones o voluntariado?</span>
                                        <div class="flex">
                                        <vs-checkbox v-model="showNeedHelp"></vs-checkbox>
                                        </div>
                                    </div>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Descripción de ayuda o servicio que realiza</label>
                                    <vs-textarea label="Hablanos un poco del más del servicio" v-model="supportDescription" />
                                </div>
                            </div>
                            <transition name="fade">
                                <div v-if="showNeedHelp">
                                    <div class="vs-component vs-divider mt-10">
                                        <span class="vs-divider-border after vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                        <span class="vs-divider--text vs-divider-text-primary vs-divider-background-default" style="background: transparent;">
                                            <i class="vs-icon notranslate icon-scale icon-divider notranslate vs-divider--icon feather icon-home null"></i>
                                        </span>
                                        <span class="vs-divider-border before vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <label class="vs-input--label">Tipo de ayuda que recibe</label>
                                            <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="helpTypeOptions" v-model="helpType" class="w-full select-large" name="help_type" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-4.help_type') }}</small>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <label class="vs-input--label">Descripción de donaciones o voluntariado que recibe</label>
                                            <vs-textarea label="Cuentanos como te podemos ayudar" v-model="helpDescription" name="help_description" style="margin-bottom: 0px;" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-4.help_description') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </form>
                    </tab-content>
                </form-wizard>
            </div>
        </vx-card>
    </div>
</template>

<script>
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

import VueSimpleSuggest from 'vue-simple-suggest'
import 'vue-simple-suggest/dist/styles.css'

import vSelect from 'vue-select'

// For custom error message
import { Validator } from 'vee-validate'
const dict = {
  custom: {
    event_name: { required: 'Necesitamos el nombre de la actividad' },
    event_type: { required: 'Necesitamos el nombre de la actividad' },
    event_region: { required: 'Necesitamos la región' },
    event_commune: { required: 'Necesitamos la comuna' },
    event_street: { required: 'Necesitamos el nombre calle' },
    event_number: {
      required: 'Necesitamos el número de la calle',
      numeric: 'Solo pueden ir números en este campo'
    },
    date_start: { required: 'Necesitamos fecha y hora de inicio' },
    date_end: { required: 'Necesitamos fecha y hora de fin' },
    days_event: { required: 'Necesitamos los días' },
    hour_event: { required: 'Necesitamos las horas del día' },
    support_type: { required: 'Necesitamos el tipo de apoyo' },
    support_beneficiaries: { required: 'Necesitamos los beneficiarios' },
    help_type: { required: 'Necesitamos el tipo de ayuda' },
    help_description: { required: 'Necesitamos un detalle de la ayuda' }
  }
}

// register custom messages
Validator.localize('en', dict)

function cleanStar () {
  return {
    // Step 1

    eventName: '',
    eventType: 0,
    dateStart: new Date(),
    dateEnd: new Date(),
    configdateTimePicker: {
      enableTime: true,
      dateFormat: 'd-m-Y H:i'
    },
    eventHour: [],
    daysEvent: [],

    // Step 2

    eventDirectionRegion: '',
    eventDirectionCommune: '',
    eventDirectionStreet: '',
    eventDirectionNumber: '',
    eventDirectionDetail: '',

    // Step 3

    contactPhone: '',
    contactEmail: '',
    contactWeb: '',
    contactFacebook: '',
    contactInstagram: '',
    contactTwitter: '',
    
    // Step 4

    supportType: '',
    supportBeneficiaries: '',
    supportBeneficiariesNumber: '',
    supportDescription: '',
    showNeedHelp: false,
    helpType: '',
    helpDescription: ''  
  }
}

// register custom messages
Validator.localize('en', dict)

export default {
  data () {
    return {
      // INFO

      regionesOptions: [],
      comunasOptions: [],
      callesOptions: [],

      // Step 1

      categoryOrganizationOptions: [],
      eventTypeOptions: [
        { key: '1', label: 'Actividad recurrente' },
        { key: '2', label: 'Actividad de una sola vez' }
      ],
      daysEventOptions: [
        { key: '0', label: 'Lunes' },
        { key: '1', label: 'Martes' },
        { key: '2', label: 'Miercoles' },
        { key: '3', label: 'Jueves' },
        { key: '4', label: 'Viernes' },
        { key: '5', label: 'Sabado' },
        { key: '6', label: 'Domingo' }
      ],

      // Step 4

      supportBeneficiariesOptions: [],
      supportTypeOptions: [],
      supportNumBeneficiariesOption: [],

      // VARIABLES

      // Step 1

      eventName: '',
      eventType: 0,
      dateStart: new Date(),
      dateEnd: new Date(),
      configdateTimePicker: {
        enableTime: true,
        dateFormat: 'd-m-Y H:i'
      },
      eventHour: {},
      daysEvent: [],

      // Step 2

      eventDirectionRegion: '',
      eventDirectionCommune: '',
      eventDirectionStreet: '',
      eventDirectionNumber: '',
      eventDirectionDetail: '',

      // Step 3

      contactPhone: '',
      contactEmail: '',
      contactWeb: '',
      contactWebDetail: '',
      contactFacebook: '',
      contactFacebookDetail: '',
      contactInstagram: '',
      contactInstagramDetail: '',
      contactTwitter: '',
      contactTwitterDetail: '',
      
      // Step 4

      supportType: '',
      supportBeneficiaries: '',
      supportBeneficiariesNumber: '',
      supportBeneficiariesNumberDetail: '',
      supportDescription: '',
      showNeedHelp: false,
      helpType: '',
      helpTypeOptions: '',
      helpDescription: ''  

    }
  },
  mounted () {
    this.$http
      .get('region')
      .then(response => (this.regionesOptions = response.data))
      .catch(error => console.log(error))

    this.$http
      .get('commune')
      .then(response => (this.comunasOptions = response.data))
      .catch(error => console.log(error))

    this.$http
      .get('street')
      .then(response => (this.callesOptions = response.data))
      .catch(error => console.log(error))      

    this.$http
      .get('forms/data/getBeneficiaries')
      .then(response => (this.supportBeneficiariesOptions = response.data))
      .catch(error => console.log(error)) 

    this.$http
      .get('forms/data/getSupport')
      .then(response => (this.supportTypeOptions = response.data))
      .catch(error => console.log(error)) 

    this.$http
      .get('forms/data/getHelps')
      .then(response => (this.helpTypeOptions = response.data))
      .catch(error => console.log(error)) 
  },
  methods: {
    validateStep1 () {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('step-1').then(result => {
          if (result) {
            resolve(true)
          } else {
            reject('correct all values')
          }
        })
      })
    },
    validateStep2 () {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('step-2').then(result => {
          if (result) {
            resolve(true)
          } else {
            reject('correct all values')
          }
        })
      })
    },
    validateStep3 () {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('step-3').then(result => {
          if (result) {
            resolve(true)
          } else {
            reject('correct all values')
          }
        })
      })
    },
    validateStep4 () {
      return new Promise((resolve, reject) => {
        this.$validator.validateAll('step-4').then(result => {
          if (result) {
            this.createEvent()
            resolve(true)
          } else {
            reject('correct all values')
          }
        })
      })
    },
    openAlert (color) {
      this.colorAlert = color
      this.$vs.dialog({
        color: this.colorAlert,
        title: `Dialog - ${this.colorAlert}`,
        text: 'I love soufflé lollipop liquorice wafer jelly-o halvah sesame snaps. Pastry chocolate cake jelly-o carrot cake jelly topping croissant ice cream.',
        accept: this.successAlert
      })
    },
    successAlert () {
      this.$vs.notify({
        color: 'success',
        title: 'Accept Selected',
        text: 'Gingerbread soufflé biscuit oat cake.'
      })
    },
    dangerAlert () {
      this.$vs.notify({
        color: 'danger',
        title: 'Danger Selected',
        text: 'Gingerbread soufflé biscuit oat cake.'
      })
    },
    createEvent () {
      const url = 'event'
      this.$http.post(url, {
        eventName: this.eventName,
        eventType: this.eventType,
        dateStart: this.dateStart,
        dateEnd: this.dateEnd,
        eventHour: this.eventHour,
        eventDirectionRegion: this.eventDirectionRegion,
        eventDirectionCommune: this.eventDirectionCommune,
        eventDirectionStreet: this.eventDirectionStreet,
        eventDirectionNumber: this.eventDirectionNumber,
        eventDirectionDetail: this.eventDirectionDetail,
        contactPhone: this.contactPhone,
        contactEmail: this.contactEmail,
        contactWeb: this.contactWeb,
        contactFacebook: this.contactFacebook,
        contactInstagram: this.contactInstagram,
        contactTwitter: this.contactTwitter,
        supportType: this.supportType,
        supportBeneficiaries: this.supportBeneficiaries,
        supportBeneficiariesNumber: this.supportBeneficiariesNumber,
        supportDescription: this.supportDescription,
        showNeedHelp: this.showNeedHelp,
        helpType: this.helpType,
        helpDescription: this.helpDescription
      }).then(response => {
        this.successAlert()
        console.log(response)
        this.$refs.wizard.reset()
        Object.assign(this.$data, cleanStar())
      }).catch(error => {
        this.dangerAlert()
        console.log(error.response)
      })
    }
  },
  computed: {
    updateAddressCommune () {
      const options = this.comunasOptions
      return options.filter(opt => opt.region_id === this.eventDirectionRegion)
    },
    arrayHours () {
      const arr = []
      let i = 0
      let j = 0
      for (i = 0; i < 24; i++) {
        for (j = 0; j < 2; j++) {
          arr.push(i + ':' + (j === 0 ? '00' : 30 * j))
        }
      }
      return arr
    }
  },
  components: {
    FormWizard,
    TabContent,
    'v-select': vSelect,
    VueSimpleSuggest,
    flatPickr
  }
}
</script>

