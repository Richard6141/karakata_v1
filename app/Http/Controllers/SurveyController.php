<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('requestform.survey');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $request->validate([
        //     'age' => 'required|string',
        //     'sexe' => 'required',
        //     'location' => 'required',
        //     'profession' => 'required',
        //     'online_payment' => 'required',
        //     'why_not_paid' => 'required',
        //     'which_product' => 'required',
        //     'payment_frequency' => 'required',
        //     'payment_obstacles' => 'required',
        //     'choose_product_by_home_delivery' => 'required',
        //     'use_delivery_service' => 'required',
        //     'delivery_cost_influence_shop' => 'required',
        //     'free_delivery_all_product' => 'required',
        //     'online_payment_advantage' => 'required',
        //     'improve_free_delivery' => 'required',
        //     'online_payment_defi' => 'required',
        //     'yes_online_payment_if_resolve' => 'required',
        //     'which_improvment_fonctionality' => 'required',

        //     // 'type_composant' => 'required',
        // ]);
        // dd(Str::uuid());

        $urvey = new Survey();
        $urvey->id = Str::uuid();
        $survey->user_id = Auth::user()->id;
        $urvey->age = $request->age;
        $urvey->sexe = $request->sexe;
        $urvey->location = $request->location;
        $urvey->profession = $request->profession;
        $urvey->online_payment = $request->online_payment;
        $urvey->why_not_paid = $request->why_not_paid;
        $urvey->which_product = $request->which_product;
        $urvey->payment_frequency = $request->payment_frequency;
        $urvey->payment_obstacles = $request->payment_obstacles;
        $urvey->choose_product_by_home_delivery = $request->choose_product_by_home_delivery;
        $urvey->use_delivery_service = $request->use_delivery_service;
        $urvey->delivery_cost_influence_shop = $request->delivery_cost_influence_shop;
        $urvey->free_delivery_all_product = $request->free_delivery_all_product;
        $urvey->improve_free_delivery = $request->improve_free_delivery;
        $urvey->online_payment_advantage = $request->online_payment_advantage;
        $urvey->online_payment_defi = $request->online_payment_defi;
        $urvey->yes_online_payment_if_resolve = $request->yes_online_payment_if_resolve;
        $urvey->which_improvment_fonctionality = $request->which_improvment_fonctionality;
        $urvey->phone = $request->phone ?? null;
        $urvey->save();
        
        // $survey = Survey::create(
        //     [
        //         'id' => Str::uuid(),
        //         'user_id' => Auth::user()->id,
        //         'age' => $request->age,
        //         'sexe' => $request->sexe,
        //         'location' => $request->location,
        //         'profession' => $request->profession,
        //         'online_payment' => $request->online_payment,
        //         'why_not_paid' => $request->why_not_paid,
        //         'which_product' => $request->which_product,
        //         'payment_frequency' => $request->payment_frequency,
        //         'payment_obstacles' => ($request->payment_obstacles),
        //         'choose_product_by_home_delivery' => $request->choose_product_by_home_delivery,
        //         'use_delivery_service' => $request->use_delivery_service,
        //         'delivery_cost_influence_shop' => $request->delivery_cost_influence_shop,
        //         'free_delivery_all_product' => $request->free_delivery_all_product,
        //         'improve_free_delivery' => $request->improve_free_delivery,
        //         'online_payment_advantage' => $request->online_payment_advantage,
        //         'online_payment_defi' => $request->online_payment_defi,
        //         'yes_online_payment_if_resolve' => $request->yes_online_payment_if_resolve,
        //         'which_improvment_fonctionality' => $request->which_improvment_fonctionality,
        //         'phone' => $request->phone ?? null,
        //     ]);

        //     dd($Survey);

        // Survey::create($survey);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSurveyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurveyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurveyRequest  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
