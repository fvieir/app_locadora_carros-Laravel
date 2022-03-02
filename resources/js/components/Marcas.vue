<template>
    <div class="container">
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
                        <button type="button" class="btn btn-primary btn-sm float-end">Adicionar</button>
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
}
</script>