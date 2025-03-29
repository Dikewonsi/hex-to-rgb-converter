<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hex & RGB Converter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Hex ↔ RGB Converter</h2>

        <form method="POST" class="space-y-4">
            <!-- HEX to RGB -->
            <div>
                <label class="block text-gray-700 font-medium">Hex Code:</label>
                <input type="text" name="hex" placeholder="#ff5733" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
                <button type="submit" name="convert_hex" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Convert to RGB
                </button>
            </div>

            <!-- RGB to HEX -->
            <div class="mt-4">
                <label class="block text-gray-700 font-medium">RGB (Comma separated):</label>
                <input type="text" name="rgb" placeholder="255,87,51" class="w-full p-2 border rounded-md focus:ring focus:ring-green-300">
                <button type="submit" name="convert_rgb" class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Convert to Hex
                </button>
            </div>
        </form>

        <div class="mt-4 p-3 bg-gray-200 rounded-md text-gray-800">
            <strong>Result:</strong>
            <?php
                function hexToRgb($hex) {
                    $hex = ltrim($hex, '#');
                    if (strlen($hex) == 3) {
                        $hex = preg_replace('/(.)/', '$1$1', $hex);
                    }
                    list($r, $g, $b) = sscanf($hex, "%02x%02x%02x");
                    return "rgb($r, $g, $b)";
                }

                function rgbToHex($r, $g, $b) {
                    return sprintf("#%02x%02x%02x", $r, $g, $b);
                }

                if (isset($_POST['convert_hex']) && !empty($_POST['hex'])) {
                    echo hexToRgb($_POST['hex']);
                }

                if (isset($_POST['convert_rgb']) && !empty($_POST['rgb'])) {
                    $rgb = explode(',', $_POST['rgb']);
                    if (count($rgb) == 3) {
                        echo rgbToHex(trim($rgb[0]), trim($rgb[1]), trim($rgb[2]));
                    } else {
                        echo "Invalid RGB format!";
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>
