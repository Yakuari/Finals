<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Program</title>

    <style>
        /* Fitness */

:root {
    --color-black: #0A0A0A;
    --color-white: #FFFFFF;
    --color-gray: #1E1E1E;
    --color-gold: #D4AF37;
    --color-gold-dark: #BF9B30;
    --color-overlay: rgba(0,0,0,0.6);
}

header {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    background-color: var(--color-gray);
    border-bottom: 3px solid var(--color-gold);
}

.fitness-top {
    display: flex;
    background: var(--color-gray);
    padding: 0;
    align-items: center;
    justify-content: space-between;
    height: 110px;
    padding: 0 20px;
    color: var(--color-white);
}

.fitness-top h1 {
    margin-right: 50px;
    color: var(--color-gold-dark);
    font-size: 40px;
}

.fitness-top button {
    margin-left: 50px;
    background-color: var(--color-black);
    color: var(--color-white);
    border: 2px solid var(--color-gold);
    padding: 12px 25px;
    border-radius: 5px;
    cursor: pointer;
}

.fitness-top button:hover {
    background-color: var(--color-gray);
}

body {
    background-color: var(--color-black);
    color: var(--color-white);
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    padding-top: 130px; /* To account for the fixed header */
}

.fitness-title {
    text-align: center;
    margin-bottom: 60px;
    margin-top: 50px;
}

.fitness-title h1 {
    color: var(--color-gold-dark);
    font-size: 50px;
}

.fitness-title p {
    font-size: 25px;
}

.fitness-choices {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 50px;
}

.fitness-choices div {
    border: 2px solid var(--color-gold);
    text-align: center;
    background-color: var(--color-gray);
    padding: 0;
    border-radius: 5px;
    color: var(--color-white);
    flex: 1; /* Ensures all columns have the same width */
    max-width: 400px; /* Optional: Set a maximum width for each column */
}

.fitness-choices div h1 {
    background-color: var(--color-gold);
    padding: 10px;
    color: var(--color-black);
    border-radius: 5px 5px 0 0;
    margin: 0;
}

.fitness-choices div p {
    margin-top: 20px;
    background-color: var(--color-gray);
    padding: 10px;
    border-top: none;
    border-radius: 0 0 5px 5px;
    font-size: 20px;
}
    </style>

</head>

<header>
    <div class="fitness-top">
        <button onclick="history.back()">Back</button>
        <h1>Iron Forge Gym</h1>
    </div>
</header>
<body>
    <div class="fitness-title">
        <h1>Fitness Transformation Programs</h1>
        <p>Choose a path tailored to your fitness journey with focused programs designed <br>
        to help you lose weight, build muscle, or enhance athletic performance. Start transforming today!</p>
    </div>

    <div class="fitness-choices">
    <div>
        <h1>Weight Loss Intensive</h1>
        <p>Comprehensive 12-week program combining high-intensity
        interval training, metabolic conditioning, and personalized nutrition planning
        to accelerate fat loss and boost metabolism.
        </p>

    </div>
    <div>
        <h1> Muscle Building</h1>
        <p>Structured strength training program focused on progressive overload,
        optimal muscle hypertrophy, and strategic nutrition to help you build lean muscle mass effectively.</p>
    </div>
    <div>
        <h1>Athletic Performance</h1>
        <p>Advanced training designed for athletes and fitness enthusiasts to improve
        strength, speed, agility, and overall athletic performance through periodized training methods.</p>
    </div>
</div>
</body>
</html>
