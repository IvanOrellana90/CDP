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
                                      <div class="vx-col w-full mt-5">
                                          <label class="vs-input--label">Días de la semana en los que se realiza la actividad</label>
                                          <v-select multiple :closeOnSelect="false" :options="daysEventOptions" v-model="daysEvent" class="w-full select-large" name="days_event" ></v-select>
                                          <small v-if="!daysEvent.length" class="text-primary">Puedes elegir el o los días en que la actividad sucede.</small>
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
                                                <div v-for=" item in daysEvent" v-bind:key="item" class="vx-col w-full mt-5">
                                                    <label class="vs-input--label">Hora de inicio para las actividades del día <strong>{{ item.label }}</strong></label>
                                                    <v-select multiple :closeOnSelect="false" :options="arrayHours" v-model="eventHour[item.key]" class="w-full select-large" name="hour_event" ></v-select>
                                                    <small class="text-danger">{{ errors.first('step-1.hour_event') }}</small>
                                                    <small class="text-primary">Respecto de cada día, señala el horario en que se realiza. Puedes elegir más de un horario si por ejemplo, la Olla Común ofrece diferentes comidas. </small>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </transition>
                        </form>
                    </tab-content>

                    <!-- tab 2 content -->
                    <tab-content title="Apoyo o servicio" class="mb-5" icon="feather icon-info" :before-change="validateStep2">
                        <form data-vv-scope="step-2">
                            <div class="vx-row">
                                <div class="vx-col w-full mt-5">
                                    <label class="vs-input--label">Tipo de apoyo o servicio</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="supportTypeOptions" v-model="supportType" class="w-full select-large" name="support_type" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-2.support_type') }}</small>
                                    <small v-if="!supportType.length && !errors.first('step-2.support_type')" class="text-primary">¿Qué tipo de ayuda o servicio brinda la actividad o la organización?</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Beneficiarios</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="supportBeneficiariesOptions" v-model="supportBeneficiaries" class="w-full select-large" name="support_beneficiaries" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-2.support_beneficiaries') }}</small>
                                    <small v-if="!supportBeneficiaries.length && !errors.first('step-2.support_beneficiaries')" class="text-primary">¿A quiénes busca asistir/apoyar la actividad u organización?</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input @focus="supportBeneficiariesNumberDetail = true" @blur="supportBeneficiariesNumberDetail = false" type="number" label="Nº de personas a las que apoya la institución"  v-model="supportBeneficiariesNumber" class="w-full" />
                                <small v-if="supportBeneficiariesNumberDetail" class="text-primary">¿Aproximadamente a cuántas personas ayuda? (por ejemplo ¿cuántas raciones diarias entrega la olla común o comedor solidario?)</small>
                                </div>
                                <div class="vx-col w-full mt-5">
                                    <label class="vs-input--label">Descripción del apoyo o servicio que realiza</label>
                                    <vs-textarea label="Hablanos un poco del más del servicio" style="margin-bottom: 0px;" v-model="supportDescription" />
                                </div>
                                <div class="vx-col md:w-1/2 w-full">
                                    <div class="demo-alignment">
                                        <span>¿Necesita o recibe donaciones o voluntariado?</span>
                                        <div class="flex">
                                        <vs-checkbox v-model="showNeedHelp"></vs-checkbox>
                                        </div>
                                    </div>
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
                                        <div class="vx-col w-full mt-5">
                                            <label class="vs-input--label">Tipo de apoyo que recibe</label>
                                            <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="helpTypeOptions" v-model="helpType" class="w-full select-large" name="help_type" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-2.help_type') }}</small>
                                        </div>
                                        <div class="vx-col w-full mt-5">
                                            <label class="vs-input--label">Cuentanós con más detalle cómo te podemos apoyar</label>
                                            <vs-textarea label="Cuentanos como te podemos ayudar" v-model="helpDescription" name="help_description" style="margin-bottom: 0px;" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-2.help_description') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </form>
                    </tab-content>

                    <!-- tab 3 content -->
                    <tab-content title="Dirección" class="mb-5" icon="feather icon-map" :before-change="validateStep3">
                        <form data-vv-scope="step-3">
                            <div class="vx-row">
                                <div class="vx-col w-full mt-5">
                                    <label class="vs-input--label">Región</label>
                                    <v-select :reduce="label => label.key" :options="regionesOptions" v-model="eventDirectionRegion" class="w-full select-large" name="event_region" v-validate="'required'" ></v-select>
                                    <small class="text-danger">{{ errors.first('step-3.event_region') }}</small>
                                </div>
                                <div class="vx-col w-full mt-5">
                                    <label class="vs-input--label">Comuna</label>
                                    <v-select :reduce="label => label.key" :options="updateAddressCommune" v-model="eventDirectionCommune" class="w-full select-large" name="event_commune" v-validate="'required'" ></v-select>
                                    <small class="text-danger">{{ errors.first('step-3.event_commune') }}</small>
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
                                    <small class="text-danger">{{ errors.first('step-3.event_street') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input type="number" label="Número"  v-model="eventDirectionNumber" class="w-full" name="event_number" v-validate="'numeric'" />
                                </div>
                                <div class="vx-col w-full mt-5">
                                    <label class="vs-input--label">Detalle</label>
                                    <vs-textarea label="Anota aquí otras indicaciones o referencias, sobre todo si el lugar es difícil de encontrar" v-model="eventDirectionDetail" />
                                </div>
                            </div>
                        </form>
                    </tab-content>

                    <!-- tab 4 content -->
                    <tab-content title="Contacto" class="mb-5" icon="feather icon-mail" :before-change="validateStep4">
                        <form data-vv-scope="step-4">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input icon-pack="feather" icon="icon-smartphone" label="Teléfono de la actividad u organización" v-model="contactPhone" class="w-full" />
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input icon-pack="feather" icon="icon-mail" label="Email" v-model="contactEmail" name="contact_email" class="w-full" v-validate="'email'"/>
                                    <small class="text-danger">{{ errors.first('step-4.contact_email') }}</small>
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
                </form-wizard>

              <vs-popup classContent="warning" title="Gracias por tu tiempo" :active.sync="popUpInformation">
                <p>Es muy importante que revises la información antes de ingresarla, debemos estar seguros de que nuestra información sea real.</p>
                <div class="vx-row"> 
                  <div class="vx-col w-full mt-5 mb-20">
                    <label class="vs-input--label">¿Dónde obtuviste la información?</label>
                    <v-select @input="createEvent" :reduce="label => label.key" :options="informationOptions" v-model="information" class="w-full select-large" name="information_detail" v-validate="'required'"/>
                 </div>
                </div>
                <small class="warning">Toda la información debe ser verificada antes de su uso público.</small>
              </vs-popup>

              <vs-popup classContent="warning" title="Muchas gracias por tu ayuda" :active.sync="popUpOrganizationEvent">
                <p>Para poder entregar una información completa podrías completar la siguiente pregunta.</p>
                <div class="vx-row"> 
                  <div class="vx-col w-full mt-5">
                    <label class="vs-input--label">¿Conoces a la organización que creo esta iniciativa?</label>
                      <vue-simple-suggest class="w-full select-large" name="event_street" v-validate="'required'"
                        v-model="organizationName"
                        :list="organizationNameOptions"
                        :filter-by-query="true"
                        :min-length="3"
                        :loading="true">
                      </vue-simple-suggest>
                  </div>
                  <div class="vx-col w-full mt-5">
                    <vs-button class="w-full" @click="linkEventOrganization" color="primary" type="filled">Ingresar</vs-button>
                  </div>
                </div>
              </vs-popup>

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
    event_type: { required: 'Necesitamos el tipo de actividad' },
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

      // Step 2

      supportBeneficiariesOptions: [],
      supportTypeOptions: [],
      supportNumBeneficiariesOption: [],

      // VARIABLES

      // Step 1

      eventName: '',
      eventType: '',
      dateStart: new Date(),
      dateEnd: new Date(),
      configdateTimePicker: {
        enableTime: true,
        dateFormat: 'd-m-Y H:i'
      },
      eventHour: {},
      daysEvent: [],

      // Step 2

      supportType: '',
      supportBeneficiaries: '',
      supportBeneficiariesNumber: '',
      supportBeneficiariesNumberDetail: '',
      supportDescription: '',
      showNeedHelp: false,
      helpType: '',
      helpTypeOptions: '',
      helpDescription: '',  

      // Step 3

      eventDirectionRegion: '',
      eventDirectionCommune: '',
      eventDirectionStreet: '',
      eventDirectionNumber: '',
      eventDirectionDetail: '',

      // Step 4

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

      // POP UP

      popUpInformation: false,
      informationOptions: [],
      information: '',
      popUpOrganizationEvent: false,
      organizationNameOptions: [],
      organizationName: '',
      eventNameHidden: ''

    }
  },
  mounted () {
    this.$http
      .get('json/data/organizationNames')
      .then(response => (this.organizationNameOptions = response.data))
      .catch(error => console.log(error))

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
      .get('forms/data/getInformation')
      .then(response => (this.informationOptions = response.data))
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
            if(this.contactPhone == '' && this.contactEmail == '' && this.contactWeb == '' && this.contactFacebook == '' && this.contactInstagram == '' && this.contactTwitter == '') {
              reject('Ingrese un dato de conectacto')
            } else {
              this.popUpInformation = true
              resolve(true)
            }
          } else {
            reject('correct all values')
          }
        })
      })
    },
    // REDIRECT
    redirect (url) {
       this.$router.push(url)
    }, 
    redirectHome () {
       this.$router.push('/')
    }, 
    redirectOrganization () {
       this.$router.push('new-organization')
	  }, 
    // Alerta de color
    openAlert () {
      this.popUpOrganizationEvent = false
      this.$vs.dialog({
        color: 'warning',
        title: 'No hemos podido encontrar a la organización en nuestra base',
        text: '¿Te interesaría ingresar esta nueva organización a nuestro sistema?',
        accept: this.redirect('/')
      })
    },
    createDialog (data) {
      this.$vs.dialog({
      type:'confirm',
      color: data.color,
      title: data.title,
      text: data.text,
      accept: this.redirectOrganization, // Al pasar parametros se lanza inmediatamente
      cancel: this.redirectHome
      })
    },
    createNotify (data) {
      this.$vs.notify({
      position: 'top-center',
      color: data.color,
      title: data.title,
      text: data.text
      })
    },
    successAlert () {
      this.$vs.notify({
        position: 'top-center',
        color: 'success',
        title: 'Gracias por tu tiempo',
        text: 'Tu actividad ha sido ingresada con éxito.'
      })
      this.popUpOrganizationEvent = true;
    },
    dangerAlert () {
      this.$vs.notify({
        position: 'top-center',
        color: 'danger',
        title: 'Ocurrio un problema',
        text: 'UPS! No hemos podido ingresar tu actividad'
      })
    },
    // INGRESOS
    linkEventOrganization() {
      const url = 'event/linkEventOrganization'
      this.$http.post(url, {
        organizationName: this.organizationName,
        eventName: this.eventNameHidden
      }).then(response => {
        console.log(response)
        this.popUpOrganizationEvent = false;
        if(response.data.type == 'notify')
          this.createNotify(response.data)
        else if (response.data.type == 'dialog') 
          this.createDialog(response.data)
      }).catch(error => {
        
        console.log(error.response)
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
        this.popUpInformation = false;
        this.successAlert()
        console.log(response)
        this.eventNameHidden = this.eventName
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

