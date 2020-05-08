<?php

namespace App\Http\Controllers;

use App\Laptop;
use Illuminate\Http\Request;

class AuxiliarController extends Controller
{
    public function exampleImage(Request $request){
        $binaryImage = "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";
        // $image = base64_encode($binaryImage->Image);
        // echo json_encode($image);
        echo json_encode($binaryImage);
    }

    public function laptopsOnAsignations(Request $request){
        $laptops = \App\Laptop::doesntHave('asignation')->get();
        echo json_encode($laptops);

    }
}
?>