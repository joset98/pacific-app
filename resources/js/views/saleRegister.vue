<template>
  	<div class="d-flex flex-column align-items-center justify-content-center">
		<div class="adjustForm">

			<h3 class="c-orange-900 mT-20 mb-3 text-center">Registro de venta</h3>

			<!-- Transition button-->
			<div class="d-flex justify-content-around pb-5">
				<div>
					<div class="circleFormat processCircle  clientFormColor">
						<div class="c-grey-100">
						1
						</div>
					</div>
					<div class="mX-20 fontFirstStage">
						Datos de cliente
					</div>
				</div>

				<div>
					<div class="circleFormat processCircle saleFormColor">
						<div class="c-grey-100">
						2
						</div>
					</div>
					<div class="mX-20 c-blue-400">
						Datos de ventas
					</div>
				</div>

				<div>
					<div class="circleFormat processCircle completeProccessColor">
						<div class="c-grey-100">
							3
						</div>
					</div>
					<div class="mX-20 fontThirdStage">
						Listo!
					</div>
				</div>
			</div>

		</div>		

	    <!-- <transition name="component-fade"> -->

		<div class="adjustForm" v-if="view == 'register-client'">

		<!-- Register Form -->
			<cl-form>
				<template v-slot:inputs> 
					<div class="d-flex flex-column | w-100">
						<at-input type="text" v-model="currentClient.rut" label="RUT" 
						:small_text="'El rut debe contener un guión'"   
							/>
						<at-input type="text" v-model="currentClient.name" label="Nombre"
						/>
						<at-input type="email" v-model="currentClient.contact" label="Correo Electrónico" 
						
						/>
						<at-input type="text" v-model="currentClient.business_name" label="Razón Social" 
						
						/>
						<at-textarea label="Dirección" v-model="currentClient.address" 
						/>
					</div>
				</template>
			</cl-form>

		<!-- Register Form -->

		<!-- buttons actions -->
			<div class="d-flex justify-content-center mY-10">
				<button class="btn btn-secondary mX-10">
					Cancelar
				</button>
				<button class="btn clientFormColor c-grey-100 mX-10" @click="continueRegistration">
					Continuar
				</button>
			</div>
		<!-- buttons actions -->
		</div>
    <!-- </transition> -->


		<template v-if="view == 'register-sales'">
			<div class="w-100">

				<!-- <h3 class="c-blue-400 mT-20 mb-3 text-center">Registro de venta</h3> -->

			<!-- General Data -->
				<div class="d-flex flex-column pt-4">

					<!-- Client and Sale Data  justify-content-around-->
					<div class="d-flex flex-wrap pb-3">
						<!-- Client Section -->
						<div class="col-6 pl-0">
							<cl-card :client="currentClient"/>
						</div>

						<!-- Sale Data -->
						<div class="col-6 pr-0">
							<sl-form>
								<template v-slot:inputs>
									<at-input type="text" v-model.number="sale.num_order" label="Nº Orden" 
										:classList="'col-12'" :alert="false" 
									/>
									<at-input type="text" v-model="sale.price" label="Precio neto" 
										:classList="'col-12'" :alert="false" 
									/>
									<at-checkbox :classList="'col-12'" :keyId="'dolars'" :label="'¿Dolares?'"/>
									<at-input type="text" :value="0" :disabled="true" label="IVA" 
										:classList="'col-12'" :alert="false" 
									/>
									<at-input type="text" :value="0" :disabled="true" label="Precio Total" 
										:classList="'col-12'" :alert="false" 
									/>
								</template>
							</sl-form>
						</div>
					</div>
					<!-- Client and Sale Data -->

					<!-- Product Data -->
					<div class="d-flex justify-content-around py-2">
						<!--machine form  -->
						<div class="col-4">
							<mc-form :machine="sale.machine_id" :model="sale.model" 
								@machineInput="selectMachine" @modelInput="inputModel" :machines="machineList"
							/>
						</div>

						<!-- provider form -->
						<div class="col-4 px-0">
							<pv-form :selectOption="sale.provider_id" @providerInput="selectProvider" 
								:providers="providerList"
							/>
						</div>

						<!-- document form -->
						<div class="col-4 px-0">
							<doc-form :file="sale.documentFile" @fileInput="fileDoc"/>
						</div>
					</div>
					<!-- Product Data -->

					<!-- Additional details -->
					<add-details :addElements="sale.adition" :machineDetails="sale.machine_detail" 
						:observations="sale.desc" @elementInput="addElement" @machineInput="machineDetails" 
						@obsInput="observationsEvt" 
					/>
		
				</div>
				<!-- General Data -->
				<div class="d-flex justify-content-center mY-10">
					<button class="btn btn-secondary mX-10">
					Cancelar
					</button>
					<button class="btn btn-primary mX-10" @click="createSale">
						<span class="icon-holder">
							<i class="ti-save"></i>
						</span>
						Crear Venta
					</button>
				</div>
				<!-- buttons actions -->

			</div>
		</template>

		<!-- <template v-if="view == 'process-completed'"> -->
		<template v-if="view == 'register-sale'">
			<div class="d-flex flex-column align-items-center">
				<div class="">
		          <img class="login_logo" :src="imgSuccess">
				</div>
				<h2 class="thirdStageSuccess">
					¡VENTA CREADA CON EXITO!
				</h2>
				<h5>
					Los datos ya se encuentran disponibles
				</h5>
				<a class="btn c-grey-100 btn-detail">
					Ver Detalle
				</a>

			</div>

		</template>

  	</div>
</template>

<script>
import { clForm, clCard, slForm, mcForm, docForm, pvForm, addDetails} from '../components/sales';
import { AtInput, AtTextarea, AtCheckbox, AtSelect} from '../components/forms';

export default {
  name: 'sales-register',
  components:{  clForm, clCard, slForm, mcForm, docForm, pvForm, addDetails,
                AtInput, AtTextarea, AtCheckbox, AtSelect },
	props:{
		imgProccess:{
			type: String,
			default: '/adminator/images/checking_success.jpg'
		},
	},
  data(){
    return{
      currentClient: {
          name: '',
          rut: '',
          contact: '',
          business_name: '',
          address: '',
      },
      view: 'register-client',
      verifyFields: false,
      providers: [],
      machines: [],

      sale:{
        price: null,
        num_order: null,

        provider_id: 0,
        // machine data
        machine_id: null,
        model: null,
        //file 
        documentFile: null,

        // detail info
        adition: null,
        machine_detail: null,
        desc: null,
      },
    }
  },
  methods:{
    async createSale(){

      console.log(this.sale);
      console.log(this.currentClient);

      let data = this.$toFormData.transform({ 
          ...this.sale,
          ...this.currentClient        
      })
      console.log(data.getAll('documentFile'))
      console.log(data.get('price'))
      console.log(data.get('machine_details'))
      this.$loader.full();
      let request = await this.$store.dispatch('sales/create', data);
      this.$loader.hide();
      
      if(request)
        console.log('all ok')
    
    },
    
    priceSet(val){
      this.sale.price = val;
    },

    orderSet(val){
      this.sale.num_order = val;
    },

    selectMachine(val){
      this.sale.machine_id = val;
    },

    inputModel(val){
      this.sale.model = val;
    },

    selectProvider(val){
      this.sale.provider_id = val;
    },
    //additional elements 
    addElement (val) {
      this.sale.adition = val;
    },

    machineDetails (val){
      this.sale.machine_detail = val;

    },

    observationsEvt (val){
      this.sale.desc = val;
    },

    //file 
    fileDoc(val){
      this.sale.documentFile = val;
    },

    async continueRegistration(){
      console.log('comprobaciones')
      // if(this.$allErrors.verifyFields(this.currentClient)) return this.verifyFields = true;
      console.log('comprobaciones aprobadas')

      this.showView = 'register-sale'
    },

    async getProviderList(){
      let request = await this.$store.dispatch('providers/getProviderList' );

      if(request.ok && request.data && request.data.length > 0){
        this.providers = request.data;
      }
      
    },

    async getMachineList(){
      let request = await this.$store.dispatch('machines/getMachineList');

      if(request.ok && request.data && request.data.length > 0){
        this.machines = request.data;
      }
      
    }
  },
  computed:{
	imgSuccess:{
		get(){ return this.imgProccess}
	},
    showView:{
      get() {return this.view;},
      set(val) { 
        this.view = val;
        this.getMachineList();
        this.getProviderList();
      }
    },

    machineList:{
      get() {return this.machines;},
      set(val) { this.machines = val; }
    },

    providerList:{
      get() {return this.providers;},
      set(val) { this.providers = val; }
    }
  },
}
</script>

<style media="screen">
	.adjustForm{
		width: 100%;
		max-width: 360px;
	}
	.circleFormat{
		border-radius: 50%;
		border-width: 1.5px;    
		border-style: solid;
		display: flex;
		justify-content: center;
		align-items: center;
		text-align: center;
		margin:0px auto;
	}		

	.processCircle{
		width: 2.5em;
		height: 2.5em;
	}
	.successCircle{
		width: 7.5em;
		height: 7.5em;
	}

	
  /* first form color */
	.clientFormColor{
		background: rgba(226, 90, 12, 0.856);
		border-color:rgba(226, 90, 12, 0.856);

	}
	
	.fontFirstStage{
		color:rgba(226, 90, 12, 0.856);
	}

  /* first form color */

  /*Seccond form color  */
	.saleFormColor{
		background: #6db7f3;
		border-color:#2196f3;

	}
	
	.fontSeccondStage{
		color:#2196f3;
	}
  /*Seccond form color  */

  /*Third form color  */
	.completeProccessColor{
		background: #97cf98;
		border-color: #84c986;

	}
	
	.fontThirdStage{
		color:#3fa742;
	}

	.thirdStageSuccess{
		color:#3dd14241;
	}
  /*Third form color  */

	.btn-detail{
		background-color: rgb(53, 187, 142);
		max-width: 300px;
		width: 100%;
	}

	.caseTrue{
		color: green;
	}
	.caseFalse{
		color: red;
	}
</style>
