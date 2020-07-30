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

        <vx-card title="Todo apoyo es importante">

            <p>Nuestro deseo es entregar información de <strong>calidad</strong>, por eso te pedímos que <strong>revises</strong> la información antes de ingresarla</p>

            <div class="mt-5">
                <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Ingresar" ref="wizard">

                    <!-- tab 1 content -->
                    <tab-content title="Organización" class="mb-5" icon="feather icon-users" :before-change="validateStep1">
                        <form data-vv-scope="step-1">
                            <div class="vx-row">
                                <div class="vx-col w-full mt-5">
                                    <vs-input label="Nombre de la organización" v-model="nameOrganization" class="w-full" name="name_organization" v-validate="'required|unique'" />
                                    <small class="text-danger">{{ errors.first('step-1.name_organization') }}</small>
                                </div>
                                <!--
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">¿De qué tipo de organización se trata?</label>
                                    <v-select :reduce="label => label.key" :options="categoryOrganizationOptions" v-model="categoryOrganization" class="w-full select-large" name="category_organization" v-validate="'required'" />
                                    <small class="text-danger">{{ errors.first('step-1.category_organization') }}</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input @focus="rutOrganizationDetail = true" @blur="rutOrganizationDetail = false" label="Rut" v-model="rutOrganization" class="w-full" />
                                    <small v-if="rutOrganizationDetail" class="text-primary">Anota el RUT de la persona jurídica de la organización sólo si lo conoces.</small>
                                </div>
                                -->
                                <div class="vx-col md:w-1/2 w-full md:mt-8">
                                    <div class="demo-alignment">
                                        <span>Cuenta con sede principal?</span>
                                        <div class="flex">
                                        <vs-checkbox v-model="showAddressOrganization"></vs-checkbox>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <transition name="fade">
                                <div v-if="showAddressOrganization">
                                    <div class="vs-component vs-divider mt-10">
                                        <span class="vs-divider-border after vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                        <span class="vs-divider--text vs-divider-text-primary vs-divider-background-default" style="background: transparent;">
                                            <i class="vs-icon notranslate icon-scale icon-divider notranslate vs-divider--icon feather icon-home null"></i>
                                        </span>
                                        <span class="vs-divider-border before vs-divider-border-primary" style="width: 100%; border-top-width: 1px; border-top-style: solid;"></span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full mt-5">
                                            <label class="vs-input--label">Región</label>
                                            <v-select :reduce="label => label.key" :options="regionesOptions" v-model="addressRegionOrganization" class="w-full select-large" name="address_region_organization" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-1.address_region_organization') }}</small>
                                        </div>
                                        <div class="vx-col w-full mt-5">
                                            <label class="vs-input--label">Comuna</label>
                                            <v-select :reduce="label => label.key" :options="updateAddressCommune" v-model="addressCommuneOrganization" class="w-full select-large" name="address_commune_organization" v-validate="'required'" />
                                            <small class="text-danger">{{ errors.first('step-1.address_commune_organization') }}</small>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <label class="vs-input--label">Calle</label>
                                            <vue-simple-suggest class="w-full select-large"
                                              v-model="addressStreetOrganization"
                                              :list="callesOptions"
                                              :filter-by-query="true"
                                              :min-length="3"
                                              :loading="true"
                                              name="address_street_organization" v-validate="'required'">
                                            </vue-simple-suggest>
                                            <small class="text-danger">{{ errors.first('step-1.address_street_organization') }}</small>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                            <vs-input type="number" label="Número"  v-model="addressNumberOrganization" class="w-full" name="address_number_organization" v-validate="'numeric'" />
                                            <small class="text-danger">{{ errors.first('step-1.address_number_organization') }}</small>
                                        </div>
                                        <div class="vx-col w-full mt-5">
                                            <label class="vs-input--label">Información detallada</label>
                                            <vs-textarea label="Oficina, departamento, local u otra indicación." v-model="addressDetailOrganization" />
                                        </div>
                                    </div>
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
                    <tab-content title="Areá de acción" class="mb-5" icon="feather icon-map" :before-change="validateStep3">
                        <form data-vv-scope="step-3">
                            <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <label class="vs-input--label">Área de acción</label>
                                    <v-select :reduce="label => label.key" :options="operationOrganizationOptions" v-model="operationOrganization" class="w-full select-large" name="operation_organization" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-3.operation_organization') }}</small>
                                    <small v-if="!operationOrganization.length && !errors.first('step-3.operation_organization')" class="text-primary">¿Actúa la organización a nivel nacional, regional, comunal o tiene límites territoriales específicos?</small>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input disabled label="País" v-model="operationCountry" class="w-full" />
                                </div>
                                <div v-if="operationOrganization === 10 || operationOrganization === 11 || operationOrganization === 12" class="vx-col  w-full mt-5" v-show="true">
                                    <label class="vs-input--label">Regiones</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="regionesOptions" v-model="operationRegion" class="w-full select-large" name="operation_region" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-3.operation_region') }}</small>
                                    <small v-if="!operationRegion.length && !errors.first('step-3.operation_region')" class="text-primary">Puedes elegir una o más regiones</small>
                                </div>
                                <div v-if="operationOrganization === 11 || operationOrganization === 12" class="vx-col  w-full mt-5" v-show="true">
                                    <label class="vs-input--label">Comunas</label>
                                    <v-select :reduce="label => label.key" multiple :closeOnSelect="false" :options="updateOperationCommune" v-model="operationCommune" class="w-full select-large" name="operation_commune" v-validate="'required'"/>
                                    <small class="text-danger">{{ errors.first('step-3.operation_commune') }}</small>
                                    <small v-if="!operationCommune.length && !errors.first('step-3.operation_commune')" class="text-primary">Puedes elegir una o más comunas</small>
                                </div>
                                <div v-if="operationOrganization === 12" class="vx-col md:w-1/2 w-full mt-5" > 
                                    <label class="vs-input--label">Calle</label>
                                    <vue-simple-suggest class="w-full select-large"
                                      v-model="operationOrganizationStreet"
                                      :list="callesOptions"
                                      :filter-by-query="true"
                                      :min-length="3"
                                      :loading="true">
                                    </vue-simple-suggest>
                                </div>
                                <div v-if="operationOrganization === 12" class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input type="number" label="Número"  v-model="operationOrganizationNumber" class="w-full" />
                                </div>
                                <div v-if="operationOrganization === 12" class="vx-col  w-full mt-5">
                                    <label class="vs-input--label">Límites territoriales específicos</label>
                                    <vs-textarea label="Describe el área de acción, puede ser un conjunto de calles, un barrio o una localidad." style="margin-bottom: 0px;" v-model="operationDetail" name="operation_detail" v-validate="'required'" />
                                    <small class="text-danger">{{ errors.first('step-3.operation_detail') }}</small>
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

              <vs-popup classContent="warning" title="Gracias por tu tiempo" :active.sync="confirmation">
                <p>Es muy importante que revises la información antes de ingresarla, debemos estar seguros de que nuestra información sea real.</p>
                <div class="vx-row"> 
                  <div class="vx-col w-full mt-5 mb-20">
                    <label class="vs-input--label">¿Dónde obtuviste la información?</label>
                    <v-select @input="createOrganization" :reduce="label => label.key" :options="informationOptions" v-model="information" class="w-full select-large" name="information_detail" v-validate="'required'"/>
                 </div>
                </div>
                <small class="warning">Toda la información debe ser verificada antes de su uso público.</small>
              </vs-popup>

            </div>
        </vx-card>
    </div>
</template>

<script>
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

import VueSimpleSuggest from 'vue-simple-suggest'
import 'vue-simple-suggest/dist/styles.css'

import vSelect from 'vue-select'

// For custom error message
import { Validator } from 'vee-validate'
const dict = {
  custom: {
    name_organization: { required: 'Necesitamos el nombre de la organización' },
    address_region_organization: { required: 'Necesitamos la región' },
    address_commune_organization: { required: 'Necesitamos la comuna' },
    address_street_organization: { required: 'Necesitamos la calle' },
    operation_organization: { required: 'Necesitamos la operación de la organización' },
    operation_region: { required: 'Necesitamos la región' },
    operation_commune: { required: 'Necesitamos la comuna' },
    operation_detail: {required: 'Necesitamos los límetes territoriales'},
    address_number_organization: {
      required: 'Necesitamos el número',
      numeric: 'Solo pueden ir números en este campo'
    },
    support_type: { required: 'Necesitamos el tipo de apoyo' },
    support_beneficiaries: { required: 'Necesitamos los beneficiarios' },
    help_type: { required: 'Necesitamos el tipo de ayuda' },
    help_description: { required: 'Necesitamos un detalle de la ayuda' }
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
      organizationNames: [],

      // Step 1

      categoryOrganizationOptions: [],

      // Step 2

      operationOrganizationOptions: [],

      // Step 4

      supportBeneficiariesOptions: [],
      supportTypeOptions: [],
      supportNumBeneficiariesOption: [],

      // VARIABLES

      // Step 1

      nameOrganization: '',
      categoryOrganization: '',
      showAddressOrganization: false,
      rutOrganization: '',
      rutOrganizationDetail: false,
      addressRegionOrganization: '',
      addressCommuneOrganization: '',
      addressStreetOrganization: '',
      addressNumberOrganization: '',
      addressDetailOrganization: '',

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

      operationOrganization: '',
      operationCountry: 'Chile',
      operationRegion: [],
      operationCommune: [],
      operationOrganizationStreet: '',
      operationOrganizationNumber: '',
      numberOrganization: '',
      operationDetail: '',
      
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

      confirmation: false,
      informationOptions: [],
      information: ''

    }
  },
  mounted () {
    const isUnique = value =>
      new Promise(resolve => {
        setTimeout(() => {
          if (this.organizationNames.indexOf(value) === -1) {
            return resolve({
              valid: true
            });
          }

          return resolve({
            valid: false,
            data: {
              message: `${value} is already taken.`
            }
          });
        }, 200);
      });

    Validator.extend("unique", {
      validate: isUnique,
      getMessage: (field, params, data) => data.message
    });

    this.$http
      .get('json/data/organizationNames')
      .then(response => (this.organizationNames = response.data))
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
      .get('forms/data/getOperations')
      .then(response => (this.operationOrganizationOptions = response.data))
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
      .get('forms/data/getOrganizations')
      .then(response => (this.categoryOrganizationOptions = response.data))
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
              this.confirmation = true;
              resolve(true)
            }
          } else {
            reject('correct all values')
          }
        })
      })
    },
    redirectHome () {
       this.$router.push('/')
	  }, 
    successAlert () {
      this.$vs.notify({
        position: 'top-center',
        color: 'success',
        title: 'Gracias por tu tiempo',
        text: 'Tu organización ha sido ingresada con éxito.'
      })
    },
    dangerAlert () {
      this.$vs.notify({
        position: 'top-center',
        color: 'danger',
        title: 'Ocurrio un problema',
        text: 'UPS! No hemos podido ingresar tu organización'
      })
    },
    createOrganization () {
      const url = 'organization'
      this.$http.post(url, {
        nameOrganization: this.nameOrganization,
        showAddressOrganization: this.showAddressOrganization,
        addressRegionOrganization: this.addressRegionOrganization,
        addressCommuneOrganization: this.addressCommuneOrganization,
        addressStreetOrganization: this.addressStreetOrganization,
        addressNumberOrganization: this.addressNumberOrganization,
        addressDetailOrganization: this.addressDetailOrganization,
        operationOrganization: this.operationOrganization,
        operationCountry: this.operationCountry,
        operationRegion: this.operationRegion,
        operationCommune: this.operationCommune,
        operationOrganizationStreet: this.operationOrganizationStreet,
        operationOrganizationNumber: this.operationOrganizationNumber,
        numberOrganization: this.numberOrganization,
        operationDetail: this.operationDetail,
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
        this.confirmation = false
        this.successAlert()
        this.redirectHome()
        console.log(response)
      }).catch(error => {
        this.dangerAlert()
        console.log(error.response)
      })
    }
  },
  computed: {
    updateAddressCommune () {
      const options = this.comunasOptions
      return options.filter(opt => opt.region_id === this.addressRegionOrganization)
    },
    updateOperationCommune () {
      const res = []
      const options = this.comunasOptions
      this.operationRegion.forEach(element => {
        options.filter(opt => opt.region_id === element).forEach(element => {
          res.push(element)
        })
      })
      return res
    }
  },
  components: {
    VueSimpleSuggest,
    FormWizard,
    TabContent,
    'v-select': vSelect
  }
}
</script>

<style lang="scss">
@import "@sass/vuexy/extraComponents/autocomplete.scss";
</style>