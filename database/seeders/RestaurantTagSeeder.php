<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class RestaurantTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Paco Meralgo
        $pacoMeralgo = Restaurant::where('name', 'Paco Meralgo')->first();
        $comidaRapida = Tag::where('name', 'Comida Rápida')->first();
        $cafe         = Tag::where('name', 'Café')->first();
        $pacoMeralgo->tags()->attach([$comidaRapida->id, $cafe->id]);

        // Disfrutar
        $disfrutar    = Restaurant::where('name', 'Disfrutar')->first();
        $altaCocina   = Tag::where('name', 'Alta Cocina')->first();
        $comidaCasera = Tag::where('name', 'Comida Casera')->first();
        $disfrutar->tags()->attach([$altaCocina->id, $comidaCasera->id]);

        // Cocina Hermanos Torres
        $cocinaHT = Restaurant::where('name', 'Cocina Hermanos Torres')->first();
        $mediterranea = Tag::where('name', 'Mediterránea')->first();
        $francesa     = Tag::where('name', 'Francesa')->first();
        $cocinaHT->tags()->attach([$mediterranea->id, $francesa->id]);

        // Lasarte
        $lasarte = Restaurant::where('name', 'Lasarte')->first();
        $italiana = Tag::where('name', 'Italiana')->first();
        $lasarte->tags()->attach([$altaCocina->id, $italiana->id]);

        // ABaC
        $abac = Restaurant::where('name', 'ABaC')->first();
        $vegano = Tag::where('name', 'Vegano')->first();
        $abac->tags()->attach([$altaCocina->id, $vegano->id]);

        // Enoteca Paco Pérez
        $enoteca = Restaurant::where('name', 'Enoteca Paco Pérez')->first();
        $mariscos = Tag::where('name', 'Mariscos')->first();
        $enoteca->tags()->attach([$mariscos->id]);

        // Moments
        $moments = Restaurant::where('name', 'Moments')->first();
        $japonesa = Tag::where('name', 'Japonesa')->first();
        $moments->tags()->attach([$altaCocina->id, $japonesa->id]);

        // Cinc Sentits
        $cincSentits = Restaurant::where('name', 'Cinc Sentits')->first();
        $healthy = Tag::where('name', 'Healthy')->first();
        $cincSentits->tags()->attach([$healthy->id]);

        // Caelis
        $caelis = Restaurant::where('name', 'Caelis')->first();
        $buffet = Tag::where('name', 'Buffet')->first();
        $caelis->tags()->attach([$buffet->id]);

        // Alkimia
        $alkimia = Restaurant::where('name', 'Alkimia')->first();
        $vegetariano = Tag::where('name', 'Vegetariano')->first();
        $alkimia->tags()->attach([$vegetariano->id]);

        // Hisop
        $hisop = Restaurant::where('name', 'Hisop')->first();
        $sinGluten = Tag::where('name', 'Sin Gluten')->first();
        $hisop->tags()->attach([$sinGluten->id]);

        // Angle
        $angle = Restaurant::where('name', 'Angle')->first();
        $tacos = Tag::where('name', 'Tacos')->first();
        $angle->tags()->attach([$altaCocina->id, $tacos->id]);

        // Koy Shunka
        $koyShunka = Restaurant::where('name', 'Koy Shunka')->first();
        $sushi = Tag::where('name', 'Sushi')->first();
        $koyShunka->tags()->attach([$sushi->id]);

        // Tickets
        $tickets = Restaurant::where('name', 'Tickets')->first();
        $mexicana = Tag::where('name', 'Mexicana')->first();
        $tickets->tags()->attach([$mexicana->id]);

        // Gresca
        $gresca = Restaurant::where('name', 'Gresca')->first();
        $barbacoa = Tag::where('name', 'Barbacoa')->first();
        $gresca->tags()->attach([$barbacoa->id]);

        // Fismuler
        $fismuler = Restaurant::where('name', 'Fismuler')->first();
        $carnes = Tag::where('name', 'Carnes')->first();
        $fismuler->tags()->attach([$carnes->id]);

        // La Mundana
        $laMundana = Restaurant::where('name', 'La Mundana')->first();
        $organico = Tag::where('name', 'Orgánico')->first();
        $laMundana->tags()->attach([$organico->id]);

        // Bar Cañete
        $barCanete = Restaurant::where('name', 'Bar Cañete')->first();
        $pizzas = Tag::where('name', 'Pizzas')->first();
        $barCanete->tags()->attach([$pizzas->id]);

        // El Nacional
        $elNacional = Restaurant::where('name', 'El Nacional')->first();
        // Puedes asignarle un tag que represente su cocina tradicional, por ejemplo:
        $tacos = Tag::where('name', 'Tacos')->first();
        $elNacional->tags()->attach([$tacos->id]);

        // Can Pineda
        $canPineda = Restaurant::where('name', 'Can Pineda')->first();
        $canPineda->tags()->attach([$italiana->id]);

        // Xerta Restaurant
        $xerta = Restaurant::where('name', 'Xerta Restaurant')->first();
        $peruana = Tag::where('name', 'Peruana')->first();
        $xerta->tags()->attach([$peruana->id]);

        // Botafumeiro
        $botafumeiro = Restaurant::where('name', 'Botafumeiro')->first();
        $botafumeiro->tags()->attach([$carnes->id]);

        // Bar Mut
        $barMut = Restaurant::where('name', 'Bar Mut')->first();
        $hamburguesas = Tag::where('name', 'Hamburguesas')->first();
        $barMut->tags()->attach([$hamburguesas->id]);

        // Hofmann
        $hofmann = Restaurant::where('name', 'Hofmann')->first();
        $hofmann->tags()->attach([$buffet->id]);

        // Maná 75
        $mana75 = Restaurant::where('name', 'Maná 75')->first();
        $postres = Tag::where('name', 'Postres')->first();
        $mana75->tags()->attach([$postres->id]);

        // Bodega 1900
        $bodega1900 = Restaurant::where('name', 'Bodega 1900')->first();
        $bodega1900->tags()->attach([$cafe->id]);

        // Casa Leopoldo
        $casaLeopoldo = Restaurant::where('name', 'Casa Leopoldo')->first();
        $casaLeopoldo->tags()->attach([$comidaCasera->id]);

        // Espai Kru by Rías de Galicia
        $espaiKru = Restaurant::where('name', 'Espai Kru by Rías de Galicia')->first();
        $china = Tag::where('name', 'China')->first();
        $espaiKru->tags()->attach([$china->id]);

        // Suculent
        $suculent = Restaurant::where('name', 'Suculent')->first();
        $suculent->tags()->attach([$healthy->id]);

        // El Quim de la Boqueria
        $elQuim = Restaurant::where('name', 'El Quim de la Boqueria')->first();
        $elQuim->tags()->attach([$buffet->id]);
    }
}
