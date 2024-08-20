<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgeGroupResource;
use App\Models\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AgeGroupController extends Controller
{
    /**
     * Display a listing of the ageGroups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ageGroups = AgeGroup::all();
        return Inertia::render('AgeGroup/Index', [
            'ageGroups' => AgeGroupResource::collection($ageGroups),
        ]);
    }

     /**
     * Display the specified ageGroup.
     *
     * @param  \App\Models\AgeGroup  $ageGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AgeGroup $ageGroup)
    {
        return Inertia::render('AgeGroup/Show', [
            'ageGroup' => new AgeGroupResource($ageGroup),
        ]);
    }
}
