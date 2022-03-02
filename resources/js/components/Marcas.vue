<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- inicio card de busca -->

                <div class="card">
                    <div class="card-header">Busca de Marcas</div>
                    <div class="card-body">
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
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </div>
                </div>

                <!-- Fim do card de busca -->


                <!-- Inicio do card de listagem de registro -->

                <div class="card mt-4">
                    <div class="card-header">Relação de Marcas</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-sm float-end">Adicionar</button>
                    </div>
                </div>

                <!-- Fim do card de listagem de registro -->

            </div>
        </div>
    </div>
</template>
<script>
import InputContainer from './InputContainer.vue'
export default {
  components: { InputContainer },
}
</script>