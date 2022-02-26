<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login Vue</div>
                
                <div class="card-body">
                    <form method="POST" action="" @submit.prevent="login($event)">
                        <input type="hidden" name="_token" :value="crf_token">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" v-model="email" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete="current-password">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Matenha-me conectado
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Login
                                </button>
                                <a class="btn btn-link" href="#">
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['crf_token'],
        data () {
            return {
                email: '',
                password: ''
            }
        },
        methods : {
            login (e) {
                let url = 'http://app_locadora_carros.test/api/login'
                let config = {
                    method: 'POST',
                    body: new URLSearchParams({
                        'email': this.email,
                        'password': this.password
                    })
                }
                fetch(url, config)
                    .then( response => response.json())
                    .then( data => {
                       if (data.token) document.cookie = 'token='+data.token+';SameSite=Lax'
                       e.target.submit()
                    })
                    .catch( error => console.log(error))
            }
        }
    }
</script>
