<?php

namespace App\Core;

class Form
{
    private $config;
    private $errors = [];
    private $fields = [];

    public function __construct(string $name)
    {
        $formPath = "../Forms/" . $name . ".php";
        if (!file_exists($formPath)) {
            die("Le form " . $name . ".php n'existe pas dans le dossier ../Forms");
        }
        include $formPath;
        $formClass = "App\\Forms\\" . $name;
        $this->config = $formClass::getConfig();
    }

    public function setField($fieldName, $value)
    {
        $this->fields[$fieldName] = $value;
    }

    public function build(): string
    {
        $html = "";

        $enctype = $this->config["config"]["enctype"] ?? '';
        $html .= "<form action='" . htmlentities($this->config["config"]["action"]) . "' method='" . htmlentities($this->config["config"]["method"]) . "' enctype='" . htmlentities($enctype) . "'>";

        foreach ($this->config["inputs"] as $name => $input) {
            $value = $this->fields[$name] ?? '';

            if (isset($input["part"])) {
                $partTitle = htmlentities($input["part"]);
                $html .= "<h3>" . $partTitle . "</h3>";
            }

            $label = isset($input["label"]) ? "<label for='" . htmlentities($name) . "'>" . htmlentities($input["label"]) . "</label><br>" : '';

            switch ($input["type"]) {
                case "select":
                    $html .= $label;
                    $html .= "<select name='" . htmlentities($input["name"] ?? '') . "' " . ($input["required"] ? "required" : "") . " aria-label='" . htmlentities($input["label"]) . "' " . ($input["multiple"] ? "multiple" : "") . ">";
                    if (isset($input["option"]) && is_array($input["option"])) {
                        foreach ($input["option"] as $option) {
                            $selected = in_array($option['id'], (array)$value) ? "selected" : "";
                            $html .= "<option value='" . htmlentities($option['id']) . "' " . ($option["disabled"] ? "disabled" : "") . " $selected>" . htmlentities($option['name']) . "</option>";
                        }
                    }
                    $html .= "</select>";
                    break;

                case "checkbox":
                    $html .= $label;
                    if (isset($input["option"]) && is_array($input["option"])) {
                        foreach ($input["option"] as $option) {
                            $html .= "<label for='" . htmlentities($option['id']) . "'><img src='" . htmlentities($option['id']) . "'></label>";
                            $html .= "<input type='checkbox' name='" . htmlentities($name) . "' value='" . htmlentities($option['id']) . "'><br>";
                        }
                    }
                    break;

                case "custom":
                    $html .= $label;
                    if (isset($input["option"]) && is_array($input["option"])) {
                        $html .= "<ul id='menu-container'>";
                        foreach ($input["option"] as $option) {
                            $html .= "<li draggable='true' class='menu-item' id='" . htmlentities($option['id']) . "'>" . htmlentities($option['name']) . "</li>";
                        }
                        $html .= "</ul>";
                    }
                    break;

                case "textarea":
                    $html .= $label;
                    $html .= "<textarea name='" . htmlentities($name) . "' " . (isset($input["id"]) ? "id='" . htmlentities($input["id"]) . "'" : "") . " " . ($input["required"] ? "required" : "") . ">" . htmlentities($value) . "</textarea>";
                    break;

                case "submit":
                    $html .= $label;
                    $html .= "<input type='" . htmlentities($input["type"]) . "' name='" . htmlentities($name) . "' value='" . htmlentities($input["value"]) . "'>";
                    break;

                default:
                    $html .= $label;
                    $html .= "<input type='" . htmlentities($input["type"]) . "' name='" . htmlentities($name) . "' value='" . htmlentities($value) . "' " . (isset($input["id"]) ? "id='" . htmlentities($input["id"]) . "'" : "") . " " . ($input["required"] ? "required" : "") . ">";
                    break;
            }

            $html .= "<br>";
        }

        $html .= "<input type='submit' value='" . htmlentities($this->config["config"]["submit"]) . "'>";
        $html .= "</form>";

        if (!empty($this->errors)) {
            $html .= "<ul>";
            foreach ($this->errors as $error) {
                $html .= "<li>" . htmlentities($error) . "</li>";
            }
            $html .= "</ul>";
        }

        return $html;
    }

    public function isSubmitted(): bool
    {
        if ($this->config["config"]["method"] === "POST" && !empty($_POST)) {
            return true;
        } elseif ($this->config["config"]["method"] === "GET" && !empty($_GET)) {
            return true;
        }
        return false;
    }

    public function isValid(): bool
    {
        $this->errors = []; // Reset errors before validation

        foreach ($this->config["inputs"] as $name => $inputConfig) {
            if (!isset($inputConfig["type"]) || $inputConfig["type"] !== "submit") {

                // Check if the field is required and present
                if (isset($inputConfig["required"]) && $inputConfig["required"] === true) {
                    if (!isset($_POST[$name]) || empty(trim($_POST[$name]))) {
                        $this->errors[] = "Le champ " . htmlentities($name) . " ne doit pas être vide";
                        continue; // Skip further checks if field is required and missing
                    }
                }

                // Check if the field is present in the POST data
                if (isset($_POST[$name])) {
                    $dataSent = $_POST[$name];

                    // Check for unauthorized fields
                    if (!isset($this->config["inputs"][$name])) {
                        $this->errors[] = "Le champ " . htmlentities($name) . " n'est pas autorisé";
                    }

                    // Length checks
                    if (isset($inputConfig["min"]) && strlen($dataSent) < $inputConfig["min"]) {
                        $this->errors[] = $inputConfig["error"];
                    }
                    if (isset($inputConfig["max"]) && strlen($dataSent) > $inputConfig["max"]) {
                        $this->errors[] = $inputConfig["error"];
                    }

                    // Specific checks for email and password
                    if ($inputConfig["type"] === "email" && !filter_var($dataSent, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[] = "Le format de l'email est incorrect";
                    }
                    if ($inputConfig["type"] === "password" && strlen($dataSent) >= 8 &&
                        (!preg_match("#[a-z]#", $dataSent) || !preg_match("#[A-Z]#", $dataSent) || !preg_match("#[0-9]#", $dataSent))) {
                        $this->errors[] = $inputConfig["error"];
                    }

                    // Comment field specific check
                    if (isset($inputConfig['label']) && $inputConfig['label'] === "Laisser un commentaire" &&
                        preg_match('/(https?|ftp):\/\/([^\s]+)/i', $dataSent)) {
                        $this->errors[] = "Les URL ne sont pas autorisés dans le commentaire.";
                    }

                    // Confirmation field check
                    if (isset($inputConfig["confirm"]) && $dataSent != $_POST[$inputConfig["confirm"]]) {
                        $this->errors[] = $inputConfig["error"];
                    }
                }
            }
        }

        return empty($this->errors);
    }
    public function isValidd(): bool {
        $expectedFieldsCount = 0;
        foreach ($this->config["inputs"] as $name => $inputConfig) {
            if (!isset($inputConfig["type"]) || $inputConfig["type"] !== "submit") {
                if (isset($inputConfig["required"]) && $inputConfig["required"] === true) {
                    $expectedFieldsCount++;
                }
                if (isset($_POST[$name])) {
                    $expectedFieldsCount++;
                }
            }
        }




        foreach ($_POST as $name => $dataSent) {
            if (!isset($this->config["inputs"][$name])) {
                $this->errors[] = "Le champ " . htmlentities($name) . " n'est pas autorisé";
            }

            if (isset($this->config["inputs"][$name]["required"]) && empty($dataSent)) {
                $this->errors[] = "Le champ " . htmlentities($name) . " ne doit pas être vide";
            }

            if (isset($this->config["inputs"][$name]["min"]) && strlen($dataSent) < $this->config["inputs"][$name]["min"]) {
                $this->errors[] = $this->config["inputs"][$name]["error"];
            }

            if (isset($this->config["inputs"][$name]["max"]) && strlen($dataSent) > $this->config["inputs"][$name]["max"]) {
                $this->errors[] = $this->config["inputs"][$name]["error"];
            }

            if (isset($this->config['inputs'][$name]['label']) && $this->config['inputs'][$name]['label'] === "Laisser un commentaire" && preg_match('/(https?|ftp):\/\/([^\s]+)/i', $dataSent)) {
                $this->errors[] = "Les URL ne sont pas autorisés dans le commentaire.";
            }

            if (isset($this->config["inputs"][$name]["confirm"]) && $dataSent != $_POST[$this->config["inputs"][$name]["confirm"]]) {
                $this->errors[] = $this->config["inputs"][$name]["error"];
            } else {
                if ($this->config["inputs"][$name]["type"] === "email" && !filter_var($dataSent, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[] = "Le format de l'email est incorrect";
                }

                if ($this->config["inputs"][$name]["type"] === "password" && strlen($dataSent) >= 8 &&
                    (!preg_match("#[a-z]#", $dataSent) || !preg_match("#[A-Z]#", $dataSent) || !preg_match("#[0-9]#", $dataSent))) {
                    $this->errors[] = $this->config["inputs"][$name]["error"];
                }
            }
        }

        return empty($this->errors);
    }

}


