<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodybuilding Program</title>

    <style>
        /* Bodybuilding */

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

.bodybuilding_top {
    display: flex;
    background: var(--color-gray);
    padding: 0;
    align-items: center;
    justify-content: space-between;
    height: 110px;
    padding: 0 20px;
    color: var(--color-white);
}

.bodybuilding_top h1 {
    margin-right: 50px;
    color: var(--color-gold-dark);
    font-size: 40px;
}

.bodybuilding_top button {
    margin-left: 50px;
    background-color: var(--color-black);
    color: var(--color-white);
    border: 2px solid var(--color-gold);
    padding: 12px 25px;
    border-radius: 5px;
    cursor: pointer;
}

.bodybuilding_top button:hover {
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

.body-title {
    text-align: center;
    margin-bottom: 60px;
    margin-top: 50px;
}

.body-title h1 {
    color: var(--color-gold-dark);
    font-size: 50px;
}

.body-title p {
    font-size: 25px;
}

.building-choices {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 50px;
}

.building-choices div {
    border: 2px solid var(--color-gold);
    text-align: center;
    background-color: var(--color-gray);
    padding: 0;
    border-radius: 5px;
    color: var(--color-white);
    flex: 1; /* Ensures all columns have the same width */
    max-width: 400px; /* Optional: Set a maximum width for each column */
}

.building-choices div h1 {
    background-color: var(--color-gold);
    padding: 10px;
    color: var(--color-black);
    border-radius: 5px 5px 0 0;
    margin: 0;
}

.building-choices div p {
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
    <div class="bodybuilding_top">
        <button onclick="history.back()">Back</button>
        <h1>Iron Forge Gym</h1>
    </div>
</header>
<body>
    <div class="body-title">
        <h1>Workout Offers</h1>
        <p>Crush your fitness goals with our workout offers that targets every muscle, <br> maximizes efficiency, and keeps your progress on track!</p>
    </div>

    <div class="building-choices">
        <div>
            <h1>Split Routines</h1>
            <p>Focus on different muscle groups each day (e.g., chest and triceps on Monday, back and biceps on Tuesday).</p>
        </div>
        <div>
            <h1>Full-Body Workouts</h1>
            <p>Train all major muscle groups in a single session, ideal for beginners or time-constrained schedules.</p>
        </div>
        <div>
            <h1>Push-Pull-Legs (PPL)</h1>
            <p>A popular three-day or six-day split that organizes workouts into pushing (chest, shoulders, triceps), pulling (back, biceps), and legs.</p>
        </div>
    </div>
</body>
</html>
