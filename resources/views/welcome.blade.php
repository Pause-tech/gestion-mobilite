<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilité Étudiante - Candidature</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <!-- Barre de navigation -->
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">Mobilité Étudiante</h1>
            <div class="menu">
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}" class="register-btn">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Section principale -->
    <section class="hero">
        <div class="container">
            <h2>Postulez pour des Programmes de Mobilité Internationale</h2>
            <p>Accédez à des opportunités uniques de stages, d'échanges universitaires et de programmes internationaux.</p>
            <a href="{{ route('login') }}" class="cta-button">Candidater Maintenant</a>
        </div>
    </section>

    <!-- Section des avantages -->
    <section class="benefits">
        <div class="container">
            <h2>Pourquoi Participer ?</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h3>Élargir vos horizons</h3>
                    <p>Découvrez de nouvelles cultures et enrichissez vos expériences personnelles et professionnelles.</p>
                </div>
                <div class="benefit-card">
                    <h3>Développer vos compétences</h3>
                    <p>Acquérez des compétences internationales qui renforceront votre CV.</p>
                </div>
                <div class="benefit-card">
                    <h3>Opportunités de carrière</h3>
                    <p>Rencontrez des employeurs internationaux et boostez votre carrière.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="footer">
        <p>&copy; 2025 Mobilité Étudiante. Tous droits réservés.</p>
    </footer>

</body>
</html>
<style>
    /* Importation de la police */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Barre de navigation */
.navbar {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 90%;
    margin: auto;
}

.navbar .logo {
    font-size: 1.5em;
    font-weight: bold;
}

.navbar .menu a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
    font-weight: 500;
}

.navbar .menu .register-btn {
    background-color: #28a745;
    padding: 10px 15px;
    border-radius: 5px;
}

/* Section principale */
.hero {
    background-image: url('{{ asset('images/hero-background.jpg') }}');
    color: white;
    text-align: center;
    padding: 150px 20px;
    position: relative;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Fond sombre semi-transparent */
    z-index: 1;
}

.hero .container {
    position: relative;
    z-index: 2; /* Place le texte au-dessus du fond */
}

.hero h2 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: white; /* Assure que le texte reste blanc */
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 30px;
    color: white; /* Texte clair */
}

.hero .cta-button {
    background-color: #007bff;
    padding: 15px 30px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.1em;
}

.hero .cta-button:hover {
    background-color: #0056b3;
}
/* Section des avantages */
.benefits {
    padding: 60px 20px;
    background-color: #fff;
}

.benefits h2 {
    text-align: center;
    margin-bottom: 40px;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.benefit-card {
    background-color: #007bff;
    color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

/* Pied de page */
.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 15px 0;
    margin-top: 20px;
}

</style>
