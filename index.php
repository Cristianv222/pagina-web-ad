<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vpmotos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Orbitron:wght@400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php include './includes/menu.php'; ?>
  <header>
  <div class="carousel-container">
        <div class="carousel">
            <!-- Slides se añadirán dinámicamente con JavaScript -->
        </div>
        <div class="carousel-controls">
            <button class="control-btn prev-btn">&lt;</button>
            <button class="control-btn next-btn">&gt;</button>
        </div>
        <div class="carousel-indicators">
            <!-- Indicadores se añadirán dinámicamente con JavaScript -->
        </div>
  </header>
  <script src="./js/scripts.js"></script>
</body>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Audiowide&family=Orbitron:wght@400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    font-family: Orbitron, sans-serif;
}
.carousel-container {
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
    display: flex;
}
.carousel {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.5s ease;
}
.slide {
    min-width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    position: relative;
}
.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.slide-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 20px;
}
.slide-text {
    max-width: 50%;
    padding: 20px;
}
.slide-text h2 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}
.slide-text p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}
.action-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}
.carousel-controls {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}
.carousel-container:hover .carousel-controls {
    opacity: 1;
}
.control-btn {
    background: transparent;
    color: white;
    border: 2px solid white;
    font-size: 2rem;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0 15px;
    border-radius: 50%;
    outline: none;
    pointer-events: auto;
}
.control-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}
.carousel-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}
.indicator {
    width: 50px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background 0.3s ease;
}
.indicator.active {
    background: white;
}
@media (max-width: 768px) {
    .slide-content {
        flex-direction: column;
        justify-content: center;
    }
    .slide-text {
        max-width: 100%;
        text-align: center;
    }
    .control-btn {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
        margin: 0 10px;
    }
}
  
</style>