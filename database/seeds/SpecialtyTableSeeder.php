<?php

use Illuminate\Database\Seeder;

/**
 * Class SpecialtyTableSeeder
 *
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class SpecialtyTableSeeder extends Seeder
{
    protected $specialties = [
        'Anatomia Patológica',
        'Anestesiologia',
        'Angiologia e Cirurgia Vascular',
        'Cardiologia',
        'Cardiologia Pediátrica',
        'Cirurgia Cardiotorácica',
        'Cirurgia Geral',
        'Cirurgia Maxilo-Facial',
        'Cirurgia Pediátrica',
        'Cirurgia Plástica Reconstrutiva e Estética',
        'Dermato-Venereologia',
        'Doenças Infecciosas',
        'Endocrinologia e Nutrição',
        'Estomatologia',
        'Gastrenterologia',
        'Genética Médica',
        'Ginecologia/Obstetrícia',
        'Imunoalergologia',
        'Imunohemoterapia',
        'Farmacologia Clínica',
        'Hematologia Clínica',
        'Medicina Desportiva',
        'Medicina do Trabalho',
        'Medicina Física e de Reabilitação',
        'Medicina Geral e Familiar',
        'Medicina Interna',
        'Medicina Legal',
        'Medicina Nuclear',
        'Medicina Tropical',
        'Nefrologia',
        'Neurocirurgia',
        'Neurologia',
        'Neurorradiologia',
        'Oftalmologia',
        'Oncologia Médica',
        'Ortopedia',
        'Otorrinolaringologia',
        'Patologia Clínica',
        'Pediatria',
        'Pneumologia',
        'Psiquiatria',
        'Psiquiatria da Infância e da Adolescência',
        'Radiologia',
        'Radioncologia',
        'Reumatologia',
        'Saúde Pública',
        'Urologia',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->truncate();

        DB::table('specialties')->insert(array_map(function ($name) {
            return [
                'name' => $name,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ];
        }, $this->specialties));
    }
}
