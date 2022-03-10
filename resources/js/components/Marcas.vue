<template>
    <div class="container">
        <modal-component title="Adicionar Marcas">
            <template v-slot:body>

                <div class="form-group">
                    <input-container-component forLabel="inputNovoNome" label="Nome" id-help="novoNomeHelp" texto="Informe o Nome da Marca">
                        <input type="text" class="form-control" id="inputNovoNome" v-model="marca" aria-describedby="novoNomeHelp" placeholder="Nome da Marca">
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component forLabel="inputFile" label="Arquivo" id-help="novoFileHelp" texto="Selecione uma imagem do tipo PNG">
                        <input type="file" class="form-control" id="inputFile" @change="getFile($event)" aria-describedby="novoFileHelp" placeholder="Selecione imagem">
                    </input-container-component>
                </div>

            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="saveBrand()">Salvar</button>
            </template>
        </modal-component>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- inicio card de busca -->

                <card-component title="Busca de Marcas">
                    
                    <template v-slot:body>
                        <div class="row">

                            <div class="col">
                                <div class="mb-3">
                                    <input-container-component forLabel="inputID" label="ID" id-help="idHelp" texto="Opcional. Informe o id do registro">
                                        <input type="email" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="id">
                                    </input-container-component>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <input-container-component forLabel="inputNome" label="Nome" id-help="nomeHelp" texto="Opcional. Informe o Nome da Marca">
                                        <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome da Marca">
                                    </input-container-component>
                                </div>
                            </div>
                                
                        </div>
                    </template >

                    <template v-slot:footer>
                         <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </template>

                </card-component>

                <!-- Fim do card de busca -->


                <!-- Inicio do card de listagem de registro -->

                <card-component title="Relação de Marcas">

                    <template v-slot:body>
                        <table-component></table-component>
                    </template>

                    <template v-slot:footer>
                        <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#marcasModal">Adicionar</button>
                    </template>

                </card-component>

                <!-- Fim do card de listagem de registro -->

            </div>
        </div>
    </div>
</template>
<script>
import Card from './Card.vue'
import InputContainer from './InputContainer.vue'
import Table from './Table.vue'
export default {
    name: 'Marcas',
    components: { InputContainer, Card, Table },
    data () {
        return {
            marca: '',
            file: [],
            url: 'http://app_locadora_carros.test/api/v1/marcas'
        }
    },
    computed: {
        token () {
            let token = document.cookie.split(';').find(e => {
                return e.startsWith('token')
            })
            token = token.split('=')[1]
            token = 'Bearer '+ token
            return token
        }
    },
    methods: {
        getFile (e) {
            this.file = e.target.files
        },
        saveBrand () {
            let formData = new FormData()
            formData.append('nome', this.marca);
            formData.append('imagem', this.file[0]);
            let config = {
                headers : {
                    'Content-type': 'multipart-form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.post(this.url,formData,config)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>