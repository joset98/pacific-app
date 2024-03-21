<template>
  	<div class="d-flex justify-content-center">
		
		<div class="w-100" ref="sale" >
			<div class="d-flex justify-content-between pt-4">
			<div class="">
				<h5>
					Edición de Venta <span>| venta Nº {{saleData.num_order}}</span>
				</h5>
			</div>
			
			<div class="">
				<button class="btn btn-dark">
					Cancelar
				</button>
				<button class="btn btn-primary" @click="editSale">
					<i class="ti-save"></i>
					Guardar
				</button>
			</div>

		</div>

          <!--  Sale form Data-->

          	<!-- General Data -->
          	<div class="d-flex flex-column">

				<!-- Client and Sale Data -->
				<div class="d-flex justify-content-around pb-2 pt-4">
					<!-- Client Section -->
					<div class="">
						<cl-form>
								<template v-slot:inputs> 

									<at-input type="text" v-model="saleClient.rut" label="RUT" 
									:small_text="'El rut debe contener un guión'" :classList="'col-6'"  
									/>

									<at-input type="text" v-model="saleClient.name" label="Nombre" :classList="'col-6'"
										
									/>
									<at-input type="email" v-model="saleClient.contact" label="Correo Electrónico" 
										:classList="'col-12'"
									/>
									<at-input type="text" v-model="saleClient.business_name" label="Razón Social" 
										:classList="'col-12'"
									/>
									<at-textarea label="Dirección" v-model="saleClient.address" 
										:classList="'col-12'"
									/>
								</template>
						</cl-form>
					</div>
		
					<!-- Sale Data -->
					<div class="pl-3">
						<sl-form>
							<template v-slot:inputs>
								<at-input type="text" v-model.number="saleData.num_order" label="Nº Orden" 
									:classList="'col-6'" :alert="false" 
								/>
								<at-select :classList="'col-6'" :label="'Estado de Venta'" :options="sellStateList"
									:values="'id'" :labels="'name'" v-model="saleData.state_id"
								/>
									<!--  -->
								<at-input type="text" v-model.number="saleData.price" label="Precio neto" 
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
					<div class="col-4 px-0">

						<mc-form :machine="saleData.machine_id" :model="saleData.model" @machineInput="selectMachine" 
							@modelInput="inputModel" :machines="machineList"
						/>
					</div>

					<!-- provider form -->
					<div class="col-4 pr-0">
						<pv-form :selectOption="saleData.provider_id" @providerInput="selectProvider" 
							:providers="providerList"
						/>
					</div>

					<!-- document form -->
					<div class="col-4 pr-0">
						<doc-form :file="documentFile" @fileInput="fileDoc"/>
					</div>
				</div>
				<!-- Product Data -->

				<!-- Additional details -->
				<div class="py-2 pl-0 pr-0">
					<add-details :addElements="saleData.adition" :machineDetails="saleData.machine_detail" 
						:observations="saleData.desc" @elementInput="addElement" @machineInput="machineDetails" 
						@obsInput="observationsEvt" 
					/>
				</div>
      
         	</div>
          <!-- General Data -->
        </div>
  </div>
</template>

<script>
import { clForm, slForm, mcForm, docForm, pvForm, addDetails} from '../components/sales';
import { AtInput, AtTextarea, AtSelect, AtCheckbox } from '../components/forms';
import saleClient from './saleDetail.vue';

export default {
	name: 'sales-edit',
	components:{  clForm, slForm, mcForm, docForm, pvForm, addDetails, saleClient, AtInput, 
					AtTextarea, AtSelect, AtCheckbox },
  	data(){
		return{
			client: {
					name: 'nombre',
					rut: '7355354-2',
					email: 'test@email.com',
					business_name: 'business test',
					address: 'address test',
    		},
			verifyFields: false,
			providers: [],
			machines: [],
			sellStates: [],
			documentFile: null,
			sale: {}
		}
	},

  	methods:{

		async getSale(){
			this.$loader.containe(this.$refs.sale);
			let request = await this.$store.dispatch('sales/showEditSale',this.$route.params.sale_id );
			this.$loader.hide();

			if(request.ok) this.sale = request.data;
		},

		async editSale(){
			const {
				id,
				price,
				num_order,
				provider_id,
				machine_id,
				state_id,
				model,
				adition,
				machine_detail,
				desc,
				client 
			} = this.sale 

			let data = this.$toFormData.transform({ 
				id,
				price,
				state_id,
				num_order,
				provider_id,
				machine_id,
				model,
				adition,
				machine_detail,
				desc,
				client,
				documentFile:this.documentFile
			})
			console.log(this.documentFile)
			console.log(data.get('documentFile'))
			this.$loader.full();
			let request = await this.$store.dispatch('sales/update', data);
			this.$loader.hide();
			if(request)
				console.log('all ok')
			
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
			this.documentFile = val;
		},

		async getSellStateList(){
			let request = await this.$store.dispatch('sellStates/getSellStateList' );

			if(request.ok && request.data && request.data.length > 0){
				this.sellStates = request.data;
			}
		},

		async getProviderList(){
			let request = await this.$store.dispatch('providers/getProviderList' );

			if(request.ok && request.data && request.data.length > 0){
				console.log('data')
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
	  	saleData: {
			get(){
				if(! Object.keys(this.sale).length ) this.getSale();

				return this.sale ;
			},

			set(val){
				this.sale = val;
			}
		},

		saleClient:{
			get() {return this.sale?.client || { };},
			set(val) { 
				this.view = val;}
		},

		sellStateList:{
			get() {
				if(this.sellStates.length == 0) this.getSellStateList();	
				console.log('ready states')

				return this.sellStates;
			},
			set(val) { this.sellStates = val; }
		},

		machineList:{
			get() {
				if(this.machines.length == 0) this.getMachineList();	
				console.log('ready machine')
				return this.machines;
			},
			set(val) { this.machines = val; }
		},

		providerList:{
			get() {
				if(this.providers.length == 0) this.getProviderList();	
				console.log('ready provider')
				
				return this.providers;
			},
			set(val) { this.providers = val; }
		}
 	},
}
</script>

<style media="screen">
  .bgBtnColor{
    background-color: orange; 
  }
 
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
