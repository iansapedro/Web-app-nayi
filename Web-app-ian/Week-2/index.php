<html>
    <body>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){ echo "<h2>Order Summary</h2>";

$coffee_prices = [
    "espresso" => 500,
    "frappe" => 500,
    "latte" => 500,
    "mocha" => 500,
];
$size_prices = [
    "small" => 30,
    "medium" => 60,
    "large" => 90, 
];
$extras_prices =[
    "sugar" => 10,
    "creamer" => 10,
];

$coffee_type = $_POST["coffee"];
$size = $_POST["size"];

if (isset ($_POST["extras"])) {
    $extras = $_POST["extras"];
}
else {
    $extras = [];
};

$total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

foreach($extras as $extra) {
    $total_price = $total_price + $extras_prices[$extra];
}
    echo $total_price;
    echo "<br/>";

    if ($coffee_type !== "espresso") {
        echo "Hey, " . htmlspecialchars($_POST["name"]) . "!";
        echo "<p>Here's a joke for you: Why did the coffee file a police report? It got mugged!</p>";
    }

    if ($total_price > 450 && $total_price < 650) {
        echo "<p> password for the cr is 12345678</p>";
    } elseif ($total_price >= 900) {
        echo "<p> password for WiFi is 87654321</p>";
    }
}

?>

</body>
</html>