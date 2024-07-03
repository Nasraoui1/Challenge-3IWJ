<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
    <style>
        /* Example styles, replace with your own */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-top: 0;
            padding-top: 20px;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            height: 150px; /* Adjust as needed */
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Créer une page</h1>
    <form action="/store-page" method="POST">
        <?php
        use App\Forms\CreatePage;

        // Get the form configuration
        $formConfig = CreatePage::getConfig();

        // Loop through each input field and render it
        foreach ($formConfig['inputs'] as $fieldName => $field) {
            $type = $field['type'];
            $placeholder = $field['placeholder'];
            $required = $field['required'] ? 'required' : '';
            $minLength = isset($field['min']) ? 'minlength="' . $field['min'] . '"' : '';
            $maxLength = isset($field['max']) ? 'maxlength="' . $field['max'] . '"' : '';
            $error = isset($field['error']) ? $field['error'] : '';

            // Start rendering the input group
            echo '<div class="form-group">';
            if (!empty($field['label'])) {
                echo '<label for="' . $fieldName . '">' . $field['label'] . '</label>';
            }

            // Render input or textarea based on type
            if ($type === 'textarea') {
                echo '<textarea id="' . $fieldName . '" name="' . $fieldName . '" placeholder="' . $placeholder . '" ' . $required . ' ' . $minLength . ' ' . $maxLength . '></textarea>';
            } else {
                echo '<input type="' . $type . '" id="' . $fieldName . '" name="' . $fieldName . '" placeholder="' . $placeholder . '" ' . $required . ' ' . $minLength . ' ' . $maxLength . '>';
            }

            // Display error message if available
            if (!empty($error)) {
                echo '<div class="error-message">' . $error . '</div>';
            }

            // Close the form group
            echo '</div>';
        }

        // Render submit button
        echo '<div class="form-group"><button type="submit">' . $formConfig['config']['submit'] . '</button></div>';
        ?>
    </form>
</div>
</body>
</html>
