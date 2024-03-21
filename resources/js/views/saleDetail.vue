<template>
  	<div class="d-flex flex-column justify-content-center" ref="sale">

      	<!-- buttons header -->
		<div class="d-flex justify-content-between pt-4">
			<div class="">
				<h5>
					Detalle de Venta <span>| venta Nº {{saleData.num_order}}</span>
				</h5>
			</div>
			
			<div class="">
				<button class="btn btn-dark">
					Volver
				</button>
				<a :href="'/ventas/'+ saleData.id +'/editar'" class="btn btn-primary">
					<i class="ti-pencil"></i>
					Editar
				</a>
				<button class="btn bgPrice c-grey-100">
					<i class="ti-pencil"></i>
					Editar Datos Adicionales
				</button>
			</div>

		</div>

      	<!-- data cards -->
		<div class="d-flex flex-wrap justify-content-around py-3">
			<div class="col-3 pl-0 pr-0">
				<div class="d-flex flex-wrap | bg-white">
					<div>
						<span class="icon-holder squareBg | c-grey-100 bgShopCart | 
						d-flex justify-content-center align-items-center">
							<i class="ti-shopping-cart-full"></i>
						</span>
					</div>
					<div class="pl-2">
						<h5 class="fontShopCartColor">Venta_Ingresada</h5>
						<div>Estado venta</div>
					</div>
				</div>
			</div>

			<div class="col-3 pr-0">
				<div class="d-flex flex-wrap | bg-white">
					<div>
						<span class="icon-holder squareBg | c-grey-100 bgNetPrice | d-flex justify-content-center align-items-center">
							<i class="fa fa-money" aria-hidden="true"></i>
						</span>
					</div>
					<div class="pl-2">
						<h5 class="fontNetPriceColor">precio_neto</h5>
						<div>Precio Neto</div>
					</div>
				</div>
			</div>

			<div class="col-3 pr-0">
				<div class="d-flex flex-wrap | bg-white" >
					<div>
						<span class="icon-holder squareBg | bg-primary  c-grey-100 | 
						d-flex justify-content-center align-items-center">
							<i class="fa fa-plus" aria-hidden="true"></i>
						</span>
					</div>
					<div class="pl-2">
						<h5 class="text-primary">iva</h5>
						<div>IVA</div>
					</div>
				</div>
			</div>

			<div class="col-3 pr-0 ">
				<div class="d-flex flex-wrap | bg-white">
					<div>
						<span class="icon-holder squareBg | bgPrice c-grey-100 | d-flex justify-content-center align-items-center">
							<i class="fa fa-usd" aria-hidden="true"></i>
						</span>
					</div>
					<div class="pl-2">
						<h5 class="fontPriceColor">Precio_total</h5>
						<div>Precio total</div>
					</div>
				</div>
			</div>

		</div>

      	<!--  other datas-->
      	<div class="w-100">
		
        	<div class="d-flex flex-wrap">

          		<div class="d-flex flex-column col-8 p-0">

					<div class="d-flex flex-row">
						<div class="col-6 pl-0 pr-2">
							<div class="bg-white">
								<h4 class="text-center text-primary">Maquina</h4>

								<div>
									<div class="text-primary">Modelo</div>
									<div>modelo_maquina</div>
									<div class="text-primary">Tipo</div>
									<div>{{saleMachine.name}}</div>
									<!-- <p>{{saleData}}</p> -->
								</div>
							</div>							
						</div>

						<div class="col-6 pr-0 pl-2">
							<div class="bg-white mb-3 h-100">
								<h4 class="text-center text-primary">Proveedor</h4>
							
								<div>
									<div class="text-primary">{{saleProvider.name}}</div>
									<div>{{saleProvider.desc}}</div>
								</div>

							</div>
						</div>
					</div>

					<!-- documents -->
					<div class="bg-white d-flex flex-column h-100 mt-2">
						<div class="text-center w-100 bgNetPrice py-3">
							<h2 class="c-grey-100">Documentos Cargados</h2>
							<div class="btnPosition">
								<span class="icon-holder btnCircle circleFormat | bg-danger  c-grey-100">
									<i class="ti-plus" aria-hidden="true"></i>
								</span>
							</div>
						</div>
						<!-- file list -->
						<div class="pt-2">
							<div class="d-flex flex-wrap pt-2 pb-2 pl-2 border-bottom"
								v-for=" document in sale.documents" :key="document.id" 
							>
								<div class="pr-2 d-flex align-items-center">
									<div class="fontPriceColor fontLetterExt">
										{{getFileExt(document.document)}}
									</div>
								</div>
								<div class="pl-2">
									<div>
										{{getFileName(document.document)}}
									</div>
									<div>
										{{document.created_date}}
									</div>
								</div>
																	
							</div>
						</div>


					</div>

          		</div>
          		<!-- right side -->
				<div class="d-flex flex-column col-4 pr-0">
					<!-- client card -->
					<div class="bg-white mb-2">
						<div class="d-flex flex-column align-items-center">
							<div>
								<h4 class="mL-10">
									Cliente
								</h4>
							</div>
							<div class="fontPriceColor">
								{{saleClient.name}}
							</div>
							<div>
								<!-- profile phto -->
								<img class="client_logo" :src="clientLogo">
							</div>
							<div class="fontPriceColor">
								{{saleClient.rut}}
							</div>
						</div> 
						
						<div class="d-flex flex-column align-items-start">
							<div class="pb-2">
								<div class="fontPriceColor">Dirección</div>
								<div>{{saleClient.address}}</div>
							</div>
							<div class="pb-2">
								<div class="fontPriceColor">Razón Social</div>
								<!-- <div>{{saleClient.}}</div> -->
							</div>
						</div>
					</div>

					<!--executive card  -->
					<div class="bg-white mt-2">
						<div class="d-flex flex-column align-items-center">
							<div>

								<h4 class="mL-10">
									Ejecutivo
								</h4>
							</div>
							<div class="fontShopCartColor">
								{{saleUser.name}}
							</div>
							<div>
								<!-- profile phto -->
								<img class="client_logo" :src="clientLogo">
							</div>
							<div class="fontShopCartColor">
								{{saleUser.rut}}
							</div>
						</div> 
					</div>

				</div>

			</div>
			<!--Dates  -->
			<div class="mT-10">
				<div class="bg-white py-2 px-2">
					<div class="d-flex justify-content-start align-items-start">	
						<span class="icon-holder | c-grey-100 bgShopCart | squareBgSmall | d-flex justify-content-center align-items-center">
							<i class="fa fa-calendar-o"></i>
						</span>
						<h4 class="pl-2">Fechas de la venta</h4>
					</div>      	
					<div class="d-flex flex-wrap">
						<div class="col-4 pb-3 pt-2">
							<div class="fontShopCartColor">Fecha Creación</div>
							<div>{{saleData.created_at}}</div>
						</div>
						<div class="col-4 pb-3 pt-2">
							<div class="fontShopCartColor">Fecha Solicitud</div>
							<div>Fecha_Solicitud</div>

						</div>
						<div class="col-4 pb-3 pt-2">
							<div class="fontShopCartColor">Fecha Aproximada de Fabricación</div>
							<div>Fecha_fabricacion</div>

						</div>
						<div class="col-4 pb-3">
							<div class="fontShopCartColor">Fecha de Embarge</div>
							<div>Fecha_embargue</div>

						</div>
						<div class="col-4 pb-3">
							<div class="fontShopCartColor">Fecha de Llegada a Chile</div>
							<div>Fecha_llegada</div>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex flex-wrap pt-3">
				<div class="col-6 pl-0 pr-2">
					<div class="bg-white pl-3">
						<h4 class="text-center fontNetPriceColor">Datos Opcionales</h4>

						<div class="d-flex flex-column">
							<div class="mb-2">
								<div class="fontNetPriceColor">Observaciones</div>
								<div>{{saleData.desc}}</div>
							</div>

							<div class="mb-2">
								<div class="fontNetPriceColor">Descripción de Máquina</div>
								<div>{{saleData.machine_detail}}</div>

							</div>

							<div class="mb-2">
								<div class="fontNetPriceColor">Descripción</div>
								<div>{{saleData.adition}}</div>
							</div>

						</div>
						
					</div>

				</div>

				<div class="col-6 pl-2" ref="comment">
					<div class="bg-white">
						<div class="p-10">
							<h4 class="fontPriceColor">Comentarios</h4>

						</div>
						<div class="container-comments px-3 py-4">

							<div v-for="comment in commentList" v-bind:key="comment.id" 
								class="d-flex flex-wrap pb-1"
							>
								<div>

									<span class="icon-holder">
										<i class="fa fa-user-circle-o fa-2x"></i>
									</span>
								</div>
								<div class="pb-2 pl-2">

									<div class="bg-white comment-style px-2">
										<div class="fontPriceColor">{{comment.user.name}}</div>
										<div>{{comment.comment}}</div>
									</div>
								</div>
							</div>
						</div>

						<div class="pt-2">
							<div class="bg-white d-flex flex-nowrap p-20">
								<input class="comment-style-input pl-2 py-1" v-model="message" 
									type="text" placeholder="Comentar Venta" 
								>
								<a class="ml-2 btn-message-position" @click="sendMessage">
									<span class="icon-holder">
										<i class="fa fa-telegram fa-2x"></i>
										<!-- btn-comment -->
									</span>
								</a>
							</div>
						</div>

					</div>
				</div>
			</div>
      	</div>

  	</div>
</template>

<script>
import { clCard, slForm, mcForm, docForm, pvForm, addDetails} from '../components/sales';
import { AtInput} from '../components/forms';

export default {
	name: 'sale-detail',
	components:{  clCard, slForm, mcForm, docForm, pvForm, addDetails, AtInput },
	props:{
		logo:{
			type: String,
			default: '/adminator/images/user.png'
		},
  	},

  	data(){
		return{
			message: null,
			sale: { },
			comments:[],
			verifyField: false,
		}
	},

	methods:{
		// 
		getFileName(path){
			const barIndex = path.lastIndexOf('/') + 1;
			let name = path.substring(barIndex);
			return name;
		},

		getFileExt(path){
			const barIndex = path.lastIndexOf('.') + 1;
			let ext = path.substring(barIndex);
			return ext;
		},


		// async methods
		async sendMessage(){
			if (!this.message) return
			console.log(this.message)
			let data = this.$toFormData.transform({ 
				comment: this.message, sale_id: this.$route.params.sale_id 
			})
      		this.$loader.full();
			const request = await this.$store.dispatch('comments/sendComment', data );
	      	this.$loader.hide();
			if(!request.ok){
					const {title, type, text} = this.$requestToNotification.transformRequest(request)
					this.$actionNotify.showNotification(type, title, text)
					return this.$allErrors.getError(request.data);
			}
			this.refreshData();
		},

		async fetchComments(){
			// this.$loader.containe(this.$refs.comment);
			let request = await this.$store.dispatch('comments/getComments',this.$route.params.sale_id );
			// this.$loader.hide();
			console.log(request.ok && request.data && request.data.length > 0)
			if(request.ok && request.data && request.data.length > 0) 
				this.comments = request.data;

		},

		async getSale(){
			this.$loader.containe(this.$refs.sale);
			let request = await this.$store.dispatch('sales/showSale',this.$route.params.sale_id );
			this.$loader.hide();

			if(request.ok) this.sale = request.data;
		},

		async refreshData(sell = false){
			this.$loader.dinamic();
			this.fetchComments()
			this.$loader.hide();
		}
	},

  	computed:{
		clientLogo(){
			return this.logo;
		},

		commentList:{
			get(){ 
				if( this.comments.length == 0 ) this.fetchComments();
				return this.comments; 
			},
			set(val){ this.comments = val; },
		},
		
		saleMachine: {
			get(){
				return this.sale?.machine || {};
			},

			set(val){
				this.sale = val;
			}
		},
		
		saleProvider: {
			get(){
				return this.sale?.provider || {};
			},

			set(val){
				this.sale = val;
			}
		},
		
		saleClient: {
			get(){
				return this.sale?.client || {};
			},

			set(val){
				this.sale = val;
			}
		},
		
		saleUser: {
			get(){
				return this.sale?.user || {};
			},

			set(val){
				this.sale = val;
			}
		},
		
		saleData: {
			get(){
				if(! Object.keys(this.sale).length) this.getSale();
				return this.sale;
			},

			set(val){
				this.sale = val;
			}
		},

  	},
}
</script>

<style media="screen">
	.adjustDocument{
		height: 100%;
	}
	
	.squareBgSmall{
		width: 2.5em;
		height: 2.5em;
	}

	.squareBg{
		width: 5em;
		height: 5em;
	}

	.bgShopCart{
	    background-color:rgba(226, 45, 0, 0.856);
  	}
	
	.fontShopCartColor{
	    color:rgba(226, 45, 0, 0.856);
  	}

	.bgPrice{
    	background-color: rgb(53, 187, 142);
  	}

	.fontPriceColor{
	    color:rgb(53, 187, 142);;
  	}
 
 	.bgNetPrice{
		background-color: rgb(79, 66, 138);
		 /* background-color: rgb(103, 87, 173); */
  	}
	  
	.fontNetPriceColor{
		color: rgb(79, 66, 138);
  	}
	  
	.container-comments{
		background-color: #d3d9e3;
		min-height: 200px;
		max-height: 200px;
		overflow-y: scroll
	}

	.comment-style-input{
		border: 1px solid #ced4da;
		width: 100%;
		border-radius: 1rem;	
	}

	.btn-message-position{
		position: absolute;
		z-index: 1;
		right: 35px;
		bottom: 1.5em;
	}

	.comment-style{
		border-radius: .25rem;	
	}

	.btn-comment{
		color: #2196f3 ;
	}

	.fontLetterExt{
		font-weight:bold;
		font-size: 1rem;
		text-transform: uppercase;
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
		border-color: #f44336;
	}	

	.btnPosition{
		position: absolute;
		left: 55em;
	}

	.btnCircle{
		width: 2.5em;
		height: 2.5em;
	}


	.bgBlue{
		background-color: blue;
	}
	.bgRed{
		background-color: red;
	}
	.client_logo{
		width: 100%;
		max-width: 100px;
	}
	.caseTrue{
		color: green;
	}
	.caseFalse{
		color: red;
	}
</style>
