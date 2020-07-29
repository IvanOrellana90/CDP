<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Category;

class CategoryController extends Controller
{
    // Obtener todas las Operations
    public function getOperations()
    {
        $operations = Category::select('id as key','name as label')->where('upper',3)->get();

        return response()->json($operations);
    }

    // Obtener todos los Beneficiaries
    public function getBeneficiaries()
    {
        $beneficiaries = Category::select('id as key','name as label')->where('upper',1)->get();

        return response()->json($beneficiaries);
    }

    // Obtener donde se obtuvo la info
    public function getInformation()
    {
        $beneficiaries = Category::select('id as key','name as label')->where('upper',80)->get();

        return response()->json($beneficiaries);
    }

    // Obtener tipos de Support
    public function getSupport()
    {
        $support = Category::select('id as key','name as label')->where('upper',2)->get();

        return response()->json($support);
    }

    // Obtener tipos de Organization
    public function getOrganizations()
    {
        $organizations = Category::select('id as key','name as label')->where('upper',4)->get();

        return response()->json($organizations);
    }

    // Obtener tipos de Help
    public function getHelps()
    {
        $helps = Category::select('id as key','name as label')->where('upper',5)->get();

        return response()->json($helps);
    }
}