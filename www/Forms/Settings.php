<?php
namespace App\Forms;

use App\Models\Page as PageModel;
use App\Models\Tag as TagModel;
use App\Models\Status as StatusModel;
class Settings
{
    public static function getConfig(): array
    {
        $page = new PageModel();
        $statusModel = new StatusModel();
        $status = $statusModel->getOneBy(["status"=>"Publié"], 'object');
        $statusId = $status->getId();
        $pages = $page->getAllDataWithWhere(["status_id"=>$statusId], 'object');
        $formattedPages = [];
        $formattedPages[] = ["id"=>"Projetcs", "name"=>"Tous les projets"];
        $formattedPages[] = ["id"=>"Users", "name"=>"Tous les utilisateurs"];
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $formattedPages[] = [
                    "id" => $page->getId(),
                    "name" => $page->getTitle(),
                ];
            }
        }
        $tag = new TagModel();
        $tags = $tag->getAllData('object');
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $formattedPages[] = [
                    "id" => $tag->getId(),
                    "name" => $tag->getName(),
                ];
            }
        }

        $timezones = \DateTimeZone::listIdentifiers();
        $timezone = [];
        $timezone[] = ["id"=>"défaut", "name"=>"Défaut"];
        if (!empty($timezones)) {
        foreach ($timezones as $singleTimezone) {
            $timezone[] = [
            "id" => strtolower($singleTimezone),
            "name" => $singleTimezone,
            ];
        }
        } else {
        $timezone[] = [
            "id" => '0',
            "name" => 'Aucune timezone',
            "selected" => true,
        ];
        }

        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "submit" => "Enregistrer"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 255,
                    "label" => "Titre du site",
                    "required" => true,
                    "error" => "Le nom du site est requis et dois faire entre 2 et 255 caractères",
                    "part" => "Information du site web"
                ],
                "slogan" => [
                    "type" => "text",
                    "max" => 500,
                    "label" => "Slogan",
                    "error" => "Le slogan doit faire entre 2 et 500 caractères"
                ],
                "site_description" => [
                    "type" => "text",
                    "label" => "Description du site",
                    "required" => true,
                    "error" => "La description du site est obligatoire"
                ],
                "timezone" => [
                    "type" => "select",
                    "label" => "Fuseau horaire",
                    "option" => $timezone,
                ], 
                "homepage" => [
                    "type" => "select",
                    "label" => "Page d'accueil",
                    "option" => $formattedPages,
                    "error" => "La page d'accueil est requise"
                ]
            ]
        ];
    }
}