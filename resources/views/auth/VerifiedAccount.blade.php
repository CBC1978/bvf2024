<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Confirmation</title>
    <link
        rel="canonical"
        href="https://www.wrappixel.com/templates/materialpro/"
    />
    <!-- Favicon icon -->
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('src/assets/images/favicon.png') }}"
    />
    <!-- Custom CSS -->
    <link href="{{ asset('src/dist/css/style.min.css') }}" rel="stylesheet" />

    <style>
    .card-body {
        width: 500px; /* Vous pouvez ajuster la largeur selon vos besoins */
        height: 500px; /* La même hauteur que la largeur pour rendre le card-body carré */
        margin: auto; /* Pour centrer horizontalement */
        text-align: center; /* Pour centrer le contenu à l'intérieur du card-body */
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</head>
<body>
<div class="card">
    <div class="card-body">
        <div class="auth-box p-4 bg-white rounded">               
            <div class="row mt-3 form-material">
                <!-- Form -->
                <div class="text-center">
                    <p class="font-sm text-brand-2"></p>
                    <h2 class="mt-10 mb-5 text-brand-1">Compte vérifié avec succès</h2>
                    <p class="font-sm text-muted mb-30"></p>
                </div>
                
                <div class="text-muted text-center">
                    <h5>
                    Connectez-vous et profitez des opportunités de la Bourse Virtuelle
                    </h5>
                    <a href="{{ route('index') }}" class="btn btn-primary mt-3">Connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>
    

    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <script src="{{ asset('src/dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('src/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- -------------------------------------------------------------- -->
    <!-- Ajoutez vos scripts JavaScript ici -->
    <!-- -------------------------------------------------------------- -->

</body>
</html>
