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

.container.header-content {
    display: flex;
    background: var(--color-gray);
    padding: 0;
    align-items: center;
    justify-content: space-between;
    height: 110px;
    padding: 0 20px;
    color: var(--color-white);
}

.container.header-content h1 {
    margin-right: 50px;
    color: var(--color-gold-dark);
    font-size: 40px;
}

.container.header-content button {
    margin-left: 50px;
    background-color: var(--color-black);
    color: var(--color-white);
    border: 2px solid var(--color-gold);
    padding: 12px 25px;
    border-radius: 5px;
    cursor: pointer;
}

.container.header-content button:hover {
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

.weightloss-header {
    text-align: center;
    margin-bottom: 60px;
    margin-top: 50px;
}

.weightloss-header h2 {
    color: var(--color-gold-dark);
    font-size: 50px;
}

.weightloss-header p {
    font-size: 25px;
}

.weightloss-grid {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 50px;
}

.weightloss-card {
    border: 2px solid var(--color-gold);
    text-align: center;
    background-color: var(--color-gray);
    padding: 0;
    border-radius: 5px;
    color: var(--color-white);
    flex: 1; /* Ensures all columns have the same width */
    max-width: 400px; /* Optional: Set a maximum width for each column */
}

.weightloss-card-header {
    background-color: var(--color-gold);
    padding: 10px;
    color: var(--color-black);
    border-radius: 5px 5px 0 0;
    margin: 0;
}

.weightloss-card-content {
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
    <div class="container header-content">
        <button onclick="history.back()">Back</button>
        <h1>Iron Forge Gym</h1>
    </div>
</header>

<main class="weightloss container">
        <div class="weightloss-header">
            <h2>WeightLoss</h2>
            <p>A successful weight loss program typically involves three important components:</p>
        </div>
    <div class="weightloss-grid">
            <div class="weightloss-card">
                <div class="weightloss-card-header">
                    <h3>Healthy Diet</h3>
                </div>
                <div class="weightloss-card-content">
                    <p>A balanced diet is key to losing weight. This means consuming fewer calories than you burn while ensuring your body gets the nutrients it needs. Focus on whole foods, including fruits, vegetables, lean proteins, whole grains, and healthy fats. Reducing processed foods, sugars, and excessive fats is crucial.</p>
                </div>
            </div>
            <div class="weightloss-card">
                <div class="weightloss-card-header">
                    <h3>Regular Physical Activity</h3>
                </div>
                <div class="weightloss-card-content">
                    <p>Exercise helps burn calories and build muscle, which increases your metabolism. Aim for a combination of aerobic exercises (like walking, running, or cycling) and strength training (such as weightlifting or bodyweight exercises).</p>
                    
                    <p>Consistency is the Key!</p>
                </div>
            </div>
            <div class="weightloss-card">
                <div class="weightloss-card-header">
                    <h3>Behavioral Changes and Mindset</h3>
                </div>
                <div class="weightloss-card-content">
                    <p>Weight loss is not just about diet and exercise—it's about making lasting lifestyle changes. This includes setting realistic goals, managing stress, getting enough sleep, and developing a positive attitude towards your progress. Tracking your food, activity, and progress can also help maintain motivation.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
