<?php
// Initialize an empty array to store user input numbers
$userNumbers = array();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input as a comma-separated string and convert it to an array
    $userInput = $_POST["user_numbers"];
    $userNumbers = explode(",", $userInput);

    // Remove any leading or trailing whitespace from each number
    $userNumbers = array_map('trim', $userNumbers);

    // Remove any empty elements
    $userNumbers = array_filter($userNumbers);

    // Initialize an empty associative array to store encountered numbers
    $encountered = array();

    // Initialize an array to store duplicate numbers
    $duplicates = array();

    foreach ($userNumbers as $number) {
        // Check if the number is numeric
        if (is_numeric($number)) {
            $number = (int)$number; // Convert the number to an integer
            // Check if the number has been encountered before
            if (isset($encountered[$number])) {
                // If it's encountered again, it's a duplicate
                $duplicates[] = $number;
            } else {
                // If it's the first encounter, mark it as encountered
                $encountered[$number] = true;
            }
        }
    }
}

// Output the duplicate numbers
if (!empty($duplicates)) {
    echo "Duplicate numbers in the input: " . implode(", ", $duplicates);
}else{
    echo "No duplicate numbers";
}
?>
<form method="POST" action="">
    <label for="user_numbers">Enter numbers (comma-separated):</label>
    <input type="text" name="user_numbers" id="user_numbers">
    <input type="submit" value="Check for duplicates">
</form>