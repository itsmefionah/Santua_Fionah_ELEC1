<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcuController extends Controller
{
    public function calculate($operation, $value1, $value2)// itong function ang magri-receive ng three parameters from the URL
    {
        switch ($operation) {// itong switch statement ang magchicheck ng value ng $operation para ma-determine kung anong arithmerthic operation ang gagamitin
            case 'multiply': // if yung $operation is 'multiply'
                $result = $value1 * $value2; // imu-multiply niya yung $value1 and $value2 tapos store niya sa $result
                break; 
            case 'divide': //if yung $operation is 'divide' 
                if ($value2 == 0) { //ichi-check niya if yung $value2 ay 0, kapag true
                    return "<h1 style='color: red;'>Error: Cannot divide by zero</h1>"; // iri-return niya itong error message, kung hindi naman
                }
                $result = $value1 / $value2; // gagawin niya ito, idi-divide niya yung $value1 and $value2 tapos store niya sa $result
                break;
            case 'add': //if yung $operation is 'add' 
                $result = $value1 + $value2; //ia-add niya yung $value1 and $value2 tapos store niya sa $result
                break;
            case 'subtract': //if yung $operation is 'subtract'
                $result = $value1 - $value2; //isu-subtract niya yung $value1 and $value2 tapos store niya sa $result
                break;
            default: //if yung $operation ay hindi nagtugma sa mga defined cases
                return "<h2 style='color: red;'>Error: Invalid operation</h2>"; //iri-return niya itong error message, na nagsasabing yung operation ay invalid
        }

        //yung function returns yung buong output as string, na kinabibilangan ng mga na-format na values and result
        return "<h3>Fionah Santua 3A</h3>"
                ."Value 1: <span style='color: " . ($value1 % 2 == 0 ? "orange" : "blue") . ";'>$value1</span><br>"
                . "Value 2: <span style='color: " . ($value2 % 2 == 0 ? "orange" : "blue") . ";'>$value2</span><br>"
                . "Operator: <span>$operation</span>" //ipapakita lang neto kung anong operator ang ginamit para sa calculation
                . "<div style='color: " . ($result % 2 == 0 ? "green" : "blue") . ";'>Result (Displayed in " 
                . ($result % 2 == 0 ? "green" : "blue") . "): "
                . "<span style='color: white; background-color: " . ($result % 2 == 0 ? "green" : "blue") . "; padding: 10px 50px;'>$result</span></div>";
        //gumamit ako ng ternary operator para mapalitan ang text color at background color ng output, ichecheck nito kung even ba or odd ung input ng user
        //kapag even ung input ng user ang text color ay orange kung odd ito ay blue
        
    }
}
