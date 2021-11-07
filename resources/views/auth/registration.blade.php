<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registracija</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Kreiraj nalog</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('registration.store')}}">
                                        @csrf
                                        @error('name')
                                        <div class="alert alert-danger p-1 small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="form-floating mb-3">
                                            <input name="name" class="form-control" id="inputName" type="text" placeholder="Unesi puno ime" value="{{old('name')}}" />
                                            <label for="inputName">Ime</label>
                                        </div>
                                        @error('username')
                                        <div class="alert alert-danger p-1 small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="form-floating mb-3">
                                            <input name="username" class="form-control" id="inputUsername" type="text" placeholder="Unesi username" value="{{old('username')}}" />
                                            <label for="inputName">Username</label>
                                        </div>
                                        @error('email')
                                        <div class="alert alert-danger p-1 small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="ime@primer.com" name="email" value="{{old('email')}}" />
                                            <label for="inputEmail">Email adresa</label>
                                        </div>
                                        @error('password')
                                        <div class="alert alert-danger p-1 small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="row mb-3 ">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Kreiraj lozinku" name="password" />
                                                    <label for="inputPassword">Lozinka</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Potvrdi lozinku" name="password_confirmation" />
                                                    <label for="inputPasswordConfirm">Potvrdi lozinku</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Registruj se</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="/login">Već imate nalog? Prijavite se</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>