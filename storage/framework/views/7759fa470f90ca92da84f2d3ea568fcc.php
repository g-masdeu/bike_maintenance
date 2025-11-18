<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e(config('app.name', 'Bike Maintenance')); ?></title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #f5f5f5, #ffffff);
        color: #333;
        overflow: hidden; /* sense scroll */
        display: flex;
        flex-direction: column;
    }
    a { text-decoration: none; }
    header {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        padding: 0.5rem 2rem;
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        height: 50px;
    }
    header h1 { margin: 0; font-size: 1.2rem; }
    nav a { margin-left: 1rem; font-size: 0.85rem; }
    nav a.button {
        background-color: #1d4ed8;
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }
    nav a.button:hover { background-color: #2563eb; }

    .hero-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 1rem;
        flex:1;
    }

    .hero-container h2 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #1d4ed8, #6366f1, #9333ea);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-container p {
        font-size: 1rem;
        margin-bottom: 1rem;
        max-width: 400px;
    }
    .hero-container .buttons a {
        display: inline-block;
        margin: 0.3rem;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        font-weight: bold;
        font-size: 0.9rem;
    }
    .hero-container .buttons a.primary {
        background-color: #1d4ed8;
        color: white;
    }
    .hero-container .buttons a.primary:hover { background-color: #2563eb; }
    .hero-container .buttons a.secondary {
        border: 2px solid #1d4ed8;
        color: #1d4ed8;
    }
    .hero-container .buttons a.secondary:hover { background-color: #e0e7ff; }

    .features {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    .feature-card {
        background: #fff;
        border-radius: 0.25rem;
        padding: 0.5rem 1rem;
        max-width: 120px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        font-size: 0.75rem;
    }
    .feature-card .icon { font-size: 1.5rem; margin-bottom: 0.3rem; }

    footer {
        text-align: center;
        font-size: 0.75rem;
        padding: 0.3rem 0;
        background: #fafafa;
        border-top: 1px solid #ddd;
    }

    .fonsHeaderFooter {
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        background-size: 200% 200%;
        animation: oceanWave 35s ease-in-out infinite;
        position: relative;
        color: white;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .fonsHeaderFooter::before {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 70% 50%, rgba(16, 185, 129, 0.08), transparent 70%);
        animation: underwater 25s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes oceanWave {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes underwater {
        0%, 100% { transform: translate(0, 0); opacity: 0.4; }
        50% { transform: translate(5px, 5px); opacity: 0.7; }
    }
</style>
</head>
<body>
    <div class="h-screen">

    </div>
    <!-- Header -->
    <header class="fonsHeaderFooter">
        <h1><?php echo e(config('app.name', 'Bike Maintenance')); ?></h1>
        <nav>
            <a href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a>
            <a href="<?php echo e(route('register')); ?>" class="button"><?php echo e(__('messages.register')); ?></a>
        </nav>
    </header>

    <!-- Hero -->
    <div class="hero-container">
        <h2><?php echo e(__('messages.hero_title')); ?></h2>
        <p><?php echo e(__('messages.hero_text')); ?></p>
        <div class="buttons">
            <a href="<?php echo e(route('register')); ?>" class="primary"><?php echo e(__('messages.start_now')); ?></a>
            <a href="<?php echo e(route('login')); ?>" class="secondary"><?php echo e(__('messages.already_account')); ?></a>
        </div>

        <div class="features">
            <div class="feature-card">
                <div class="icon">🚴‍♂️</div>
                <?php echo e(__('messages.feature_kilometers')); ?>

            </div>
            <div class="feature-card">
                <div class="icon">🛠️</div>
                <?php echo e(__('messages.feature_maintenance')); ?>

            </div>
            <div class="feature-card">
                <div class="icon">⚡</div>
                <?php echo e(__('messages.feature_biketype')); ?>

            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="fonsHeaderFooter">
        &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Bike Maintenance')); ?> · Guillem Masdeu de Maria
    </footer>

</body>
</html>
<?php /**PATH C:\daw\dwm\bike_maintenance\resources\views/welcome.blade.php ENDPATH**/ ?>