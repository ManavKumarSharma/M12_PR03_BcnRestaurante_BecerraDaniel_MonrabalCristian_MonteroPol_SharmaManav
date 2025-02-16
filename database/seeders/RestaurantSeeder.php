<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Carbon\Carbon;
use DateTime;
use Faker\Core\DateTime as CoreDateTime;
use Faker\Provider\DateTime as ProviderDateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Restaurant::create([
            'name' => 'Paco Meralgo',
            'description' => 'Paco Meralgo es más que una taberna. Tapas, medias raciones o raciones elaboradas, creativas y siempre con los mejores productos. No resulta tapeo barato pero se paga la calidad y la exquisitez. Buena selección de vinos. Conviene reservar.',
            'location' => '41.398208, 2.153359',
            'img_restaurant' => 'pacomeralgo.jpg',
            'average_price' => 100,
            'phone' => '+34 666 777 999',
            'opening_hours' => '09:00',
            'closing_hours' => '23:00',  
            'manager_id' => 5, 
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $now = now();

        Restaurant::create([
            'name' => 'Disfrutar',
            'description' => 'Restaurante galardonado con tres estrellas Michelin, reconocido como el mejor del mundo en 2024. Ofrece una experiencia culinaria innovadora con raíces en el legado de El Bulli.',
            'location' => '41.398208, 2.153359',
            'img_restaurant' => 'disfrutar.jpg',
            'average_price' => 250,
            'phone' => '+34 933 481 754',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 6,
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Cocina Hermanos Torres',
            'description' => 'Con tres estrellas Michelin, este restaurante ofrece alta cocina mediterránea en un espacio donde la cocina abierta es el centro de la experiencia gastronómica.',
            'location' => '41.393060, 2.147384',
            'img_restaurant' => 'cocina_hermanos_torres.jpg',
            'average_price' => 180,
            'phone' => '+34 933 562 173',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 7,
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Lasarte',
            'description' => 'Dirigido por el chef Martín Berasategui, este restaurante de tres estrellas Michelin ofrece una propuesta culinaria que destaca por su creatividad y excelencia.',
            'location' => '41.396267, 2.162080',
            'img_restaurant' => 'lasarte.jpg',
            'average_price' => 210,
            'phone' => '+34 934 675 300',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 8,
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'ABaC',
            'description' => 'Bajo la dirección del chef Jordi Cruz, ABaC cuenta con tres estrellas Michelin y ofrece una cocina creativa que combina tradición e innovación.',
            'location' => '41.411003, 2.128016',
            'img_restaurant' => 'abac.jpg',
            'average_price' => 230,
            'phone' => '+34 933 000 531',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 9,
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Enoteca Paco Pérez',
            'description' => 'Con dos estrellas Michelin, este restaurante en el Hotel Arts Barcelona ofrece una cocina mediterránea de autor con una extensa bodega de más de 700 vinos.',
            'location' => '41.378377, 2.192930',
            'img_restaurant' => 'enoteca_paco_perez.jpg',
            'average_price' => 200,
            'phone' => '+34 933 221 222',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 10,
            'zones_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Moments',
            'description' => 'Ubicado en el Hotel Mandarin Oriental y dirigido por la chef Carme Ruscalleda y su hijo Raül Balam, Moments cuenta con dos estrellas Michelin y ofrece una cocina catalana moderna.',
            'location' => '41.393523, 2.022100',
            'img_restaurant' => 'moments.jpg',
            'average_price' => 220,
            'phone' => '+34 933 480 003',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 6,
            'zones_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Cinc Sentits',
            'description' => 'Restaurante de dos estrellas Michelin que ofrece una experiencia gastronómica contemporánea catalana, destacando por su atención al detalle y la calidad de sus ingredientes.',
            'location' => '41.382465, 2.159634',
            'img_restaurant' => 'cinc_sentits.jpg',
            'average_price' => 180,
            'phone' => '+34 933 227 374',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 7,
            'zones_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Caelis',
            'description' => 'Con una estrella Michelin, Caelis ofrece una cocina francesa contemporánea bajo la dirección del chef Romain Fornell, en un ambiente elegante y sofisticado.',
            'location' => '41.383654, 2.179875',
            'img_restaurant' => 'caelis.jpg',
            'average_price' => 190,
            'phone' => '+34 933 022 513',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 8,
            'zones_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Alkimia',
            'description' => 'Este restaurante con una estrella Michelin ofrece una reinterpretación moderna de la cocina catalana, utilizando ingredientes locales y técnicas innovadoras.',
            'location' => '41.373758, 2.151182',
            'img_restaurant' => 'alkimia.jpg',
            'average_price' => 170,
            'phone' => '+34 934 411 395',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 9,
            'zones_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Hisop',
            'description' => 'Con una estrella Michelin, Hisop se especializa en cocina catalana contemporánea, destacando por su creatividad y uso de productos de temporada.',
            'location' => '41.406875, 2.143529',
            'img_restaurant' => 'hisop.jpg',
            'average_price' => 160,
            'phone' => '+34 932 018 029',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 10,
            'zones_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Angle',
            'description' => 'Restaurante de una estrella Michelin dirigido por el chef Jordi Cruz, que ofrece una cocina creativa y técnica en un ambiente elegante.',
            'location' => '41.396870, 2.164508',
            'img_restaurant' => 'angle.jpg',
            'average_price' => 180,
            'phone' => '+34 933 620 754',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 11,
            'zones_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Koy Shunka',
            'description' => 'Restaurante japonés con una estrella Michelin, reconocido por su alta calidad y autenticidad en la preparación de sushi y otros platos tradicionales.',
            'location' => '41.382671, 2.179908',
            'img_restaurant' => 'koy_shunka.jpg',
            'average_price' => 150,
            'phone' => '+34 933 415 211',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 12,
            'zones_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Tickets',
            'description' => 'Creado por Albert Adrià, Tickets ofrece una experiencia gastronómica lúdica y vanguardista, reinterpretando el concepto de las tapas tradicionales.',
            'location' => '41.375655, 2.160504',
            'img_restaurant' => 'tickets.jpg',
            'average_price' => 100,
            'phone' => '+34 933 289 284',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 13,
            'zones_id' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Gresca',
            'description' => 'Restaurante y bar de vinos que combina una cocina creativa con una extensa selección de vinos naturales, en un ambiente informal y acogedor.',
            'location' => '41.397511, 2.164701',
            'img_restaurant' => 'gresca.jpg',
            'average_price' => 70,
            'phone' => '+34 934 457 700',
            'opening_hours' => '13:30',
            'closing_hours' => '15:30',
            'manager_id' => 14,
            'zones_id' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Fismuler',
            'description' => 'Conocido por su cocina de mercado y platos que destacan por su sencillez y sabor, Fismuler ofrece una experiencia gastronómica contemporánea en un ambiente desenfadado.',
            'location' => '41.383567, 2.179838',
            'img_restaurant' => 'fismuler.jpg',
            'average_price' => 90,
            'phone' => '+34 933 153 508',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 15,
            'zones_id' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'La Mundana',
            'description' => 'Este restaurante fusiona la cocina mediterránea con influencias japonesas y francesas, ofreciendo tapas y platillos creativos en un ambiente acogedor.',
            'location' => '41.374290, 2.136420',
            'img_restaurant' => 'la_mundana.jpg',
            'average_price' => 80,
            'phone' => '+34 934 897 443',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 16,
            'zones_id' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'Bar Cañete',
            'description' => 'Conocido por sus tapas tradicionales y ambiente animado, Bar Cañete es un lugar emblemático para disfrutar de la cocina.',
            'location' => '41.379870, 2.170140',
            'img_restaurant' => 'bar_canete.jpg',
            'average_price' => 50,
            'phone' => '+34 933 181 138',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 17,
            'zones_id' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Restaurant::create([
            'name' => 'El Nacional',
            'description' => 'Un espacio gastronómico con diferentes restaurantes y bares que ofrecen cocina tradicional española y mediterránea.',
            'location' => '41.391457, 2.164710',
            'img_restaurant' => 'el_nacional.jpg',
            'average_price' => 50,
            'phone' => '+34 935 739 669',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 18,
            'zones_id' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Can Pineda',
            'description' => 'Restaurante clásico con más de 100 años de historia, especializado en cocina catalana con productos de primera calidad.',
            'location' => '41.423238, 2.188130',
            'img_restaurant' => 'can_pineda.jpg',
            'average_price' => 85,
            'phone' => '+34 933 191 012',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 19,
            'zones_id' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Xerta Restaurant',
            'description' => 'Restaurante de una estrella Michelin que ofrece cocina de las Tierras del Ebro con un toque innovador.',
            'location' => '41.394208, 2.161749',
            'img_restaurant' => 'xerta_restaurant.jpg',
            'average_price' => 130,
            'phone' => '+34 933 160 235',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 20,
            'zones_id' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Botafumeiro',
            'description' => 'Uno de los mejores restaurantes de mariscos en Barcelona, famoso por su cocina gallega y pescados frescos.',
            'location' => '41.406122, 2.162528',
            'img_restaurant' => 'botafumeiro.jpg',
            'average_price' => 100,
            'phone' => '+34 933 185 400',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 21,
            'zones_id' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Bar Mut',
            'description' => 'Pequeño bar de tapas gourmet con una gran selección de vinos y platos creativos de inspiración mediterránea.',
            'location' => '41.398271, 2.179935',
            'img_restaurant' => 'bar_mut.jpg',
            'average_price' => 65,
            'phone' => '+34 933 684 271',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 22,
            'zones_id' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Hofmann',
            'description' => 'Restaurante con una estrella Michelin, perteneciente a la prestigiosa escuela de hostelería Hofmann, con una cocina refinada y elegante.',
            'location' => '41.397505, 2.159693',
            'img_restaurant' => 'hofmann.jpg',
            'average_price' => 180,
            'phone' => '+34 933 189 573',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 23,
            'zones_id' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Maná 75',
            'description' => 'Conocido por su paella y arroces en un ambiente moderno y luminoso cerca de la playa de la Barceloneta.',
            'location' => '41.378421, 2.191399',
            'img_restaurant' => 'mana_75.jpg',
            'average_price' => 70,
            'phone' => '+34 931 943 540',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 24,
            'zones_id' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Bodega 1900',
            'description' => 'Un homenaje a las antiguas bodegas de vermut, con tapas clásicas y productos de calidad seleccionados por Albert Adrià.',
            'location' => '41.378536, 2.158850',
            'img_restaurant' => 'bodega_1900.jpg',
            'average_price' => 50,
            'phone' => '+34 933 482 108',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 25,
            'zones_id' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Casa Leopoldo',
            'description' => 'Restaurante histórico en el Raval, famoso por su cocina catalana y sus guisos tradicionales.',
            'location' => '41.379835, 2.168905',
            'img_restaurant' => 'casa_leopoldo.jpg',
            'average_price' => 75,
            'phone' => '+34 933 018 489',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 26,
            'zones_id' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Espai Kru by Rías de Galicia',
            'description' => 'Especializado en mariscos y pescados en su versión cruda o ligeramente cocinada, con una influencia japonesa y mediterránea.',
            'location' => '41.375582, 2.179190',
            'img_restaurant' => 'espai_kru.jpg',
            'average_price' => 150,
            'phone' => '+34 933 416 297',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 27,
            'zones_id' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'Suculent',
            'description' => 'Cocina de autor con raíces en la gastronomía tradicional, con platos reinventados con técnicas modernas.',
            'location' => '41.378906, 2.164151',
            'img_restaurant' => 'suculent.jpg',
            'average_price' => 85,
            'phone' => '+34 933 185 671',
            'opening_hours' => '13:00',
            'closing_hours' => '15:30',
            'manager_id' => 28,
            'zones_id' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Restaurant::create([
            'name' => 'El Quim de la Boqueria',
            'description' => 'Un clásico dentro del mercado de la Boqueria, famoso por su cocina de mercado con productos frescos y tapas elaboradas.',
            'location' => '41.380329, 2.169443',
            'img_restaurant' => 'el_quim_boqueria.jpg',
            'average_price' => 45,
            'phone' => '+34 933 184 059',
            'opening_hours' => '08:00',
            'closing_hours' => '15:30',
            'manager_id' => 29,
            'zones_id' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
    }
}
